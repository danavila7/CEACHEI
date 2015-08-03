@extends('layouts.layout')
@section('head')
@stop
@section('titulo')
CMA/Mis Clases
@stop
@section('sidebar')
    @parent
@stop
@section('content')
<table>
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
	{{ $filter }}
	{{ $grid }}
@stop