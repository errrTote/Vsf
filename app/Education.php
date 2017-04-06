<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model{

    protected $table='educations';
    
    protected $fillable = [        
        'career',
        'name',
        'type',
        'period',
        'address',
        'city',
        'notes',
        'sat',
        'toefl',
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
