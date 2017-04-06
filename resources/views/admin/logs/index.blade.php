@extends('layouts.adminIndex')
@if(Session('applocale')=='es')
	@section('title', 'Historial')
@else
	@section('title', 'Log')
@endif
@section('content')
	<div class="container-fluid">        
        <div class="well">
            <h2>{{trans('text.logsList')}}</h2>
            <ul id="logTab" class="nav nav-tabs nav_tabs">
	            @if(isset($logs))
	              <li class="active"><a href="#usuarios"  data-toggle="tab">{{trans('text.users')}}</a></li>
	            @endif
	            @if(isset($logsAdmins))
	              <li ><a href="#admins" data-toggle="tab">{{trans('text.admins')}}</a></li>
	            @endif
          	</ul>

         	<div id="logTabContent" class="tab-content container-fluid">
      
	            @if(isset($logs))
	              	<div class=" tab-pane fade in active" id="usuarios">		            	  	
		           		<table class="table table-striped table-hover table-responsive text-center" id="panelPrincipal">
			            	<thead>
								<th>{{trans('text.id')}}</th>
								<th>{{trans('text.user')}}</th>
			            		<th>{{trans('text.date')}}</th>	
								<th>{{trans('text.description')}}</th>
			            	</thead>
			            	<tbody>
			            		@foreach($logs as $log)
									<tr>
										<td>{{ $log->id_entry }}</td>
										<td>{{ $log->email }}</td>
										<td>{{ $log->date }}</td>
										<td> {{ $log->action}}
										{{ $log->description}}</td>
									</tr>
			            		@endforeach
			            	</tbody>
		            	</table>
		            </div>
		         @endif

		         @if(isset($logsAdmins))
	              	<div class="tab-pane fade in " id="admins">
		           		 <table class="table table-striped table-hover table-responsive text-center" id="panelSecundario" style="width: 100%;">
			            	<thead>
								<th>{{trans('text.id')}}</th>
								<th>{{trans('text.user')}}</th>
			            		<th>{{trans('text.date')}}</th>	
								<th>{{trans('text.description')}}</th>
			            	</thead>
			            	<tbody>
			            		@foreach($logsAdmins as $logAdmins)
									<tr>
										<td>{{ $logAdmins->id_entry }}</td>
										<td>{{ $logAdmins->email }}</td>
										<td>{{ $logAdmins->date }}</td>
										<td> {{ $logAdmins->action}}
										{{ $logAdmins->description}}</td>						
									</tr>
			            		@endforeach
			            	</tbody>
		            	</table>           
		            </div>
		        @endif
        	</div>
        </div>
    </div>
@endsection()