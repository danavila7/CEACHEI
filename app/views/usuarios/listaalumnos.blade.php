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
<h1> Alumnos</h1>
<br/>
{{ $filter }}
	<div class="pull-left">
        <h2></h2>
    </div>
     <div class="pull-right">
         <a href="{{ URL::to('/') }}/admin/usuarios/edit" class="btn btn-default">Agregar Usuario</a>
     </div>
 <br />


<table class="table">
    <thead>
    <tr>
                 <th>
                    <a href="{{ URL::to('/') }}/ListaAlumnos?ord=activo">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaAlumnos?ord=-activo">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Activo            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaAlumnos?ord=nombre">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaAlumnos?ord=-nombre">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Nombre            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaAlumnos?ord=apellido_paterno">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                             Apellido Paterno            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaAlumnos?ord=apellido_materno">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaAlumnos?ord=-apellido_materno">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Apellido Materno            </th>
                                             <th>
                            Rut            </th>
                            <th>
                            Dirección            </th>

                            <th>
                            Telefono
                            </th>
                            <th>
                            Plan            </th>
                            <th>
                            Asignar Rol            </th>
                            <th>
                            Horarios            </th>
                 <th>
                            Acciones            </th>
         </tr>
    </thead>
    <tbody>
    	@foreach ($grid->data as $item)
            <tr>
                        <td>{{ $item->activo }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->apellido_paterno }}</td>
                        <td>{{ $item->apellido_materno }}</td>
                        <td>{{ $item->rut }}</td>
                        <td>{{ $item->direccion }}</td>
                        <td>{{ $item->telefono }}</td>
                        <td>{{ $item->plan['nombre'] }}</td>
                        <td><a href="{{ URL::to('/') }}/AsignaRol/{{ $item->user_id }}"><span class="glyphicon glyphicon-plus"> </span></a>
                        <td><a href="{{ URL::to('/') }}/HorarioUsuario/{{ $item->user_id }}">Ver</a></td>
                        <td><a class="" title="Modify" href="{{ URL::to('/') }}/usuarios/edit?modify={{ $item->user_id }}"><span class="glyphicon glyphicon-edit"> </span></a>
    <a class="text-danger" title="Delete" href="{{ URL::to('/') }}/usuarios/edit?delete={{ $item->user_id }}"><span class="glyphicon glyphicon-trash"> </span></a>
</td>
                    </tr>
          @endforeach
        </tbody>
</table>
{{ $grid->links() }}
        </div>

@stop