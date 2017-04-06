<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Essay extends Model{
    protected $table='essay';
    
    protected $fillable = [        
        'id',        
        'essay',        
        'original_name',        
        'id_user',
    ];

    protected function User(){
        return $this->belongsTo('App\User');
    }

    
}
