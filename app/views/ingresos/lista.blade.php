@extends('layouts.layout')
@section('head')
@stop
@section('title')
Lista Ingresos
    <div class="pull-right">
         <a href="{{ URL::to('/') }}/admin/ingresos/edit" class="btn btn-success">Crear Nuevo</a>
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
                                                <a href="{{ URL::to('/') }}/admin/ingresos/lista?ord=fecha">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/admin/ingresos/lista?ord=-fecha">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Fecha
            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/admin/ingresos/lista?ord=descripcion">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/admin/ingresos/lista?ord=-descripcion">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Descripción
            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/admin/ingresos/lista?ord=monto">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/admin/ingresos/lista?ord=-monto">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Monto
            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/admin/ingresos/lista?ord=saldo">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/admin/ingresos/lista?ord=-saldo">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Saldo
            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/admin/ingresos/lista?ord=tipo_pago">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/admin/ingresos/lista?ord=-tipo_pago">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                              Tipo Pago
            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/admin/ingresos/lista?ord=recepcionado_por">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/admin/ingresos/lista?ord=-recepcionado_por">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Recepcionado
            	</th>
            	<th>
                    Imagen
                </th>
                @if(Entrust::hasRole('administracion'))
                <th>
                     Ver/Editar/Borrar
                </th>
                @endif
         </tr>
    </thead>
    <tbody>
    @foreach ($grid->data as $item)
            <tr>
                        <td>{{ date('d/m/Y', strtotime($item->fecha)) }}</td>
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->monto }}</td>
                        <td>{{ $item->saldo }}</td>
                        <td>{{ $item->tipo_pago }}</td>
                        <td>{{ $item->recepcionado_por }}</td>
                        <td>
                        @if (isset($item->foto))
                        <a href="{{ URL::to('/') }}/uploads/respaldo/{{ $item->foto }}">Ver</a>
						@else
							Sin imagen
						@endif
						</td>
						@if(Entrust::hasRole('administracion'))
						 <td><a class="" title="Show" href="{{ URL::to('/') }}/admin/ingresos/edit?show={{ $item->id }}"><span class="glyphicon glyphicon-eye-open"> </span></a>
						    <a class="" title="Modify" href="{{ URL::to('/') }}/admin/ingresos/edit?modify={{ $item->id }}"><span class="glyphicon glyphicon-edit"> </span></a>
						    <a class="text-danger" title="Delete" href="{{ URL::to('/') }}/admin/ingresos/edit?delete={{ $item->id }}"><span class="glyphicon glyphicon-trash"> </span></a>
						</td>
						@endif
            </tr>
         @endforeach
        </tbody>
</table>
</div>
</div>
</div>
</div>
{{ $grid->links() }}
@stop