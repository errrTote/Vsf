@extends('layouts.adminindex')

@if(Session('applocale')=='es')
	@section('title', 'Administrador')
@else
	@section('title', 'Admin')
@endif

@section('content')
	<div class="container-fluid">
    <div class="well">
        <h2>{{trans('text.welcomeH2')}} <small>{{ $user->first_name}} {{$user->last_name }}</small> </h2>
        <h4>{{trans('text.infoAdmin')}}</h4>
    </div>
  </div>
@endsection()