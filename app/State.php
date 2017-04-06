<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model{

    protected $table='states';

    protected $fillable = ['name','id_country'];

    public function Country(){
        return $this->belongsTo('App\Country');
    }

    public function Personals(){
        return $this->hasMany('App\Personal');
    }

    public function Familiars(){
        return $this->hasMany('App\Family');
    }

    public function Educations(){
        return $this->hasMany('App\Education');
    }

    public static function state($id){
        return State::where('state_id', "=", $id)->get();
    }
}
