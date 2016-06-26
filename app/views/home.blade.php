@extends('layouts.layout')
@section('head')
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

  <!--<div class="row">
    <div class="col-md-6">
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>
              <h3 class="box-title">Calendario de Labores</h3>
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <div id="calendar" style="width: 100%"></div>
            </div>
            <div class="box-footer text-black">
              <div class="row">
                <div class="col-sm-6">
                  <div class="clearfix">
                    <span class="pull-left">Task #1</span>
                    <small class="pull-right">90%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Task #2</span>
                    <small class="pull-right">70%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="clearfix">
                    <span class="pull-left">Task #3</span>
                    <small class="pull-right">60%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Task #4</span>
                    <small class="pull-right">40%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
  </div>-->
  @endif
</div>
@stop
