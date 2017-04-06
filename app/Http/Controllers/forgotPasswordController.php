<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Mail;

use DB;

use App\User;


use Laracasts\Flash\Flash;

class forgotPasswordController extends Controller
{
    /**
     * Display a form to send password.
     *
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request){

        $user = DB::table('users')
                    ->where('email', '=', $request->email)
                    ->first();
        $user = User::find($user->id);
        $password=substr(md5(uniqid()), 0, 10); 
        $user->__SET('password',  bcrypt($password));
        
        $user->save();
                    
        //Envio de correo
       Mail::send('emails.password', ['user' => $user, 'password' => $password], function($mensaje) use ($user){
            $mensaje->from('account@venezuelanscholarshipfund.org', 'VSF Profile');
            $mensaje->to($user->email, $user->first_name)->subject('Reset password');
        });

       if (Session('applocale')=='es')
           
            Flash::success('Le hemos enviado a su correo la nueva contraseña para ingresar');
        else
            Flash::success('We have sent to your email the new password');

        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
