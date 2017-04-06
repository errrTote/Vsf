@extends('layouts.main')

@section('title', 'Login')

@section('content')
@if(Auth::user())    
    {!! redirect('/'); !!}
@else


<div class="container-fluid">                
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="jumbotron">
                    <div class="panel-heading">
                        <h4>                        
                            {{ trans('text.loginForm') }}
                        </h4>
                    </div><!--panel-heading-->
                        
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                            <div class="container-fluid">                
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="email" class="control-label">{{ trans('text.email') }}</label>                                        
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">                                        
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid">                
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="password" class="control-label">{{ trans('text.password') }}</label>                                        
                                        <input id="password" type="password" class="form-control" name="password">                                        
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid">                
                                <div class="row buttons">
                                      <div class="col-md-3 col-sm-3">
                                        <a href="{{ url('/')}}" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-arrow-left"></span> {{ trans('text.back') }}
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-md-offset-4 col-sm-3 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ trans('text.singIn') }}
                                        </button>
                                    </div>
                                </div>
                            </div>                            
                            <a class="btn btn-link" data-toggle="modal" data-target="#forgotPassword_modal">{{ trans('text.forgotPassword') }}</a>
                        </form>
                    </div><!--panel-body-->
                </div><!--panel-->
            </div><!--col-md-4-->
        </div><!--row-->
    </div><!--container-fluid--> 

    <div class="modal fade" id="forgotPassword_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{trans('text.resetPassword')}}</h4>
                </div>
                <form action="{{route('forgotPassword.send')}}" method="POST">
                    {{csrf_field()}}                    
                    <div class="modal-body">
                        <label class="control-label"> {{trans('text.email')}} </label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('text.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{trans('text.send')}}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal-->        
@endif
@endsection
