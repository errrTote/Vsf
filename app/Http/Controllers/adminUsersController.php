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
use App\User;
use App\Log;


class adminUsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = DB::table('users')->orderBy('users.id', 'ASC')->paginate(5);
        
        return view('admin.users.index')
            ->with('users', $users);
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

      if($request->store==='university'){

        for ($i=0; $i < count($_POST['name']); $i++) { 
              
          $education = new Education();      
             
          $education->__SET('career',    $_POST['career'][$i]);
          $education->__SET('name',      $_POST['name'][$i]);
          $education->__SET('type',      $_POST['type'][$i]);
          $education->__SET('period',    $_POST['period'][$i]);
          $education->__SET('address',   $_POST['address'][$i]);
          $education->__SET('city',      $_POST['city'][$i]);
          $education->__SET('id_state',  $_POST['id_state'][$i]);
          $education->__SET('id_user',   $_POST['id_user']);
  
          
          $education->save();
        }

        //Registro en el historial
          $datalog['id_user'] = auth('admins')->user()->id;
          $datalog['action'] = 'Stored';
          $datalog['description'] = 'Education to the user: '. $education->id_user;

          $log = new Log($datalog);
          $log -> save(); 

        if (Session('applocale')=='es')
           
          Flash::success('Datos academicos guardados');
         else
          Flash::success('Saved academic data');

        return redirect('adm/users');
      }
    if ($request->store==='award') {
      $validator = Validator::make($request->all(),[          
          'title.*'        => 'required|min:6|max:50',
          'description.*'  => 'required|min:6|max:200',
          'date.*'         => 'required|date'
          
          ],[
              'id_user' => 'Ya posee premios o reconocimientos registrados'
          ]);

      if($validator->fails()){
          return back()->withInput()->withErrors($validator);
      }

      for ($i=0; $i < count($_POST['title']); $i++) { 
          
          $award = new Award();               
          
          $award->__SET('title',        $_POST['title'][$i]);
          $award->__SET('date',         $_POST['date'][$i]);
          $award->__SET('description',  $_POST['description'][$i]);          
          $award->__SET('id_user',      $_POST['id_user']);
              
          
         $award->save();
      }

      //Registro en el historial
          $datalog['id_user'] = auth('admins')->user()->id;
          $datalog['action'] = 'Stored';
          $datalog['description'] = 'Award to the user: '. $award->id_user;

          $log = new Log($datalog);
          $log -> save();  

      if (Session('applocale')=='es')
           
        Flash::success('Premios y reconocimientos guardados');
      else
        Flash::success('Awards & recognitions saved');

      return redirect('adm/users');
    }
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
      $user         = DB::table('users')->where('id', $id)->first();
      $personal     = DB::table('personals')->where('id_user', $id)->first();
      if (isset($personal)) {
      
        $permanent_state   = DB::table('states')->where('id', '=', $personal->id_permanent_state)->first();
        $residence_state   = DB::table('states')->where('id', '=', $personal->id_residence_state)->first();
        $birth_state       = DB::table('states')->where('id', '=', $personal->id_birth_state)->first();
        $permanent_country = DB::table('countries')->where('id', '=', $permanent_state->id_country)->first();
        $residence_country = DB::table('countries')->where('id', '=', $residence_state->id_country)->first();
        $birth_country     = DB::table('countries')->where('id', '=', $birth_state->id_country)->first(); 
      }

      $high_school  = DB::table('educations')->where('id_user', $id)->first();
      if (isset($high_school)) {
       
        $high_school_state = DB::table('educations')->join('states', 'states.id', '=', 'educations.id_state')->where('educations.id_state', '=', $high_school->id_state)->first();
        $high_school_country_selected = DB::table('countries')->where('id', '=', $high_school_state->id_country)->first();
      }

      $educations   = DB::table('educations')->where('id_user', $id)->where('type', 'h')->get(); 
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

      $familiars  = DB::table('familiars')->where('id_user', $id)->get();
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
         

      $awards = DB::table('awards')->where('id_user', $id)->get();
      $essay  = DB::table('essay')->where('id_user', $id)->first();


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
      if(!isset($high_school))
          $high_school=NULL;
      if(!isset($high_school_state))
          $high_school_state=NULL;
      if(!isset($high_school_country_selected))
          $high_school_country_selected=NULL;
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

      return view('admin.users.show')
              ->with('user', $user)
              ->with('personal', $personal)                
              ->with('permanent_state', $permanent_state)
              ->with('residence_state', $residence_state)
              ->with('birth_state', $birth_state)
              ->with('permanent_country', $permanent_country)
              ->with('residence_country', $residence_country)
              ->with('birth_country', $birth_country)
              ->with('high_school', $high_school)
              ->with('high_school_state', $high_school_state)
              ->with('high_school_country_selected', $high_school_country_selected)
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

        if($edit==='personal'){

            $personal  = Personal::find($id);            
                      
            $permanent_state   = DB::table('states')->where('id', '=', $personal->id_permanent_state)->first();
            $residence_state   = DB::table('states')->where('id', '=', $personal->id_residence_state)->first();
            $birth_state       = DB::table('states')->where('id', '=', $personal->id_birth_state)->first();
            $permanent_country = DB::table('countries')->where('id', '=', $permanent_state->id_country)->first();
            $residence_country = DB::table('countries')->where('id', '=', $residence_state->id_country)->first();
            $birth_country = DB::table('countries')->where('id', '=', $birth_state->id_country)->first(); 
            
            $countries = Country::lists('name','id'); 
            return view('admin.personals.edit')
                    ->with('personal', $personal)
                    ->with('countries', $countries)
                    ->with('permanent_country', $permanent_country)
                    ->with('residence_country', $residence_country)
                    ->with('birth_country', $birth_country)
                    ->with('permanent_state', $permanent_state)
                    ->with('residence_state', $residence_state)
                    ->with('birth_state', $birth_state);
        }

        if($edit==='education'){

            $educations = DB::table('educations')->where('id_user', '=', $id)->get();
                
            foreach ($educations as $education) {
           
                $states[] = DB::table('educations')->join('states', 'states.id', '=', 'educations.id_state')->where('educations.id_state', '=', $education->id_state)->get();


                if ($education->type=="h") {            
                    $educations_h[] = $education;                 
                }
            }
            if (isset($states)) {
              foreach ($states as $state) {                
                  $country_selected[] = DB::table('countries')->where('id', '=', $state[0]->id_country)->first();
              }
            }
            
            $countries=Country::lists('name','id'); 
            return view('admin.educations.edit')
                    ->with('states', $states)
                    ->with('countries', $countries)
                    ->with('educations_h', $educations_h)
                    ->with('country_selected', $country_selected)
                    ->with('educations', $educations);
        }

        if($edit==='family'){

            $countries = Country::lists('name', 'id');
            $familiars = DB::table('familiars')->where('id_user', $id)->get();
            foreach ($familiars as $family) {
               
                $states[] = DB::table('familiars')->join('states', 'states.id', '=', 'familiars.id_state')->where('familiars.id_state', '=', $family->id_state)->get();
            }
            foreach ($states as $state) {
                
                $country_selected[] = DB::table('countries')->where('id', '=', $state[0]->id_country)->first();
               
            }
            
            return view('admin.familiars.edit')
                    ->with('familiars', $familiars)
                    ->with('states', $states)
                    ->with('country_selected', $country_selected)
                    ->with('countries', $countries);
        }

        if($edit==='award'){

            $awards = DB::table('awards')->where('id_user', $id)->get();
            return view('admin.awards.edit')->with('awards', $awards);
        }

        if($edit==='essay'){

            return view('admin.essays.create');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        if($request->update==='personal'){

          $personal = Personal::find($id);   
             
          $personal->fill($request->all()); 
          if($request->same_address){
            $personal->residence_address     = $personal->permanent_address;
            $personal->residence_city        = $personal->permanent_city;
            $personal->residence_postal_code = $personal->permanent_postal_code;
            $personal->id_residence_state    = $personal->id_permanent_state;           
          }                           
          $personal->save();

          //Registro en el historial
          $datalog['id_user'] = auth('admins')->user()->id;
          $datalog['action'] = 'Updated';
          $datalog['description'] = 'User personal data: '. $id;

          $log = new Log($datalog);
          $log -> save();

          if(Session('applocale')=='es')
            Flash::success('Datos personales modificado correctamente' );
          else
            Flash::success('Personal data correctly modified' );

          return redirect('adm/users');
        }
        
        if($request->update==='education'){
          for ($i=0; $i < count($request->id); $i++) { 
                
            $education = Education::find($request->id[$i]);          
            
            
            $education->career     =  $request->career[$i];
            $education->name       =  $request->name[$i];
            $education->type       =  $request->type[$i];
            $education->period     =  $request->period[$i];
            $education->address    =  $request->address[$i];  
            $education->city       =  $request->city[$i];  
            $education->id_state   =  $request->id_state[$i]; 
            
            $education->save();        
          } 

          //Registro en el historial
          $datalog['id_user'] = auth('admins')->user()->id;
          $datalog['action'] = 'Updated';
          $datalog['description'] = 'User education: '. $id;
          $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';

          $log = new Log($datalog);
          $log -> save();

          if(Session('applocale')=='es')
            Flash::success('Infomación academica modificada correctamente' );
          else
            Flash::success('Academic information modified correctly' );

          return redirect('adm/users');          
        }

        if($request->update==='family'){

          $deceased=[$_POST['deceased_a'], $_POST['deceased_b']];  
          $siblings=[$_POST['siblings'], $_POST['siblings']];  
              

          for ($i=0; $i < count($request->id); $i++) { 
              
          $family = Family::find($request->id[$i]);                       
              
              $family->first_name =  $request->first_name[$i];
              $family->last_name  =  $request->last_name[$i];
              $family->deceased   =  $deceased[$i];
              $family->title      =  $request->title[$i];
              $family->employer   =  $request->employer[$i];
              $family->industry   =  $request->industry[$i];
              $family->city       =  $request->city[$i];
              $family->siblings   =  $siblings[$i];
              $family->id_state   =  $request->id_state[$i];           
              

              $family->save();        
          } 

          //Registro en el historial
          $datalog['id_user'] = auth('admins')->user()->id;
          $datalog['action'] = 'Updated';
          $datalog['description'] = 'User familiars: '. $id;
          $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';

          $log = new Log($datalog);
          $log -> save();

          if(Session('applocale')=='es')
            Flash::success('Datos de familiares modificado correctamente' );
          else
            Flash::success('Family information correctly changed' );

          return redirect('adm/users');          

        }
        if($request->update==='award'){

          for ($i=0; $i < count($request->id); $i++) { 
              
            $award = Award::find($request->id[$i]);   
            
            $award->title       =  $request->title[$i];
            $award->date        =  $request->date[$i];
            $award->description =  $request->description[$i];           

            $award->save();        
          } 

          //Registro en el historial
          $datalog['id_user'] = auth('admins')->user()->id;
          $datalog['action'] = 'Updated';
          $datalog['description'] = 'User Awards: '. $id;
          $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';

          $log = new Log($datalog);
          $log -> save();

          if(Session('applocale')=='es')
            Flash::success('Premios y reconocimientos modificado correctamente' );
          else
            Flash::success('Prizes and awards successfully changed' );

          return redirect('adm/users');          

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
      $user = User::find($id);
      
      $user->delete();

      //Registro en el historial
        $datalog['id_user'] = auth('admins')->user()->id;
        $datalog['action'] = 'Delete';
        $datalog['description'] = 'User with id: '. $id ;
        $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';

        $log = new Log($datalog);
        $log -> save();

      if(Session('applocale')=='es')
            Flash::success('Usuario eliminado correctamente' );
          else
            Flash::success('User successfully deleted' );

       return redirect('adm/users');    

    }

    public function download($url){  
      //Registro en el historial
        $datalog['id_user'] = auth('admins')->user()->id;
        $datalog['action'] = 'Download';
        $datalog['description'] = $url;
        $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';

        $log = new Log($datalog);
        $log -> save();

        return Response::download('librerias/essays/'.$url);
    }

    public function add($id, $add) {

      if($add==='university'){
        
        $countries=Country::lists('name','id'); 
        return view('admin.educations.add')
              ->with('countries', $countries)
              ->with('id_user', $id); 
      }

      if($add==='award'){
        return view('admin.awards.add')          
          ->with('id_user', $id);
      }
    }

    public function getUserInfo($id){
      
      $user = User::find($id);
      return $user;
    }
}
