@extends('layouts.layout')
@section('head')

@stop
@section('titulo')
CMA/Realizar Examen
@stop
@section('sidebar')
    @parent
@stop
@section('content')
<h1> Realizar Examen {{ $examen->nombre }}</h1>
<br/>
<br/>
@if($pregresp)
{{ Form::open(array('url' => 'RealizarExamen', 'id'=>'form_pregunta')) }}
<input type="hidden" name="id_usuario" value="{{ $id_usuario }}">
<table class="table table-hover">
	@foreach($pregresp as $pr)
	<tr>
		<td>
			{{ $pr['texto'] }}
		</td>
		<td>
			<table>
			@foreach($pr['respuestas'] as $r)
				<tr>
					<td>
						{{ $r->texto}}
					</td>
				</tr>
			@endforeach
			</table>
		</td>
	<tr>
	@endforeach

	<tr>
		<th>
			<input type="submit" class="btn btn-info" value="Guardar">
		</th>
	</tr>
</table>
{{ Form::close() }}
@else
<p>Este examen no tiene preguntas</p>
@endif
@stop