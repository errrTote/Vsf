@extends('layouts.main')

@if(Session('applocale')=='es')
    @section('title', 'Información familiar')
@else
    @section('title', 'Familiar information')
@endif
@section('content')

	<div class="container-fluid">                
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="jumbotron">
                    <div class="panel-heading">
                        <h3>                        
                            {{trans('text.editFamilyTitle')}}
                        </h3>
                        <h5> {{trans('text.requiredA')}} <span class="nota">*</span>  {{trans('text.requiredB')}}</h5>
                    </div>
        
                    <div class="panel-body">            			
                        {!! Form::open(['route'=>['familiars.update', Session('user_id')], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
                            {{ csrf_field() }}

							
                            <div class="container-fluid">  

                                <div class="row">
                                    <h4 class="separador">{{trans('text.titleFamily')}}</h4>
                                    <h5 class="sub-separador">{{trans('text.member')}} 1</h5>
                                </div>  
                                <div class="col-md-6">
                                    <label class="control-label ">{{trans('text.name')}}<span class="nota">*</span></label> 
                                    <input type="text" class="form-control"  name="first_name[]" value="{{ $familiars[0]->first_name }}" id="{{trans('text.name')}}" title="{{trans('text.title-nameFirstFamily')}}">                                     
                                </div>              

                                <div class="col-md-6">
                                    <label for="last_name" class="control-label ">{{trans('text.lastName')}}<span class="nota">*</span></label>
                                
                                    <input type="text" class="form-control"  name="last_name[]" value="{{ $familiars[0]->last_name }}" id="{{trans('text.lastName')}}" title="{{trans('text.title-lastNameFirstFamily')}}">  
                                </div> 

                                 <div class="col-md-6">
                                    <label for="relationship" class="control-label">{{trans('text.relationship')}}</label>
                                    <input type="text" name="relationship[]" value="{{ $familiars[0]->relationship }}" class="form-control" id="{{trans('text.relationship')}}"  title="{{trans('text.title-relationshipFirstFamily')}}">
                                </div> 
                                <div class="col-md-6">
                                    <label class="control-label">{{trans('text.ocupation')}}</label>
                                    <input type="text"  name="ocupation[]" value="{{ $familiars[0]->ocupation }}" class="form-control" id="{{trans('text.ocupation')}}"  title="{{trans('text.title-ocupationFirstFamily')}}">
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label">{{trans('text.dateBirth')}}</label>
                                    <input type="text"  name="dateBirth[]" value="{{ $familiars[0]->dateBirth }}" class="form-control" id="{{trans('text.dateBirth')}}"  title="{{trans('text.title-dateBirthFirstFamily')}}">
                                </div>


                                <div class="col-md-6">
                                    <label for="country" class="control-label">{{trans('text.countryBirth')}}<span class="nota">*</span></label>
                                    @if(Session('applocale')=='es')
                                        {!! Form::select('familiar_country', $countries, $country_selected[0]->id, ['class' => 'form-control familiar_country', 'id' => 'Pais', 'title' => 'Seleccione el pais donde nació su primer familiar']) !!}
                                    @else
                                        {!! Form::select('familiar_country', $countries, $country_selected[0]->id, ['class' => 'form-control familiar_country', 'id' => 'Country', 'title' => 'Select the country where your first familiar was born']) !!}
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="state" class="control-label">{{trans('text.stateBirth')}}<span class="nota">*</span></label>
                                    <select name="id_state[]" class="form-control familiar_states_list" id="{{trans('text.state')}}" title ="{{trans('text.title-stateBirthFirstFamily')}}">
                                        <option value="{{ $states[0][0]->id }}"> {{ $states[0][0]->name }} </option>
                                        
                                    </select>
                                </div>
                                
                                 <div class="col-md-6">
                                    <label class="control-label">{{trans('text.email')}}</label>
                                    <input type="text" name="email[]" value="{{ $familiars[0]->email }}" class="form-control" id="{{trans('text.email')}}" title="{{trans('text.title-emailFirstFamily')}}">
                                </div>  

                                <div class="col-md-6">
                                    <label for="home_phone" class="control-label">{{trans('text.homePhone')}}</label>
                                    <input type="text" id="{{trans('text.homePhone')}}" name="home_phone[]" class="form-control" value="{{ $familiars[0]->home_phone }}"  title="{{trans('text.title-HomePhone')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="movil_phone" class="control-label">{{trans('text.celPhone')}}</label>
                                    <input type="text" id="{{trans('text.celPhone')}}" name="movil_phone[]" class="form-control" value="{{ $familiars[0]->movil_phone }}"  title="{{trans('text.title-CelPhone')}}">
                                </div>

                                <div class="col-md-12 padding-check">
                                    <label for="deceased" class="control-label" >{{trans('text.deceased')}}</label>
                                    Si <input type="radio" class="padding-check" value="1" name="deceased_a" id="{{trans('text.deceased')}}" title="{{trans('text.title-deceasedFirstFamily')}}">
                                    No <input type="radio" class="padding-check" value="0" checked name="deceased_a" id="{{trans('text.deceased')}}" title="{{trans('text.title-deceasedFirstFamily')}}">
                                </div>                                 
                            </div><!--container-fluid-->
                            
                            <br>
                            <div class="container-fluid">  

                                <div class="row">
                                    
                                    <h5 class="sub-separador">{{trans('text.member')}} 2</h5>
                                </div>  
                                <div class="col-md-6">
                                    <label class="control-label ">{{trans('text.name')}}<span class="nota">*</span></label> 

                                    <input type="text" class="form-control"  name="first_name[]" value="{{ $familiars[1]->first_name }}" id="{{trans('text.name')}}" title="{{trans('text.title-nameSecondFamily')}}">                                     
                                </div>              

                                <div class="col-md-6">
                                    <label for="last_name" class="control-label ">{{trans('text.lastName')}}<span class="nota">*</span></label>
                                
                                    <input type="text" class="form-control"  name="last_name[]" value="{{ $familiars[1]->last_name }}" id="{{trans('text.lastName')}}" title="{{trans('text.title-lastNameSecondFamily')}}">  
                                </div> 

                                 <div class="col-md-6">
                                    <label for="relationship" class="control-label">{{trans('text.relationship')}}</label>
                                    <input type="text" name="relationship[]" value="{{ $familiars[1]->relationship }}" class="form-control" id="{{trans('text.relationship')}}"  title="{{trans('text.title-relationshipSecondFamily')}}">
                                </div> 

                                <div class="col-md-6">
                                    <label class="control-label">{{trans('text.ocupation')}}</label>
                                    <input type="text"  name="ocupation[]" value="{{ $familiars[1]->ocupation }}" class="form-control" id="{{trans('text.ocupation')}}"  title="{{trans('text.title-ocupationSecondFamily')}}">
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label">{{trans('text.dateBirth')}}</label>
                                    <input type="text"  name="dateBirth[]" value="{{ $familiars[1]->dateBirth }}" class="form-control" id="{{trans('text.dateBirth')}}"  title="{{trans('text.title-dateBirthSecondFamily')}}">
                                </div>


                                <div class="col-md-6">
                                    <label for="country" class="control-label">{{trans('text.countryBirth')}}<span class="nota">*</span></label>
                                    @if(Session('applocale')=='es')
                                        {!! Form::select('familiar_country', $countries, $country_selected[1]->id, ['class' => 'form-control familiar_b_country', 'id' => 'Pais', 'title' => 'Seleccione el pais donde nació su primer familiar']) !!}
                                    @else
                                        {!! Form::select('familiar_country', $countries, $country_selected[1]->id, ['class' => 'form-control familiar_b_country', 'id' => 'Country', 'title' => 'Select the country where your Second familiar was born']) !!}
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="state" class="control-label">{{trans('text.stateBirth')}}<span class="nota">*</span></label>
                                    <select name="id_state[]" class="form-control familiar_b_states_list" id="{{trans('text.state')}}" title ="{{trans('text.title-stateBirthSecondFamily')}}">
                                        <option value="{{ $states[0][0]->id }}"> {{ $states[0][0]->name }} </option>
                                        
                                    </select>
                                </div>
                                
                                 <div class="col-md-6">
                                    <label class="control-label">{{trans('text.email')}}</label>
                                    <input type="text" name="email[]" value="{{ $familiars[1]->email }}" class="form-control" id="{{trans('text.email')}}" title="{{trans('text.title-emailSecondFamily')}}">
                                </div>  

                                <div class="col-md-6">
                                    <label for="home_phone" class="control-label">{{trans('text.homePhone')}}</label>
                                    <input type="text" id="{{trans('text.homePhone')}}" name="home_phone[]" class="form-control" value="{{ $familiars[1]->home_phone }}"  title="{{trans('text.title-HomePhone')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="movil_phone" class="control-label">{{trans('text.celPhone')}}</label>
                                    <input type="text" id="{{trans('text.celPhone')}}" name="movil_phone[]" class="form-control" value="{{ $familiars[1]->movil_phone }}"  title="{{trans('text.title-CelPhone')}}">
                                </div>

                                <div class="col-md-12 padding-check">
                                    <label for="deceased" class="control-label" >{{trans('text.deceased')}}</label>
                                    Si <input type="radio" class="padding-check" value="1" name="deceased_b" id="{{trans('text.deceased')}}" title="{{trans('text.title-deceasedSecondFamily')}}">
                                    No <input type="radio" class="padding-check" value="0" checked name="deceased_b" id="{{trans('text.deceased')}}" title="{{trans('text.title-deceasedSecondFamily')}}">
                                </div>                 
                            </div><!--container-fluid-->

                            <input type="hidden" name="id_user" value="{{Session('user_id') }}">
                            <input type="hidden" name="id[]" value="{{ $familiars[0]->id }}">
                            <input type="hidden" name="id[]" value="{{ $familiars[1]->id }}">
                           
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
@endsection()