<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'verify']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.patients', ['patients' => Patient::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'medical_record_number' => 'required|numeric|unique:patients',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'sex' => 'required|boolean',
            'physician' => 'required|string',
            'room' => 'required|string',
        ]);
        $data = $request->all();
        $data['date_of_birth'] = Carbon::parse($data['date_of_birth'])->format('Y-m-d');
        Patient::create($data);
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
        return view('admin.patient', ['patient' => Patient::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.patient.edit', ['patient' => Patient::findOrFail($id)]);
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
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'sex' => 'required|boolean',
            'physician' => 'required|string',
            'room' => 'required|string',
        ]);
        $data = $request->all();
        $data['date_of_birth'] = Carbon::parse($data['date_of_birth'])->format('Y-m-d');
        Patient::findOrFail($id)->update($data);
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
        Patient::destroy($id);
        return redirect()->back();
    }

    /**
     * Attempts to verify a patient based on its name, date of birth, and id.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'dob' => 'required|string',
            'mrn' => 'required|numeric'
        ]);
        try {
            $patient = Patient::where([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'date_of_birth' => $request->input('dob'),
                'medical_record_number' => $request->input('mrn'),
            ])->firstOrFail();
            return response()->json([
                'status' => 'success',
                'data' => $patient->toApiArray()
            ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'status' => 'error',
                'data' => $ex->getMessage()
            ]);
        }
    }
}
