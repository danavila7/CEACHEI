@extends('layouts.layout')
@section('head')
@stop
@section('title')
Administración de Usuarios Administrador/Recepción
    <div class="pull-right">
        <a href="{{ URL::to('/') }}/admin/administracion/crear" class="btn btn-success">Agregar Administrador/Recepción</a>
    </div>
@stop
@section('sidebar')
    @parent
@stop
@section('content')
{{ $filter }}
<br>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                <a href="{{ URL::to('/') }}/admin/administracion/lista?ord=user_id">
                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                </a>
                                <a href="{{ URL::to('/') }}/admin/administracion/lista?ord=-user_id">
                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                </a>
                                ID
                            </th>
                            <th>
                                <a href="{{ URL::to('/') }}/admin/administracion/lista?ord=nombre">
                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                </a>
                                <a href="{{ URL::to('/') }}/admin/administracion/lista?ord=-nombre">
                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                </a>
                                    Nombre
                            </th>
                            <th>
                                <a href="{{ URL::to('/') }}/admin/administracion/lista?ord=apellido_paterno">
                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                </a>
                                <a href="{{ URL::to('/') }}/admin/administracion/lista?ord=-apellido_paterno">
                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                </a>
                                    Apellido Paterno
                            </th>
                            <th>
                                <a href="{{ URL::to('/') }}/admin/administracion/lista?ord=apellido_materno">
                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                </a>
                                <a href="{{ URL::to('/') }}/admin/administracion/lista?ord=-apellido_materno">
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
                                Fecha Ingreso Registro
                            </th>
                            @if(Entrust::hasRole('administracion'))
                                <th>
                                    Rol
                                </th>
                                <th>
                                    Acciones
                                </th>
                            @endif
                         </tr>
                    </thead>
                    <tbody>
                        @foreach ($grid->data as $item)
                            <tr>
                                <td>{{ $item->user_id }}</td>
                                <td>{{ $item->nombre }}</td>
                                <td>{{ $item->apellido_paterno }}</td>
                                <td>{{ $item->apellido_materno }}</td>
                                <td>{{ $item->rut }}</td>
                                <td>{{ $item->direccion }}</td>
                                <td>{{ $item->telefono }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ date("d-m-Y", strtotime($item->created_at)) }}</td>
                                @if(Entrust::hasRole('administracion'))
                                    <td>
                                        <a href="{{ URL::to('/') }}/admin/asignarol/{{ $item->user_id }}"><span class="glyphicon glyphicon-plus"> </span></a>
                                    </td>
                                    <td>
                                        <a class="" title="Modify" href="{{ URL::to('/') }}/admin/administracion/crud?modify={{ $item->user_id }}"><span class="glyphicon glyphicon-edit"> </span></a>
                                        <a class="text-danger" title="Delete" href="{{ URL::to('/') }}/admin/administracion/crud?delete={{ $item->user_id }}"><span class="glyphicon glyphicon-trash"> </span></a>
                                    </td>
                                @endif
                            </tr>
                          @endforeach
                        </tbody>
                </table>
                {{ $grid->links() }}
            </div>
        </div>
    </div>
</div>
@stop