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
<h1> Crear Opex</h1>
<br/>
{{ HTML::link('ListaOpex','Volver',array( 'type' => 'button', 'class' => 'btn btn-default')) }}
<br/>
<br/>
{{ Form::open(array('url' => 'CrearOpex', 'id'=>'form_usuario')) }}
<table class="table table-hover">
	<tr>
		<th>
			Producto 
		</th>
		<th>
			<input type="text" name="producto" placeholder="Ingresar producto" required>
		</th>
	</tr>
	<tr>
		<th>
			Monto
		</th>
		<th>
			<input type="text" name="monto" placeholder="Ingresar monto" required>
		</th>
	</tr>
	<tr>
		<th>
			Num. Boleta 
		</th>
		<th>
			<input type="text" name="num_boleta" placeholder="Ingresar numero de boleta" >
		</th>
	</tr>
	<tr>
		<th>
			Num. Factura 
		</th>
		<th>
			<input type="text" name="num_factura" placeholder="Ingresar numero de factura" >
		</th>
	</tr>
	<tr>
		<th>
			Responsable 
		</th>
		<th>
			@if($usuarios != null)
			<select name="responsable">
				<option value="0">Seleccione una opción</option>
			@foreach($usuarios as $us)
					<option value="{{$us->id}}">{{$us->nombre}} {{$us->apellido_paterno}}</option>
    		@endforeach
    		</select>
			@else
			No existen Usuarios
			@endif
		</th>
	</tr>
	<tr>
		<th>
			Observación 
		</th>
		<th>
			<textarea rows="4" cols="50" name="observacion">
			</textarea>
		</th>
	</tr>
	<tr>
		<th>
			Categoría 
		</th>
		<th>
			@if($catopex != null)
			<select name="cat_opex">
				<option value="0">Seleccione una opción</option>
			@foreach($catopex as $cat)
					<option value="{{$cat->id}}">{{$cat->nombre}}</option>
    		@endforeach
    		</select>
			@else
			No existen Categorías
			@endif
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