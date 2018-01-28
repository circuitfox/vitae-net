<?php

namespace App\Http\Requests;

use App\Medication;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VerifyMedication extends FormRequest
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
        return [
            'name' => 'required|string',
            'dosage_amount' => 'required|numeric',
            'dosage_unit' => 'required|string',
            'secondary_name' => 'string|nullable',
            'second_amount' => 'numeric|nullable',
            'second_unit' => 'string|nullable',
            'second_type' => [
                'nullable',
                Rule::in(Medication::SECOND_TYPES),
            ],
        ];
    }
}
