<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'medical_record_number');
    }
}
