@extends('layouts.welcome')

@if(Session('applocale')=='es')
    @section('title', 'Información Académica')
@else
    @section('title', 'Academic information')
@endif

@section('content')
  <div class="container-fluid">                
        <div class="row">
            <div class="col-md-12 ">
                <div class="jumbotron">
                    <div class="panel-heading">
                        <h3>                        
                            {{trans('text.editEducationTitle')}}
                        </h3>
                       
                    </div>
        
                    <div class="panel-body"> 
                      <div class="container-fluid">            
                        
                        <h4 class="title_info">{{ trans('text.infoEducation') }} </h4>
                        <br>
                        <h5 class="sub_title_info">{{ trans('text.docs') }}:</h5>  
                        <label class="control-label"><span  aria-hidden="true" class="glyphicon btn-lg glyphicon-file"></span>{{ $educations[0]->notes }}</label> <a class="btn-lg" href="{{ route('educations.download.score', $educations[0]->notes) }}"><span class="glyphicon glyphicon-download-alt"></span></a>
                        <br>
                        <label class="control-label"><span  aria-hidden="true" class="glyphicon btn-lg glyphicon-file"></span>{{ $educations[0]->sat }}</label> <a class="btn-lg" href="{{ route('educations.download.sat', $educations[0]->sat) }}"><span class="glyphicon glyphicon-download-alt"></span></a>
                        <br>
                        <label class="control-label"><span  aria-hidden="true" class="glyphicon btn-lg glyphicon-file"></span>{{ $educations[0]->toefl }}</label> <a class="btn-lg" href="{{ route('educations.download.toefl', $educations[0]->toefl) }}"><span class="glyphicon glyphicon-download-alt"></span></a>
                        <hr>
                        <?php $i=1; ?>
                        @foreach($educations as $education)
                          @if($education->type == 's')
                            <h5 class="sub_title_info">{{ trans('text.highSchool') }}:</h5>  
                          @endif

                          @if($education->type == 'h')
                            <h5 class="sub_title_info">{{ trans('text.university') }}: </h5>
                          @endif                      

                          <a href="{{ route('educations.destroy', $education->id) }}" class="btn btn-default right"><span class="glyphicon glyphicon-trash"></span></a>
                            
                          <a href="{{ route('educations.edit', $education->id) }}" class="btn btn-default right"><span class="glyphicon glyphicon-pencil"></span></a>
                          
                          <div class="form-group">              
                            <label for="Career"class="control-label">{{ trans('text.career') }}:</label>
                            {{ $education->career}} 
                          </div>  

                          <div class="form-group">              
                            <label for="name"class="control-label">{{ trans('text.name') }}:</label>
                            {{ $education->name}} 
                          </div>   

                          <div class="form-group">              
                            <label for="Period"class="control-label">{{ trans('text.period') }}:</label>
                            {{ $education->period}} 
                          </div>           
                              
                           <div class="form-group">              
                            <label for="address"class="control-label">{{ trans('text.address') }}:</label>
                            {{ $education->address}}                 
                          </div> 

                          <div class="form-group">              
                            <label for="City"class="control-label">{{ trans('text.city') }}:</label>
                            {{ $education->city}} 
                          </div>           

                          <div class="form-group">              
                            <label for="State"class="control-label">{{ trans('text.state') }}:</label>
                            {{  $states[$i-1][0]->name}} 
                          </div>

                          <div class="form-group">              
                            <label for="State"class="control-label">{{ trans('text.country') }}:</label>
                            {{  $country_selected[$i-1]->name }} 
                          </div>
                          <?php $i++; ?>
                          <hr>
                        @endforeach                          
                      </div><!--container-fluid-->                        
                        <div>
                          <h5>{{trans('text.addUniversity')}} <a href="{{route('educations.create')}}" class="btn btn-primary" ><span class="glyphicon glyphicon-plus"></span> </a></h5>
                        </div>
                    </div><!--panel-body-->             
                </div><!--jumbotron-->
            </div><!--col-md-->           
        </div><!--row-->
    </div><!--container-fluid-->
    {!! Form::open(['route' => ['states', ':USER_ID'], 'method' => 'get', 'class' => 'form-states'])  !!}
    {!! Form::close()!!}
@endsection