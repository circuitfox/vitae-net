<?php

namespace App\Http\Requests;

use App\Lab;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLab extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $lab = Lab::find($this->route('lab'));
        return $this->user()->can('update', $lab);
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
            'doc' => 'nullable|mimetypes:application/pdf',
            'patient_id' => 'integer|exists:patients,medical_record_number|nullable',
        ];
    }
}
