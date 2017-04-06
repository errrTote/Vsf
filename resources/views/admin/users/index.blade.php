@extends('layouts.adminIndex')
@if(Session('applocale')=='es')
	@section('title', 'Usuarios')
@else
	@section('title', 'Users')
@endif
@section('content')
	<div class="container-fluid">        
        <div class="well">
            <h2>{{trans('text.usersList')}}</h2>
            <div class="container-fluid">            	
	            <table class="table table-striped table-hover table-responsive text-center" id="panelPrincipal">
	            	<thead>
	            		<th>{{trans('text.id')}}</th>
	            		<th>{{trans('text.name')}}</th>
	            		<th>{{trans('text.email')}}</th>
	            		<th>{{trans('text.options')}}</th>
	            	</thead>
	            	<tbody>
	            	
	            		@foreach($users as $user)							
							<tr>
								<td>{{ $user->id }}</td>
								<td>{{ $user->first_name }} {{ $user->middle }} {{ $user->last_name }} {{ $user->name_mother }}</td>
								<td>{{ $user->email }}</td>
								<td>
									<a href="{{ route('adm.users.show', $user->id) }}"  class="btn" title="{{trans('text.title-editButton')}}{{ $user->first_name }} {{ $user->last_name }}"><span class="glyphicon glyphicon-eye-open"></span>/<span class="glyphicon glyphicon-pencil"></span></a>

									<a onclick="eliminar_usuario({{$user->id}})"  class="delete_user" title="{{trans('text.title-deleteButton')}}{{ $user->first_name }} {{ $user->last_name }}"><i class="fa fa-lg fa-trash"></i></a>
								</td>							
							</tr>							
	            		@endforeach
	            	</tbody>
	            </table>           
            </div>
        </div>
    </div>

<div class="modal fade" id="delete_user_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cuidado!</h4>
            </div>
            <div class="modal-body">
                Desea eliminar el usuario <b id="modal_user_name"></b>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a id="link_eliminar" type="button" class="btn btn-primary">Eliminar</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal-->      


<script>
	function eliminar_usuario(id){
	
     $('#delete_user_modal').modal('show'); 
     // ajax delete data to database
        $.ajax({        	
        	type: "get",
        	dataType: 'json',
        	url: "users/data/"+id,
        
        
        success: function(data){
            /*
            * Se ejecuta cuando termina la petición y esta ha sido
            * correcta
            * */
            $("#modal_user_name").html(data['first_name']+" "+data['last_name']);
            $("#link_eliminar").attr("href", "users/destroy/"+data['id']);

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
									