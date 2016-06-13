@extends('layouts.layout')
@section('head')
@stop
@section('title')
Gastos
    <div class="pull-right">
         <a href="{{ URL::to('/') }}/admin/gastosacma/edit" class="btn btn-success">Crear Nuevo</a>
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
                                <a href="{{ URL::to('/') }}/admin/gastosacma?ord=fecha">
                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                </a>
                                <a href="{{ URL::to('/') }}/admin/gastosacma?ord=-fecha">
                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                </a>
                                Fecha
                            </th>
                            <th>Monto</th>
                            <th>
                                <a href="{{ URL::to('/') }}/admin/gastosacma?ord=fondo">
                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                </a>
                                <a href="{{ URL::to('/') }}/admin/gastosacma?ord=-fondo">
                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                </a>
                                Fondo
                            </th>
                            <th>
                                <a href="{{ URL::to('/') }}/admin/gastosacma?ord=descripcion">
                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                </a>
                                <a href="{{ URL::to('/') }}/admin/gastosacma?ord=-descripcion">
                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                </a>
                                Descripción
                            </th>
                            <th>
                                <a href="{{ URL::to('/') }}/admin/gastosacma?ord=bol_fact">
                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                </a>
                                <a href="{{ URL::to('/') }}/admin/gastosacma?ord=-bol_fact">
                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                </a>
                                Boleta/Factura
                            </th>
                            <th>
                                <a href="{{ URL::to('/') }}/admin/gastosacma?ord=responsable">
                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                </a>
                                <a href="{{ URL::to('/') }}/admin/gastosacma?ord=-responsable">
                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                </a>
                                Responsable
                            </th>
                            <th>
                                <a href="{{ URL::to('/') }}/admin/gastosacma?ord=autorizador_id">
                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                </a>
                                <a href="{{ URL::to('/') }}/admin/gastosacma?ord=-autorizador_id">
                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                </a>
                                Autorizador
            	            </th>
            	            <th>
                                Imagen
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
                                <td>{{ $item->fecha }}</td>
                                <td>{{ $item->monto }}</td>
                                <td>{{ $item->fondo }}</td>
                                <td>{{ $item->descripcion }}</td>
                                <td>{{ $item->bol_fact }}</td>
                                <td>{{ $item->responsable }}</td>
                                <td>{{ $item->autorizador }}</td>
                                <td>
                                @if (isset($item->foto))
                                <a href="{{ URL::to('/') }}/uploads/respaldo/{{ $item->foto }}">Ver</a>
        						@else
        							Sin imagen
        						@endif
        						</td>
        						@if(Entrust::hasRole('administracion'))
        						 <td><a class="" title="Show" href="{{ URL::to('/') }}/admin/gastosacma/edit?show={{ $item->id }}"><span class="glyphicon glyphicon-eye-open"> </span></a>
        						    <a class="" title="Modify" href="{{ URL::to('/') }}/admin/gastosacma/edit?modify={{ $item->id }}"><span class="glyphicon glyphicon-edit"> </span></a>
        						    <a class="text-danger" title="Delete" href="{{ URL::to('/') }}/admin/gastosacma/edit?delete={{ $item->id }}"><span class="glyphicon glyphicon-trash"> </span></a>
        						</td>
        						@endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
    {{ $grid->links() }}
</div>
@stop