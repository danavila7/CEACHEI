@extends('layouts.layout')
@section('head')
@stop
@section('titulo')
CMA/Lista Capex
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