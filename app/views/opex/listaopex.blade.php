@extends('layouts.layout')
@section('head')

{{ HTML::script('js/functions/listaopex.js') }}
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
{{ HTML::link('indexcma','Volver',array( 'type' => 'button', 'class' => 'btn btn-default')) }}
{{ HTML::link('CrearOpex','Crear Opex',array( 'type' => 'button', 'class' => 'btn btn-default')) }}
{{ HTML::link('ListaCatOpex','Lista Categorias Opex',array( 'type' => 'button', 'class' => 'btn btn-default')) }}
<br/>
<br/>
<table class="table table-hover">
	<tr>
		<th>
			Producto
		</th>
		<th>
			Monto
		</th>
		<th>
			Num. Boleta
		</th>
		<th>
			Num. Factura
		</th>
		<th>
			Creado
		</th>
		<th>
			Responsable
		</th>
		<th>
			Observación
		</th>
		<th>
			Categoria
		</th>
		<th>
			Editar
		</th>
		<th>
			Eliminar
		</th>
		</tr>
@if($opexs != null)
	<lu>
    @foreach($opexs as $op)
    <tr>
		<td>
			{{ $op['producto'] }}
		</td>
		<td>
			{{ $op['monto'] }} 
		</td>
		<td>
			{{ $op['num_boleta'] }} 
		</td>
		<td>
			{{ $op['num_factura'] }}
		</td>
		<td>
			{{ $op['fecha'] }}
		</td>
		<td>
			{{ $op['responsable'] }}
		</td>
		<td>
			{{ $op['observacion'] }}
		</td>
		<td>
			{{ $op['categoria'] }}
		</td>
		<td>
			{{ HTML::link('EditarUsuario/'.$op['id'],'Editar Usuario',array( 'type' => 'button', 'class' => 'btn btn-default')) }}
		</td>
		<td>
			<input type="button" class="btn btn-default borrar_opex" value="Borrar Opex" data-id="{{ $op['id'] }}">
		</td>
	</tr>
        
    @endforeach
	</lu>
@else
No existen datos opex
@endif
</table>
@stop