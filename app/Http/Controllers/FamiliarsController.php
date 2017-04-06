<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\familiarRequest;

use App\Family;

use Laracasts\Flash\Flash;

use DB;

use App\Country;

use App\CountryEN;

use App\Log;

use Validator;

class FamiliarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        if(Session('applocale')=='es')
            $countries=Country::lists('name','id'); 
        else
            $countries=CountryEN::lists('name','id'); 
        return view('familiars.create')->with('countries', $countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(familiarRequest $request){

        $validator = Validator::make($request->all(),[
           'first_name.*' => 'required|alpha',
            'last_name.*' => 'required|alpha',
            'relationship.*' => 'required|alpha',
            'ocupation.*' => 'required|alpha',
            'dateBirth.*' => 'required',
            'id_state.*' => 'required',
            'email.*' => 'required|email',
            'home_phone.*' => 'required|numeric',
            'movil_phone.*' => 'required|numeric',
            ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $deceased=[$_POST['deceased_a'], $_POST['deceased_b']];

        for ($i=0; $i < count($_POST['first_name']); $i++) { 
            
            $family = new Family();               
            
            $family->__SET('first_name',  $_POST['first_name'][$i]);
            $family->__SET('last_name',   $_POST['last_name'][$i]);
            $family->__SET('deceased',    $deceased[$i]);
            $family->__SET('relationship',       $_POST['relationship'][$i]);
            $family->__SET('ocupation',    $_POST['ocupation'][$i]);
            $family->__SET('dateBirth',    $_POST['dateBirth'][$i]);
            $family->__SET('email',        $_POST['email'][$i]);
            $family->__SET('home_phone',    $_POST['home_phone'][$i]);
            $family->__SET('movil_phone',    $_POST['movil_phone'][$i]);
            $family->__SET('id_state',    $_POST['id_state'][$i]);
            $family->__SET('id_user',     Session('user_id'));
                
           $family->save();
       } 

        //Registro en el historial
        $datalog['id_user'] = $request->id_user;
        $datalog['action'] = 'Record';
        $datalog['description'] = 'Familiar data';
        $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';
        
        $log = new Log($datalog);
        $log -> save();

        if(Session('applocale')=='es')
        
            Flash::success('Datos familiares guardados');
        else
            Flash::success('Saved family data');

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        if (Session('user_id')==$id) {
        
            if(Session('applocale')=='es')
                $countries=Country::lists('name','id'); 
            else
                $countries=CountryEN::lists('name','id'); 
            
            $familiars = DB::table('familiars')->where('id_user', $id)->get();
            foreach ($familiars as $family) {
               
                $states[] = DB::table('familiars')->join('states', 'states.id', '=', 'familiars.id_state')->where('familiars.id_state', '=', $family->id_state)->get();
            }
            foreach ($states as $state) {
                
                $country_selected[] = DB::table('countries')->where('id', '=', $state[0]->id_country)->first();
               
            }
            
            return view('familiars.edit')
                    ->with('familiars', $familiars)
                    ->with('states', $states)
                    ->with('country_selected', $country_selected)
                    ->with('countries', $countries);
        }
        else
            return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(familiarRequest $request, $id){ 
        $validator = Validator::make($request->all(),[
           'first_name.*' => 'required|alpha',
            'last_name.*' => 'required|alpha',
            'relationship.*' => 'required|alpha',
            'ocupation.*' => 'required|alpha',
            'dateBirth.*' => 'required',
            'id_state.*' => 'required',
            'email.*' => 'required|email',
            'home_phone.*' => 'required|numeric',
            'movil_phone.*' => 'required|numeric',
            ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        if (Session('user_id')==$id) {
            $deceased=[$_POST['deceased_a'], $_POST['deceased_b']];                

            for ($i=0; $i < 2; $i++) { 
                
            $family = Family::find($request->id[$i]);                       
                
                $family->first_name =  $request->first_name[$i];
                $family->last_name  =  $request->last_name[$i];
                $family->deceased   =  $deceased[$i];
                $family->relationship      =  $request->relationship[$i];
                $family->ocupation   =  $request->ocupation[$i];
                $family->dateBirth   =  $request->dateBirth[$i];
                $family->email       =  $request->email[$i];
                $family->home_phone       =  $request->home_phone[$i];
                $family->movil_phone       =  $request->movil_phone[$i];
                $family->id_state   =  $request->id_state[$i];           
                

                $family->save();        
            } 

            //Registro en el historial
            $datalog['id_user'] = $request->id_user;
            $datalog['action'] = 'Updated';
            $datalog['description'] = 'Familiar data';
            $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';
            
            $log = new Log($datalog);
            $log -> save();   

            if(Session('applocale')=='es')
                Flash::success('Datos de familiares modificado correctamente' );
            else
                Flash::success('Correctly modified family data');

            return redirect('/');
        }
        else
            return back();
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
}
