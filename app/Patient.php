<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'medical_record_number';
    protected $fillable = [
      'medical_record_number', 'last_name', 'first_name',
      'date_of_birth', 'sex', 'height',
      'weight', 'diagnosis', 'allergies',
      'code_status', 'physician', 'room',
    ];

    public const CODE_STATUSES = ['FULL CODE', 'DNR', 'DNI'];

    public function toApiArray()
    {
        return [
            'medical_record_number' => $this->medical_record_number,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'date_of_birth' => $this->date_of_birth,
            'sex' => $this->sex ? 'Male' : 'Female',
            'height' => $this->height,
            'weight' => $this->weight,
            'diagnosis' => $this->diagnosis,
            'allergies' => $this->allergies,
            'code_status' => $this->code_status,
            'physician' => $this->physician,
            'room' => $this->room,
        ];
    }
}
