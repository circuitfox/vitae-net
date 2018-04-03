<?php

namespace App\Http\Requests;

use App\MarEntry;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMarEntry extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $marEntry = MarEntry::find($this->route('mar'));
        return $this->user()->can('update', $marEntry);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'medication_id' => 'required|integer|exists:medications,medication_id',
            'stat' => 'boolean|nullable',           
            'instructions' => 'required|string',
            'given_at.*' => 'boolean|nullable',
        ];
    }
}
