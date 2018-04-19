<?php

namespace App\Http\Controllers;

use App\MarEntry;
use App\Medication;
use App\Patient;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MarEntryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($medical_record_number)
    {
        $this->authorize('create', MarEntry::class);
        $patient = Patient::find($medical_record_number);
        $meds = json_encode(Medication::all()->map(function ($med) {
            return $med->toMarArray();
        }));
        if ($patient === null) {
            // it's an error to try to make a MAR with an invalid MRN
            abort(400, 'No patient with this MRN exists');
        }
        return view('admin.mar.create', [
            'medical_record_number' => $medical_record_number,
            'meds' => $meds
        ]);
    }

    public function show($medical_record_number)
    {
        $patient = Patient::find($medical_record_number);
        $marEntries = MarEntry::where('medical_record_number', $patient->medical_record_number)->get();
        list($statMeds, $prescriptions) = $marEntries->partition(function($entry) {
            return $entry->stat;
        });
        $entryMeds = $marEntries->map(function($entry) {
            return $entry->medication->toMarArray();
        })->unique();
        $complete = session('complete.' . $patient->medical_record_number);
        if ($complete === null) {
            $complete = [];
        }
        return view('admin.mar', [
            'patient' => $patient,
            'prescriptions' => $prescriptions,
            'statMeds' => $statMeds,
            'meds' => $entryMeds,
            'complete' => $complete,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateMarEntry $request)
    {
        $mars = $request->input('mars.*');
        if (isset($mars)) {
            foreach ($mars as &$mar) {
                if (isset($mar['given_at'])) {
                    $mar['given_at'] = MarEntry::timesToInteger($mar['given_at']);
                } else {
                    $mar['given_at'] = 0;
                }
                if (!isset($mar['stat'])) {
                    $mar['stat'] = false;
                }
            }
        }
        MarEntry::insert($mars);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marEntry = MarEntry::findOrFail($id);
        $this->authorize('update', $marEntry);
        return view('admin.mar.edit', ['marEntry' => $marEntry]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateMarEntry $request, $id)
    {
        $mar = MarEntry::findOrFail($id);
        $data = $request->all();
        if (isset($data['given_at'])) {
            $data['given_at'] = MarEntry::timesToInteger($data['given_at']);
        } else {
            $data['given_at'] = 0;
        }
        if (!isset($data['stat'])) {
            $data['stat'] = false;
        }
        $mar->update($data);
        return back();
    }
}
