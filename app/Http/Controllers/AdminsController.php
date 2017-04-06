<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\adminsRequest;
use App\Http\Requests;
use App\Admins;
use Laracasts\Flash\Flash;
use Hash;

use App\Log;

use DB;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $admins = DB::table('admins')->orderBy('admins.id', 'ASC')->paginate(5);
        
        return view('admin.admins.index')
            ->with('admins', $admins);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        
        return view('admin.admins.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(adminsRequest $request){
        
        $pass=auth('admins')->user()->password;
        if (Hash::check($request->adminPassword, $pass)){
            if(preg_match('/(?=[a-z])/', $request->password)){
                if(preg_match('/(?=[A-Z])/', $request->password)){            
                    if(preg_match('/(?=[0-9])/',$request->password)){

                        $admin = new Admins($request->all());           

                        $admin->password=bcrypt($request->password); 
                       
                        $admin->save();

                        //Registro en el historial
                        $datalog['id_user'] = auth('admins')->user()->id;
                        $datalog['action'] = 'Record';
                        $datalog['description'] = 'New admin User: '. $admin->id;

                        $log = new Log($datalog);
                        $log -> save();  

                        if (Session('applocale')=='es')
           
                            Flash::success('Registro de nuevo usuario administrador completo!');
                        else
                            Flash::success('New admin user registration completed!');

                        return redirect()->route('adm.admins.index');
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
        }
        else{
            if (Session('applocale')=='es')
           
                Flash::error('Debe ingresar la contraseña de administrador!');
            else
                Flash::error('You must enter the administrator password!');

            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $admin  = Admins::find($id); 
        return view('admin.admins.edit')->with('admin', $admin);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $pass=auth('admins')->user()->password;
        if (Hash::check($request->adminPassword, $pass)){
            $admin = Admins::find($id);   
               
            $admin->fill($request->all());                
            $admin->save();

            //Registro en el historial
              $datalog['id_user'] = auth('admins')->user()->id;
              $datalog['action'] = 'Updated';
              $datalog['description'] = 'Admin user: '.$id;

              $log = new Log($datalog);
              $log -> save();  

            if (Session('applocale')=='es')
           
                Flash::success('Datos de usuario administrador modificados correctamente');
            else
                Flash::success('Admin user data changed successfully');

            return redirect('adm/admins');

          
        }
        else{
            if (Session('applocale')=='es')
           
                Flash::error('Debe ingresar la contraseña de administrador!');
            else
                Flash::error('You must enter the administrator password!');

            return redirect();
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
        $admin = Admins::find($id);
        $admin->delete();

        //Registro en el historial
          $datalog['id_user'] = auth('admins')->user()->id;
          $datalog['action'] = 'Deleted';
          $datalog['description'] = 'Admin user: '. $id;

          $log = new Log($datalog);
          $log -> save();  

        if(Session('applocale')=='es')
            Flash::success('Administrador eliminado correctamente' );
        else
            Flash::success('Admin successfully deleted' );

        return redirect('adm/admins');
    }

    public function getAdminInfo($id){
      $admin = Admins::find($id);
      return $admin;
    }

   
}
