@extends('layouts.layout')
@section('head')
@stop
@section('title')
Asignar Rol
@stop
@section('sidebar')
    @parent
@stop
@section('content')
	<div class="container-fluid">
	<div class="inner">
	@if($errors->has())
        <div class='alert alert-danger'>
            @foreach ($errors->all('<p>:message</p>') as $message)
                [[ $message ]]
            @endforeach
        </div>
    @endif
    {{ Form::open(array( 'url' => 'admin/asignarol', 'class' => 'form-horizontal')) }}
    {{ Form::hidden('user_id', $usuario->id ) }}
		<div class="btn-toolbar" role="toolbar">
			<div class="pull-left">
				<h1>{{  $usuario->fullname }}</h1>
			</div>
		</div>
		<br>
		<div class="form-group">
		<label class="col-sm-2 control-label required" > Roles</label>
		<div class="col-sm-10">
					<ul class="list-group">
					@forelse($roles as $ro)
						  <li class="list-group-item">
						  	<div class="checkbox">
							  <label>
							    <input type="radio" name="role_user[]" value="{{ $ro->id }}"
							    @if (in_array($ro->id, $user_role)) checked @endif
							    >
							    {{ $ro->name }}
							  </label>
							</div>
						  </li>
					@empty
					 <li class="list-group-item">
						No existen Roles
					</li>
					@endforelse
					</ul>
		</div>
		</div>
		<br>
		<div class="btn-toolbar" role="toolbar">
			<div class="pull-left">
			{{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}
			</div>
		</div>
	{{ Form::close() }}
	</div>
	</div>
@stop