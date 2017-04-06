@extends('layouts.admin')

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
                            {{trans('text.editEducationTitle')}}
                        </h3>
                        <h5>{{trans('text.requiredA')}}<span class="nota">*</span>{{trans('text.requiredB')}}</h5>
                    </div>
        
                    <div class="panel-body">    
                        {!! Form::open(['route'=>['adm.users.update', $educations[0]->id_user], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}        			
                        
                            {{ csrf_field() }}

							
                            <div class="container-fluid">  

								<div class="row">
									<h4 class="separador">{{trans('text.highSchool')}}</h4>
								</div>	
	                            <div class="col-md-6">
	                            	<input type="hidden" name="career[]" value="Bachiller">
                                    <label for="name" class="control-label ">{{trans('text.institute')}}</label>
                              
                                    <input type="text" class="form-control" id="{{trans('text.institute')}}" name="name[]" value="{{ $educations[0]->name }}" required pattern="[A-Za-z\sÑÁÉÍÓÚñáéíóú.]{8,32}" title="{{trans('text.title-secundariName')}}">  
                                        <input type="hidden" name="type[]" value="s">
                                        <input type="hidden" name="id[]" value="{{ $educations[0]->id }}">
	                            </div>              

                            	<div class="col-md-6">
                                    <label for="family_name" class="control-label ">{{trans('text.period')}}</label>
                                
                                    <input type="text" class="form-control" id="{{trans('text.period')}}" name="period[]" value="{{ $educations[0]->period }}" required pattern="[0-9-]{9}" title="{{trans('text.title-period')}}">  
                                </div> 


                                <div class="col-md-6">
                                	<label for="address" class="control-label">{{trans('text.address')}}</label>
                                	<input type="text" id="{{trans('text.address')}}" name="address[]" value="{{ $educations[0]->address }}" class="form-control" required pattern="^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s#.-°]{6,32}" title="{{trans('text.title-addressInstitute')}}">
                                </div>

                                 <div class="col-md-6">
                                	<label for="city" class="control-label">{{trans('text.city')}}</label>
                                	<input type="text" name="city[]" value="{{ $educations[0]->city }}" id="{{trans('text.city')}}" class="form-control" required pattern="[A-Za-z\sÑÁÉÍÓÚñáéíóú]{3,32}" title="{{trans('text.title-cityIntitute')}}">
                                </div> 

                                 <div class="col-md-6">
                                	<label for="country" class="control-label">{{trans('text.country')}}</label>
                                    @if(Session('applocale')=='es')
                                       {!! Form::select('education_country', $countries, $country_selected[0]->id, ['class' => 'form-control education_country', 'id' => 'Pais', 'required', 'title' => 'Seleccione el pais del isntituto']) !!}
                                    @else
                                	   {!! Form::select('education_country', $countries, $country_selected[0]->id, ['class' => 'form-control education_country', 'id' => 'Country', 'required', 'title' => 'Select country institute']) !!}

                                    @endif
                                </div>

                                 <div class="col-md-6">
                                	<label for="city" class="control-label">{{trans('text.state')}}</label>
                                	<select name="id_state[]" id="{{trans('text.state')}}" class="form-control education_states_list" title="{{trans('text.title-stateInstitute')}}">
                                        <option value="{{ $states[0][0]->id }}"> {{ $states[0][0]->name }} </option>

                                    </select>
                                </div>  
                            </div><!--container-fluid-->	


                            <br>


                            <div class="container-fluid university">
                                <div class="row">
                                    <h4 class="separador">{{trans('text.university')}}</h4>
                                </div> 
                               <?php $i=0; ?>

                               @foreach ($educations_h as $university)
                                    <?php $i++; ?>
                                    <div class="copy" >

                                        <div class="new">                                        
                                        
                                            <div class="col-md-12">
                                                <label for="career" class="control-label ">{{trans('text.career')}}</label>
                                          
                                                <input type="text" class="form-control" id="{{trans('text.career')}}" name="career[]" value="{{ $university->career }}" required pattern="[A-Za-z\sÑÁÉÍÓÚñáéíóú]{8,32}" title="{{trans('text.title-career')}}">  
                                                    
                                            </div>      

                                            <div class="col-md-6">
                                                <label for="name" class="control-label ">{{trans('text.institute')}}</label>
                                          
                                                <input type="text" class="form-control" id="{{trans('text.institute')}}" name="name[]" value="{{ $university->name }}" required pattern="[A-Za-z\sÑÁÉÍÓÚñáéíóú.]{8,32}" title="{{trans('text.title-universityName')}}">  
                                                <input type="hidden" name="type[]" value="h">
                                                    
                                            </div>              

                                            <div class="col-md-6">
                                                <label for="family_name" class="control-label ">{{trans('text.period')}}</label>
                                            
                                                <input type="text" class="form-control" id="{{trans('text.period')}}" name="period[]" value="{{ $university->period }}" required pattern="[0-9-]{9}" title="{{trans('text.title-period')}}">  
                                            </div> 


                                            <div class="col-md-6">
                                                <label for="address" class="control-label">{{trans('text.address')}}</label>
                                                <input type="text" id="{{trans('text.address')}}" name="address[]" value="{{ $university->address }}" class="form-control" required pattern="^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s#.-°]{6,32}" title="{{trans('text.title-addressInstitute')}}">
                                            </div>

                                             <div class="col-md-6">
                                                <label for="city" class="control-label">{{trans('text.city')}}</label>
                                                <input type="text" name="city[]" value="{{$university->city}}" id="{{trans('text.city')}}" class="form-control" required pattern="[A-Za-z\sÑÁÉÍÓÚñáéíóú]{3,32}" title="{{trans('text.title-cityIntitute')}}" >
                                            </div> 

                                            <div class="col-md-6">
                                                <label for="country" class="control-label">{{trans('text.country')}}</label>
                                                @if(Session('applocale')=='es')
                                                    {!! Form::select('education_country', $countries, $country_selected[$i]->id, ['class' => 'form-control education_country_university_edit'.$i, 'id' => 'Pais', 'required', 'title' => 'Seleccione el pais del isntituto']) !!}
                                                @else
                                                    {!! Form::select('education_country', $countries, $country_selected[$i]->id, ['class' => 'form-control education_country_university_edit'.$i, 'id' => 'Country', 'required', 'title' => 'Select country institute']) !!}

                                                @endif
                                            </div>

                                             <div class="col-md-6">
                                                <label for="city" class="control-label">{{trans('text.state')}}</label>
                                                <select name="id_state[]" id="{{trans('text.state')}}" class="form-control education_states_list_university_edit{{$i}}" title="{{trans('text.title-stateInstitute')}}">
                                                     <option value="{{ $states[$i][0]->id }}"> {{ $states[$i][0]->name }} </option>
                                                </select>
                                                <hr>
                                            </div>
                                        </div>
                                                                     
                                    </div> 
                                    <input type="hidden" name="id[]" value="{{ $educations[$i]->id }}">
                                @endforeach
                            </div>
                            <div class="new_university container-fluid">
                                
                            </div>
                           
                            <input type="hidden" name="update" value="education">
                            <div>
                            
                                <h5>{{trans('text.addUniversity')}} <a href="{{ route('adm.users.add', [$educations[$i]->id_user, 'university']) }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> </a></h5>
                            </div>                           
                           
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
@endsection