<?php

namespace App\Http\Requests;

use App\Signature;
use Illuminate\Foundation\Http\FormRequest;

class CreateSignature extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Signature::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'medical_record_number' => 'required|integer|exists:patients,medical_record_number',
            'medications.*.medication_id' => 'required|integer|exists:medications,medication_id',
            'medications.*.comments' => 'string|nullable',
            'student_name' => 'required|string',
            'time' => 'required|string',
            'comments' => 'string|nullable',
        ];
    }
}
