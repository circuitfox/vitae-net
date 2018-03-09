<?php

namespace App\Http\Requests;

use App\Patient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VerifyPatient extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // medical_record_number is actually required, but we want to send our
        // own error status, not Laravel's, so we'll let it slide here.
        return [
            'medical_record_number' => 'numeric|nullable',
            'last_name' => 'string|nullable',
            'first_name' => 'string|nullable',
            'date_of_birth' => 'string|nullable',
            'sex' => 'boolean|nullable',
            'height' => 'string|nullable',
            'weight' => 'string|nullable',
            'diagnosis' => 'string|nullable',
            'allergies' => 'string|nullable',
            'code_status' => [
                'nullable',
                Rule::in(Patient::CODE_STATUSES),
            ],
            'physician' => 'string|nullable',
            'room' => 'string|nullable',
        ];
    }
}
