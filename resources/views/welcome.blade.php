@extends('layouts.welcome')

@if(Session('applocale')=='es')
  @section('title', 'Bienvenido')
@else
  @section('title', 'Welcome')
@endif

@if(Auth::user())
  {{ Session::put('user_id', Auth::user()->id) }}
    
    @section('content')
    
      <div class="container-fluid">
        <div class="well">
          <h2>{{trans('text.welcomeH2')}} <small>{{ Auth::user()->first_name}} {{Auth::user()->last_name }}</small> </h2>
          @if(isset($user) && isset($personal) && isset($educations) && isset($familiars) && isset($awards) && isset($essay))
            <h4>{{trans('text.welcomeH4CompleteA')}} <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> {{trans('text.welcomeH4CompleteB')}}</h4>           
          @else
            <h4>{{ trans('text.welcomeH4Info') }}</h4>             
          @endif
        </div>
      </div>

      <div class="container-fluid">
        <div class="well"> 

          <ul id="homeTab" class="nav nav-tabs nav_tabs">                            
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

      
          <div id="homeTabContent" class="tab-content">
      
            @if(isset($user))
              <div class=" tab-pane fade in active" id="user">
                <h4 class="title_info">{{ trans('text.infoUser') }} </h4>                

                <a data-toggle="modal" data-target="#modal_change_pass" class="btn btn-default right"><span class="glyphicon glyphicon-lock" title="{{trans('text.titleEditPass')}}" aria-hidden="true"></span></a>
                
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-default right"><span class="glyphicon glyphicon-pencil"  aria-hidden="true"></span></a>

                <div class="form-group">              
                  <label class="control-label">{{ trans('text.name') }}:</label>              
                  {{$user->first_name}} {{ $user->last_name}}  
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
                  <a  aria-hidden="true" href="{{ route('personals.edit', $personal->id) }}" class="btn btn-default right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
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
                <br>
                
                <?php $i=1; ?>
                  <a  href="{{ route('educations.show', Auth::user()->id) }}" class="btn btn-default right"><span class="glyphicon glyphicon-pencil" ></span></a>
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
                <a href="{{ route('familiars.edit', $familiars[0]->id_user) }}" class="btn btn-default right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                <br>
                <?php $i=0 ?>
                @foreach($familiars as $family)

                  <h5 class="sub_title_info">{{ trans('text.family') }} {{$i+1}}:</h5>

                  <div class="form-group">              
                    <label class="control-label">{{ trans('text.name') }}:</label>
                    {{ $family->first_name}} {{ $family->last_name}}                 
                  </div>               

                  <div class="form-group">              
                    <label class="control-label">{{ trans('text.deceased') }}:</label>
                    {{$family->deceased=='0'?"No":"Si"}}
                  </div>           
                      
                  <div class="form-group">              
                    <label class="control-label">{{ trans('text.relationship') }}:</label>
                    {{ $family->relationship}}                 
                  </div> 

                  <div class="form-group">              
                    <label class="control-label">{{ trans('text.ocupation') }}:</label>
                    {{ $family->ocupation}} 
                  </div>           

                  <div class="form-group">              
                    <label class="control-label">{{ trans('text.dateBirth') }}:</label>
                    {{ $family->dateBirth}} 
                  </div>  

                  <div class="form-group">              
                    <label class="control-label">{{ trans('text.email') }}:</label>
                    {{ $family->email}} 
                  </div> 

                  <div class="form-group">              
                    <label class="control-label">{{ trans('text.home-phone') }}:</label>
                    {{ $family->home_phone}} 
                  </div> 

                  <div class="form-group">              
                    <label class="control-label">{{ trans('text.movil-phone') }}:</label>
                    {{ $family->movil_phone}} 
                  </div>  

                  <div class="form-group">              
                    <label class="control-label">{{ trans('text.state') }}:</label>
                    {{ $familiars_states[$i][0]->name}} 
                  </div>  

                  <div class="form-group">              
                    <label class="control-label">{{ trans('text.country') }}:</label>
                    {{ $familiars_country_selected[$i]->name}} 
                  </div>  
                  <?php $i++; ?>
                @endforeach                
              </div>
            @endif

            @if(isset($awards[0]))
              <div class="tab-pane fade in" id="awards">  
                <h4 class="title_info">{{ trans('text.infoAwards') }}</h4>
                <a href="{{ route('awards.edit', $awards[0]->id_user) }}" class="btn btn-default right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
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
                <a href="{{ route('essays.create') }}" class="btn btn-default right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                <label for="essay" class="control-label"><span  aria-hidden="true" class="glyphicon btn-lg glyphicon-file"></span>{{ $essay->original_name }}</label> <a class="btn-lg" href="{{ route('essay.download', $essay->essay) }}"><span class="glyphicon glyphicon-download-alt"></span></a>
              </div>
            @endif
          </div><!--/tab-content-->
        </div><!--Well-->
      </div><!--Container-fluid-->

<div class="modal fade" id="modal_change_pass" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header modal-primary">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">{{trans('text.titleEditPass')}}</h4>
          </div>
          {!! Form::open(['route'=>['users.changePassowrd'], 'method'=>'POST', 'class'=>'form-horizontal edit_user']) !!}
              {{ csrf_field() }}
              <div class="modal-body">
                <div class="pswd_info" hidden>
                  <h5>{{trans('text.passRequiredTitle')}}</h5>
                  <ul>
                      <li class="letter">{{trans('text.atLeast')}}<strong> {{trans('text.letter')}}</strong></li>

                      <li class="capital">{{trans('text.atLeast')}}<strong> {{trans('text.capitalLetter')}}</strong></li>

                      <li class="number">{{trans('text.atLeast')}}<strong> {{trans('text.number')}}</strong></li>

                      <li class="length"><strong> {{trans('text.eightCharacter')}}</strong> {{trans('text.asMinimum')}}</li>
                  </ul>
              </div>

              <div class="pswd_info_b" hidden>
                  <h5>{{trans('text.passRequiredTitle')}}</h5>
                  <ul>
                      <li class="equality"><strong>{{trans('text.samePassword')}}</strong> {{trans('text.previousPass')}}</li>                         
                  </ul>
              </div> 
                <div class="input-group input_group_app">
                  <span class="input-group-addon input_group_addon_app">{{trans('text.newPassword')}}</span>
                  <input type="password" name="password" class="form-control pswd">
                </div>

                <div class="input-group input_group_app">
                  <span class="input-group-addon input_group_addon_app">{{trans('text.repeatPassword')}}</span>
                  <input type="password" name="password_b" class="form-control repswd">
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('text.close')}}</button>
                  <button type="submit" class="btn btn-primary">{{trans('text.save')}}</button>
              </div>
              <input type="hidden" name="id_user" value="{{$user->id}}">
            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal-->      
    @endsection
@else
    @section('content')
        <div class="jumbotron">
          <h1 class="h1 row">{{ trans('text.welcomeH2') }}</h1>
          <h2>VSF <small class="h1-small">- Venezuelan Scholarship Fund</small></h2>
          <h5> {{ trans('text.welcomeH5') }}</h5>
         
          <br><br>
          <a class="btn btn-primary btn-lg" href="{{  route('users.create') }}" role="button">{{ trans('text.singUp') }}</a>
          <a class="btn btn-primary btn-lg" href="{{  route('login') }}" role="button">{{ trans('text.singIn') }}</a>
               
        </div>
    @endsection
@endif