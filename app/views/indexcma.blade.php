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
  <table class="table">
    <tr>
      <td>
       <h4 class='text-primary'>Escuela</h4>
      </td>
    </tr>
  <tr>
    <td>
      <a href="ListaUsuarios" class="btn btn-default" alt="Usuarios"><i class="fa fa-users"></i> Usuarios</a>
    </td>
	</tr>
  <tr>
    <td>
      <a href="ListaPlanes" class="btn btn-default" alt="Planes"><i class="fa fa-list-alt"></i> Planes</a>
    </td>
  </tr>
	<tr>
    <td>
     <a href="ListaExamenes" class="btn btn-default" alt="Examenes"><i class="fa fa-file-text"></i> Examenes</a>
    </td>
	</tr>
  <tr>
    <td>
      <a class="btn btn-default" target="_blank" alt="Examenes"><i class="fa fa-table"></i> Horarios</a>
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
    </tr>
  <tr>
    <td>
      <a href="ListaOpex" class="btn btn-default" alt="Opex"><i class="fa fa-line-chart"></i> Opex</a>
    </td>
    </tr>
    <tr>
    <td>
      <a href="ListaCapex" class="btn btn-default" alt="Capex"><i class="fa fa-bar-chart"></i> Capex</a>
    </td>
    </tr>
  </table>
  </div>
@stop



