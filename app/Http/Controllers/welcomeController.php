<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use Laracasts\Flash\Flash;

use Response;

use Validator;

use Auth;

use App\State;
use App\Country;
use App\Personal;
use App\Education;
use App\Family;
use App\Award;


class welcomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       
    }


    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(){
    if(Auth::user()){
      $user = DB::table('users')->where('id', Auth::user()->id)->first();

      $personal     = DB::table('personals')->where('id_user', Auth::user()->id)->first();
      if (isset($personal)) {
       
        $permanent_state   = DB::table('states')->where('id', '=', $personal->id_permanent_state)->first();
        $residence_state   = DB::table('states')->where('id', '=', $personal->id_residence_state)->first();
        $birth_state       = DB::table('states')->where('id', '=', $personal->id_birth_state)->first();
        $permanent_country = DB::table('countries')->where('id', '=', $permanent_state->id_country)->first();
        $residence_country = DB::table('countries')->where('id', '=', $residence_state->id_country)->first();
        $birth_country     = DB::table('countries')->where('id', '=', $birth_state->id_country)->first(); 
      }
      

      $educations   = DB::table('educations')->where('id_user', Auth::user()->id)->orderBy('period', 'ASC')->get(); 

      if (isset($educations)) {
       
        foreach ($educations as $education) {
             
          $states[] = DB::table('educations')->join('states', 'states.id', '=', 'educations.id_state')->where('educations.id_state', '=', $education->id_state)->get();
        }

        if (isset($states)) {
          foreach ($states as $state) {
                
            $country_selected[] = DB::table('countries')->where('id', '=', $state[0]->id_country)->first();
               
          }
        }
      }

      $familiars  = DB::table('familiars')->where('id_user', Auth::user()->id)->get();
      if (isset($familiars)) {
         
        foreach ($familiars as $family) {
           
            $familiars_states[] = DB::table('familiars')->join('states', 'states.id', '=', 'familiars.id_state')->where('familiars.id_state', '=', $family->id_state)->get();
        }
        if (isset($familiars_states)) {
          foreach ($familiars_states as $family_state) {
              
              $familiars_country_selected[] = DB::table('countries')->where('id', '=', $family_state[0]->id_country)->first();
          }
        }
      }
         

      $awards       = DB::table('awards')->where('id_user', Auth::user()->id)->get();
      $essay        = DB::table('essay')->where('id_user', Auth::user()->id)->first();
    }

      if(!isset($user))
          $user=NULL;

      if(!isset($user))
          $user=NULL;
      if(!isset($personal))
          $personal=NULL;
      if(!isset($permanent_state))
          $permanent_state=NULL;
      if(!isset($residence_state))
          $residence_state=NULL;
      if(!isset($birth_state))
          $birth_state=NULL;
      if(!isset($permanent_country))
          $permanent_country=NULL;
      if(!isset($residence_country))
          $residence_country=NULL;
      if(!isset($birth_country))
          $birth_country=NULL;      
      if(!isset($educations))
          $educations=NULL;
      if(!isset($states))
          $states=NULL;
      if(!isset($country_selected))
          $country_selected=NULL;
      if(!isset($familiars))
          $familiars=NULL;
      if(!isset($familiars_states))
          $familiars_states=NULL;
      if(!isset($familiars_country_selected))
          $familiars_country_selected=NULL;
      if(!isset($awards))
          $awards=NULL;
      if(!isset($essay))
        $essay=NULL;

      return view('welcome')
              ->with('user', $user)
              ->with('personal', $personal)                
              ->with('permanent_state', $permanent_state)
              ->with('residence_state', $residence_state)
              ->with('birth_state', $birth_state)
              ->with('permanent_country', $permanent_country)
              ->with('residence_country', $residence_country)
              ->with('birth_country', $birth_country)              
              ->with('educations', $educations)
              ->with('states', $states)
              ->with('country_selected', $country_selected)
              ->with('familiars', $familiars)
              ->with('familiars_states', $familiars_states)
              ->with('familiars_country_selected', $familiars_country_selected)
              ->with('awards', $awards)
              ->with('essay', $essay);
                
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $edit){

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function download($url){  

        return Response::download('librerias/essays/'.$url);
    }

    public function add($id, $add) {

      
    }
}
