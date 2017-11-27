<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'medical_record_number';
    protected $fillable = [
      'medical_record_number', 'last_name', 'first_name',
      'date_of_birth', 'sex', 'physician', 'room',
    ];

    public function toApiArray()
    {
        return [
            'mrn' => $this->medical_record_number,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'dob' => $this->date_of_birth,
            'sex' => $this->sex ? 'male' : 'female',
            'physician' => $this->physician,
            'room' => $this->room,
        ];
    }
}
