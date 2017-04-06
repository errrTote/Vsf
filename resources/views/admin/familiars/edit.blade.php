@extends('layouts.admin')

@section('title', 'Información familiar')

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
                        {!! Form::open(['route'=>['adm.users.update', $familiars[0]->id_user], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
                            {{ csrf_field() }}

							
                            <div class="container-fluid">  

								<div class="row">
									<h4 class="separador"> {{trans('text.familiars')}}</h4>
									<h5 class="sub-separador">{{trans('text.family')}} 1</h5>
								</div>	
	                            <div class="col-md-6">
	                                <label for="first_name" class="control-label ">{{trans('text.name')}}<span class="nota">*</span></label>	

                                    <input type="hidden" name="id[]" value="{{ $familiars[0]->id }}">

                                    <input type="text" class="form-control"  name="first_name[]" value="{{ $familiars[0]->first_name }}" id="{{trans('text.name')}}" required pattern="^[A-ZÑÁÉÍÓÚ]{1}[a-zñáéíóú]{3,32}" title="{{trans('text.title-nameFirstFamily')}}">                                       
                                </div>              

                                <div class="col-md-6">
                                    <label for="last_name" class="control-label ">{{trans('text.lastName')}}<span class="nota">*</span></label>
                                
                                    <input type="text" class="form-control"  name="last_name[]" value="{{ $familiars[0]->last_name }}" id="{{trans('text.lastName')}}" required pattern="^[A-ZÑÁÉÍÓÚ]{1}[a-zñáéíóú]{3,32}" title="{{trans('text.title-lastNameFirstFamily')}}">  
                                </div> 


                                <div class="col-md-6">
                                    <label for="title" class="control-label">{{trans('text.title')}}</label>
                                    <input type="text"  name="title[]" value="{{ $familiars[0]->title }}" class="form-control" id="{{trans('text.title')}}" pattern="^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s.,]{6,64}"" title="{{trans('text.title-titleFirstFamily')}}">
                                </div>

                                 <div class="col-md-6">
                                    <label for="employer" class="control-label">{{trans('text.employ')}}</label>
                                    <input type="text" name="employer[]" value="{{ $familiars[0]->employer }}" class="form-control" id="{{trans('text.employ')}}" pattern="^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s.,]{6,64}"" title="{{trans('text.title-employFirstFamily')}}">
                                </div> 

                                 <div class="col-md-6">
                                    <label for="industry" class="control-label">{{trans('text.industry')}}</label>
                                    <input type="text" name="industry[]" value="{{ $familiars[0]->industry }}" class="form-control" id="{{trans('text.industry')}}" pattern="^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s.,]{6,64}"" title="{{trans('text.title-industryFirstFamily')}}">
                                </div>   

                                <div class="col-md-6">
                                    <label for="city" class="control-label">{{trans('text.city')}}<span class="nota">*</span></label>
                                    <input type="text" name="city[]" value="{{ $familiars[0]->city }}" class="form-control" id="{{trans('text.city')}}" required pattern="[A-Za-z\sÑÁÉÍÓÚñáéíóú]{3,32}" title="{{trans('text.title-cityFirstFamily')}}">
                                </div>   

                                <div class="col-md-6">
                                    <label for="country" class="control-label">{{trans('text.country')}}<span class="nota">*</span></label>
                                    @if(Session('applocale')=='es')
                                        {!! Form::select('familiar_country', $countries, $country_selected[0]->id, ['class' => 'form-control familiar_country', 'id' => 'Pais', 'required', 'title' => 'Seleccione el pais donde reside su primer familiar']) !!}
                                    @else
                                        {!! Form::select('familiar_country', $countries, $country_selected[0]->id, ['class' => 'form-control familiar_country', 'id' => 'Country', 'required', 'title' => 'Select the country where your first family resides']) !!}                                    
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="state" class="control-label">{{trans('text.state')}}<span class="nota">*</span></label>
                                    <select name="id_state[]" class="form-control familiar_states_list" id="{{trans('text.state')}}" required title ="{{trans('text.title-stateFirstFamily')}}">
                                        <option value="{{ $states[0][0]->id }}"> {{ $states[0][0]->name }} </option>
                                    </select>
                                </div>

                                <div class="col-md-6 padding-check">
                                    <label for="deceased" class="control-label" >{{trans('text.deceased')}}</label>
                                   
                                    @if($familiars[0]->deceased == 0)

                                        Si <input type="radio" class="padding-check" value="1" name="deceased_a" id="{{trans('text.deceased')}}" title="{{trans('text.title-deceasedFirstFamily')}}">
                                        No <input type="radio" class="padding-check" value="0" checked name="deceased_a" id="{{trans('text.deceased')}}" title="{{trans('text.title-deceasedFirstFamily')}}">
                                    @else
                                        Si <input type="radio" class="padding-check" value="1" checked name="deceased_a" id="{{trans('text.deceased')}}" title="{{trans('text.title-deceasedFirstFamily')}}">
                                        No <input type="radio" class="padding-check" value="0"  name="deceased_a" id="{{trans('text.deceased')}}" title="{{trans('text.title-deceasedFirstFamily')}}">
                                    @endif
                                </div>                                 
                            </div><!--container-fluid-->
                            
                            <br>
                            <div class="container-fluid">  

                                <div class="row">
                                    
                                    <h5 class="sub-separador">{{trans('text.family')}} 2</h5>
                                </div>  
                                <div class="col-md-6">
                                {{ csrf_field() }}
                                <input type="hidden" name="id[]" value="{{ $familiars[1]->id }}">

                                    <label for="first_name" class="control-label ">{{trans('text.name')}}<span class="nota">*</span></label>                             
                                    <input type="text" class="form-control " name="first_name[]" value="{{ $familiars[1]->first_name }}" id="{{trans('text.name')}}" required pattern="^[A-ZÑÁÉÍÓÚ]{1}[a-zñáéíóú]{3,32}" title="{{trans('text.title-nameSecondFamily')}}">                                       
                                </div>              

                                <div class="col-md-6">
                                    <label for="last_name" class="control-label ">{{trans('text.lastName')}}<span class="nota">*</span></label>
                                
                                    <input type="text" class="form-control  " name="last_name[]" value="{{ $familiars[1]->last_name }}" id="{{trans('text.lastName')}}" required pattern="^[A-ZÑÁÉÍÓÚ]{1}[a-zñáéíóú]{3,32}" title="{{trans('text.title-lastNameSecondFamily')}}">  
                                </div> 


                                <div class="col-md-6">
                                	<label for="title" class="control-label">{{trans('text.title')}}</label>
                                	<input type="text" name="title[]" value="{{ $familiars[1]->title }}" class="form-control" id="{{trans('text.title')}}" pattern="^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s.,]{6,64}" title="{{trans('text.title-titleSecondFamily')}}">

                                </div>

                                 <div class="col-md-6">
                                	<label for="employer" class="control-label">{{trans('text.employ')}}</label>
                                	<input type="text" name="employer[]" value="{{ $familiars[1]->employer }}" class="form-control" id="{{trans('text.employ')}}" pattern="^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s.,]{6,64}" title="{{trans('text.title-employSecondFamily')}}">
                                </div> 

                                 <div class="col-md-6">
                                	<label for="industry" class="control-label">{{trans('text.industry')}}</label>
                                	<input type="text" name="industry[]" value="{{ $familiars[1]->industry }}" class="form-control" id="{{trans('text.industry')}}" pattern="^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s.,]{6,64}" title="{{trans('text.title-industrySecondFamily')}}">
                                </div>   

                                <div class="col-md-6">
                                	<label for="city" class="control-label">{{trans('text.city')}}<span class="nota">*</span></label>
                                	<input type="text" name="city[]" value="{{ $familiars[1]->city }}" class="form-control" id="{{trans('text.city')}}" required pattern="[A-Za-z\sÑÁÉÍÓÚñáéíóú]{3,32}" title="{{trans('text.title-citySecondFamily')}}">
                                </div>   

                                <div class="col-md-6">
                                    <label for="country" class="control-label">{{trans('text.country')}}<span class="nota">*</span></label>
                                    @if(Session('applocale')=='es')
                                        {!! Form::select('familiar_country', $countries, $country_selected[1]->id, ['class' => 'form-control familiar_b_country', 'id' => 'Pais', 'required', 'title' => 'Seleccione el pais donde reside su segundo familiar']) !!}
                                    @else
                                        {!! Form::select('familiar_country', $countries, $country_selected[1]->id, ['class' => 'form-control familiar_b_country', 'id' => 'Country', 'required', 'title' => 'Select the country where your second family resides']) !!}

                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="state" class="control-label">{{trans('text.state')}}<span class="nota">*</span></label>
                                    <select name="id_state[]" class="form-control familiar_b_states_list" id="{{trans('text.state')}}" required title ="{{trans('text.title-stateSecondFamily')}}">
                                        <option value="{{ $states[1][0]->id }}"> {{ $states[1][0]->name }} </option>
                                    </select>
                                </div>

 								<div class="col-md-6 padding-check">
                                	<label for="deceased" class="control-label" >{{trans('text.deceased')}}</label>
                                    @if($familiars[1]->deceased == 0)
                                        Si <input type="radio" class="padding-check" value="1" name="deceased_b" id="{{trans('text.deceased')}}" title="{{trans('text.title-deceasedFirstFamily')}}">
                                        No <input type="radio" class="padding-check" value="0" checked name="deceased_b" id="{{trans('text.deceased')}}" title="{{trans('text.title-deceasedFirstFamily')}}">
                                    @else
                                        Si <input type="radio" class="padding-check" value="1" checked name="deceased_b" id="{{trans('text.deceased')}}" title="{{trans('text.title-deceasedFirstFamily')}}">
                                        No <input type="radio" class="padding-check" value="0"  name="deceased_b" id="{{trans('text.deceased')}}" title="{{trans('text.title-deceasedFirstFamily')}}">
                                    @endif
                                </div>                                 
                            </div><!--container-fluid-->

                            <div class="container-fluid">                
                            
                                <div class="row">
                                    <h4 class="separador">{{trans('text.siblings')}}</h4>                             
                                </div>

                                 <div class="col-md-12">
                                     <label for="siblings" class="control-label ">{{trans('text.age')}}</label>                             
                                    <input type="text" class="form-control " name="siblings" value="{{ $familiars[0]->siblings }}" pattern="[0-9,\s]{0,32}" id="{{trans('text.age')}}" title="{{trans('text.title-age')}}">                                       
                                </div>    
                            </div>    

                            
                            <input type="hidden" name="update" value="family">
                           
                            <div class="container-fluid">                
                               <div class="row buttons">
                                    <div class="col-md-3 col-sm-2 col-xs-11">
                                        <a href=" {{ url('adm/users') }}" class="btn btn-primary ">
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