<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $fillable = [
      'medication_id', 'name', 'dosage_amount', 'dosage_unit',
      'instructions', 'comments', 'stat',
    ];
}
