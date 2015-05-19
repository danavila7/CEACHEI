@extends('layouts.layout')
@section('head')

{{ HTML::script('js/functions/listausuarios.js') }}
@stop
@section('titulo')
Missing/Lista de Usuarios
@stop
@section('sidebar')
    @parent
@stop
@section('content')
<h1> Usuarios</h1>
<br/>
{{ $filter }}
	<div class="pull-left">
        <h2></h2>
    </div>
     <div class="pull-right">
         <a href="{{ URL::to('/') }}/usuarios/edit" class="btn btn-default">Agregar Usuario</a>
     </div>
 <br />


<table class="table">
    <thead>
    <tr>        
                <th>
                ID
                </th>
                 <th>
                    <a href="{{ URL::to('/') }}/ListaUsuarios?ord=activo">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaUsuarios?ord=-activo">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Activo            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaUsuarios?ord=nombre">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaUsuarios?ord=-nombre">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Nombre            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaUsuarios?ord=apellido_paterno">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                             Apellido Paterno            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaUsuarios?ord=apellido_materno">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaUsuarios?ord=-apellido_materno">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Apellido Materno            </th>
                 <th>
                            Rut            </th>
                            <th>
                            Plan            </th>
                            <th>
                            Asignar Rol            </th>
                            <th>
                            Examenes            </th>
                            
                            <th>
                            Horarios            </th>
                 <th>
                            Acciones            </th>
         </tr>
    </thead>
    <tbody>
    	@foreach ($grid->data as $item)
            <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->activo }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->apellido_paterno }}</td>
                        <td>{{ $item->apellido_materno }}</td>
                        <td>{{ $item->rut }}</td>
                        <td>{{ $item->plan['nombre'] }}</td>
                        <td><a href="{{ URL::to('/') }}/AsignaRol/{{ $item->id }}"><span class="glyphicon glyphicon-plus"> </span></a>
                        <td><a href="{{ URL::to('/') }}/ListaAlumnoExamenes/{{ $item->id }}">Ver</a></td>
                        <td><a href="{{ URL::to('/') }}/HorarioUsuario/{{ $item->id }}">Ver</a></td>
                        <td><a class="" title="Modify" href="{{ URL::to('/') }}/usuarios/edit?modify={{ $item->id }}"><span class="glyphicon glyphicon-edit"> </span></a>
    <a class="text-danger" title="Delete" href="{{ URL::to('/') }}/usuarios/edit?delete={{ $item->id }}"><span class="glyphicon glyphicon-trash"> </span></a>
</td>
                    </tr>
          @endforeach
        </tbody>
</table>
{{ $grid->links() }}
        </div>

@stop