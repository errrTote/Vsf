@extends('layouts.main')

@if(Session('applocale')=='es')
    @section('title', 'Premios y reconocimientos')

@else
    @section('title', 'Awards and recognitions')
@endif

@section('content')

	<div class="container-fluid">                
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="jumbotron">
                    <div class="panel-heading">
                        <h3> {{trans('text.titleEditAward')}}</h3>
                        <h5>{{trans('text.requiredC')}}</h5>
                    </div>
        
                    <div class="panel-body">   
                        {!! Form::open(['route'=>['awards.update', Session('user_id')], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}         			
                        
                            {{ csrf_field() }}
							<div class="copy">
								
                                @foreach ($awards as $award)                                   

                                    <div class="container-fluid new">  
                                        <div class="row">
                                            <h4 class="separador">{{trans('text.awardCount')}}</h4>
                                            
                                        </div>  
                                        <div class="col-md-6">
                                            <input type="hidden" name="id[]" value="{{ $award->id }}">
                                            <label for="Title" class="control-label ">{{trans('text.title')}}</label>                              
                                            <input type="text" class="form-control " name="title[]" value="{{ $award->title }}" id="{{trans('text.title')}}" pattern="[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s#.-°]{6,32}" title="{{trans('text.title-titleAward')}}">                                      
                                        </div>              

                                        <div class="col-md-6">
                                            <label for="date" class="control-label ">{{trans('text.date')}}</label>
                                        
                                           <input type="text" class="form-control datepicker" id="{{trans('text.date')}}" name="date[]" value="{{ $award->date }}" required title="{{trans('text.title-dateAward')}}">
                                        </div> 


                                        <div class="col-md-12">
                                            <label for="description" class="control-label">{{trans('text.description')}}</label>
                                            <textarea name="description[]" class="form-control"  required id="{{trans('text.description')}}" pattern="[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s#.-°]{12,200}" title="{{trans('text.title-descriptionAward')}}">{{ $award->description }}</textarea>                                   
                                        </div>
                                    </div><!--container-fluid-->
                                @endforeach
                            </div><!--copy-->
                            <div class="target">
                                <h5>{{trans('text.addAward')}}<a href="{{ route('awards.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> </a></h5>
                            </div>        
                            <div class="container-fluid">                
                                <div class="row buttons">
                                    <div class="col-md-3 col-sm-2 col-xs-11">
                                        <a href="{{ url('/')}}" class="btn btn-primary ">
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

@endsection()