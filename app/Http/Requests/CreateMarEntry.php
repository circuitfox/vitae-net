<?php

namespace App\Http\Requests;

use App\MarEntry;
use Illuminate\Foundation\Http\FormRequest;

class CreateMarEntry extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', MarEntry::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mars.*.medication_id' => 'required|integer:exists:medication,medication_id',
            'mars.*.medical_record_number' => 'required|integer:patient,medical_record_number',
            'mars.*.stat' => 'boolean|nullable',           
            'mars.*.instructions' => 'required|string',
            'mars.*.given_at.*' => 'boolean|nullable',
        ];
    }
}
