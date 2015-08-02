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
<h1> Administración</h1>
<br/>
{{ $filter }}
<br>
<div class="pull-left">
    <a href="{{ URL::to('/') }}/ListaUsuarios/usuarios" class="btn 
    @if($filtro == 'usuarios')
    btn-primary 
    @else 
    btn-default
    @endif">Usuarios</a>
     </div>
<div class="pull-left">
         <a href="{{ URL::to('/') }}/ListaUsuarios/instructores" class="btn 
    @if($filtro == 'instructores')
    btn-primary 
    @else 
    btn-default
    @endif">Instructores</a>
     </div>
<div class="pull-left">
         <a href="{{ URL::to('/') }}/ListaUsuarios/alumno" class="btn 
         @if($filtro == 'alumno')
        btn-primary 
        @else 
        btn-default
        @endif
         ">Alumnos</a>
</div><br><br><br>
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
                            Fecha Nacimiento            </th>
                            <th>
                            Edad
                            </th>
                            <th>
                            Dirección
                            </th>
                            <th>
                            Telefono
                            </th>
                            <th>
                            Correo
                            </th>
                            <th>
                            Plan            </th>
                            <th>
                            Creado            </th>
                            <th>
                            Asignar Rol            </th>
                            <!--<th>
                            Examenes            </th>
                            -->
                            <th>
                            Imagen           
                            </th>
                            <th>
                            Clases           
                            </th>
                            @if($es_id == 3)
                            <th>
                            Horario
                            </th>
                            @endif
                            @if(!Entrust::hasRole('recepcion'))
                            <th>
                                 Ver/Editar/Borrar 
                            </th>
                            @endif
         </tr>
    </thead>
    <tbody>
    	@foreach ($grid->data as $item)
            <tr>        
                @if($es_id == 1)
                        <td>{{ $item->id }}</td>
                @else
                        <td>{{ $item->user_id }}</td>
                @endif
                        <td>{{ $item->activo }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->apellido_paterno }}</td>
                        <td>{{ $item->apellido_materno }}</td>
                        <td>{{ $item->rut }}</td>
                        <td>{{ date("d-m-Y", strtotime($item->fecha_nacimiento)) }}</td>
                        <td>{{ floor((time() - strtotime($item->fecha_nacimiento))/31556926) }}
                        <td>{{ $item->direccion }}</td>
                        <td>{{ $item->telefono }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->plan['nombre'] }}</td>
                        <td>{{ date("d-m-Y", strtotime($item->created_at)) }}</td>
                        @if($es_id == 1)
                        <td><a href="{{ URL::to('/') }}/AsignaRol/{{ $item->id }}"><span class="glyphicon glyphicon-plus"> </span></a>
                        @else
                        <td><a href="{{ URL::to('/') }}/AsignaRol/{{ $item->user_id }}"><span class="glyphicon glyphicon-plus"> </span></a>
                        @endif
                        <td>
                        @if (isset($item->imagen))
                        <a href="{{ URL::to('/') }}/uploads/usuarios/{{ $item->imagen }}">Ver</a>
                        @else
                            Sin imagen
                        @endif
                        </td>
                        @if($es_id == 1)
                        <td><a href="{{ URL::to('/') }}/Clases/{{ $item->id }}">Ver</a>
                        @else
                        <td><a href="{{ URL::to('/') }}/Clases/{{ $item->user_id }}">Ver</a>
                        @endif
                        @if($es_id == 3)
                            <td><a href="{{ URL::to('/') }}/HorarioUsuario/{{ $item->user_id }}">Ver</a></td>
                        @endif
                        @if($es_id == 1)
                            @if(!Entrust::hasRole('recepcion'))
                            <!--<td><a href="{{ URL::to('/') }}/ListaAlumnoExamenes/{{ $item->id }}">Ver</a></td>
                            <td><a href="{{ URL::to('/') }}/HorarioUsuario/{{ $item->id }}">Ver</a></td>-->
                            <td><a class="" title="Modify" href="{{ URL::to('/') }}/usuarios/edit?modify={{ $item->id }}"><span class="glyphicon glyphicon-edit"> </span></a>
                            <a class="text-danger" title="Delete" href="{{ URL::to('/') }}/usuarios/edit?delete={{ $item->id }}"><span class="glyphicon glyphicon-trash"> </span></a>
                            @endif
                        @else
                            @if(!Entrust::hasRole('recepcion'))
                            <!--<td><a href="{{ URL::to('/') }}/ListaAlumnoExamenes/{{ $item->user_id }}">Ver</a></td>
                            <td><a href="{{ URL::to('/') }}/HorarioUsuario/{{ $item->user_id }}">Ver</a></td>-->
                            <td><a class="" title="Modify" href="{{ URL::to('/') }}/usuarios/edit?modify={{ $item->user_id }}"><span class="glyphicon glyphicon-edit"> </span></a>
                            <a class="text-danger" title="Delete" href="{{ URL::to('/') }}/usuarios/edit?delete={{ $item->user_id }}"><span class="glyphicon glyphicon-trash"> </span></a>
                            @endif
                        @endif
</td>
                    </tr>
          @endforeach
        </tbody>
</table>
{{ $grid->links() }}
        </div>

@stop