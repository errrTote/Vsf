<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class logsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $logs = DB::table('log AS l')
                ->select('id_entry','email', 'action', 'description', 'l.created_at as date')
                ->join('users AS u', 'u.id', '=', 'id_user' )                
                ->orderBy('id_entry', 'DESC')
                ->get();
        $logsAdmins = DB::table('log AS l')
                ->join('admins AS a', 'id', '=', 'id_user')
                ->select('id_entry','email', 'action', 'description', 'l.created_at as date')
                ->orderBy('l.id_entry', 'DESC')
                ->get();
        return view('admin.logs.index')
                ->with('logs', $logs)
                ->with('logsAdmins', $logsAdmins);
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
