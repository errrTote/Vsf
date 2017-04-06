@extends('layouts.admin')

@section('title', 'Información personal')

@section('content')
	<div class="container-fluid">                
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="jumbotron">
                    <div class="panel-heading">
                        <h3>                        
                            {{trans('text.editPersonalTitle')}}
                        </h3>
                        <h5>{{trans('text.requiredA')}} <span class="nota">*</span> {{trans('text.requiredB')}}</h5>
                    </div>
                    <div class="panel-body">                     
                        
                      {!! Form::open(['route'=>['adm.users.update', $personal->id], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
                            {{ csrf_field() }}                            
                   
                            
                            <div class="row">
                                <h4 class="separador">{{trans('text.addresses')}}</h4>
                                
                            </div>                  

                            <br>
                            <div class="row">                               
                                <h5 class="sub-separador">{{trans('text.permanentAddress')}}</h5>
                            </div>
                            <div class="container-fluid">                
                                
                                <div class="col-md-12">
                                    <label for="permanent_address" class="control-label ">{{trans('text.address')}}<span class="nota">*</span></label>                             
                                    <input type="text" class="form-control" id="{{trans('text.address')}}" name="permanent_address" value="{{ $personal->permanent_address}}" required pattern="^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s#.-°]{6,64}" title="{{trans('text.title-PermanentAddress')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="permanent_city" class="control-label ">{{trans('text.city')}}<span class="nota">*</span></label>                               
                                    <input type="text" class="form-control" id="{{trans('text.city')}}" name="permanent_city" value="{{ $personal->permanent_city }}" required pattern="[A-Za-z\sÑÁÉÍÓÚñáéíóú]{3,64}" title="{{trans('text.title-PermanentCity')}}">  
                                </div>                              
                                                     

                                <div class="col-md-6">
                                    <label for="permanent_postal_code" class="control-label ">{{trans('text.postalCode')}}</label>
                                
                                    <input type="text" class="form-control num" id="Código Postal" name="permanent_postal_code" value="{{ $personal->permanent_postal_code }}" required pattern="[0-9]{4,10}" title="{{trans('text.title-PermanentCode')}}">  
                                </div>                                
                                <div class="col-md-6">
                                    <label for="permanent_country" class="control-label">{{trans('text.country')}}<span class="nota">*</span></label>
                                    @if(Session('applocale')=='es')
                                        {!! Form::select('permanent_country', $countries, $permanent_country->id, ['class' => 'form-control country_permanent', 'id' => 'Pais', 'required', 'title' => 'Seleccione su pais de origen']) !!}
                                    @else
                                        {!! Form::select('permanent_country', $countries, $permanent_country->id, ['class' => 'form-control country_permanent', 'id' => 'Country', 'required', 'title' => 'Select the country of origin']) !!}
                                    @endif
                                </div>
                                

                                <div class="col-md-6">
                                    <label for="permanent_state" class="control-label">{{trans('text.state')}}<span class="nota">*</span></label>                                      
                                    <select name="id_permanent_state" id="{{trans('text.state')}}" class="form-control states_list_permanent" required title ="{{trans('text.title-PermanentState')}}">
                                        <option value="{{ $permanent_state->id }}">{{ $permanent_state->name }}</option>
                                    </select>
                                </div>
                                                     
                            </div><!--container-fluid-->
                            <br>
                            <div class="row">                                
                                <h5 class="sub-separador">{{trans('text.residenceAddress')}}</h5>
                            </div>

                            <div class="container-fluid">                        

                                <div class="col-md-12 padding-check">
                                    <label for="checkbox" class="control-label" >{{trans('text.equalPermanent')}}</label>
                                    <input type="checkbox" class="residence_checkbox" id="{{trans('text.residenceAddress')}}" name="same_address" title="{{trans('text.title-ResidenceCheck')}}">
                                </div>  

                            </div>


                            <div class="container-fluid residence_div" >  
                           
                                <div class="col-md-12">
                                    <label for="residence_address" class="control-label ">{{trans('text.address')}}</label>                               
                                    <input type="text" class="form-control" id="{{trans('text.address')}} actual" name="residence_address" value="{{ $personal->residence_address }}" pattern="^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s#.-°]{6,64}" title="{{trans('text.title-ResidenceAddress')}}">  
                                </div>

                                <div class="col-md-6">
                                    <label for="residence_city" class="control-label ">{{trans('text.city')}}</label>                              
                                    <input type="text" class="form-control" id="{{trans('text.city')}} actual" name="residence_city" value="{{ $personal->residence_city }}" pattern="[A-Za-z\sÑÁÉÍÓÚñáéíóú]{3,64}" title="{{trans('text.title-ResidenceCity')}}">  
                                </div>                              
                                                     

                                <div class="col-md-6">
                                    <label for="residence_postal_code" class="control-label ">{{trans('text.postalCode')}}</label>
                                
                                    <input type="text" class="form-control" id="Cod. Postal actual" name="residence_postal_code" value="{{ $personal->residence_postal_code }}" pattern="[0-9]{4,10}" title="{{trans('text.title-ResidenceCode')}}">  
                                </div>

                                <div class="col-md-6">
                                    <label for="residence_country" class="control-label">{{trans('text.country')}}</label>
                                    @if(Session('applocale')=='es')
                                        {!! Form::select('residence_country', $countries, $residence_country->id, ['class' => 'form-control country_residence', 'id' => 'Pais de residencia', 'title' => 'Seleccione su pais de residencia actual']) !!}
                                    @else
                                        {!! Form::select('residence_country', $countries, $residence_country->id, ['class' => 'form-control country_residence', 'id' => 'Residence country', 'title' => 'Select the country where you live now']) !!}
                                    @endif
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="residence_state" class="control-label">{{trans('text.state')}}</label>
                                    <select name="id_residence_state" id="{{trans('text.state')}} de residencia" class="form-control states_list_residence" title="{{trans('text.title-ResidenceState')}}">
                                        <option value="{{ $residence_state->id }}">{{ $residence_state->name }}</option>
                                    </select>                               
                                </div>                             
                            </div><!--container-fluid-hidden-->

                            
                            <br>
                            <div class="row">                                
                                <h4 class="sub-separador">{{trans('text.birth')}}</h4>
                            </div>    
                            <div class="container-fluid">
                                <div class="col-md-12 pad-left ">
                                    <label for="gender" class="control-label ">{{trans('text.gender')}}</label><br>
                                    @if($personal->gender=='Masculino')
                                        M <input type="radio" name="gender" id="{{trans('text.gender')}}" checked value="Masculino" title="{{trans('text.title-gender')}}" checked>  
                                        F <input type="radio" name="gender" id="{{trans('text.gender')}}" value="Femenino" title="{{trans('text.title-gender')}}">
                                    @else
                                        M <input type="radio" name="gender" id="{{trans('text.gender')}}" checked value="Masculino" title="{{trans('text.title-gender')}}">  
                                        F <input type="radio" name="gender" id="{{trans('text.gender')}}" value="Femenino" title="{{trans('text.title-gender')}}" checked>
                                    @endif     
                                </div>    

                                <div class="col-md-6">
                                    <label for="birth_date" class="control-label">{{trans('text.date')}}<span class="nota">*</span></label>
                                     <input type="text" class="form-control datepicker" value="{{ $personal->birth_date }}" id="Fecha de nacimiento" name="birth_date" required title = "{{trans('text.title-BirthDate')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="birth_city" class="control-label">{{trans('text.city')}}<span class="nota">*</span></label>
                                    <input type="text" id="{{trans('text.city')}}" name="birth_city" class="form-control" value="{{ $personal->birth_city }}" pattern="[A-Za-z\sÑÁÉÍÓÚñáéíóú]{3,64}" title="{{trans('text.title-BirthCity')}}" required>
                                </div>

                                 <div class="col-md-6">
                                    <label for="birth_country" class="control-label">{{trans('text.country')}}<span class="nota">*</span></label>
                                    @if(Session('applocale')=='es')
                                        {!! Form::select('birth_country', $countries, $birth_country->id, ['class' => 'form-control country_birth', 'id' => 'Pais de nacimiento', 'required', 'title' => 'Seleccione su pais de nacimiento']) !!}
                                    @else
                                        {!! Form::select('birth_country', $countries, $birth_country->id, ['class' => 'form-control country_birth', 'id' => 'Birth country', 'required', 'title' => 'Select your country of birth']) !!}
                                    @endif
                                </div>

                                 <div class="col-md-6">
                                    <label for="birth_state" class="control-label">{{trans('text.state')}}<span class="nota">*</span></label>
                                    <select name="id_birth_state" id="{{trans('text.state')}}" class="form-control states_list_birth" title="{{trans('text.title-BirthState')}}">   
                                        <option value="{{ $birth_state->id }}">{{ $birth_state->name }}</option>

                                    </select>                               
                                   
                                </div>                                
                            </div><!--container-fluid-->
                             
                            <br>
                            <div class="row">                                
                                <h4 class="separador">{{trans('text.additionalInformation')}}</h4>
                            </div>

                            <div class="container-fluid">
                                <div class="col-md-6">
                                    <label for="home_phone" class="control-label">{{trans('text.homePhone')}}</label>
                                    <input type="text" id="{{trans('text.homePhone')}}" name="home_phone" class="form-control" value="{{ $personal->home_phone }}" pattern="[0-9]{11,15}" title="{{trans('text.title-HomePhone')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="movil_phone" class="control-label">{{trans('text.celPhone')}}</label>
                                    <input type="text" id="{{trans('text.celPhone')}}" name="movil_phone" class="form-control" value="{{ $personal->movil_phone }}" pattern="[0-9]{11,15}" title="{{trans('text.title-CelPhone')}}">
                                </div>
                               
                                
                            </div><!--container-fluid-->

                           
                            
                            <input type="hidden" name="update" value="personal">

                           
                            <div class="container-fluid">                
                                <div class="row buttons">
                                    <div class="col-md-3 col-sm-2 col-xs-11">
                                        <a href=" {{ url('adm/users') }}" class="btn btn-primary">
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
