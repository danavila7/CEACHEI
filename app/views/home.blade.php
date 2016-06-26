@extends('layouts.layout')
@section('head')
@stop
@section('titulo')
PANEL DE CONTRO / CMA
@stop
@section('sidebar')
    @parent
@stop
@section('title')
  Panel de Control
@stop
@section('content')

  @if(Entrust::hasRole('recepcion'))
  <div class="row">
      <div class="col-md-12">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $usuarios_all }}</h3>

              <p>Alumnos totales</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people-outline"></i>
            </div>
            <a href="{{ url('admin/alumnos/lista') }}" class="small-box-footer">
              Más Información <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $usuarios_activos }}</h3>

              <p>Alumnos Activos</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('admin/alumnos/lista/1') }}" class="small-box-footer">
              Más Información <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>
  </div>
  @endif

  @if(Entrust::hasRole('alumno'))

  @endif

  @if(Entrust::hasRole('instructores'))

  @endif

  @if(Entrust::hasRole('administracion'))
  <!--<div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Alumnos totales</span>
          <span class="info-box-number">{{ $usuarios_all }}</span>
        </div>
    </div>
  </div>-->
  <div class="row">
  <div class="col-md-12">
    <div class="col-lg-3 col-sm-6 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ $usuarios_all }}</h3>

          <p>Alumnos totales</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-people-outline"></i>
        </div>
        <a href="{{ url('admin/alumnos/lista') }}" class="small-box-footer">
          Más Información <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ $usuarios_activos }}</h3>

          <p>Alumnos Activos</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="{{ url('admin/alumnos/lista/1') }}" class="small-box-footer">
          Más Información <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ $instructores_activos }}</h3>

          <p>Instructores</p>
        </div>
        <div class="icon">
          <i class="ion ion-university"></i>
        </div>
        <a href="{{ url('admin/instructores/lista') }}" class="small-box-footer">
          Más Información <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{ $recepcion_activos }}</h3>

          <p>Administración</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-home"></i>
        </div>
        <a href="{{ url('admin/administracion/lista') }}" class="small-box-footer">
          Más Información <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
  </div>
  </div>
  <div class="row">
      <div class="col-md-12">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Gastos</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                    <tr>
                      <th>Tipo</th>
                      <th>Eduardo</th>
                      <th>Ceachei</th>
                      <th>Totales</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td><a href="{{ url('admin/opex/lista') }}">Opex</a></td>
                      <td>{{ number_format($total_eduardo_o)  }}</td>
                      <td>{{ number_format($total_ceachei_o) }}</td>
                      <td>{{ number_format($t_opex) }} </td>
                    </tr>
                    <tr>
                      <td><a href="{{ url('admin/capex/lista') }}">Capex</a></td>
                      <td>{{ number_format($total_eduardo_c)  }}</td>
                      <td>{{ number_format($total_ceachei_c) }}</td>
                      <td>{{ number_format($t_capex) }} </td>
                    </tr>
                    <tr>
                      <td>Totales</td>
                      <td>{{ number_format($total_eduardo)  }}</td>
                      <td>{{ number_format($total_ceachei) }}</td>
                      <td>{{ number_format($total_final) }} </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                <a href="{{ url('admin/infofinanciero') }}" class="btn btn-sm btn-info btn-flat pull-left">Informe Financiero</a>
              </div>
              <!-- /.box-footer -->
            </div>
      </div>
  </div>
  @endif
</div>
@stop
