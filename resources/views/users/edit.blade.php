@extends('layouts.main')

@section('title', 'Usuario')

@section('content')
	<div class="container-fluid">                
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="jumbotron">
                    <div class="panel-heading">
                        <h3>
                            {{trans('text.editUserTitle')}}                     
                            
                        </h3>
                        <h5>{{trans('text.requiredA')}}<span class="nota">*</span> {{trans('text.requiredB')}}</h5>
                    </div>
        
                    <div class="panel-body">            			
                       {!! Form::open(['route'=>['users.update', $user], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
                            {{ csrf_field() }}
                            <div class="container-fluid">                
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="nombre" class="control-label ">{{trans('text.names')}}</label>                                                                           
                                    </div>
                                    <div class="col-md-12">                                        
                                        <input type="text" class="form-control" name="first_name" id="{{trans('text.firstName')}}" value="{{ $user->first_name }}" required pattern="[A-Za-zñÑÁÉÍÓÚáéíóú]{3,16}" title="{{trans('text.title-firstName')}}">  
                                    </div>                                                                   
                                </div>
                            </div>
                            <div class="container-fluid">                
                                <div class="row">
                                    <div class="col-md-12">                         
                                        <label for="apellido" class="control-label">{{trans('text.surnames')}}</label>
                                    </div>
                                    <div class="col-md-12">                                        
                                        <input type="text" class="form-control" name="last_name" id="{{trans('text.firstSurname')}}" value="{{ $user->last_name }}" required pattern="[A-Za-zñÑÁÉÍÓÚáéíóú]{3,16}" title="{{trans('text.title-firstSurname')}}">                
                                    </div>
                                   
                                </div>
                            </div>

                            <div class="container-fluid">                
                                <div class="row">
                                    <div class="col-md-12">                                           
                                        <label for="email" class="control-label ">{{trans('text.email')}}</label>
                                           
                                        <input type="email" class="form-control" name="email" id="{{trans('text.email')}}" value="{{ $user->email }}" required title="{{trans('text.title-email')}}">
                                        
                                    </div>  
                                </div>  
                            </div>  
                           
                            <div class="container-fluid">                
                                <div class="row buttons">
                                    <div class="col-md-3 col-sm-2 col-xs-11">
                                        <a href=" {{ url('adm/users') }}" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-arrow-left"></span> {{trans('text.back')}}
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-sm-2 col-xs-11">
                                        <button type="reset" class="btn btn-primary ">
                                            {{trans('text.reset')}} 
                                        </button>
                                    </div>
                                    <div class="col-md-3 col-sm-offset-1 col-md-offset-2 col-sm-2 col-xs-11">
                                        <button type="submit" class="btn btn-primary">
                                            {{trans('text.save')}} 
                                        </button>
                                    </div>
                                </div>
                            </div>            
                         {!! Form::close() !!}                
                    </div><!--panel-body-->             
                </div><!--jumbotron-->
            </div><!--col-md-->
        </div><!--row-->
    </div><!--container-fluid-->

@endsection