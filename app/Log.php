<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model{
    protected $table = 'log';

    protected $primaryKey = 'id_entry';

    protected $fillable = [
    	'action',
    	'id_user',
    	'description',
    	'created_at',
    	'updated_at',
    ];
}
