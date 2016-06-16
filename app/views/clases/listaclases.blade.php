@extends('layouts.layout')
@section('head')
@stop
@section('titulo')
CMA/Lista Clases
@stop
@section('sidebar')
    @parent
@stop
@section('content')
<table>
<thead>
<th>
Usuario:
</th>
<td>
 {{ $usuario->nombre }} {{ $usuario->apellido_paterno }} {{ $usuario->apellido_materno }}
</td>
</thead>
<tbody>
<th>
Plan:
</th>
<td>
 {{ $plan->nombre }}
</td>
</tbody>
</table>
<br>
{{ HTML::link('admin/ListaUsuarios/alumno','Lista Alumnos',array( 'type' => 'button', 'class' => 'btn btn-default')) }}
	{{ $filter }}
	{{ $grid }}
@stop