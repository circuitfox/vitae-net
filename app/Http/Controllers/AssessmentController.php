<?php

namespace App\Http\Controllers;

use App\Assessment;
use App\Patient;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AssessmentController extends Controller
{
    /**
     * Index all assessments for a given patient by date. Values passed to view
     * are of the form:
     */
    public function index(Request $request, $id)
    {
        $this->authorize('index', Assessment::class);
        $patient = Patient::findOrFail($id);
        $assessments = Assessment::byDate($patient)
            ->mapWithKeys(function ($assessment, $date) {
                $date = new Carbon($date);
                return [$date->toFormattedDateString() => $assessment];
            });
        return view('admin.assessments', [
            'patient' => $patient,
            'assessments' => $assessments,
        ]);
    }
    
    /**
     * Update an assessment if it exists or create a new one.
     */
    public function update(Requests\UpdateAssessment $request)
    {
        $data = $request->all();
        if (!isset($data['automatic'])) {
            $data['automatic'] = false;
        }
        if ($request->session()->has('assessment')) {
            // update an existing assessment
            $assessment = Assessment::findOrFail($request->session()->get('assessment'));
            $assessment->update($data);
            return back();
        } else {
            // create a new assessment
            $assessment = Assessment::create($data);
            $request->session()->put('assessment', $assessment->id);
            return back();
        }
    }
}
