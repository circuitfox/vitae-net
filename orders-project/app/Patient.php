<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
	protected $fillable = ['MRN', 'fname','lname','DOB','sex','height','weight','diangosis','allergies','physician','code_status'];

  public $timestamps = false; 

  public function orders()
 {
     return $this->hasMany('App\Order');
 }

// public function labs()
//{
//    return $this->hasMany('App\Lab);
//}
}
