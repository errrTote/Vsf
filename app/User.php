<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','first_name', 'last_name', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function Personal(){
        return $this->hasOne('App\Personal');
    }

    protected function Educations(){
        return $this->hasMany('App\Education');
    }

    protected function Familiars(){
        return $this->hasMany('App\Family');
    }

    protected function Essays(){
        return $this->hasMany('App\Essay');
    }
}
