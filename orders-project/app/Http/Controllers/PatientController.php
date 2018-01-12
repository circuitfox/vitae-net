<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Lab;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
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

      // create a new patient using the form data
      $patient = new \App\Patient;
      $patient->MRN = request('MRN');
      $patient->fname = request('fname');
      $patient->lname = request('lname');
      $patient->DOB = request('DOB');
      $patient->sex = request('sex');
      $patient->height = request('height');
      $patient->weight = request('weight');
      $patient->diagnosis = request('diagnosis');
      $patient->allergies = request('allergies');
      $patient->physician = request('physician');
      $patient->code_status = request('code_status');

      // save it to the database
      $patient->save();

      // redirect to index page
       return redirect()->route('patients.index')->with('message','Patient has been added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {

      $labs = Lab::where('patient_id', $patient->id)->get();
      $orders = Order::where('patient_id', $patient->id)->where('completed', 1)->get();
      $pendings = Order::where('patient_id', $patient->id)->where('completed', 0)->get();

      return view('patients.show', compact('patient', 'labs', 'orders', 'pendings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
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
        $patient = Patient::find($id);
        $patientUpdate = $request->all();
        $patient->update($patientUpdate);
        return redirect()->route('patients.index')->with('message','Patient has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('message','Patient has been deleted successfully');
    }
}
