<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
  protected $fillable = ['name', 'decription', 'patient_id'];
  public $timestamps = false;

  public function patient()
  {
      return $this->belongsTo('App\Patient');
  }
}
