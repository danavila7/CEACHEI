@extends('layouts.layout')
@section('head')

{{ HTML::script('js/functions/listacatopex.js') }}
@stop
@section('titulo')
CMA/Lista Opex
@stop
@section('sidebar')
    @parent
@stop
@section('content')
<h1> Opex</h1>
<br/>
{{ HTML::link('ListaOpex','Volver',array( 'type' => 'button', 'class' => 'btn btn-default')) }}
{{ HTML::link('CrearCatOpex','Crear Categoría Opex',array( 'type' => 'button', 'class' => 'btn btn-default')) }}
<br/>
<br/>
<table class="table table-hover">
	<tr>
		<th>
			Nombre
		</th>
		<th>
			Editar
		</th>
		<th>
			Eliminar
		</th>
		</tr>
@if($catopex != null)
	<lu>
    @foreach($catopex as $cop)
    <tr>
		<td>
			{{ $cop->nombre }}
		</td>
		<td>
			{{ HTML::link('EditarCatOpex/'.$cop->id,'Editar Categoría',array( 'type' => 'button', 'class' => 'btn btn-default')) }}
		</td>
		<td>
			<input type="button" class="btn btn-default borrar_catopex" value="Borrar Categoría" data-id="{{ $cop->id }}">
		</td>
	</tr>
        
    @endforeach
	</lu>
@else
No existen categorías opex
@endif
</table>
@stop