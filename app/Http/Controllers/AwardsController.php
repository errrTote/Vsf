<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Laracasts\Flash\Flash;

use App\Award;

use App\Log;

use DB;

use Validator;

class AwardsController extends Controller
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
        return view('awards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            
            'title.*'        => 'required|min:6|max:50',
            'description.*'  => 'required|min:6|max:200',
            'date.*'         => 'required|date',           
            'id_user'        => 'unique:awards'
            ],[
                'id_user' => 'Ya posee algun premio o reconocimiento registrados'
            ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        for ($i=0; $i < count($_POST['title']); $i++) { 
            
            $award = new Award();               
            
            $award->__SET('title',        $_POST['title'][$i]);
            $award->__SET('date',         $_POST['date'][$i]);
            $award->__SET('description',  $_POST['description'][$i]);          
            $award->__SET('id_user',      Session('user_id'));
                
            
           $award->save();
       } 

        //Registro en el historial
        $datalog['id_user'] = $request->id_user;
        $datalog['action'] = 'Record';
        $datalog['description'] = 'Award data';
        $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';
        
        $log = new Log($datalog);
        $log -> save();
       
        if (Session('applocale')=='es')
           
            Flash::success('Premios y reconocimientos guardados');
        else
            Flash::success('Registered');

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
            $awards = DB::table('awards')->where('id_user', $id)->get();
            return view('awards.edit')->with('awards', $awards);
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

            for ($i=0; $i < count($request->id); $i++) { 
                
                $award = Award::find($request->id[$i]);  
                $award->title       =  $request->title[$i];
                $award->date        =  $request->date[$i];
                $award->description =  $request->description[$i];           

                $award->save();        
            } 

            //Registro en el historial
            $datalog['id_user'] = $request->id_user;
            $datalog['action'] = 'Updated';
            $datalog['description'] = 'Award data';
            $datalog['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';
            
            $log = new Log($datalog);
            $log -> save();   

            if(Session('applocale')=='es')

                Flash::success('Premios y reconocimientos modificado correctamente' );
            else
                Flash::success('Awards and recognitions correctly modified');

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
