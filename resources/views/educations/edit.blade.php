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
                        {{trans('text.editEducationTitle')}}
                    </h3>
                    <h5>
                        {{trans('text.requiredC')}}                        
                    </h5>
                </div>

                <div class="panel-body"> 
                    <div class="container-fluid">                        
                        {!! Form::open(['route'=>['educations.update', $education->id], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}                   
                        {{ csrf_field() }}
                        
                            <div class="container-fluid">  
                                <div class="row">
                                    <h4 class="separador">{{trans('text.secundari')}}</h4>
                                </div>  

                                <div class="col-md-12">
                                    <label for="name" class="control-label ">{{trans('text.name')}}</label>

                                    <input type="text" class="form-control" id="{{trans('text.institute')}}" name="name" value="{{ $education->name }}"   title="{{trans('text.title-secundariName')}}">
                                    <input type="hidden" name="type" value="s">
                                    <input type="hidden" name="id" value="{{ $education->id }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="address" class="control-label">{{trans('text.address')}}</label>
                                    <input type="text" id="{{trans('text.instituteAddress')}}" name="address" value="{{ $education->address }}" class="form-control"   title="{{trans('text.title-addressInstitute')}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="city" class="control-label">{{trans('text.city')}}</label>
                                    <input type="text" name="city" value="{{ $education->city }}" id="{{trans('text.city')}}" class="form-control"   title="{{trans('text.title-cityIntitute')}}">
                                </div> 

                                <div class="col-md-6">
                                    <label for="country" class="control-label">{{trans('text.country')}}</label>
                                    @if(Session('applocale')=='es')
                                        {!! Form::select('education_country', $countries, $country_selected->id, ['class' => 'form-control education_country', 'id' => 'País', 'title' => 'Seleccione el país del instituto']) !!}
                                    @else
                                        {!! Form::select('education_country', $countries, $country_selected->id, ['class' => 'form-control education_country', 'id' => 'Country', 'title' => 'Select country institute']) !!}

                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="city" class="control-label">{{trans('text.state')}}</label>
                                    <select name="id_state" id="{{trans('text.state')}}" class="form-control education_states_list" title="{{trans('text.title-stateInstitute')}}">
                                    <option value="{{ $state->id }}"> {{ $state->name }} </option>

                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="type" class="control-label ">{{trans('text.type')}}</label>
                                    <select name="type" id="{{trans('text.type')}}" title="{{trans('text.title-type')}}" class="form-control">
                                        <option value="{{$education->type}}">
                                            {{$education->type =='h'?trans("text.university") : trans("text.secundari") }}
                                        </option>
                                        <option value="null" disabled></option>
                                        <option value="s">{{trans('text.secundari')}}</option>
                                        <option value="h">{{trans('text.university')}}</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="family_name" class="control-label ">{{trans('text.period')}}</label>

                                    <input type="text" class="form-control" id="{{trans('text.period')}}" name="period" value="{{ $education->period }}"   title="{{trans('text.title-period')}}">  
                                </div>

                                <div class="col-md-12">
                                    <label for="career" class="control-label ">{{trans('text.career')}}</label>

                                    <input type="text" class="form-control" id="{{trans('text.career')}}" name="career" value="{{ $education->career }}"  title="{{trans('text.title-career')}}">  
                                </div>
                            </div><!--container-fluid--> 
                            <div class="container-fluid">                
                                <div class="row buttons">
                                    <div class="col-md-3 col-sm-2 col-xs-11">
                                        <a href="{{ route('educations.show', Auth::user()->id)}}" class="btn btn-primary ">
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
                </div><!--panel-body-->             
            </div><!--jumbotron-->
        </div><!--col-md-->           
    </div><!--row-->
</div><!--container-fluid-->
    {!! Form::open(['route' => ['states', ':USER_ID'], 'method' => 'get', 'class' => 'form-states'])  !!}
    {!! Form::close()!!}
@endsection