<?php

namespace App\Http\Requests;

use App\Assessment;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAssessment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', Assessment::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'student_name' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'medical_record_number' => 'required|integer:exists:patients,medical_record_number',
            'reason' => 'required|string',
<<<<<<< HEAD
            'temperature' => 'required|numeric|digits:5',
=======
            'temperature' => 'required|decimal'
>>>>>>> 7a25de73d121c4217c8231bc957751ee0e96762b
            'bp_over' => 'required|integer',
            'bp_under' => 'required|integer',
            'apical_pulse' => 'required|integer',
            'respiration' => 'required|integer',
            'oximetry' => 'required|integer',
            'automatic' => 'boolean|nullable',
            'allergies' => 'string|nullable',
            'loc' => 'string|nullable',
            'orientation' => 'string|nullable',
            'speech' => 'string|nullable',
            'behavior' => 'string|nullable',
            'memory' => 'string|nullable',
            'pupillary' => 'string|nullable',
            'pain' => 'string|nullable',
            'skincolor' => 'string|nullable',
            'skintemp' => 'string|nullable',
            'hydration' => 'string|nullable',
            'integrity' => 'string|nullable',
            'dressings' => 'string|nullable',
            'ivsite' => 'string|nullable',
            'centrallines' => 'string|nullable',
            'heartrhythm' => 'string|nullable',
            'radial' => 'string|nullable',
            'capillary' => 'string|nullable',
            'upper' => 'string|nullable',
            'breathrhythm' => 'string|nullable',
            'cough' => 'string|nullable',
            'secretions' => 'string|nullable',
            'roomair' => 'string|nullable',
            'nausea' => 'string|nullable',
            'abdomen' => 'string|nullable',
            'bowel' => 'string|nullable',
            'stool' => 'string|nullable',
            'tubefeeding' => 'string|nullable',
            'genitourinary' => 'string|nullable',
            'motion' => 'string|nullable',
            'muscle' => 'string|nullable',
            'pedal' => 'string|nullable',
            'lower' => 'string|nullable',
            'peripheral' => 'string|nullable',
            'ted' => 'string|nullable',
            'restraints' => 'string|nullable',
            'drainage' => 'string|nullable',
            'activity' => 'string|nullable',
        ];
    }
}
