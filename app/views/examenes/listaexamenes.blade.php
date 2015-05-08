@extends('layouts.layout')
@section('head')
{{ HTML::script('js/functions/listaexamen.js') }}
@stop
@section('titulo')
CMA/Lista de Examenes
@stop
@section('sidebar')
    @parent
@stop
@section('content')
<h1> Examenes</h1>
<br/>
{{ HTML::link('ListaPreguntas','Lista Preguntas',array( 'type' => 'button', 'class' => 'btn btn-default')) }}
<br/>
{{ $filter }}
<div>
	<div class="pull-left">
        <h2></h2>
    </div>
        <div class="pull-right">
        	<a href="{{ URL::to('/');}}/examenes/edit" class="btn btn-default">Crear Nuevo</a>            
        </div>
    </div>
 <br />
<table class="table table-striped">
    <thead>
    <tr>
                 <th>
                                                <a href="{{ URL::to('/');}}/ListaExamenes?ord=id">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                             ID            </th>
                 <th>
                                                <a href="{{ URL::to('/');}}/ListaExamenes?ord=nombre">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/');}}/ListaExamenes?ord=-nombre">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Nombre            </th>
                 <th>
                 	Preguntas
                 </th>
                 <th>
                            Editar/Borrar            </th>
         </tr>
    </thead>
    <tbody>
    	@foreach ($grid->data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nombre }}</td>
                <td><a href="{{ URL::to('/');}}/AgregarPregunta/{{ $item->id }}">Agregar</a></td>
                <td><a class="" title="Modify" href="{{ URL::to('/');}}/examenes/edit?modify={{ $item->id }}"><span class="glyphicon glyphicon-edit"> </span></a>
    				<a class="text-danger" title="Delete" href="{{ URL::to('/');}}/examenes/edit?delete={{ $item->id }}"><span class="glyphicon glyphicon-trash"> </span></a>
				</td>
           	</tr>
        @endforeach
        </tbody>
</table>
{{ $grid->links() }}
        </div>

@stop