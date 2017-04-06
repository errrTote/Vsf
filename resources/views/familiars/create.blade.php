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
                            {{trans('text.titleFamily')}}
                        </h3>
                       <h5>{{trans('text.requiredA')}}<span class="nota">*</span>{{trans('text.requiredB')}}</h5>
                    </div>
        
                    <div class="panel-body">            			
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('familiars.store') }}">
                            {{ csrf_field() }}
							
                            <div class="container-fluid">  

								<div class="row">
									<h4 class="separador">{{trans('text.titleFamily')}}</h4>
									<h5 class="sub-separador">{{trans('text.member')}} 1</h5>
								</div>	
	                            <div class="col-md-6">
	                                <label class="control-label ">{{trans('text.name')}}<span class="nota">*</span></label>	

	                                <input type="text" class="form-control"  name="first_name[]" value="{{ old('first_name.0') }}" id="{{trans('text.name')}}" title="{{trans('text.title-nameFirstFamily')}}">	                            		
	                            </div>              

                            	<div class="col-md-6">
                                    <label for="last_name" class="control-label ">{{trans('text.lastName')}}<span class="nota">*</span></label>
                                
                                    <input type="text" class="form-control"  name="last_name[]" value="{{ old('last_name.0') }}" id="{{trans('text.lastName')}}" title="{{trans('text.title-lastNameFirstFamily')}}">  
                                </div> 

                                 <div class="col-md-6">
                                	<label for="relationship" class="control-label">{{trans('text.relationship')}}</label>
                                	<input type="text" name="relationship[]" value="{{ old('relationship.0') }}" class="form-control" id="{{trans('text.relationship')}}"  title="{{trans('text.title-relationshipFirstFamily')}}">
                                </div> 

                                <div class="col-md-6">
                                    <label class="control-label">{{trans('text.ocupation')}}</label>
                                    <input type="text"  name="ocupation[]" value="{{ old('ocupation.0') }}" class="form-control" id="{{trans('text.ocupation')}}"  title="{{trans('text.title-ocupationFirstFamily')}}">
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label">{{trans('text.dateBirth')}}</label>
                                    <input type="text"  name="dateBirth[]" value="{{ old('dateBirth.0') }}" class="form-control" id="{{trans('text.dateBirth')}}"  title="{{trans('text.title-dateBirthFirstFamily')}}">
                                </div>


                                <div class="col-md-6">
                                    <label for="country" class="control-label">{{trans('text.countryBirth')}}<span class="nota">*</span></label>
                                    @if(Session('applocale')=='es')
                                        {!! Form::select('familiar_country', $countries, null, ['class' => 'form-control familiar_country', 'id' => 'Pais', 'title' => 'Seleccione el pais donde nació su primer familiar']) !!}
                                    @else
                                        {!! Form::select('familiar_country', $countries, null, ['class' => 'form-control familiar_country', 'id' => 'Country', 'title' => 'Select the country where your first familiar was born']) !!}
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="state" class="control-label">{{trans('text.stateBirth')}}<span class="nota">*</span></label>
                                    <select name="id_state[]" class="form-control familiar_states_list" id="{{trans('text.state')}}" title ="{{trans('text.title-stateBirthFirstFamily')}}">
                                        
                                    </select>
                                </div>
                                
                                 <div class="col-md-6">
                                    <label class="control-label">{{trans('text.email')}}</label>
                                    <input type="text" name="email[]" value="{{ old('email.0') }}" class="form-control" id="{{trans('text.email')}}" title="{{trans('text.title-emailFirstFamily')}}">
                                </div>  

                                <div class="col-md-6">
                                    <label for="home_phone" class="control-label">{{trans('text.homePhone')}}</label>
                                    <input type="text" id="{{trans('text.homePhone')}}" name="home_phone[]" class="form-control" value="{{ old('home_phone.0') }}"  title="{{trans('text.title-HomePhone')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="movil_phone" class="control-label">{{trans('text.celPhone')}}</label>
                                    <input type="text" id="{{trans('text.celPhone')}}" name="movil_phone[]" class="form-control" value="{{ old('movil_phone.0') }}"  title="{{trans('text.title-CelPhone')}}">
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

                                    <input type="text" class="form-control"  name="first_name[]" value="{{ old('first_name.1') }}" id="{{trans('text.name')}}" title="{{trans('text.title-nameSecondFamily')}}">                                     
                                </div>              

                                <div class="col-md-6">
                                    <label for="last_name" class="control-label ">{{trans('text.lastName')}}<span class="nota">*</span></label>
                                
                                    <input type="text" class="form-control"  name="last_name[]" value="{{ old('last_name.1') }}" id="{{trans('text.lastName')}}" title="{{trans('text.title-lastNameSecondFamily')}}">  
                                </div> 

                                 <div class="col-md-6">
                                    <label for="relationship" class="control-label">{{trans('text.relationship')}}</label>
                                    <input type="text" name="relationship[]" value="{{ old('relationship.1') }}" class="form-control" id="{{trans('text.relationship')}}"  title="{{trans('text.title-relationshipSecondFamily')}}">
                                </div> 

                                <div class="col-md-6">
                                    <label class="control-label">{{trans('text.ocupation')}}</label>
                                    <input type="text"  name="ocupation[]" value="{{ old('ocupation.1') }}" class="form-control" id="{{trans('text.ocupation')}}"  title="{{trans('text.title-ocupationSecondFamily')}}">
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label">{{trans('text.dateBirth')}}</label>
                                    <input type="text"  name="dateBirth[]" value="{{ old('dateBirth.1') }}" class="form-control" id="{{trans('text.dateBirth')}}"  title="{{trans('text.title-dateBirthSecondFamily')}}">
                                </div>


                                <div class="col-md-6">
                                    <label for="country" class="control-label">{{trans('text.countryBirth')}}<span class="nota">*</span></label>
                                    @if(Session('applocale')=='es')
                                        {!! Form::select('familiar_country', $countries, null, ['class' => 'form-control familiar_country', 'id' => 'Pais', 'title' => 'Seleccione el pais donde nació su primer familiar']) !!}
                                    @else
                                        {!! Form::select('familiar_country', $countries, null, ['class' => 'form-control familiar_country', 'id' => 'Country', 'title' => 'Select the country where your Second familiar was born']) !!}
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="state" class="control-label">{{trans('text.stateBirth')}}<span class="nota">*</span></label>
                                    <select name="id_state[]" class="form-control familiar_states_list" id="{{trans('text.state')}}" title ="{{trans('text.title-stateBirthSecondFamily')}}">
                                        
                                    </select>
                                </div>
                                
                                 <div class="col-md-6">
                                    <label class="control-label">{{trans('text.email')}}</label>
                                    <input type="text" name="email[]" value="{{ old('email.1') }}" class="form-control" id="{{trans('text.email')}}" title="{{trans('text.title-emailSecondFamily')}}">
                                </div>  

                                <div class="col-md-6">
                                    <label for="home_phone" class="control-label">{{trans('text.homePhone')}}</label>
                                    <input type="text" id="{{trans('text.homePhone')}}" name="home_phone[]" class="form-control" value="{{ old('home_phone.1') }}"  title="{{trans('text.title-HomePhone')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="movil_phone" class="control-label">{{trans('text.celPhone')}}</label>
                                    <input type="text" id="{{trans('text.celPhone')}}" name="movil_phone[]" class="form-control" value="{{ old('movil_phone.1') }}"  title="{{trans('text.title-CelPhone')}}">
                                </div>

                                <div class="col-md-12 padding-check">
                                    <label for="deceased" class="control-label" >{{trans('text.deceased')}}</label>
                                    Si <input type="radio" class="padding-check" value="1" name="deceased_b" id="{{trans('text.deceased')}}" title="{{trans('text.title-deceasedSecondFamily')}}">
                                    No <input type="radio" class="padding-check" value="0" checked name="deceased_b" id="{{trans('text.deceased')}}" title="{{trans('text.title-deceasedSecondFamily')}}">
                                </div>                 
                            </div><!--container-fluid-->
                            

                            <input type="hidden" name="id_user" value="{{Auth::user()->id }}">
                           
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
@endsection()