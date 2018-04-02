<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ROLES = ['admin', 'instructor', 'student'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'reset_password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin() {
        if ($this->role === 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public function isInstructor() {
        if ($this->role === 'instructor') {
            return true;
        } else {
            return false;
        }
    }
}
