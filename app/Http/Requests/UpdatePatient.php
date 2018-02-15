<?php

namespace App\Http\Requests;

use App\Patient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePatient extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $patient = Patient::find($this->route('patient'));
        return $patient && $this->user()->can('update', $patient);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|string',
            'sex' => 'required|boolean',
            'height' => 'string|nullable',
            'weight' => 'string|nullable',
            'diagnosis' => 'string|nullable',
            'allergies' => 'string|nullable',
            'code_status' => [
                'nullable',
                Rule::in(Patient::CODE_STATUSES),
            ],
            'physician' => 'required|string',
            'room' => 'required|string',
        ];
    }
}
