<?php

namespace App\Http\Controllers;

use App\Medication;
use App\Http\Requests\CreateMedication;
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
    public function store(CreateMedication $request)
    {
        $now = Carbon::now('utc')->toDateTimeString();
        $this->authorize('create', Medication::class);
        // we can receive multiple medications, so they need to all be
        // validated. Stat is a checkbox, so it's either true or null.
        $meds = $request->input('meds.*');
        foreach ($meds as &$med) {
            if (!isset($med['stat'])) {
                $med['stat'] = false;
            }
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
    public function update(Request $request, $id)
    {
        $med = Medication::findOrFail($id);
        $request->validate([
            'name' => 'required|string',
            'dosage_amount' => 'required|numeric',
            'dosage_unit' => 'required|string',
            'instructions' => 'required|string',
            'comments' => 'string|nullable',
            'stat' => 'boolean|nullable'
        ]);
        $data = $request->all();
        if (!isset($data['stat'])) {
            $data['stat'] = false;
        }
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
     * Verify the given medication by its name and dosage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'dosage' => 'required|numeric',
            'units' => 'required|string',
        ]);
        try {
            $med = Medication::where([
                'name' => $request->input('name'),
                'dosage_amount' => $request->input('dosage'),
                'dosage_unit' => $request->input('units')
            ])->firstOrFail();
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
}
