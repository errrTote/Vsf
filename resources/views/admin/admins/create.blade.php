@extends('layouts.admin')

@if(Session('applocale')=='es')
    @section('title', 'Registrar Administrador')

@else
    @section('title', 'New admin')

@endif

@section('content')

	<div class="container-fluid">                
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="jumbotron">
                    <div class="panel-heading">
                        <h3>                        
                            {{trans('text.newAdminTitle')}}
                        </h3>
                        <h5>{{trans('text.requiredC')}}</h5>
                    </div>
        
                    <div class="panel-body">            			
                       <form class="form-horizontal" role="form" method="POST" action="{{ route('adm.admins.store') }}">
                             {{ csrf_field() }}
                          
                             <div class="pswd_info" hidden>
                                <h5>{{trans('text.passRequiredTitle')}}</h5>
                                <ul>
                                    <li class="letter">{{trans('text.atLeast')}}<strong> {{trans('text.letter')}}</strong></li>

                                    <li class="capital">{{trans('text.atLeast')}}<strong> {{trans('text.capitalLetter')}}</strong></li>

                                    <li class="number">{{trans('text.atLeast')}}<strong> {{trans('text.number')}}</strong></li>

                                    <li class="length"><strong> {{trans('text.eightCharacter')}}</strong> {{trans('text.asMinimum')}}</li>
                                </ul>
                            </div>

                            <div class="pswd_info_b" hidden>
                                <h5>{{trans('text.passRequiredTitle')}}</h5>
                                <ul>
                                    <li class="equality"><strong>{{trans('text.samePassword')}}</strong> {{trans('text.previousPass')}}</li>                         
                                </ul>
                            </div> 
                            <div class="container-fluid">                
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="nombre" class="control-label ">{{trans('text.names')}}</label>                                                                           
                                    </div>
                                    <div class="col-md-6">                                        
                                        <input type="text" class="form-control" name="first_name" id="{{trans('text.firstName')}}" value="{{ old('first_name') }}" required pattern="[A-Za-zñÑÁÉÍÓÚáéíóú]{3,16}" title="{{trans('text.title-adminFirstName')}}">  
                                    </div>
                                    <div class="col-md-6">                                        
                                        <input type="text" class="form-control" name="middle" id="{{trans('text.secondName')}}" value="{{ old('middle') }}" pattern="[A-Za-zñÑÁÉÍÓÚáéíóú]{3,16}" title="{{trans('text.title-adminSecondName')}}">  
                                    </div>                                    
                                </div>
                            </div>
                            <div class="container-fluid">                
                                <div class="row">
                                    <div class="col-md-12">                         
                                        <label for="apellido" class="control-label">{{trans('text.surnames')}}</label>
                                    </div>
                                    <div class="col-md-6">                                        
                                        <input type="text" class="form-control" name="last_name" id="{{trans('text.firstSurname')}}" value="{{ old('last_name') }}" required pattern="[A-Za-zñÑÁÉÍÓÚáéíóú]{3,16}" title="{{trans('text.title-adminFirstSurname')}}">                
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name_mother" id="{{trans('text.secondSurname')}}" value="{{ old('name_mother') }}" pattern="[A-Za-zñÑÁÉÍÓÚáéíóú]{3,16}" title="{{trans('text.title-adminSecondSurname')}}">  
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid">                
                                <div class="row">
                                    <div class="col-md-6">                         
                                        <label for="password" class="control-label">{{trans('text.password')}}</label>
                                    </div>
                                    <div class="col-md-6">                         
                                        <label for="password" class="control-label">{{trans('text.confirmPassword')}}</label>
                                    </div>

                                    <div class="col-md-6">                                        
                                        <input type="password" class="form-control pswd" name="password" id="{{trans('text.password')}}" required pattern="[A-Za-zñÑÁÉÍÓÚáéíóú0-9]{8,32}" title="{{trans('text.title-password')}}">                
                                    </div>


                                    <div class="col-md-6">
                                        <input type="password" class="form-control repswd" name="repasword" id="{{trans('text.confirmPassword')}}"  pattern="[A-Za-zñÑÁÉÍÓÚáéíóú0-9{8,32}" title="{{trans('text.title-confirmPassword')}}">  
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid">                
                                <div class="row">
                                    <div class="col-md-12">                                           
                                        <label for="email" class="control-label ">{{trans('text.email')}}</label>
                                           
                                        <input type="email" class="form-control" name="email" id="Correo" value="{{ old('email') }}" required title="{{trans('text.title-userEmail')}}">
                                         
                                    </div>  
                                </div>  
                            </div>  

                            <div class="container-fluid">                
                                <div class="row">
                                    <div class="col-md-12">                                           
                                        <label for="password_admin" class="control-label ">{{trans('text.adminPassword')}}</label>
                                           
                                        <input type="password" class="form-control" name="adminPassword" id="{{trans('text.adminPassword')}}" required pattern="[A-Za-zñÑÁÉÍÓÚáéíóú0-9{8,32}" title="{{trans('text.title-adminPassword')}}Ingrese su contraseña para guardar los cambios">
                                         
                                    </div>  
                                </div>  
                            </div>  
                           
                            <div class="container-fluid">                
                                <div class="row buttons">
                                      <div class="col-md-3 col-sm-3">
                                        
                                        <a href="{{ url('adm/admins')}}" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-arrow-left"></span> {{trans('text.back')}}
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-md-offset-4 col-sm-3 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{trans('text.save')}}
                                        </button>
                                    </div>
                                </div>
                            </div>  
                    </div><!--panel-body-->             
                </div><!--jumbotron-->
            </div><!--col-md-->           
        </div><!--row-->
    </div><!--container-fluid-->

@endsection
