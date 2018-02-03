<?php

namespace App\Http\Controllers;

use App\Lab;
use App\Order;
use App\Patient;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

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
        return view('patients.create');
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
            'date_of_birth' => 'required|string',
            'sex' => 'required|boolean',
            'physician' => 'required|string',
            'room' => 'required|string',
        ]);
        $data = $request->all();
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
        $patient = Patient::findOrFail($id);
        $labs = Lab::where('patient_id', $patient->medical_record_number)->get();
        $orders = Order::where('patient_id', $patient->medical_record_number)->get();
        return view('admin.patient', [
            'patient' => $patient,
            'labs' => $labs,
            'orders' => $orders,
        ]);
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
            'date_of_birth' => 'required|string',
            'sex' => 'required|boolean',
            'physician' => 'required|string',
            'room' => 'required|string',
        ]);
        $data = $request->all();
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
            'mrn' => 'numeric|nullable'
        ]);
        try {
            // Because of how codes scan, the verification routine must do the
            // following:
            // - If we have an MRN, search using that only; if it's in the
            //   database, we'll get a match
            // - Otherwise, search using the first and last names and the date
            //   of birth. The first and last names might not be in order,
            //   though, so we'll check both ways.
            $patient = Patient::when($request->input('mrn'), function($query) use ($request) {
                return $query->where('medical_record_number', $request->input('mrn'));
            }, function ($query) use ($request) {
                return $query->where([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'date_of_birth' => $request->input('dob')
                ])->orWhere([
                    'first_name' => $request->input('last_name'),
                    'last_name' => $request->input('first_name'),
                    'date_of_birth' => $request->input('dob')
                ]);
            })->firstOrFail();
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
