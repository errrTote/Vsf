@extends('layouts.main')

@section('title', 'Ensayo')

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
									<h4 class="separador"> {{trans('text.question')}}</h4>									
								</div>	

	                            <div class="col-md-12">
	                               <h4> {{trans('text.detailQuestion')}}</h4>                            		
	                            </div> 
                            </div><!--container-fluid-->
                            <div class="container-fluid">                               

                                <div class="row">
                                    <h4 class="separador"> {{trans('text.navEssay')}}</h4>                                 
                                </div>
                                <div class="col-md-12">
                                    <input type="file" name="essay" id=" {{trans('text.navEssay')}}" title=" {{trans('text.title-essay')}}" value="show">
                                </div>
                            </div>
                           
                            <input type="hidden" name="id_user" value="{{Session('user_id') }}">
                         	<div class="container-fluid">                
                                <div class="row buttons">
                                     <div class="col-md-5 col-sm-4 col-xs-12">
                                        <a href="{{ url('/')}}" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-arrow-left"></span>  {{trans('text.back')}}
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