<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = ['name', 'description', 'patient_id', 'completed'];
  public $timestamps = false;

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id');
    }
}
