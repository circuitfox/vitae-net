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
        $medication = Medication::find($this->route('medication'));
        return $this->user()->can('update', $medication);
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
            'dosage_amount' => 'numeric|nullable',
            'dosage_unit' => 'string|nullable',
            'secondary_name' => 'string|nullable',
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
