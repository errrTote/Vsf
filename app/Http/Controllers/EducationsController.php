<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\educationRequest;

use App\Country;

use App\CountryEN;

use Laracasts\Flash\Flash;

use App\Education;

use DB;

use App\Log;

use Auth;

use Response;

use Validator;

class EducationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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

        $education = DB::table('educations')
                    ->where('id_user' ,'=', Auth::user()->id)
                    ->first();
        return view('educations.create')
                ->with('countries', $countries)
                ->with('education', $education);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(educationRequest $request){ 

        $validator = Validator::make($request->all(),[
            'career'   => 'min:4|',
            'name'     => 'required|min:8|',        
            'period'   => 'required|min:9|',
            'address'  => 'required|min:8|',
            'city'     => 'required|min:3|',
            'id_state' => 'required',
            ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }       
            
        $education = new Education($request->all());  

        if($request->file('notes')){   
            $user = DB::table('users')->where('id', Session('user_id'))->first();              
                     
            $file = $request->file('notes');
            $name = 'user_notes.' . $file->getClientOriginalExtension();
            $path = 'librerias/users/'.$user->id.'-' .$user->first_name.'_'.$user->last_name.'_docs';
            $original_name=$file->getClientOriginalName();
            $file->move($path, $name);
            $education->notes=$name;
        }

        if($request->file('sat')){   
            $user = DB::table('users')->where('id', Session('user_id'))->first();              
                     
            $file = $request->file('sat');
            $name = 'user_sat.' . $file->getClientOriginalExtension();
            $path = 'librerias/users/'.$user->id.'-'.$user->first_name.'_'.$user->last_name.'_docs';
            $original_name=$file->getClientOriginalName();
            $file->move($path, $name);
            $education->sat=$name;
        }

        if($request->file('toefl')){   
            $user = DB::table('users')->where('id', Session('user_id'))->first();              
                     
            $file = $request->file('toefl');
            $name = 'user_toefl.' . $file->getClientOriginalExtension();
            $path = 'librerias/users/'.$user->id.'-'.$user->first_name.'_'.$user->last_name.'_docs';
            $original_name=$file->getClientOriginalName();
            $file->move($path, $name);
            $education->toefl=$name;
        }

        $education->save();

        //Registro en el historial
        $datalog['id_user'] = $request->id_user;
        $datalog['action'] = 'Record';
        $datalog['description'] = 'Education data';
        $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';
        
        $log = new Log($datalog);
        $log -> save();
        
        if(Session('applocale')=='es')
            Flash::success('Datos académicos guardados');            

        else
            Flash::success('Saved academic data');

        
        return redirect('/');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
        $educations = DB::table('educations')
                        ->where('id_user', Session('user_id'))
                        ->orderBy('period', 'ASC')
                        ->get(); 
        
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

        if($educations == Null){
            return back();
        }

        
                
        if(Session('applocale')=='es')
            $countries=Country::lists('name','id'); 
        else
            $countries=CountryEN::lists('name','id'); 

        return view('educations.show')            
            ->with('states', $states)
            ->with('countries', $countries)
            ->with('educations', $educations)
            ->with('country_selected', $country_selected);
        
    }

    public function add($id) {
        if (Session('user_id')==$id) {
            $countries=Country::lists('name','id'); 
            return view('educations.add')->with('countries', $countries);
        }
        else
            return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_education){
       $education = DB::table('educations')->where('id', '=', $id_education)->first();

       $state = DB::table('educations')->join('states', 'states.id', '=', 'educations.id_state')
                        ->where('educations.id_state', '=', $education->id_state)
                        ->first();
                    

                   
                        
        $country_selected = DB::table('countries')
                                ->where('id', '=', $state->id_country)
                                ->first();

        if(Session('applocale')=='es')
            $countries=Country::lists('name','id'); 
        else
            $countries=CountryEN::lists('name','id'); 

       return view('educations.edit')
                ->with('state', $state)
                ->with('countries', $countries)
                ->with('country_selected', $country_selected)
                ->with('education', $education);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(educationRequest $request, $id_education){
        $validator = Validator::make($request->all(),[
            'career'   => 'min:4|',
            'name'     => 'required|min:8|',        
            'period'   => 'required|min:9|',
            'address'  => 'required|min:8|',
            'city'     => 'required|min:3|',
            'id_state' => 'required',
            ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }     

        $education = Education::find($id_education);          
        if (Session('user_id')==$education->id_user) {
            $education->fill($request->all());
            $education->save(); 

            //Registro en el historial
            $datalog['id_user'] = $education->id_user;
            $datalog['action'] = 'Updated';
            $datalog['description'] = 'Education data';
            $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';
            
            $log = new Log($datalog);
            $log -> save();       
             
            if(Session('applocale')=='es')
                Flash::success('Infomacion academica modificada correctamente');            

            else
                Flash::success('Modified');

            return redirect()->route('educations.show', $education->id_user);
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
    public function destroy($id_education){
        $education = Education::find($id_education);
        $education -> delete();

        if(Session('applocale')=='es')
                Flash::success('Infomacion academica eliminada correctamente');            

        else
            Flash::success('Deleted academic information');

        return redirect('/');
    }

    public function downloadScore($url){
        //Registro en el historial
        $datalog['id_user'] = Auth::user()->id;
        $datalog['action'] = 'Download';
        $datalog['description'] = $url;
        $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';

        $log = new Log($datalog);
        $log -> save();
        
        return Response::download('librerias/users/'.Auth::user()->id.'-'.Auth::user()->first_name.'_'.Auth::user()->last_name.'_docs/'.$url);
    }

    public function downloadSat($url){
        //Registro en el historial
        $datalog['id_user'] = Auth::user()->id;
        $datalog['action'] = 'Download';
        $datalog['description'] = $url;
        $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';

        $log = new Log($datalog);
        $log -> save();
        
        return Response::download('librerias/users/'.Auth::user()->id.'-'.Auth::user()->first_name.'_'.Auth::user()->last_name.'_docs/'.$url);
    }

    public function downloadToefl($url){
        //Registro en el historial
        $datalog['id_user'] = Auth::user()->id;
        $datalog['action'] = 'Download';
        $datalog['description'] = $url;
        $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';

        $log = new Log($datalog);
        $log -> save();
        
        return Response::download('librerias/users/'.Auth::user()->id.'-'.Auth::user()->first_name.'_'.Auth::user()->last_name.'_docs/'.$url);
    }
}
