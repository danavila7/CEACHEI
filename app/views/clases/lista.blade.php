@extends('layouts.layout')
@section('head')
@stop
@section('title')
<div class="row">
<div class="col-md-12">
        <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">{{ $usuario->nombre }} {{ $usuario->apellido_paterno }} {{ $usuario->apellido_materno }}</h3>
              <h5 class="widget-user-desc">{{ $usuario->email }}</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="{{ asset("img/avatar-default.jpeg") }}" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Nº de Clases</h5>
                    <span class="description-text">{{ $num_clases }}</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Plan</h5>
                    <span class="description-text">{{ $plan->nombre }}</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">Fecha Inscripción</h5>
                    <span class="description-text">{{ date("d-m-Y", strtotime($usuario->fecha_inscripcion)) }}</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
</div>
@stop
@section('sidebar')
    @parent
@stop
@section('content')
	{{ $filter }}
	{{ $grid }}
@stop