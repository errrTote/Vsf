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
    
 
</head>
<body>
     
    @yield('content')
          
      
</body>

</html>