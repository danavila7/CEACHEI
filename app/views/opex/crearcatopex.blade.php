@extends('layouts.layout')
@section('head')
{{ HTML::script('js/functions/crearopex.js') }}
{{ HTML::script('js/lib/jquery.ui.js') }}
@stop
@section('titulo')
CMA/Crear Opex
@stop
@section('sidebar')
    @parent
@stop
@section('content')
<h1> Crear Categoría Opex</h1>
<br/>
{{ HTML::link('ListaCatOpex','Volver',array( 'type' => 'button', 'class' => 'btn btn-default')) }}
<br/>
<br/>
{{ Form::open(array('url' => 'CrearCatOpex', 'id'=>'form_usuario')) }}
<table class="table table-hover">
	<tr>
		<th>
			Nombre 
		</th>
		<th>
			<input type="text" name="nombre" placeholder="Ingresar Nombre" required>
		</th>
	</tr>
	<tr>
		<th>
			<input type="submit" class="btn btn-info" value="Guardar">
		</th>
	</tr>
</table>
{{ Form::close() }}
@stop