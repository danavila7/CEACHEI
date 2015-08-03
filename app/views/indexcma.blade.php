@extends('layouts.layout')
@section('head')
@stop
@section('titulo')
PANEL DE CONTRO / CMA
@stop
@section('sidebar')
    @parent
@stop
@section('content')
<div class="row" class="col-md-12">
  <div class="col-md-12" >
  	<h3 class="text-center">Panel de Control</h3></div>
  <div class="col-md-12" >
  <div class="col-md-4" >
  @if(Entrust::hasRole('recepcion'))
  <table class="table">
    <tr>
      <td>
       <h4 class='text-primary'>Recepcíon</h4>
      </td>
    </tr>
  <tr>
    <td>
      <a href="ListaUsuarios/alumno" class="btn btn-default" alt="Usuarios"><i class="fa fa-users"></i> Usuarios</a>
    </td>
	</tr>
      <tr>
    <td>
      <a href="ListaGastosAcma" class="btn btn-default" target="_blank" alt="Gastos"><i class="fa fa-table"></i> Gastos Acma</a>
    </td>
    </tr>
    <tr>
    <td>
      <a href="ListaIngresosAcma" class="btn btn-default" target="_blank" alt="Gastos"><i class="fa fa-table"></i> Ingresos Acma</a>
    </td>
    </tr>
    <tr>
    <td>
      <a href="ListaMatricula" class="btn btn-default" alt="Matricula"><i class="fa fa-users"></i> Matricula</a>
    </td>
  </tr>
      <tr>
    <td>
      <a href="ListaPlanes" class="btn btn-default" alt="Planes"><i class="fa fa-users"></i> Planes</a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="ListaLabores" class="btn btn-default" alt="Labores"><i class="fa fa-users"></i> Labores</a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="AllHorario" class="btn btn-default" target="_blank" alt="Horarios"><i class="fa fa-table"></i> Horarios</a>
    </td>
    </tr>
  </table>
  @endif

      @if(Entrust::hasRole('alumno'))
  <table class="table">
    <tr>
      <td>
       <h4 class='text-primary'>Alumno</h4>
      </td>
    </tr>
  <tr>
    <td>
      <a href="MisNotas" class="btn btn-default" alt="Mis notas"><i class="fa fa-users"></i>Mis Notas</a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="MisClases" class="btn btn-default" alt="Mis clases"><i class="fa fa-users"></i>Mis Clases</a>
    </td>
  </tr>
    <tr>
    <td>
      <a href="MisHorarios" class="btn btn-default" alt="Mis horarios"><i class="fa fa-table"></i>Mis Horarios</a>
    </td>
  </tr>
  </table>
  @endif

    @if(Entrust::hasRole('instructores'))
  <table class="table">
    <tr>
      <td>
       <h4 class='text-primary'>Instructor</h4>
      </td>
    </tr>
  <tr>
    <td>
      <a href="ListaExamenes" class="btn btn-default" alt="Examenes"><i class="fa fa-users"></i> Examenes</a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="ListaUsuarios/alumno" class="btn btn-default" alt="Usuarios"><i class="fa fa-users"></i> Usuarios</a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="ListaEvaluaciones" class="btn btn-default" alt="Evaluaciones"><i class="fa fa-users"></i> Evaluaciones</a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="ListaLaboresUser/{{ Auth::user()->id }}" class="btn btn-default" alt="Labores"><i class="fa fa-users"></i> Labores</a>
    </td>
  </tr>
 <!-- <tr>
    <td>
      <a href="/HorarioUsuario/{{ Auth::user()->id }}" class="btn btn-default" target="_blank" alt="Horarios"><i class="fa fa-table"></i> Horario</a>
    </td>
  </tr>
   <tr>
    <td>
      <a href="/ClasesInstructor/{{ Auth::user()->id }}" class="btn btn-default" target="_blank" alt="Horarios"><i class="fa fa-table"></i> Clases</a>
    </td>
  </tr>-->
  </table>
  @endif

    @if(Entrust::hasRole('administracion'))
 <table class="table">
    <tr>
      <td>
       <h4 class='text-primary'>Administración</h4>
      </td>
    </tr>
  <tr>
    <td>
      <a href="ListaExamenes" class="btn btn-default" alt="Examenes"><i class="fa fa-users"></i> Examenes</a>
    </td>
  </tr>
    <tr>
    <td>
      <a href="ListaEvaluaciones" class="btn btn-default" alt="Evaluaciones"><i class="fa fa-users"></i> Evaluaciones</a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="ListaUsuarios/alumno" class="btn btn-default" alt="Usuarios"><i class="fa fa-users"></i> Usuarios</a>
    </td>
  </tr>
      <tr>
    <td>
      <a href="ListaGastosAcma" class="btn btn-default" target="_blank" alt="Gastos"><i class="fa fa-table"></i> Gastos Acma</a>
    </td>
    </tr>
    <tr>
    <td>
      <a href="ListaIngresosAcma" class="btn btn-default" target="_blank" alt="Gastos"><i class="fa fa-table"></i> Ingresos Acma</a>
    </td>
    </tr>
    <tr>
    <td>
      <a href="ListaMatricula" class="btn btn-default" alt="Matricula"><i class="fa fa-users"></i> Matricula</a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="ListaPlanes" class="btn btn-default" alt="Planes"><i class="fa fa-users"></i> Planes</a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="ListaLabores" class="btn btn-default" alt="Labores"><i class="fa fa-users"></i> Labores</a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="AllHorario" class="btn btn-default" target="_blank" alt="Horarios"><i class="fa fa-table"></i> Horarios</a>
    </td>
    </tr>
  </table>
  </div>
  <div class="col-md-4" >
  <table class="table">
    <tr>
      <td>
       <h4 class='text-primary'>Gastos</h4>
      </td>
      <td>
        Eduardo
      </td>
      <td>
        Ceachei
      </td>
      <td>
        Totales
      </td>
    </tr>
  <tr>
    <td>
      <a href="ListaOpex" class="btn btn-default" alt="Opex"><i class="fa fa-line-chart"></i> Opex</a>
    </td>
    <td>
        {{ number_format($total_eduardo_o)  }}
    </td>
    <td>
        {{ number_format($total_ceachei_o) }}
    </td>
    <td>
        {{ number_format($t_opex) }}
    </td>
  </tr>
    <tr>
      <td>
        <a href="ListaCapex" class="btn btn-default" alt="Capex"><i class="fa fa-bar-chart"></i> Capex</a>
      </td>
      <td>
          {{ number_format($total_eduardo_c) }}
      </td>
      <td>
          {{ number_format($total_ceachei_c) }}
      </td>
      <td>
        {{ number_format($t_capex) }}
      </td>
    </tr>
    <tr>
      <td>
        Totales
      </td>
      <td>
          {{ number_format($total_eduardo) }}
      </td>
      <td>
          {{ number_format($total_ceachei) }}
      </td>
      <td>
          {{ number_format($total_final) }}
      </td>
    </tr>
    <tr>
    <td>
      <a href="ListaInfoFinanciero" class="btn btn-default" alt="Info FInanciero"><i class="fa fa-table"></i> Informe Financiero</a>
    </td>
  </tr>
  </table>
  @endif

  @if(Entrust::hasRole('superadmin'))
 <table class="table">
    <tr>
      <td>
       <h4 class='text-primary'>Super Administración</h4>
      </td>
    </tr>
  <tr>
    <td>
      <a href="ListaExamenes" class="btn btn-default" alt="Examenes"><i class="fa fa-users"></i> Examenes</a>
    </td>
  </tr>
    <tr>
    <td>
      <a href="ListaEvaluaciones" class="btn btn-default" alt="Evaluaciones"><i class="fa fa-users"></i> Evaluaciones</a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="ListaUsuarios/alumno" class="btn btn-default" alt="Usuarios"><i class="fa fa-users"></i> Usuarios</a>
    </td>
  </tr>
      <tr>
    <td>
      <a href="ListaGastosAcma" class="btn btn-default" target="_blank" alt="Gastos"><i class="fa fa-table"></i> Gastos Acma</a>
    </td>
    </tr>
    <tr>
    <td>
      <a href="ListaIngresosAcma" class="btn btn-default" target="_blank" alt="Gastos"><i class="fa fa-table"></i> Ingresos Acma</a>
    </td>
    </tr>
    <tr>
    <td>
      <a href="ListaMatricula" class="btn btn-default" alt="Matricula"><i class="fa fa-users"></i> Matricula</a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="ListaPlanes" class="btn btn-default" alt="Planes"><i class="fa fa-users"></i> Planes</a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="ListaLabores" class="btn btn-default" alt="Labores"><i class="fa fa-users"></i> Labores</a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="AllHorario" class="btn btn-default" target="_blank" alt="Horarios"><i class="fa fa-table"></i> Horarios</a>
    </td>
    </tr>
  </table>
  </div>
  <div class="col-md-4" >
  <table class="table">
    <tr>
      <td>
       <h4 class='text-primary'>Gastos</h4>
      </td>
      <td>
        Eduardo
      </td>
      <td>
        Ceachei
      </td>
      <td>
        Totales
      </td>
    </tr>
  <tr>
    <td>
      <a href="ListaOpex" class="btn btn-default" alt="Opex"><i class="fa fa-line-chart"></i> Opex</a>
    </td>
    <td>
        {{ number_format($total_eduardo_o)  }}
    </td>
    <td>
        {{ number_format($total_ceachei_o) }}
    </td>
    <td>
        {{ number_format($t_opex) }}
    </td>
  </tr>
    <tr>
      <td>
        <a href="ListaCapex" class="btn btn-default" alt="Capex"><i class="fa fa-bar-chart"></i> Capex</a>
      </td>
      <td>
          {{ number_format($total_eduardo_c) }}
      </td>
      <td>
          {{ number_format($total_ceachei_c) }}
      </td>
      <td>
        {{ number_format($t_capex) }}
      </td>
    </tr>
    <tr>
      <td>
        Totales
      </td>
      <td>
          {{ number_format($total_eduardo) }}
      </td>
      <td>
          {{ number_format($total_ceachei) }}
      </td>
      <td>
          {{ number_format($total_final) }}
      </td>
    </tr>
    <tr>
    <td>
      <a href="ListaInfoFinanciero" class="btn btn-default" alt="Info FInanciero"><i class="fa fa-table"></i> Informe Financiero</a>
    </td>
  </tr>
  </table>
  @endif
  </div>
@stop



