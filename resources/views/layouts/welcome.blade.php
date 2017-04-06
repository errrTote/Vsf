<!DOCTYPE html>
<html lang="es">
<head class="maqueta">
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" type="img/png"  href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('librerias/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('librerias/bootstrap/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('librerias/chosen/chosen.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('librerias/datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{ asset('librerias/datePicker/css/bootstrap-datepicker.standalone.css')}}">

    <script src="{{ asset('librerias/js/jquery.js') }}" ></script>    
    <script src="{{ asset('librerias/bootstrap/js/bootstrap.js') }}" ></script>
    <script src="{{ asset('librerias/chosen/chosen.jquery.js') }}" ></script>
    <script src="{{ asset('librerias/js/main.js') }}" ></script>    
    <script src="{{ asset('librerias/datePicker/js/bootstrap-datepicker.js')}}"></script>

    <!-- DataTable-->
    <script src="{{ asset('librerias/datatables/media/js/jquery.dataTables.js') }}" ></script>    
    <script src="{{ asset('librerias/datatables/media/js/dataTables.bootstrap.min.js') }}" ></script>
    
    <!-- Languaje -->
    <script src="{{ asset('librerias/datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
    <title>@yield('title') - VSF</title>
 
</head>
<body>
  <header class="maqueta">
    <img src="{{ asset('img/bannerB.png') }}" class="img-responsive banner" alt="">
  </header>

  @if(Session('applocale')=='es')
    <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Web navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="http://venezuelanscholarshipfund.org/">{{trans('text.index')}}</a>
      </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li ><a href="http://venezuelanscholarshipfund.org/a-quienes-buscamos-2">{{trans('text.whoWeAreLookingFor')}}</a></li>

          <li><a href="http://venezuelanscholarshipfund.org/quienes-somos">{{trans('text.aboutUs')}}</a></li>        
          <li class="active"><a >{{trans('text.profile')}}</a></li>        
          <li><a href="http://venezuelanscholarshipfund.org/donaciones">{{trans('text.donations')}}</a></li>        
          <li><a href="http://venezuelanscholarshipfund.org/fechas-de-aplicacion">{{trans('text.aplicationDates')}}</a></li>        
          <li><a href="http://venezuelanscholarshipfund.org/preguntas-frecuentes">{{trans('text.frequentQuestions')}}</a></li>     
        </ul>   
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{ route('change_locale','en')}}" class="lang">ESPAÑOL <i class="fa fa-language lang" title="{{ trans('text.language') }}" aria-hidden="true"></i></a></li>
        </ul>     
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>  
  @else
    <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Web navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="http://venezuelanscholarshipfund.org/english/">{{trans('text.index')}}</a>
      </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li ><a href="http://venezuelanscholarshipfund.org/english/who-we-are-looking-for/">{{trans('text.whoWeAreLookingFor')}}</a></li>

          <li><a href="http://venezuelanscholarshipfund.org/english/who-we-are/">{{trans('text.aboutUs')}}</a></li>        
          <li class="active"><a >{{trans('text.profile')}}</a></li>        
          <li><a href="http://venezuelanscholarshipfund.org/english/sample-page/">{{trans('text.donations')}}</a></li>        
          <li><a href="http://venezuelanscholarshipfund.org/english/application-dates/">{{trans('text.aplicationDates')}}</a></li>        
          <li><a href="http://venezuelanscholarshipfund.org/english/frequent-questions/">{{trans('text.frequentQuestions')}}</a></li>  
        </ul>    
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{ route('change_locale','es')}}" class="lang">ENGLISH <i class="fa fa-language lang" title="{{ trans('text.language') }}" aria-hidden="true"></i></a></li>
        </ul>  
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>  
  @endif
	
  <div class="container-fluid maqueta">
    <div class="main-row">
      @if(Auth::user())
      <?php 
          $user         = DB::table('users')->where('id', Auth::user()->id)->first();
          $personal     = DB::table('personals')->where('id_user', Auth::user()->id)->first();
          $educations   = DB::table('educations')->where('id_user', Auth::user()->id)->orderBy('period', 'ASC')->get();     
          $familiars    = DB::table('familiars')->where('id_user', Auth::user()->id)->get();
          $awards       = DB::table('awards')->where('id_user', Auth::user()->id)->get();
          $essay        = DB::table('essay')->where('id_user', Auth::user()->id)->first();
        ?>
      
        <div class="sidebar col-sm-12 col-md-2">
          <div class="list-group menu">           
            <spam class="list-group-item active">
              <small>{{ trans('text.menu') }} </small>
            </spam>
           
             <a href="{{url('/')}}" id="home" class="list-group-item">
              {{ trans('text.home') }}
            </a>
            @if(isset($personal))
            <a href="{{ route('personals.edit', $personal->id) }}" class="list-group-item">{{ trans('text.navPersonal') }}</a>
            @else
            <a href="{{ route('personals.create') }}" class="list-group-item">{{ trans('text.navPersonal') }}</a>
            @endif

            @if(isset($educations[0]))
              <a href="{{ route('educations.show', Auth::user()->id) }}" class="list-group-item">{{ trans('text.navEducation') }}</a>   
            @else
              <a href="{{ route('educations.create') }}" class="list-group-item">{{ trans('text.navEducation') }}</a>   
            @endif 

            @if(isset($familiars[0]))
              <a href="{{ route('familiars.edit', $familiars[0]->id_user) }}" class="list-group-item">{{ trans('text.navFamily') }}</a>
            @else
              <a href="{{ route('familiars.create') }}" class="list-group-item">{{ trans('text.navFamily') }}</a>
            @endif

            @if(isset($awards[0]))
              <a href="{{ route('awards.edit', $awards[0]->id_user)}}" class="list-group-item">{{ trans('text.navAwards') }}</a>
            @else
              <a href="{{ route('awards.create')}}" class="list-group-item">{{ trans('text.navAwards') }}</a>

            @endif           
              <a href="{{ route('essays.create')}}" class="list-group-item">{{ trans('text.navEssay') }}</a> 
                 
            <a href="{{ url('/logout') }}" class="list-group-item">({{ Auth::user()->first_name }}) {{ trans('text.navOut') }} <span class="glyphicon glyphicon-user"></span> </a>   
          </div>
        </div>     
        <div class="col-sm-12 col-md-10  content">        
          @include('flash::message')

         @if(count($errors)>0)
            <div class="alert alert-danger"> 
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                
                @endforeach
              </ul>
            </div>
          @endif     
          @yield('content')
          
        </div> 
      @else
        <div class="col-sm-12 col-md-12  content">        
          @include('flash::message')
          @yield('content')

          @if(count($errors)>0)
            <div class="alert alert-danger"> 
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                
                @endforeach
              </ul>
            </div>
          @endif     
        </div> 
      @endif  
    </div><!--main-row-->   
  </div><!--container-fluid-->

  
  <footer class="maqueta">
      <div class="col-md-1 col-xs-3 col-sm-2 col-lg-1 col-md-offset-10 col-xs-offset-5">          
        <img src="{{ asset('img/KTlogo.png') }}" class="Ktlogo"></img>
      </div> 
    </footer>
</body>

</html>