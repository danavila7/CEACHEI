@extends('layouts.layout')
@section('head')
@stop
@section('titulo')
CMA/Lista Capex
@stop
@section('sidebar')
    @parent
@stop
@section('content')
	{{ $filter }}
	<div class="pull-right">
         <a href="{{ URL::to('/') }}/capex/edit" class="btn btn-default">Crear Nuevo</a>            
    </div>
	<table class="table table-striped">
    <thead>
    <tr>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaCapex?ord=producto">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaCapex?ord=-producto">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Producto            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaCapex?ord=num_boleta">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaCapex?ord=-num_boleta">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Boleta            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaCapex?ord=num_factura">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaCapex?ord=-num_factura">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Factura            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaCapex?ord=monto">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaCapex?ord=-monto">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Monto            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaCapex?ord=fecha">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaCapex?ord=-fecha">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Fecha            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaCapex?ord=id_usuario">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaCapex?ord=-id_usuario">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Encargado            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaCapex?ord=id_cat_capex">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaCapex?ord=-id_cat_capex">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Categoría Capex            </th>
                 <th>
                                                <a href="{{ URL::to('/') }}/ListaCapex?ord=imagen">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                                                    <a href="{{ URL::to('/') }}/ListaCapex?ord=-imagen">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                                             Imagen            </th>
                 <th>
                            Ver/Editar/Borrar            </th>
         </tr>
    </thead>
    <tbody>
    	@foreach ($grid->data as $item)
            <tr>
                        <td>{{ $item->producto }}</td>
                        <td>{{ $item->num_boleta }}</td>
                        <td>{{ $item->num_factura }}</td>
                        <td>{{ number_format(intval($item->monto)) }}</td>
                        <td>
                        @if(isset($item->fecha) && $item->fecha != '0000-00-00 00:00:00')
                        {{ date("d-m-Y", strtotime($item->fecha)) }}
                        @else
                        Sin Fecha
                        @endif
                        </td>
                        <td>{{ $item->usuario['nombre'] }}</td>
                        <td>{{ $item->catcapex['nombre'] }}</td>
                        <td>
                        @if (isset($item->imagen))
                        <a href="{{ URL::to('/') }}/uploads/respaldo/{{ $item->imagen }}">Ver</a>
						@else
							Sin imagen
						@endif
						</td>
                        <td><a class="" title="Show" href="{{ URL::to('/') }}/capex/edit?show={{ $item->id }}"><span class="glyphicon glyphicon-eye-open"> </span></a>
						    <a class="" title="Modify" href="{{ URL::to('/') }}/capex/edit?modify={{ $item->id }}"><span class="glyphicon glyphicon-edit"> </span></a>
						    <a class="text-danger" title="Delete" href="{{ URL::to('/') }}/capex/edit?delete={{ $item->id }}"><span class="glyphicon glyphicon-trash"> </span></a>
						</td>
                    </tr>
        @endforeach
        </tbody>
        {{ $grid->links() }}
</table>
	<table class="table table-striped">
		<tbody>
			<td>

			</td>
			<td>
				
			</td>
			<td>
				
			</td>
			<td>
				Total: {{ number_format($total) }}
			</td>
			<td>
				Total Eduardo: {{ number_format($total_eduardo) }}
			</td>
			<td>
				Total Ceachei: {{ number_format($total_ceachei) }}
			</td>
		</tbody>
</table>
@stop