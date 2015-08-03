@extends('layouts.layout')
@section('head')
@stop
@section('titulo')
CMA/Lista Ingresos
@stop
@section('sidebar')
    @parent
@stop
@section('content')
	{{ $filter }}
	<div class="pull-right">
         <a href="{{ URL::to('/') }}/ingresosacma/edit" class="btn btn-default">Crear Nuevo</a>            
    </div>
	<table class="table table-striped">
    <thead>
    <tr>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaIngresosAcma?ord=fecha">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaIngresosAcma?ord=-fecha">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Fecha
            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaIngresosAcma?ord=descripcion">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaIngresosAcma?ord=-descripcion">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Descripción
            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaIngresosAcma?ord=monto">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaIngresosAcma?ord=-monto">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Monto
            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaIngresosAcma?ord=saldo">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaIngresosAcma?ord=-saldo">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Saldo
            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaIngresosAcma?ord=tipo_pago">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaIngresosAcma?ord=-tipo_pago">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                              Tipo Pago
            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaIngresosAcma?ord=recepcionado_por">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaIngresosAcma?ord=-recepcionado_por">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Recepcionado
            	</th>
            	<th>
                    Imagen           
                </th>
                @if(Entrust::hasRole('superadmin'))
                <th>
                     Ver/Editar/Borrar 
                </th>
                @endif
         </tr>
    </thead>
    <tbody>
    @foreach ($grid->data as $item)
            <tr>
                        <td>{{ $item->fecha }}</td>
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
						@if(Entrust::hasRole('superadmin'))
						 <td><a class="" title="Show" href="{{ URL::to('/') }}/ingresosacma/edit?show={{ $item->id }}"><span class="glyphicon glyphicon-eye-open"> </span></a>
						    <a class="" title="Modify" href="{{ URL::to('/') }}/ingresosacma/edit?modify={{ $item->id }}"><span class="glyphicon glyphicon-edit"> </span></a>
						    <a class="text-danger" title="Delete" href="{{ URL::to('/') }}/ingresosacma/edit?delete={{ $item->id }}"><span class="glyphicon glyphicon-trash"> </span></a>
						</td>
						@endif
            </tr>
         @endforeach
        </tbody>
        {{ $grid->links() }}
</table>
@stop