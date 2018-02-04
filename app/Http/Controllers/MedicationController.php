<?php

namespace App\Http\Controllers;

use App\Medication;
use App\Http\Requests;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MedicationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['verify']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.medications', ['medications' => Medication::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Medication::class);
        return view('admin.medications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Request\CreateMedication  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateMedication $request)
    {
        $now = Carbon::now('utc')->toDateTimeString();
        $meds = $request->input('meds.*');
        // We need to set timestamps for all of these, as insert won't do it for
        // us.
        foreach ($meds as &$med) {
            if (isset($med['secondary_name'])) {
                $med['name'] = $this->joinNames($med['name'], $med['secondary_name']);
            }
            unset($med['secondary_name']);
            $med['created_at'] = $now;
            $med['updated_at'] = $now;
        }
        Medication::insert($meds);
        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.medication', ['medication' => Medication::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.medication.edit', ['medication' => Medication::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateMedication $request, $id)
    {
        $med = Medication::findOrFail($id);
        $data = $request->all();
        if (isset($data['secondary_name'])) {
            $data['name'] = $this->joinNames($data['name'], $data['secondary_name']);
        }
        unset($data['secondary_name']);
        $med->update($data);
        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Medication::destroy($id);
        return redirect()->back();
    }

    /**
     * Verify the given medication by its attribues.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Requests\VerifyMedication $request)
    {
        try {
            $data = $request->all();
            if (isset($data['secondary_name'])) {
                $data['name'] = $this->joinNames($data['name'], $data['secondary_name']);
            }
            unset($data['secondary_name']);
            $med = Medication::where($data)->firstOrFail();
            return response()->json([
                'status' => 'success',
                'data' => $med->toApiArray()
            ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'status' => 'error',
                'data' => $ex->getMessage()
            ]);
        }
    }

    /**
     * Join two names for storage in the Medication model.
     *
     * @param string $name The first name to join
     * @param string $secondary_name The second name to join
     */
    private function joinNames(string $name, string $secondary_name)
    {
        return $name . Medication::NAME_SEPARATOR . $secondary_name;
    }
}
