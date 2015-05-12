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
	{{ $filter }}
	{{ $grid }}
	<table class="table table-striped">
		<tbody>
			<td>

			</td>
			<td>
				
			</td>
			<td>
				
			</td>
			<td>
				Total: {{ $total }}
			</td>
			<td>
				Total Eduardo: {{ $total_eduardo }}
			</td>
			<td>
				Total Ceachei: {{ $total_ceachei }}
			</td>
		</tbody>
	</table>
@stop