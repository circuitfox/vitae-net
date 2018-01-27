<?php

namespace App\Http\Requests;

use App\Medication;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMedication extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', Medication::class);
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
            'second_amount' => 'numeric|nullable',
            'second_unit' => 'string|nullable',
            'second_type' => [
                'nullable',
                Rule::in(Medication::SECOND_TYPES),
            ],
            'comments' => 'string|nullable',
        ];
    }
}
