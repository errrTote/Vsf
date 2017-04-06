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
                        <h5>{{trans('text.requiredA')}}<span class="nota">*</span>{{trans('text.requiredB')}}</h5>
                    </div>
        
                    <div class="panel-body">            			
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('educations.store') }}">
                            {{ csrf_field() }}							
                            
                            <div class="container-fluid university">
                                <div class="row">
                                    <h4 class="separador">{{trans('text.university')}}</h4>
                                </div> 
                               
                                <div class="copy" >

                                    <div class="new">                                        
                                    
                                        <div class="col-md-12">
                                            <label for="career" class="control-label ">{{trans('text.career')}}</label>
                                      
                                            <input type="text" class="form-control" id="{{trans('text.career')}}" name="career[]" value="{{ old('career') }}" required pattern="[A-Za-z\sÑÁÉÍÓÚñáéíóú]{8,32}" title="{{trans('text.title-career')}}">  
                                                
                                        </div>      

                                        <div class="col-md-6">
                                            <label for="name" class="control-label ">{{trans('text.institute')}}</label>
                                      
                                            <input type="text" class="form-control" id="{{trans('text.institute')}}" name="name[]" value="{{ old('name') }}" required pattern="[A-Za-z\sÑÁÉÍÓÚñáéíóú.]{8,32}" title="{{trans('text.title-universityName')}}">  
                                            <input type="hidden" name="type[]" value="h">
                                                
                                        </div>              

                                        <div class="col-md-6">
                                            <label for="family_name" class="control-label ">{{trans('text.period')}}</label>
                                        
                                            <input type="text" class="form-control" id="{{trans('text.period')}}" name="period[]" value="{{ old('period') }}" required pattern="[0-9-]{9,10}" title="{{trans('text.title-period')}}">  
                                        </div> 


                                        <div class="col-md-6">
                                            <label for="address" class="control-label">{{trans('text.address')}}</label>
                                            <input type="text" id="{{trans('text.instituteAddress')}}" name="address[]" class="form-control" required pattern="^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s#.-°]{6,32}" title="{{trans('text.title-addressInstitute')}}">
                                        </div>

                                         <div class="col-md-6">
                                            <label for="state" class="control-label">{{trans('text.city')}}</label>
                                            <input type="text" name="city[]" id="{{trans('text.instituteCity')}}" class="form-control" required pattern="[A-Za-z\sÑÁÉÍÓÚñáéíóú]{3,32}" title="{{trans('text.title-Institute')}}" >
                                        </div> 

                                         <div class="col-md-6">
                                            <label for="country" class="control-label">{{trans('text.country')}}</label>
                                            @if(Session('applocale')=='es')
                                                {!! Form::select('education_country', $countries, null, ['class' => 'form-control education_country_university', 'id' => 'Pais', 'title' => 'Seleccione el pais del isntituto']) !!}
                                            @else
                                                {!! Form::select('education_country', $countries, null, ['class' => 'form-control education_country_university', 'id' => 'Country', 'title' => 'Select country institute']) !!}
                                            @endif
                                            
                                        </div>

                                         <div class="col-md-6">
                                            <label for="state" class="control-label">{{trans('text.state')}}</label>
                                            <select name="id_state[]" id="{{trans('text.state')}}" class="form-control education_states_list_university" title="{{trans('text.stateInstitute')}}"></select>
                                            <hr>
                                        </div>
                                    </div>
                                                                 
                                </div> 
                            </div>
                            <div class="new_university container-fluid">
                                
                            </div>
                           
                            
                            <div>
                                <h5>{{trans('text.addUniversity')}}<button class="btn btn-primary add_university"><span class="glyphicon glyphicon-plus"></span> </button></h5>
                            </div>


                            <input type="hidden" name="id_user" value="{{Session('user_id') }}">
                           
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
    {!! Form::open(['route' => ['states', ':USER_ID'], 'method' => 'get', 'class' => 'form-states'])  !!}
    {!! Form::close()!!}
@endsection