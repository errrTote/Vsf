<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\State;

use DB;

class StatesController extends Controller
{
   public function getStates(Request $request, $id){
        if($request->ajax()){
        	$states = DB::table('states')->where('id_country', $id)->get();        	
            return response()->json($states);
        }
    }
}
