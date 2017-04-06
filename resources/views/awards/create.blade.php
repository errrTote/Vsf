@extends('layouts.main')

@section('title', 'Premios y reconocimientos')

@section('content')

	<div class="container-fluid">                
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="jumbotron">
                    <div class="panel-heading">
                        <h3>                        
                            {{trans('text.titleAward')}}
                        </h3>
                        <h5>{{trans('text.requiredA')}}<span class="nota">*</span>{{trans('text.requiredB')}}</h5>
                    </div>
        
                    <div class="panel-body">            			
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('awards.store') }}">
                            {{ csrf_field() }}
							<div class="copy">
								

	                            <div class="container-fluid new">  
									<div class="row">
										<h4 class="separador">{{trans('text.awardCount')}}</h4>
										
									</div>	
		                            <div class="col-md-6">
		                                <label for="Title" class="control-label ">{{trans('text.title')}}</label>	                          
		                                <input type="text" class="form-control " name="title[]" value="{{ old('title.0') }}" id="{{trans('text.title')}}" required pattern="[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s#.,-°]{6,50}" title="{{trans('text.title-titleAward')}}">	                            		
		                            </div>              

	                            	<div class="col-md-6">
	                                    <label for="date" class="control-label ">{{trans('text.date')}}</label>
	                                
	                                   <input type="text" class="form-control datepicker" id="{{trans('text.date')}}" name="date[]" required title="{{trans('text.title-dateAward')}}">
	                                </div> 


	                                <div class="col-md-12">
	                                	<label for="description" class="control-label">{{trans('text.description')}}</label>
	                                	<textarea name="description[]" class="form-control" value=" {{ old('description.0')}}" required id="{{trans('text.description')}}" pattern="[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s#.-°]{12,200}" title="{{trans('text.title-descriptionAward')}}"></textarea>                                	
	                                </div>
	                            </div><!--container-fluid-->
                            </div><!--copy-->
                            <div class="target">
                                <h5>{{trans('text.addAward')}}<button class="btn btn-primary add_award"><span class="glyphicon glyphicon-plus"></span> </button></h5>
                            </div>        
                         	<div class="container-fluid">                
                                <div class="row buttons">
                                     <div class="col-md-5 col-sm-4 col-xs-12">
                                        <a href="{{ url('/')}}" class="btn btn-primary">
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
                        </form>
                    </div><!--panel-body-->             
                </div><!--jumbotron-->
            </div><!--col-md-->            
        </div><!--row-->
    </div><!--container-fluid-->

@endsection()