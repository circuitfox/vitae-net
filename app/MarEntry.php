<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarEntry extends Model
{
    protected $table = 'mar_entries';
    protected $primaryKey = ['medical_record_number', 'medication_id'];
    public $timestamps = false;
    protected $fillable = [
      'medical_record_number', 'medication_id', 'stat',
       'instructions', 'given_at',
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
