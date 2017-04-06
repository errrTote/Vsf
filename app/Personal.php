<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model{


    protected $fillable = [
        'id',
        'birth_date',
        'home_phone',
        'movil_phone',
        'gender',
        'permanent_postal_code',
        'permanent_address',
        'permanent_city',
        'birth_city',
        'residence_postal_code',
        'residence_address',        
        'residence_city',
        'id_user',
        'id_permanent_state',
        'id_residence_state',
        'id_birth_state',
         
    ];

    protected function User(){
        return $this->belongsTo('App\User');
    }

    protected function State(){
        return $this->belongsTo('App\State');
    }

    protected function Familiars(){
        return $this->hasMany('App\Family');
    }

    protected function Educations(){
        return $this->hasMany('App\Education');
    }

    protected function Awards(){
        return $this->hasMany('App\Award');
    }





    
}
