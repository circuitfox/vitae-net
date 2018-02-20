<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    protected $primaryKey = ['medical_record_number', 'medication_id'];
    public $timestamps = false;
    protected $fillable = [
      'medical_record_number', 'medication_id', 'time',
       'student_name',
    ];

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'medical_record_number');
    }

    public function medication()
    {
        return $this->belongsTo('App\Medication', 'medication_id');
    }
}
