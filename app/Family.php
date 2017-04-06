<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model{

    protected $table='familiars';
   
    protected $fillable = [        
        'first_name',
        'last_name',
        'deceased',
        'ocupation',
        'dateBirth',
        'email',
        'home_phone',
        'movil_phone',
        'id_state',
        'id_user',
    ];

   

    protected function User(){
        return $this->belongsTo('App\User');
    }

    protected function State(){
        return $this->belongsTo('App\State');
    }
}
