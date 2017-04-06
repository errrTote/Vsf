<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\personalRequest;

use App\Http\Requests\updatePersonalRequest;

use App\Country;

use App\CountryEN;

use Laracasts\Flash\Flash;

use App\Personal;

use App\Log;

use DB;

use Auth;

use App\State;

use Validator;

class PersonalsController extends Controller
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
    public function create()
    {
        if(Session('applocale')=='es')
            $countries=Country::lists('name','id'); 
        else
            $countries=CountryEN::lists('name','id');  
       
        return view('personals.create')                
                ->with('countries', $countries);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(personalRequest $request){

        $validator = Validator::make($request->all(),[
            'gender'                => 'required',           
            'permanent_address'     => 'min:8|required',
            'permanent_city'        => 'min:3|required|alpha',
            'permanent_postal_code' => 'min:4|required|numeric',
            'id_permanent_state'    => 'required',
            'residence_address'     => 'min:8|',
            'residence_city'        => 'min:3|alpha',
            'residence_postal_code' => 'min:4|numeric',
            'birth_date'            => 'required|date',
            'birth_city'            => 'min:3|required',
            'id_birth_state'        => 'required',
            'home_phone'            => 'min:11|numeric',
            'movil_phone'           => 'min:11|numeric',
            'id_user'               => 'unique:personals'
            ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        
        $personal = new Personal($request->all());
        if($request->same_address){
            $personal->residence_address     = $personal->permanent_address;
            $personal->residence_city        = $personal->permanent_city;
            $personal->residence_postal_code = $personal->permanent_postal_code;
            $personal->id_residence_state    = $personal->id_permanent_state;           
        }            
        
        $personal->save();

        //Registro en el historial
        $datalog['id_user'] = $request->id_user;
        $datalog['action'] = 'Record';
        $datalog['description'] = 'Pernsonal data';
        $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';
        
        $log = new Log($datalog);
        $log -> save();

        if(Session('applocale')=='es')
            Flash::success('Datos personales guardados');            

        else
            Flash::success('Saved personal data');      
         
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
        
       
        $personal  = Personal::find($id); 
           
           
        if (Session('user_id')==$personal->id_user) {
                      
            $permanent_state   = DB::table('states')->where('id', '=', $personal->id_permanent_state)->first();
            $residence_state   = DB::table('states')->where('id', '=', $personal->id_residence_state)->first();
            $birth_state       = DB::table('states')->where('id', '=', $personal->id_birth_state)->first();
            $permanent_country = DB::table('countries')->where('id', '=', $permanent_state->id_country)->first();
            $residence_country = DB::table('countries')->where('id', '=', $residence_state->id_country)->first();
            $birth_country = DB::table('countries')->where('id', '=', $birth_state->id_country)->first(); 
            
            if(Session('applocale')=='es')
                $countries=Country::lists('name','id'); 
            else
                $countries=CountryEN::lists('name','id'); 
            
            return view('personals.edit')
                    ->with('personal', $personal)
                    ->with('countries', $countries)
                    ->with('permanent_country', $permanent_country)
                    ->with('residence_country', $residence_country)
                    ->with('birth_country', $birth_country)
                    ->with('permanent_state', $permanent_state)
                    ->with('residence_state', $residence_state)
                    ->with('birth_state', $birth_state);
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
    public function update(updatePersonalRequest $request, $id){
        $validator = Validator::make($request->all(),[
            'gender'                => 'required',           
            'permanent_address'     => 'min:8|max:120|required',
            'permanent_city'        => 'min:3|max:24|required|alpha',
            'permanent_postal_code' => 'min:4|required|numeric',
            'id_permanent_state'    => 'required',
            'residence_address'     => 'min:8|max:120',
            'residence_city'        => 'min:3|max:24|alpha',
            'residence_postal_code' => 'min:4|numeric',
            'birth_date'            => 'required|date',
            'birth_city'            => 'min:3|max:120|required',
            'id_birth_state'        => 'required',
            'home_phone'            => 'min:11|numeric',
            'movil_phone'           => 'min:11|numeric',
            ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $personal = Personal::find($id);   

        if (Session('user_id')==$personal->id_user) {
           
            $personal->fill($request->all());                
            $personal->save();

            //Registro en el historial
            $datalog['id_user'] = $personal->id_user;
            $datalog['action'] = 'Updated';
            $datalog['description'] = 'Pernsonal data';
            $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';
            
            $log = new Log($datalog);
            $log -> save();
            
            if(Session('applocale')=='es')
                Flash::success('Datos personales modificado correctamente.');            
            

            else
                Flash::success('Correctly modified personal data');
            
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
