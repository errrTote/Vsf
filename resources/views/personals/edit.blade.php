@extends('layouts.main')

@if(Session('applocale')=='es')
    @section('title', 'Información Personal')
@else
    @section('title', 'Personal Information')
@endif

@section('content')
	<div class="container-fluid">                
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="jumbotron">
                    <div class="panel-heading">
                        <h3>                        
                            {{ trans('text.editPersonalTitle') }}
                        </h3>
                        <h5>{{trans('text.requiredA')}} <span class="nota">*</span> {{trans('text.requiredB')}}</h5>
                    </div>
                    <div class="panel-body">                     
                        
                      {!! Form::open(['route'=>['personals.update', $personal->id], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
                            {{ csrf_field() }}  

                            <br>
                            <div class="row">                                
                                <h5 class="sub-separador">{{trans('text.titlePersonal')}}</h5>
                            </div>    
                            <div class="container-fluid">
                                <div class="col-md-6">
                                    <label class="control-label">{{trans('text.names')}}<span class="nota">*</span> </label>
                                     <input type="text" class="form-control" value="{{Auth::user()->first_name}}" readonly="readonly">
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label">{{trans('text.surnames')}}</label>
                                     <input type="text" class="form-control" value="{{Auth::user()->last_name}}" readonly="readonly">
                                </div>

                                <div class="col-md-12 pad-left ">
                                    <label for="gender" class="control-label ">{{trans('text.gender')}}</label><br>
                                    @if($personal->gender=='Masculino')
                                        M <input type="radio" name="gender" id="{{trans('text.gender')}}"  value="Masculino" title="{{trans('text.title-gender')}}" checked>  
                                        
                                        F <input type="radio" name="gender" id="{{trans('text.gender')}}" value="Femenino" title="{{trans('text.title-gender')}}">
                                    @else
                                        M <input type="radio" name="gender" id="{{trans('text.gender')}}" value="Masculino" title="{{trans('text.title-gender')}}">  
                                        
                                        F <input type="radio" name="gender" id="{{trans('text.gender')}}" value="Femenino" title="{{trans('text.title-gender')}}" checked>
                                    @endif 
                                </div>    

                                <div class="col-md-6">
                                    <label for="birth_date" class="control-label">{{trans('text.dateBirth')}}</label>
                                     <input type="text" class="form-control datepicker" value="{{ $personal->birth_date }}" id="{{trans('text.birthDate')}}" name="birth_date"  title = "{{trans('text.title-BirthDate')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="birth_city" class="control-label">{{trans('text.cityBirth')}}</label>
                                    <input type="text" id="{{trans('text.birthCity')}}" name="birth_city" class="form-control" value="{{ $personal->birth_city }}" title="{{trans('text.title-BirthCity')}}" >
                                </div>

                                 <div class="col-md-6">
                                    <label for="birth_country" class="control-label">{{trans('text.countryBirth')}}</label>
                                    @if(Session('applocale')=='es')  
                                        {!! Form::select('birth_country', $countries, $birth_country->id, ['class' => 'form-control country_birth', 'id' => 'País de nacimiento', 'title' => 'Seleccione su país de nacimiento']) !!}
                                    @else
                                        {!! Form::select('birth_country', $countries, $birth_country->id, ['class' => 'form-control country_birth', 'id' => 'Birth country', 'title' => 'Select your country of birth']) !!}

                                    @endif
                                </div>

                                 <div class="col-md-6">
                                    <label for="birth_state" class="control-label">{{trans('text.stateBirth')}}</label>
                                    <select name="id_birth_state" id="{{trans('text.birthState')}}" class="form-control states_list_birth" title = "{{trans('text.title-BirthState')}}">   
                                        <option value="{{ $birth_state->id }}">{{ $birth_state->name }}</option>

                                    </select>                               
                                   
                                </div>                                
                            </div><!--container-fluid-->

                            <br>
                            <div class="row">                                
                                <h5 class="sub-separador">{{trans('text.contactInformacion')}}</h5>
                            </div>

                            <div class="container-fluid">
                                <div class="col-md-6">
                                    <label for="home_phone" class="control-label">{{trans('text.homePhone')}}</label>
                                    <input type="text" id="{{trans('text.homePhone')}}" name="home_phone" class="form-control" value="{{ $personal->home_phone }}" title="{{trans('text.title-HomePhone')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="movil_phone" class="control-label">{{trans('text.celPhone')}}</label>
                                    <input type="text" id="{{trans('text.celPhone')}}" name="movil_phone" class="form-control" value="{{ $personal->movil_phone }}"  title="{{trans('text.title-CelPhone')}}">
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label">{{trans('text.email')}}</label>
                                     <input type="text" class="form-control" value="{{Auth::user()->email}}" readonly="readonly">
                                </div> 
                               
                                
                            </div><!--container-fluid-->

                            <div class="row">
                                <h4 class="separador">{{trans('text.addresses')}}</h4>                                
                            </div>                  

                            <br>
                            <div class="row">                               
                                <h5 class="sub-separador">{{trans('text.physicalAddress')}}</h5>
                            </div>
                            <div class="container-fluid">                
                                
                                <div class="col-md-12">
                                    <label for="permanent_address" class="control-label ">{{trans('text.address')}}</label>                             
                                    <input type="text" class="form-control" id="{{trans('text.permanentAddress')}}" name="permanent_address" value="{{ $personal->permanent_address}}"  title="{{trans('text.title-PermanentAddress')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="permanent_city" class="control-label ">{{trans('text.city')}}</label>                               
                                    <input type="text" class="form-control" id="{{trans('text.permanentCity')}}" name="permanent_city" value="{{ $personal->permanent_city }}"  title="{{trans('text.title-PermanentCity')}}">
                                </div>                              
                                                     

                                <div class="col-md-6">
                                    <label for="permanent_postal_code" class="control-label ">{{trans('text.postalCode')}}</label>
                                
                                    <input type="text" class="form-control num" id="{{trans('text.postalCode')}}" name="permanent_postal_code" value="{{ $personal->permanent_postal_code }}"  title="{{trans('text.title-PermanentCode')}}"> 
                                </div>                                
                                <div class="col-md-6">
                                    <label for="permanent_country" class="control-label">{{trans('text.country')}}</label>
                                    @if(Session('applocale')=='es')
                                        {!! Form::select('permanent_country', $countries, $permanent_country->id, ['class' => 'form-control country_permanent', 'id' => 'País', 'title' => 'Seleccione su país de origen']) !!}
                                    
                                    @else
                                        {!! Form::select('permanent_country', $countries, $permanent_country->id, ['class' => 'form-control country_permanent', 'id' => 'Country', 'title' => 'Select the country of origin']) !!}
                                    
                                    @endif                              
                                                                   
                                </div>
                                

                                <div class="col-md-6">
                                    <label for="permanent_state" class="control-label">{{trans('text.state')}}</label>                               
                                    <select name="id_permanent_state" id="{{trans('text.state')}}" class="form-control states_list_permanent"  title = "{{trans('text.title-PermanentState')}}">
                                        <option value="{{ $permanent_state->id }}">{{ $permanent_state->name }}</option>
                                    </select>
                                </div>
                                                     
                            </div><!--container-fluid-->
                            <br>
                            <div class="row">                                
                                <h5 class="sub-separador">{{trans('text.mailingAddress')}}</h5>
                            </div>

                            <div class="container-fluid">                        

                                <div class="col-md-12 ">
                                    <label for="checkbox" class="control-label" >{{trans('text.equalPhysical')}}</label>
                                    <input type="checkbox" class="residence_checkbox" id="{{trans('text.residenceAddress')}}" name="same_address" title="{{trans('text.title-ResidenceCheck')}}">
                                </div>  

                            </div>


                            <div class="container-fluid residence_div" >  
                           
                                <div class="col-md-12">
                                    <label for="residence_address" class="control-label ">{{trans('text.address')}}</label>                               
                                    <input type="text" class="form-control" id="{{trans('text.residenceAddress')}}" name="residence_address" value="{{ $personal->residence_address }}" title="{{trans('text.title-ResidenceAddress')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="residence_city" class="control-label ">{{trans('text.city')}}</label>                              
                                    <input type="text" class="form-control" id="{{trans('text.residenceCity')}}" name="residence_city" value="{{ $personal->residence_city }}" title="{{trans('text.title-ResidenceCity')}}">
                                </div>                              
                                                     

                                <div class="col-md-6">
                                    <label for="residence_postal_code" class="control-label ">{{trans('text.postalCode')}}</label>
                                
                                    <input type="text" class="form-control" id="{{trans('text.residencePostalCode')}}" name="residence_postal_code" value="{{ $personal->residence_postal_code }}" title="{{trans('text.title-ResidenceCode')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="residence_country" class="control-label">{{trans('text.country')}}</label>
                                    @if(Session('applocale')=='es')
                                        {!! Form::select('residence_country', $countries, $residence_country->id, ['class' => 'form-control country_residence', 'id' => 'País de residencia', 'title' => 'Seleccione su país de residencia actual']) !!}
                                    
                                    @else
                                        {!! Form::select('residence_country', $countries, $residence_country->id, ['class' => 'form-control country_residence', 'id' => 'País de residencia', 'title' => 'Select your country of residence']) !!}
                                    @endif
                                    
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="residence_state" class="control-label">{{trans('text.state')}}</label>

                                    <select name="id_residence_state" id="{{trans('text.residenceState')}}" class="form-control states_list_residence" title ="{{trans('text.title-ResidenceState')}}">
                                        <option value="{{ $residence_state->id }}">{{ $residence_state->name }}</option>
                                    </select>                               
                                </div>                             
                            </div><!--container-fluid-hidden-->

                            <input type="hidden" name="id_user" value="{{Session('user_id') }}">
                            <input type="hidden" name="id" value="{{ $personal->id }}">

                           
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
    {!! Form::open(['route' => ['states', ':USER_ID'], 'method' => 'get', 'class' => 'form-states'])  !!}
    {!! Form::close()!!}
@endsection
