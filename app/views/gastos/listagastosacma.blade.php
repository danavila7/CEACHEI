@extends('layouts.layout')
@section('head')
@stop
@section('titulo')
CMA/Lista Gastos
@stop
@section('sidebar')
    @parent
@stop
@section('content')
	{{ $filter }}
	<div class="pull-right">
         <a href="{{ URL::to('/') }}/gastosacma/edit" class="btn btn-default">Crear Nuevo</a>            
    </div>
	<table class="table table-striped">
    <thead>
    <tr>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaGastosAcma?ord=fecha">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaGastosAcma?ord=-fecha">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Fecha
            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaGastosAcma?ord=fondo">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaGastosAcma?ord=-fondo">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Fondo
            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaGastosAcma?ord=descripcion">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaGastosAcma?ord=-descripcion">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Descripción
            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaGastosAcma?ord=bol_fact">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaGastosAcma?ord=-bol_fact">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Boleta/Factura
            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaGastosAcma?ord=responsable">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaGastosAcma?ord=-responsable">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Responsable
            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaGastosAcma?ord=autorizador_id">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaGastosAcma?ord=-autorizador_id">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Autorizador
            	</th>
            	<th>
                    Imagen           
                </th>
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
                        <td>{{ $item->fecha }}</td>
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
						@if(!Entrust::hasRole('recepcion'))
						 <td><a class="" title="Show" href="{{ URL::to('/') }}/gastosacma/edit?show={{ $item->id }}"><span class="glyphicon glyphicon-eye-open"> </span></a>
						    <a class="" title="Modify" href="{{ URL::to('/') }}/gastosacma/edit?modify={{ $item->id }}"><span class="glyphicon glyphicon-edit"> </span></a>
						    <a class="text-danger" title="Delete" href="{{ URL::to('/') }}/gastosacma/edit?delete={{ $item->id }}"><span class="glyphicon glyphicon-trash"> </span></a>
						</td>
						@endif
            </tr>
         @endforeach
        </tbody>
        {{ $grid->links() }}
</table>
@stop