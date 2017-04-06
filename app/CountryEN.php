<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryEN extends Model{

	protected $table='countriesen';

    protected $fillable = ['name'];

    public function States(){
        return $this->hasMany('App\State');
    }
   
}
