@extends('layouts.adminIndex')

@if(Session('applocale')=='es')
	@section('title', 'Administradores')
@else
	@section('title', 'Admins')
@endif

@section('content')
	<div class="container-fluid">        
        <div class="well">
            <h2>{{trans('text.adminsRegistered')}}</h2>
            <div class="container-fluid">            	
	            <table class="table table-striped table-hover table-responsive text-center" id="panelPrincipal">
	            	<thead>
	            		<th>Id</th>
	            		<th>{{trans('text.name')}}</th>
	            		<th>{{trans('text.email')}}</th>
	            		<th>{{trans('text.options')}}</th>
	            	</thead>
	            	<tbody>
	            		@foreach($admins as $admin)
							<tr>
								<td>{{ $admin->id }}</td>
								<td>{{ $admin->first_name }} {{ $admin->middle }} {{ $admin->last_name }} {{ $admin->name_mother }}</td>
								<td>{{ $admin->email }}</td>
								<td>
									<a href="{{ route('adm.admins.edit', $admin->id) }}" class="btn " title="{{trans('text.title-editButton')}} {{ $admin->first_name }} {{ $admin->last_name }}"><span class="glyphicon glyphicon-eye-open"></span>/<span class="glyphicon glyphicon-pencil"></span></a>									

									<a onclick="eliminar_administrador({{$admin->id}})"  class="delete_admin" title="{{trans('text.title-deleteButton')}}{{ $admin->first_name }} {{ $admin->last_name }}"><i class="fa fa-lg fa-trash"></i></a>
								</td>
							</tr>
	            		@endforeach
	            	</tbody>
	            </table>           
            </div>
        </div>
    </div>

    <div class="container-fluid">
    	<div class="well">
    		<h4>{{trans('text.addAdminUser')}} <a href="{{ route('adm.admins.create') }}" class="btn btn-primary"> <span class="glyphicon glyphicon-plus"></span></a></h4>
    		
    	</div>
    </div>

	<div class="modal fade" id="delete_admin_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cuidado!</h4>
            </div>
            <div class="modal-body">
                Desea eliminar al administrador<b id="modal_admin_name"></b>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a id="link_eliminar" type="button" class="btn btn-primary">Eliminar</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal-->      


<script>
	function eliminar_administrador(id){
	
     $('#delete_admin_modal').modal('show'); 
     // ajax delete data to database
        $.ajax({        	
        	type: "get",
        	dataType: 'json',
        	url: "admins/data/"+id,
        
        
        success: function(data){
            /*
            * Se ejecuta cuando termina la petición y esta ha sido
            * correcta
            * */
            $("#modal_admin_name").html(data['first_name']+" "+data['last_name']);
            $("#link_eliminar").attr("href", "destroy/"+data['id']);

        },
        error: function(data){
            /*
            * Se ejecuta si la peticón ha sido erronea
            * */
            alert("Problemas al tratar de enviar el formulario");
        }

     });

  }
</script>
@endsection()