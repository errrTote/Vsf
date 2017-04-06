<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Essay;

use App\Log;

use Laracasts\Flash\Flash;

use DB;

use Auth;

use Response;

class EssaysController extends Controller
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
        return view('essays.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $essay = new Essay($request->all());


         if($request->file('essay')){   
            $user = DB::table('users')->where('id', Session('user_id'))->first(); 
             
                     
            $file = $request->file('essay');
            $name = 'essay_' . $request->id_user . '_' . $user->first_name .'_'.  $user->last_name .'.' . $file->getClientOriginalExtension();
            $path = 'librerias/users/'.$user->id.'-'.$user->first_name.'_'.$user->last_name.'_docs';
            $original_name=$file->getClientOriginalName();
            $file->move($path, $name);
            $essay->essay=$name;
            $essay->original_name=$original_name;
        }
            $essay->save();

            //Registro en el historial
            $datalog['id_user'] = $request->id_user;
            $datalog['action'] = 'Upload';
            $datalog['description'] = $name;
            $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';
            
            $log = new Log($datalog);
            $log -> save();

            if(Session('applocale')=='es')
                Flash::success('Ensayo Guardado' );
            else
                Flash::success('Essay saved' );
            
            return redirect('/');
    }

    public function download($url){
        //Registro en el historial
        $datalog['id_user'] = Auth::user()->id;
        $datalog['action'] = 'Download';
        $datalog['description'] = $url;
        $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';

        $log = new Log($datalog);
        $log -> save();
        
        return Response::download('librerias/essays/'.$url);
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
