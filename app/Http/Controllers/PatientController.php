<?php

namespace App\Http\Controllers;

use App\Lab;
use App\Order;
use App\Patient;
use App\Http\Requests;
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
        $this->authorize('create', Patient::class);
        return view('admin.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreatePatient $request)
    {
        Patient::create($request->all());
        return redirect('/home');
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
        $patient = Patient::findOrFail($id);
        $this->authorize('update', $patient);
        return view('admin.patient.edit', ['patient' => $patient]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdatePatient $request, $id)
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
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $this->authorize('delete', $patient);
        $patient->delete();
        return redirect()->back();
    }

    /**
     * Attempts to verify a patient based on its id.
     *
     * This is used for both QR and barcode verification, as QR and barcodes
     * will both contain the patient's MRN.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Requests\VerifyPatient $request)
    {
        // check if MRN is null first, we'll return a special error
        if ($request->input('medical_record_number') === null) {
            return response()->json([
                'status' => 'error',
                'data' => 'Missing MRN for this patient',
            ]);
        }
        try {
            // Just look with the MRN; if it's there we get a match, if it
            // isn't then the code was bad or the patient isn't there.
            $patient = Patient::where('medical_record_number',
                $request->input('medical_record_number'))->firstOrFail();
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
