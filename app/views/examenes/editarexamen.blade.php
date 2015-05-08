@extends('layouts.layout')
@section('head')
{{ HTML::script('js/functions/editarexamen.js') }}
@stop
@section('titulo')
CMA/Editar Examen
@stop
@section('sidebar')
    @parent
@stop
@section('content')
<h1> Agregar Preguntas</h1>
<br/>
{{ HTML::link('ListaExamenes','Lista Examenes',array( 'type' => 'button', 'class' => 'btn btn-default')) }}
<br/>
<br/>
<input type="hidden" name="id" value="{{ $examen->id }}">
		@if($preg != null)
			<table class="table table-striped">
				<tr>
					<th>
						Pregunta
					</th>
					<th>
						Agregar/Quitar
					</th>
					</tr>
			@if($preg != null)
			<lu>
    		@foreach($preg as $p)
    		<tr>
				<td>
					{{ $p['texto'] }} 
				</td>
				<td>
					<input type="button" class="btn btn-default @if(!$p['existe']) agregar_pregunta @else quitar_pregunta @endif" 
					value="@if(!$p['existe']) Agregar @else Quitar @endif" 
					data-id-examen="{{ $examen->id }}" data-id-pregunta="{{ $p['id'] }}">
				</td>
			</tr>
    		@endforeach
			</lu>
			@else
			No existen Preguntas
			@endif
			</table>
		@else
			No existen preguntas
		@endif
@stop