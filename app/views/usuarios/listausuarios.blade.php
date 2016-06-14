@extends('layouts.layout')
@section('head')

{{ HTML::script('js/functions/listausuarios.js') }}
@stop
@section('title')
Administración de Usuarios

    <div class="pull-right">
        <a href="{{ URL::to('/') }}/admin/usuarios/edit" class="btn btn-default">Agregar Usuario</a>
    </div>
@stop
@section('sidebar')
    @parent
@stop
@section('content')
{{ $filter }}
<br>
<br>
<div class="row">
    <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        <a href="{{ URL::to('/') }}/ListaUsuarios/{{ $filtro }}?ord=nombre">
                                            <span class="glyphicon glyphicon-arrow-up"></span>
                                        </a>
                                        <a href="{{ URL::to('/') }}/ListaUsuarios/{{ $filtro }}?ord=-nombre">
                                            <span class="glyphicon glyphicon-arrow-down"></span>
                                        </a>
                                            Nombre
                                    </th>
                                    <th>
                                        <a href="{{ URL::to('/') }}/ListaUsuarios/{{ $filtro }}?ord=apellido_paterno">
                                            <span class="glyphicon glyphicon-arrow-up"></span>
                                        </a>
                                        <a href="{{ URL::to('/') }}/ListaUsuarios/{{ $filtro }}?ord=-apellido_paterno">
                                            <span class="glyphicon glyphicon-arrow-down"></span>
                                        </a>
                                            Apellido Paterno
                                    </th>
                                    <th>
                                        <a href="{{ URL::to('/') }}/ListaUsuarios/{{ $filtro }}?ord=apellido_materno">
                                            <span class="glyphicon glyphicon-arrow-up"></span>
                                        </a>
                                        <a href="{{ URL::to('/') }}/ListaUsuarios/{{ $filtro }}?ord=-apellido_materno">
                                            <span class="glyphicon glyphicon-arrow-down"></span>
                                        </a>
                                            Apellido Materno
                                    </th>
                                    <th>
                                        Rut
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
                                        Activo
                                    </th>
                                    <th>
                                        Plan
                                    </th>
                                    <th>
                                        Creado
                                    </th>
                                    <th>
                                        Asignar Rol
                                    </th>
                                    <th>
                                        Imagen
                                    </th>
                                    <th>
                                        Clases
                                    </th>
                                    @if(Entrust::hasRole('administracion'))
                                        <th>
                                            Acciones
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
                                                <td>{{ $item->nombre }}</td>
                                                <td>{{ $item->apellido_paterno }}</td>
                                                <td>{{ $item->apellido_materno }}</td>
                                                <td>{{ $item->rut }}</td>
                                                <td>{{ $item->direccion }}</td>
                                                <td>{{ $item->telefono }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>@if($item->activo ==1) SI @else NO @endif</td>
                                                <td>{{ $item->plan['nombre'] }}</td>
                                                <td>{{ date("d-m-Y", strtotime($item->created_at)) }}</td>
                                                @if($es_id == 1)
                                                    <td>
                                                        <a href="{{ URL::to('/') }}/admin/AsignaRol/{{ $item->id }}"><span class="glyphicon glyphicon-plus"> </span></a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href="{{ URL::to('/') }}/admin/AsignaRol/{{ $item->user_id }}"><span class="glyphicon glyphicon-plus"> </span></a>
                                                    </td>
                                                @endif
                                                <td>
                                                    @if (isset($item->imagen))
                                                    <a href="{{ URL::to('/') }}/admin/uploads/usuarios/{{ $item->imagen }}">Ver</a>
                                                    @else
                                                        Sin imagen
                                                    @endif
                                                </td>
                                                @if($es_id == 1)
                                                    <td><a href="{{ URL::to('/') }}/admin/Clases/{{ $item->id }}">Ver</a></td>
                                                @else
                                                    <td><a href="{{ URL::to('/') }}/admin/Clases/{{ $item->user_id }}">Ver</a></td>
                                                @endif
                                                @if($es_id == 1)
                                                    @if(Entrust::hasRole('administracion'))
                                                        <td>
                                                            <a class="" title="Modify" href="{{ URL::to('/') }}/admin/usuarios/edit?modify={{ $item->id }}"><span class="glyphicon glyphicon-edit"> </span></a>
                                                            <a class="text-danger" title="Delete" href="{{ URL::to('/') }}/admin/usuarios/edit?delete={{ $item->id }}"><span class="glyphicon glyphicon-trash"> </span></a>
                                                        </td>
                                                    @endif
                                                @else
                                                    @if(Entrust::hasRole('administracion'))
                                                        <td>
                                                            <a class="" title="Modify" href="{{ URL::to('/') }}/admin/usuarios/edit?modify={{ $item->user_id }}"><span class="glyphicon glyphicon-edit"> </span></a>
                                                            <a class="text-danger" title="Delete" href="{{ URL::to('/') }}/admin/usuarios/edit?delete={{ $item->user_id }}"><span class="glyphicon glyphicon-trash"> </span></a>
                                                        </td>
                                                    @endif
                                                @endif
                                            </tr>
                                  @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            {{ $grid->links() }}
    </div>
</div>
@stop