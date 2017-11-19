<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public $incrementing = false;
    protected $fillable = [
      'medical_record_number', 'last_name', 'first_name',
      'date_of_birth', 'sex', 'physician', 'room',
    ];
}
