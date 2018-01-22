<?php

namespace App\Http\Requests;

use App\Medication;
use Illuminate\Foundation\Http\FormRequest;

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
        // input names are like <input name="meds[0][name]">
        return [
            'meds.*.name' => 'required|string',
            'meds.*.dosage_amount' => 'required|numeric',
            'meds.*.dosage_unit' => 'required|string',
            'meds.*.instructions' => 'required|string',
            'meds.*.comments' => 'string|nullable',
        ];
    }
}
