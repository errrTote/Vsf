<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model{
    
    protected $fillable = [
        'id',
        'title',
        'date',
        'description',
        'id_user',
    ];
}
