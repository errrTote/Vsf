@extends('layouts.admin')

@if(Session('applocale')=='es')

    @section('title', 'Ensayo')
@else
    @section('title', 'Essay')
@endif

@section('content')

	<div class="container-fluid">                
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="jumbotron">
                    <div class="panel-heading">
                        <h3>                        
                            {{trans('text.infoEssay')}}
                        </h3>
                       
                    </div>
        
                    <div class="panel-body">       
                        {!! Form::open(['route'=>'essays.store', 'method' => 'POST', 'files' => true]) !!}     			
                        
                            {{ csrf_field() }}
												

                            <div class="container-fluid">  
								<div class="row">
									<h4 class="separador">{{trans('text.question')}}</h4>									
								</div>	

	                            <div class="col-md-12">
	                               <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                   tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                   consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                   cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                   proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</h4>                            		
	                            </div> 
                            </div><!--container-fluid-->
                            <div class="container-fluid">
                                

                                <div class="row">
                                    <h4 class="separador">{{trans('text.infoEssay')}}</h4>                                 
                                </div>
                                <div class="col-md-12">
                                    <input type="file" name="essay" id="Ensayo" title="{{trans('text.title-essay')}}" >
                                </div>
                            </div>
                           
                            <input type="hidden" name="id_user" value="{{Session('user_id') }}">
                         	<div class="container-fluid">                
                                <div class="row buttons">
                                     <div class="col-md-5 col-sm-4 col-xs-12">
                                        <a href="{{ url('adm/users')}}" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-arrow-left"></span> {{trans('text.back')}}
                                        </a>
                                    </div>
                                    <div class="col-md-5 col-sm-4 col-sm-offset-2 col-xs-12">
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

@endsection()