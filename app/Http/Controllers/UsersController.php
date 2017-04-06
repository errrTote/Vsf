<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\userRequest;

use Laracasts\Flash\Flash;

use App\User;

use Mail;

use DB;

use App\Log;

use Auth;

class UsersController extends Controller
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
        
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(userRequest $request){
        
        $user = new User($request->all());   

        $password=substr(md5(uniqid()), 0, 10); 
        $user->password=$password;       

        //Envio de correo
       Mail::send('emails.emails', ['user' => $user], function($mensaje) use ($user){
            $mensaje->from('account@venezuelanscholarshipfund.org', 'VSF Profile');
            $mensaje->to($user->email, $user->name)->subject('Prueba envio');
        });

        $user->password=bcrypt($password);
        $user->save();
        
        $users = DB::table('users')->get();
        $lastId=0;
        foreach ($users as $user) {
            if($user->id > $lastId)
                $lastId = $user->id;
        }

        //Registro en el historial
        $datalog['id_user'] = $lastId;
        $datalog['action'] = 'Record';
        $datalog['description'] = 'New User';
        $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';
        
        $log = new Log($datalog);
        $log -> save();


        if (Session('applocale')=='es')
           
            Flash::success('Registro exitoso! Le hemos enviado a su correo las credenciales para ingresar');
        else
            Flash::success('Successful registration! We have sent you a email with the credentials to enter');

        return redirect()->route('login');
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
        
            $user = User::find($id);
            
            return view('users.edit')->with('user', $user);
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
    public function update(Request $request, $id){
        if (Session('user_id')==$id) {
       
            $user = User::find($id);   
           
            $user->fill($request->all());                
            $user->save();

            //Registro en el historial
            $datalog['id_user'] = $user->id;
            $datalog['action'] = 'Updated';
            $datalog['description'] = 'User data';
            $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';
            
            $log = new Log($datalog);
            $log -> save();

            if (Session('applocale')=='es')
           
            Flash::success('Datos de usuario modificados correctamente');
        else
            Flash::success('Correctly modified user data');
        
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

    public function changePassword(Request $request){
        if(Auth::user()->id == $request->id_user){

            if(preg_match('/(?=[a-z])/', $request->password)){
                if(preg_match('/(?=[A-Z])/', $request->password)){            
                    if(preg_match('/(?=[0-9])/',$request->password)){
                        if($request->password == $request->password_b){

                            $user = User::find($request->id_user);           

                            $user->password=bcrypt($request->password); 
                           
                            $user->save();

                            //Registro en el historial
                            $datalog['id_user'] = Auth::user()->id;
                            $datalog['action'] = 'Updated';
                            $datalog['description'] = 'His password';

                            $log = new Log($datalog);
                            $log -> save();  

                            if (Session('applocale')=='es')
               
                                Flash::success('Moficiación de contraseña completa!');
                            else
                                Flash::success('Password modified correctly!');

                            return redirect()->route('welcome');
                        }
                        else{
                            if (Session('applocale')=='es')
               
                                Flash::error('La contraseñas deben coincidir!');
                            else
                                Flash::error('The passwords must be same!');

                            return back();
                        } 
                    }
                    else{
                        if (Session('applocale')=='es')
           
                            Flash::error('La contraseña debe poseer al menos un numero!');
                        else
                            Flash::error('The password must have at least one number!');

                        return back();
                    } 
                }else{
                    if (Session('applocale')=='es')
           
                        Flash::error('La contraseña debe poseer al menos una letra mayuscula!');
                    else
                        Flash::error('The password must have at least one uppercase letter!');

                    return back();
                }
            }else{
                if (Session('applocale')=='es')
           
                    Flash::error('La contraseña debe poseer al menos una letra minuscula!');
                else
                    Flash::error('Password must have at least one lowercase letter!');

                return back();
            }
        }else
            return back();
    }       
    
}
