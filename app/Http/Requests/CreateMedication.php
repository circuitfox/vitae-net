<?php

namespace App\Http\Requests;

use App\Medication;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateMedication extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Medication::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // input names are of the form <input name="meds[x][field]">,
        // and they encode to 'meds.x.field'
        return [
            'meds.*.name' => 'required|string',
            'meds.*.dosage_amount' => 'required|numeric',
            'meds.*.dosage_unit' => 'required|string',
            'meds.*.secondary_name' => 'string|nullable',
            'meds.*.second_amount' => 'numeric|nullable',
            'meds.*.second_unit' => 'string|nullable',
            'meds.*.second_type' => [
                'nullable',
                Rule::in(Medication::SECOND_TYPES),
            ],
            'meds.*.comments' => 'string|nullable',
        ];
    }
}
