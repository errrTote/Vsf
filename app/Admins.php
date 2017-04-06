<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model{

    protected $table='admins';
    
    protected $fillable = [
        'id',
        'first_name',
        'middle',
        'last_name',
        'name_mother',
        'email',
        'password',
    ];
}
