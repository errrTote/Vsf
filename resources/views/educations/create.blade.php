@extends('layouts.main')

@if(Session('applocale')=='es')
    @section('title', 'Información Académica')
@else
    @section('title', 'Academic information')
@endif

@section('content')
	<div class="container-fluid">                
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="jumbotron">
                    <div class="panel-heading">
                        <h3>                        
                            {{trans('text.titleEducation')}}
                        </h3>
                        <h5>{{trans('text.requiredC')}}
                    </div>
        
                    <div class="panel-body">            			
                        {!! Form::open(['route'=>'educations.store', 'method' => 'POST', 'files' => true]) !!}   
                            {{ csrf_field() }}							
                            <div class="container-fluid">  
								<div class="row">
									<h4 class="separador">{{trans('text.institute')}}</h4>
								</div>	
	                            <div class="col-md-12">
                                    <label for="name" class="control-label ">{{trans('text.name')}}</label>                              
                                    <input type="text" class="form-control" id="{{trans('text.institute')}}" name="name" value="{{ old('name') }}"  title="{{trans('text.title-secundariName')}}">  
                                </div> 

                                <div class="col-md-6">
                                    <label for="address" class="control-label">{{trans('text.address')}}</label>
                                    <input type="text" id="{{trans('text.instituteAddress')}}" name="address" value="{{ old('address') }}"class="form-control"   title="{{trans('text.title-addressInstitute')}}">
                                </div>

                                 <div class="col-md-6">
                                    <label for="city" class="control-label">{{trans('text.city')}}</label>
                                    <input type="text" name="city" value="{{ old('city') }}" id="{{trans('text.instituteCity')}}" class="form-control"   title="{{trans('text.title-cityIntitute')}}">
                                </div> 

                                <div class="col-md-6">
                                    <label for="country" class="control-label">{{trans('text.country')}}</label>
                                    @if(Session('applocale')=='es')
                                       {!! Form::select('education_country', $countries, null, ['class' => 'form-control education_country', 'id' => 'País', '', 'title' => 'Seleccione el país del instituto']) !!}
                                    @else
                                       {!! Form::select('education_country', $countries, null, ['class' => 'form-control education_country', 'id' => 'Country', '', 'title' => 'Select country institute']) !!}

                                    @endif
                                </div>

                                 <div class="col-md-6">
                                    <label for="city" class="control-label">{{trans('text.state')}}</label>
                                    <select name="id_state" id="{{trans('text.state')}}" class="form-control education_states_list"  title="{{trans('text.title-stateInstitute')}}"></select>
                                </div> 
                                <div class="col-md-6">
                                    <label for="type" class="control-label ">{{trans('text.type')}}</label>
                                    <select name="type" class="form-control" id="selectTypeEducation">
                                        <option value="s">{{trans('text.secundari')}}</option>
                                        <option value="h">{{trans('text.university')}}</option>
                                    </select>
                                </div>            
                                <div class="col-md-6">
                                    <label for="family_name" class="control-label ">{{trans('text.period')}}</label>
                                
                                    <input type="text" class="form-control" id="{{trans('text.period')}}" name="period" value="{{ old('period') }}"   title="{{trans('text.title-period')}}">  
                                </div> 
                                <div class="col-md-12" id="divCareer" hidden="hidden">
                                    <label for="career" class="control-label ">{{trans('text.career')}}</label>
                              
                                    <input type="text" class="form-control" id="{{trans('text.career')}}" name="career" value="{{ old('career') }}"   title="{{trans('text.title-career')}}">
                                        
                                </div>  
                            </div><!--container-fluid-->
                            <hr>
                            @if(!isset($education))
                                <div class="container-fluid">
                                    <div class="row">
                                        <h4 class="separador"> {{trans('text.academicPerformance')}} </h4>
                                        <h5 class="sub-separador"> {{trans('text.notes')}} </h5>
                                    </div>
                                    <div class="col-md-12">
                                        <span class="nota"> {{trans('text.noteUploadNotes')}} </span>
                                        <input type="file" name="notes" id=" {{trans('text.score')}}" title=" {{trans('text.title-score')}}" value="show">
                                    </div>
                                    <br>
                                    <br>
                                    <hr>
                                    <div class="row">
                                        <h5 class="sub-separador"> {{trans('text.sat')}} </h5>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="file" name="sat" id=" {{trans('text.sat')}}" title=" {{trans('text.title-sat')}}" value="show">
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <h5 class="sub-separador"> {{trans('text.toefl')}} </h5>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="file" name="toefl" id=" {{trans('text.toefl')}}" title=" {{trans('text.title-toefl')}}" value="show">
                                    </div>
                                </div>
                            @endif
                            <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
                           
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
                        {!! Form::close() !!}                   
                    </div><!--panel-body-->             
                </div><!--jumbotron-->
            </div><!--col-md-->           
        </div><!--row-->
    </div><!--container-fluid-->
    {!! Form::open(['route' => ['states', ':USER_ID'], 'method' => 'get', 'class' => 'form-states'])  !!}
    {!! Form::close()!!}
@endsection