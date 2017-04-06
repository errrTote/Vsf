@extends('layouts.main')

@if(Session('applocale')=='es')
    @section('title', 'Personal')
@else
    @section('title', 'Personal')
@endif

@section('content')
	<div class="container-fluid">                
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="jumbotron">
                    <div class="panel-heading">
                        <h3>                        
                            {{trans('text.titlePersonal')}}
                        </h3>
                        <h5>{{trans('text.requiredA')}}<span class="nota">*</span>{{trans('text.requiredB')}}</h5>
                    </div>
        
                    <div class="panel-body">            			
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('personals.store') }}">
                            {{ csrf_field() }}
                            <div class="row">                                
                                <h5 class="sub-separador">{{trans('text.titlePersonal')}}</h5>
                            </div>    
                            <div class="container-fluid">
                                
                                <div class="col-md-6">
                                    <label class="control-label">{{trans('text.names')}}</label>
                                     <input type="text" class="form-control" value="{{Auth::user()->first_name}}" readonly="readonly">
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label">{{trans('text.surnames')}}</label>
                                     <input type="text" class="form-control" value="{{Auth::user()->last_name}}" readonly="readonly">
                                </div>

                                <div class="col-md-12 pad-left ">
                                    <label for="gender" class="control-label ">{{trans('text.gender')}}</label><br>
                                    M <input type="radio" name="gender" id="{{trans('text.gender')}}" checked value="Masculino" title="{{trans('text.title-gender')}}">
                                    F <input type="radio" name="gender" id="{{trans('text.gender')}}" value="Femenino" title="{{trans('text.title-gender')}}">    
                                </div>    

                                <div class="col-md-6">
                                    <label for="birth_date" class="control-label">{{trans('text.dateBirth')}}<span class="nota">*</span></label>
                                     <input type="text" class="form-control" id="{{trans('text.birthDate')}}" name="birth_date"  title = "{{trans('text.title-BirthDate')}}">
                                </div>


                                <div class="col-md-6">
                                    <label for="birth_city" class="control-label">{{trans('text.cityBirth')}}<span class="nota">*</span></label>
                                    <input type="text" id="{{trans('text.birthCity')}}" name="birth_city" class="form-control" value="{{ old('birth_city') }}" title="{{trans('text.title-BirthCity')}}" >
                                </div>

                                 <div class="col-md-6">
                                    <label for="birth_country" class="control-label">{{trans('text.countryBirth')}}<span class="nota">*</span></label>
                                    @if(Session('applocale')=='es')                    
                                        {!! Form::select('birth_country', $countries,null, ['class' => 'form-control country_birth', 'id' => 'País de nacimiento', '', 'title' => 'Seleccione su país de nacimiento']) !!}

                                    @else
                                        {!! Form::select('birth_country', $countries,null, ['class' => 'form-control country_birth', 'id' => 'Birth country', '', 'title' => 'Select your country of birth']) !!}
                                    
                                    @endif
                                </div>

                                 <div class="col-md-6">
                                    <label for="birth_state" class="control-label">{{trans('text.stateBirth')}}<span class="nota">*</span></label>
                                    <select name="id_birth_state" id="{{trans('text.birthState')}}" class="form-control states_list_birth" title = "{{trans('text.title-BirthState')}}"></select>
                                </div>  
                            </div><!--container-fluid-->
                            <br>

                            <div class="row">                               
                                <h5 class="sub-separador">{{trans('text.contactInformacion')}}</h5>
                            </div>
                            <div class="container-fluid">                
                           
                                <div class="col-md-6">
                                    <label for="home_phone" class="control-label">{{trans('text.homePhone')}}</label>
                                    <input type="text" id="{{trans('text.homePhone')}}" name="home_phone" class="form-control" value="{{ old('home_phone') }}"  title="{{trans('text.title-HomePhone')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="movil_phone" class="control-label">{{trans('text.celPhone')}}</label>
                                    <input type="text" id="{{trans('text.celPhone')}}" name="movil_phone" class="form-control" value="{{ old('movil_phone') }}"  title="{{trans('text.title-CelPhone')}}">
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
                                    <label for="permanent_address" class="control-label ">{{trans('text.address')}}<span class="nota">*</span></label>                             
                                    <input type="text" class="form-control" id="{{trans('text.permanentAddress')}}" name="permanent_address" value="{{ old('permanent_address')}}"  title="{{trans('text.title-PermanentAddress')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="permanent_city" class="control-label ">{{trans('text.city')}}<span class="nota">*</span></label>                               
                                    <input type="text" class="form-control" id="{{trans('text.permanentCity')}}" name="permanent_city" value="{{ old('permanent_city') }}"  pattern="[A-Za-z\sÑÁÉÍÓÚñáéíóú]{3,64}" title="{{trans('text.title-PermanentCity')}}">
                                </div>                              
                                                     

                                <div class="col-md-6">
                                    <label for="permanent_postal_code" class="control-label ">{{trans('text.postalCode')}}</label>
                                
                                    <input type="text" class="form-control num" id="{{trans('text.postalCode')}}" name="permanent_postal_code" value="{{ old('permanent_postal_code') }}"  pattern="[0-9]{4,10}" title="{{trans('text.title-PermanentCode')}}">
                                </div>

                                
                                <div class="col-md-6">
                                    <label for="permanent_country" class="control-label">{{trans('text.country')}}<span class="nota">*</span></label> 
                                    @if(Session('applocale')=='es') 
                                        {!! Form::select('permanent_country', $countries,null, ['class' => 'form-control country_permanent', 'id' => 'País', '', 'title' => 'Seleccion el país de donde proviene']) !!}
                                      
                                    @else
                                        {!! Form::select('permanent_country', $countries,null, ['class' => 'form-control country_permanent', 'id' => 'Country', '', 'title' => 'Select the country of origin']) !!}
                                    @endif
                                </div>
                                

                                <div class="col-md-6">
                                    <label for="permanent_state" class="control-label">{{trans('text.state')}}<span class="nota">*</span></label>                               
                                    <select name="id_permanent_state" id="{{trans('text.state')}}" class="form-control states_list_permanent"  title = "{{trans('text.title-PermanentState')}}">
                                        
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
                                    <input type="checkbox" class="residence_checkbox" id="{{trans('text.residenceAddress')}}" checked name="same_address" title="{{trans('text.title-ResidenceCheck')}}">
                                </div>  

                            </div>

                            <div class="container-fluid residence_div" hidden>  
                           
                                <div class="col-md-12">
                                    <label for="residence_address" class="control-label ">{{trans('text.address')}}</label>                               
                                    <input type="text" class="form-control" id="{{trans('text.residenceAddress')}}" name="residence_address" value="{{ old('residence_address') }}" pattern="[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s#.-°]{8,64}" title="{{trans('text.title-ResidenceAddress')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="residence_city" class="control-label ">{{trans('text.city')}}</label>                              
                                    <input type="text" class="form-control" id="{{trans('text.residenceCity')}}" name="residence_city" value="{{ old('residence_city') }}" pattern="[A-Za-z\sÑÁÉÍÓÚñáéíóú]{3,64}" title="{{trans('text.title-ResidenceCity')}}">
                                </div>                              
                                                     

                                <div class="col-md-6">
                                    <label for="residence_postal_code" class="control-label ">{{trans('text.postalCode')}}</label>
                                
                                    <input type="text" class="form-control" id="{{trans('text.residencePostalCode')}}" name="residence_postal_code" value="{{ old('residence_postal_code') }}" pattern="[0-9]{4,10}" title="{{trans('text.title-ResidenceCode')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="residence_country" class="control-label">{{trans('text.country')}}</label> 
                                    @if(Session('applocale')=='es')                    
                                        {!! Form::select('residence_country', $countries,null, ['class' => 'form-control country_residence', 'id' => 'País de residencia', 'title' => 'Seleccione el país donde reside actualmente']) !!}
                                    @else
                                        {!! Form::select('residence_country', $countries,null, ['class' => 'form-control country_residence', 'id' => 'Residence country', 'title' => 'Select the country where you live now']) !!}
                                    @endif
                                    
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="residence_state" class="control-label">{{trans('text.state')}}</label>
                                    <select name="id_residence_state" id="{{trans('text.residenceState')}}" class="form-control states_list_residence" title ="{{trans('text.title-ResidenceState')}}">  </select>                               
                                </div>                             
                            </div><!--container-fluid-hidden-->

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
