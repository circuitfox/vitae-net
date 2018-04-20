<?php

namespace App\Http\Requests;

use App\Lab;
use Illuminate\Foundation\Http\FormRequest;

class CreateLab extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Lab::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'doc' => 'required|mimetypes:application/pdf',
            'patient_id' => 'integer|exists:patients,medical_record_number|nullable',
        ];
    }
}
