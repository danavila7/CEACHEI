@extends('layouts.layout')
@section('head')
@stop
@section('title')
Pagos Curso
<div class="pull-right">
         <a href="{{ URL::to('/') }}/admin/matriculas/edit" class="btn btn-success">Crear Nueva</a>
</div>
@stop
@section('sidebar')
    @parent
@stop
@section('content')
	{{ $filter }}
  <div class="pull-right">
    <span class="label label-warning">Cuotas Incompletas</span>
    <span class="label label-danger">Cuotas Incompletas 5 clases prácticas</span>
  </div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <thead>
                  <tr>
                      <th>
                        <a href="{{ URL::to('/') }}/admin/matriculas/lista/1?ord=usuario_id">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                        </a>
                        <a href="{{ URL::to('/') }}/admin/matriculas/lista/1?ord=-usuario_id">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                        </a>
                      ID
                      </th>
                      <th>
                        <a href="{{ URL::to('/') }}/admin/matriculas/lista/1?ord=usuario_id">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                        </a>
                        <a href="{{ URL::to('/') }}/admin/matriculas/lista/1?ord=-usuario_id">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                        </a>
                      Alumno (click en el nombre para editar)
                      </th>
                      <th>
                        <a href="{{ URL::to('/') }}/admin/matriculas/lista/1?ord=usuarios.fecha_inscripcion">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                        </a>
                        <a href="{{ URL::to('/') }}/admin/matriculas/lista/1?ord=-usuarios.fecha_inscripcion">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                        </a>
                      Fecha Inscripción Alumno
                      </th>
                      <th>
                      Plan
                      </th>
                      <th>
                        <a href="{{ URL::to('/') }}/admin/matriculas/lista/1?ord=created_at">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                        </a>
                        <a href="{{ URL::to('/') }}/admin/matriculas/lista/1?ord=-created_at">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                        </a>
                      Fecha Ingreso Registro
                      </th>
                      <th>
                        Nº Clases Prácticas
                      </th>
                      <th>
                      Primera Cuota
                      </th>
                      <th>
                      Segunda Cuota
                      </th>
                      <th>
                      Total Pagado
                      </th>
                      <th>
                      Valor del Plan
                      </th>
                      <th>
                      Editar/Borrar
                      </th>
                  </tr>
              </thead>
              <tbody>
              @foreach ($grid->data as $item)
                <tr
                <?php
                $practicas = 0;
                ?>
                  @foreach($item->usuario['clases'] as $item2)
                    @if($item2['tipo'] == 'practica')
                      {{ $practicas++; }}
                    @endif
                  @endforeach
                  @if($practicas >= 5 && $item->usuario['plan']['valor'] > $item->total_pago)
                     style="color: red;"
                  @else
                    @if($item->usuario['plan']['valor'] > $item->total_pago)
                     style="color: #F8920C;"
                    @endif
                  @endif
                >
                  <td>{{ $item->usuario['id'] }}</td>
                  <td><a href="#" data-id="{{ $item->usuario['id'] }}" class="link-to-user">{{ $item->usuario['fullname'] }}</a></td>
                  <td>{{ date('d/m/Y', strtotime($item->usuario['fecha_inscripcion'])) }}</td>
                  <td>{{ $item->usuario['plan']['nombre'] }}</td>
                  <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                  <td>{{ $practicas }}</td>
                  <td>{{ $item->primera_cuota }}</td>
                  <td>{{ $item->segunda_cuota }}</td>
                  <td>{{ $item->total_pago }}</td>
                  <td>{{ $item->usuario['plan']['valor'] }}</td>
                  <td><a class="" title="Modify" href="{{ URL::to('/') }}/admin/matriculas/edit?modify={{ $item->id  }}"><span class="glyphicon glyphicon-edit"> </span></a>
                    <a class="text-danger" title="Delete" href="{{ URL::to('/') }}/admin/matriculas/edit?delete={{ $item->id  }}"><span class="glyphicon glyphicon-trash"> </span></a>
                  </td>
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