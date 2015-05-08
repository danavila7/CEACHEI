@extends('layouts.layout')
@section('head')
{{ HTML::script('js/functions/listapreguntas.js') }}
@stop
@section('titulo')
CMA/Lista de Preguntas
@stop
@section('sidebar')
    @parent
@stop
@section('content')
<h1> Preguntas</h1>
<br/>
{{ HTML::link('ListaExamenes','Lista Examenes',array( 'type' => 'button', 'class' => 'btn btn-default')) }}
{{ $filter }}
<div>
<div class="pull-left">
        <h2></h2>
    </div>
                <div class="pull-right">
         <a href="http://test.cma.cl/preguntas/edit" class="btn btn-default">Crear Nuevo</a>            </div>
    </div>
 <br />


<table class="table table-striped">
    <thead>
    <tr>
                 <th>
                                                <a href="http://test.cma.cl/ListaPreguntas?ord=id">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                             ID            </th>
                 <th>
                                                <a href="http://test.cma.cl/ListaPreguntas?ord=texto">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="http://test.cma.cl/ListaPreguntas?ord=-texto">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Texto            </th>
				<th>
                            Respuestas           </th>
                 <th>
                            Editar/Borrar            </th>
         </tr>
    </thead>
    <tbody>
    		@foreach ($grid->data as $item)
        <tr>
			<td>{{ $item->id }}</td>
			<td>{{ $item->texto }}</td>
			<td><a href="{{ URL::to('/');}}/AgregarRespuesta/{{ $item->id }}">Agregar</a></td>
           	<td><a class="" title="Show" href="{{ URL::to('/');}}/preguntas/edit?show={{ $item->id }}"><span class="glyphicon glyphicon-eye-open"> </span></a>
    		<a class="" title="Modify" href="{{ URL::to('/');}}/preguntas/edit?modify={{ $item->id }}"><span class="glyphicon glyphicon-edit"> </span></a>
    		<a class="text-danger" title="Delete" href="{{ URL::to('/');}}/preguntas/edit?delete={{ $item->id }}"><span class="glyphicon glyphicon-trash"> </span></a>
			</td>
        </tr>
        	@endforeach
    </tbody>
</table>
	{{ $grid->links() }}
        </div>

@stop