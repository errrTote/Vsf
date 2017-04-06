@extends('layouts.adminIndex')

@section('title', 'Usuarios')

@section('content')
	<div class="container-fluid">        
    <div class="well">
       	<h3>{{trans('text.detailsUser')}}<small><label class="control-label">{{ $user->first_name }} {{ $user->middle }} {{ $user->last_name }} {{ $user->name_mother }}</label></small></h3>
       	<a href="{{ url('/adm/users')}}" class="btn btn-primary ">
            <span class="glyphicon glyphicon-arrow-left"></span> {{trans('text.back')}}
       	</a>
    </div>
  </div>

  <ul id="adminUsarTab" class="nav nav-tabs nav_tabs">                            
    <li class="active"><a href="#user" data-toggle="tab">{{trans('text.infoUser')}}</a></li>
    @if(isset($personal))
      <li ><a href="#personal" data-toggle="tab">{{trans('text.infoPersonal')}}</a></li>
    @endif
    @if(isset($educations[0]))
      <li ><a href="#education" data-toggle="tab">{{trans('text.infoEducation')}}</a></li>
    @endif

    @if(isset($familiars[0]))
      <li ><a href="#familiars" data-toggle="tab">{{trans('text.infoFamily')}}</a></li>
    @endif
    @if(isset($awards[0]))
      <li ><a href="#awards" data-toggle="tab">{{trans('text.infoAwards')}}</a></li>
    @endif
    @if(isset($essay))
      <li ><a href="#essay" data-toggle="tab">{{trans('text.infoEssay')}}</a></li>
    @endif
  </ul>

  <div class="container-fluid">
    <div class="well">
      <div id="homeTabContent" class="tab-content">
      
        @if(isset($user))
          <div class=" tab-pane fade in active" id="user">
            <h4 class="title_info">{{ trans('text.infoUser') }} </h4>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-default right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
            <div class="form-group">              
              <label class="control-label">{{ trans('text.name') }}:</label>              
              {{$user->first_name}} {{ $user->middle}} {{ $user->last_name}} {{ $user->name_mother}} 
            </div>    

            <div class="form-group">    
              <label for="Correo" class="control-label">{{ trans('text.email') }}:</label>
              {{ $user->email}}               
            </div> 
          </div>
        @endif

        @if(isset($personal))
          <div class="tab-pane fade in" id="personal">                
            <h4 class="title_info">{{ trans('text.infoPersonal') }} </h4>             
              <a  aria-hidden="true" href="{{ route('adm.users.edit', [$personal->id, 'personal']) }}" class="btn btn-default right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
            <div class="form-group">              
              <label for="gender" class="control-label">{{ trans('text.gender') }}:</label>
              {{$personal->gender=='Masculino'?"Masculino":"Femenino"}}                 
            </div>    

            <div class="form-group">    
              <label for="Telefonos" class="control-label">{{ trans('text.phones') }}:</label>
              {{ $personal->home_phone}} -
              {{ $personal->movil_phone}}         
            </div>   

            <h5 class="sub_title_info">{{ trans('text.permanentAddress') }}:</h5>
            
            <div class="form-group">              
              <label for="Street Address"class="control-label">{{ trans('text.address') }}:</label>
              {{ $personal->permanent_address}} 
            </div>           

            <div class="form-group">              
              <label for="city"class="control-label">{{ trans('text.city') }}:</label>
              {{ $personal->permanent_city}} 
            </div>           

            <div class="form-group">              
              <label for="postal code"class="control-label">{{ trans('text.postalCode') }}:</label>
              {{ $personal->permanent_postal_code}} 
            </div>           
                
            <div class="form-group">              
              <label for="state"class="control-label">{{ trans('text.state') }}:</label>
              {{ $permanent_state->name }}                 
            </div>

            <div class="form-group">              
              <label for="state"class="control-label">{{ trans('text.country') }}:</label>
              {{ $permanent_country->name }}                 
            </div>           

            <h5 class="sub_title_info">{{ trans('text.residenceAddress') }}:</h5>

            <div class="form-group">              
              <label for="Street Address"class="control-label">{{ trans('text.address') }}:</label>
              {{ $personal->residence_address}} 
            </div>           

            <div class="form-group">              
              <label for="city"class="control-label">{{ trans('text.city') }}:</label>
              {{ $personal->residence_city}} 
            </div>           

            <div class="form-group">              
              <label for="postal code"class="control-label">{{ trans('text.postalCode') }}:</label>
              {{ $personal->residence_postal_code}} 
            </div>           
                
             <div class="form-group">              
              <label for="state"class="control-label">{{ trans('text.state') }}:</label>
              {{ $residence_state->name }}
            </div>      

             <div class="form-group">              
              <label for="state"class="control-label">{{ trans('text.country') }}:</label>
              {{ $residence_country->name }}
            </div>      

            <h5 class="sub_title_info">{{ trans('text.birth') }}:</h5>

            <div class="form-group">              
              <label for="Birth Date"class="control-label">{{ trans('text.birthDate') }}:</label>
              {{ $personal->birth_date}} 
            </div>           

            <div class="form-group">              
              <label for="city"class="control-label">{{ trans('text.city') }}:</label>
              {{ $personal->birth_city}} 
            </div>    
                
             <div class="form-group">              
              <label for="state"class="control-label">{{ trans('text.state') }}:</label>
              {{ $birth_state->name }}                 
            </div>
            <div class="form-group">              
              <label for="state"class="control-label">{{ trans('text.country') }}:</label>
              {{ $birth_country->name }}                 
            </div>                   
          </div>
        @endif

        @if(isset($educations[0]))
          <div class="tab-pane fade in" id="education"> 
            <h4 class="title_info">{{ trans('text.infoEducation') }} </h4>
            <a  href="{{ route('adm.users.edit', [$user->id, 'education']) }}" class="btn btn-default right"><span class="glyphicon glyphicon-pencil" ></span></a>
            <br>
            
            <?php $i=1; ?>
            @foreach($educations as $education)

              @if($education->type == 's')
                <h5 class="sub_title_info">{{ trans('text.highSchool') }}:</h5>  
              @endif

              @if($education->type == 'h')
                <h5 class="sub_title_info">{{ trans('text.university') }}: </h5>
              @endif 
             

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
            @endforeach
          </div>
        @endif

        @if(isset($familiars[0]))
          <div class="tab-pane fade in" id="familiars">
            <h4 class="title_info">{{ trans('text.infoFamily') }}</h4>
            <a href="{{ route('adm.users.edit', [$user->id, 'family']) }}" class="btn btn-default right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
            <br>
            <?php $i=0 ?>
            @foreach($familiars as $family)

              <h5 class="sub_title_info">{{ trans('text.family') }} {{$i+1}}:</h5>

              <div class="form-group">              
                <label for="First Name"class="control-label">{{ trans('text.name') }}:</label>
                {{ $family->first_name}} {{ $family->last_name}}                 
              </div>               

              <div class="form-group">              
                <label for="Dceased"class="control-label">{{ trans('text.deceased') }}:</label>
                {{$family->deceased=='0'?"No":"Si"}}
              </div>           
                  
               <div class="form-group">              
                <label for="title"class="control-label">{{ trans('text.title') }}:</label>
                {{ $family->title}}                 
              </div> 

              <div class="form-group">              
                <label for="Employer"class="control-label">{{ trans('text.employ') }}:</label>
                {{ $family->employer}} 
              </div>           

              <div class="form-group">              
                <label for="Industry"class="control-label">{{ trans('text.industry') }}:</label>
                {{ $family->industry}} 
              </div>  

              <div class="form-group">              
                <label for="City"class="control-label">{{ trans('text.city') }}:</label>
                {{ $family->city}} 
              </div>  

              <div class="form-group">              
                <label for="State"class="control-label">{{ trans('text.state') }}:</label>
                {{ $familiars_states[$i][0]->name}} 
              </div>  

              <div class="form-group">              
                <label for="State"class="control-label">{{ trans('text.country') }}:</label>
                {{ $familiars_country_selected[$i]->name}} 
              </div>  
              <?php $i++; ?>
            @endforeach 

            <h5 class="sub_title_info">{{ trans('text.siblings') }}:</h5>

            <div class="form-group">              
              <label for="Siblings"class="control-label">{{ trans('text.age') }}:</label>
              {{ $family->siblings}} 
            </div>  
            
          </div>
        @endif

        @if(isset($awards[0]))
          <div class="tab-pane fade in" id="awards">  
            <h4 class="title_info">{{ trans('text.infoAwards') }}</h4>
            <a href="{{ route('adm.users.edit', [$user->id, 'award']) }}" class="btn btn-default right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
            <br>
            <?php $i=1; ?>
            @foreach($awards as $award)

              <h5 class="sub_title_info">{{ trans('text.awardCount') }} {{$i}}:</h5>

              <div class="form-group">              
                <label for="Title"class="control-label">{{ trans('text.title') }}:</label>
                {{ $award->title}}          
              </div>  

              <div class="form-group">              
                <label for="Date"class="control-label">{{ trans('text.date') }}:</label>
                {{ $award->date}}          
              </div>  

              <div class="form-group">              
                <label for="Description"class="control-label">{{ trans('text.description') }}:</label>
                {{ $award->description}}          
              </div>    
                <?php $i++; ?>                     
            @endforeach
          </div>
        @endif

        @if(isset($essay))
          <div class="tab-pane fade in" id="essay"> 
            <h4 class="title_info">{{ trans('text.infoEssay') }}</h4>
            <a href="{{ route('adm.users.edit', [$user->id, 'essay']) }}" class="btn btn-default right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
            <label for="essay" class="control-label"><span  aria-hidden="true" class="glyphicon btn-lg glyphicon-file"></span>{{ $essay->original_name }}</label> <a class="btn-lg" href="{{ route('essay.download', $essay->essay) }}"><span class="glyphicon glyphicon-download-alt"></span></a>
          </div>
        @endif
      </div><!--/tab-content-->
    </div>
  </div>



  <div class="container-fluid">
  	<div class="well">
  		<a href="{{ url('/adm/users')}}" class="btn btn-primary ">
          <span class="glyphicon glyphicon-arrow-left"></span> {{trans('text.back')}}
     	</a>
  	</div>
  </div>
@endsection()