<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = ['name', 'decription', 'patient_id', 'completed'];
  public $timestamps = false;

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
