@extends('layouts.main')
@if(Session('applocale')=='es')
    @section('title','Nuevo usuario')
@else
    @section('title','New user')
@endif

@if(Auth::user())
{!! redirect('/'); !!}
@endif
@section('content')
	<div class="container-fluid">                
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="jumbotron">
                    <div class="panel-heading">
                        <h3>                        
                            {{trans('text.registrationForm')}}
                        </h3>
                        <h5>{{trans('text.requiredC')}}</h5>
                    </div>
        
                    <div class="panel-body">            			
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('users.store') }}">
                            {{ csrf_field() }}
                            <div class="container-fluid">                
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="nombre" class="control-label ">{{trans('text.names')}}</label>                                                                           
                                    </div>
                                    <div class="col-md-12">                                        
                                        <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required pattern="[A-Za-zñÑÁÉÍÓÚáéíóú\s]{3,255}" title="{{trans('text.title-names')}}" for="Primer Nombre">  
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid">                
                                <div class="row">
                                    <div class="col-md-12">                         
                                        <label for="apellido" class="control-label">{{trans('text.surnames')}}</label>
                                    </div>
                                    <div class="col-md-12">                                        
                                        <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required pattern="[A-Za-zñÑÁÉÍÓÚáéíóú\s]{3,255}" title="{{trans('text.title-surnames')}}">                
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid">                
                                <div class="row">
                                    <div class="col-md-12">                                           
                                        <label for="email" class="control-label ">{{trans('text.email')}}</label>
                                           
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}"  title="{{trans('text.title-email')}}" required>
                                         <p class="help-block"></p>
                                    </div>  
                                </div>  
                            </div>  
                           
                            <div class="container-fluid">                
                                <div class="row buttons">
                                      <div class="col-md-3 col-sm-3">
                                        
                                        <a href="{{ url('/')}}" class="btn btn-primary">
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
                        </form>                       
                    </div><!--panel-body-->             
                </div><!--jumbotron-->
            </div><!--col-md-->
        </div><!--row-->
    </div><!--container-fluid-->
@endsection