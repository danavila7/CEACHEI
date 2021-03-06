
@extends('layouts.layout')
@section('head')
@stop
@section('title')
Crear Alumno
@stop
@section('sidebar')
    @parent
@stop
@section('content')
<link rel="stylesheet" type="text/css" href="http://test.cma.cl/packages/zofe/rapyd/assets/datepicker/datepicker3.css">
<script type="http://test.cma.cl/packages/zofe/rapyd/assets/datepicker/locales/bootstrap-datepicker.es.js"></script>
<script type="http://test.cma.cl/packages/zofe/rapyd/assets/datepicker/bootstrap-datepicker.js"></script>
<div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Datos Alumno</h3>
        </div>
        {{ Form::open(array('url' => 'admin/alumnos/crear', 'method' => 'post')) }}
          <div class="box-body">

            <div class="form-group  {{ $errors->has('fecha_inscripcion') ? 'error' : '' }}">
                <label class="control-label" for="name">Fecha Inscripción</label>
                <div class="controls">
                    <input class="form-control datepicker_local" type="text" name="fecha_inscripcion" value="{{ Input::old('fecha_inscripcion') }}" />
                    {{ $errors->first('fecha_inscripcion', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            <!-- nombre -->
            <div class="form-group {{ $errors->has('nombre') ? 'error' : '' }}">
                <label class="control-label" for="name">Nombre</label>
                <div class="controls">
                    <input class="form-control" type="text" name="nombre" id="nombre" value="{{ Input::old('nombre') }}" />
                    {{ $errors->first('nombre', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            <div class="form-group {{ $errors->has('apellido_paterno') ? 'error' : '' }}">
                <label class="control-label" for="name">Apellido Paterno</label>
                <div class="controls">
                    <input class="form-control" type="text" name="apellido_paterno" id="apellido_paterno" value="{{ Input::old('apellido_paterno') }}" />
                    {{ $errors->first('apellido_paterno', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            <div class="form-group {{ $errors->has('apellido_materno') ? 'error' : '' }}">
                <label class="control-label" for="name">Apellido Materno</label>
                <div class="controls">
                    <input class="form-control" type="text" name="apellido_materno" id="apellido_materno" value="{{ Input::old('apellido_materno') }}" />
                    {{ $errors->first('apellido_materno', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            <div class="form-group  {{ $errors->has('fecha_nacimiento') ? 'error' : '' }}">
                <label class="control-label" for="name">Fecha Nacimiento</label>
                <div class="controls">
                    <input class="form-control datepicker_local" type="text" name="fecha_nacimiento" value="{{ Input::old('fecha_nacimiento') }}" />
                    {{ $errors->first('fecha_nacimiento', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            <div class="form-group {{ $errors->has('rut') ? 'error' : '' }}">
                <label class="control-label" for="name">Rut</label>
                <div class="controls">
                    <input class="form-control" type="text" name="rut" id="rut" value="{{ Input::old('rut') }}" />
                    {{ $errors->first('rut', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'error' : '' }}">
                <label class="control-label" for="name">Email</label>
                <div class="controls">
                    <input class="form-control" type="text" name="email" id="email" value="{{ Input::old('email') }}" />
                    {{ $errors->first('email', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            <div class="form-group {{ $errors->has('telefono') ? 'error' : '' }}">
                <label class="control-label" for="name">Telefono</label>
                <div class="controls">
                    <input class="form-control" type="text" name="telefono" id="telefono" value="{{ Input::old('telefono') }}" />
                    {{ $errors->first('telefono', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            <div class="form-group {{ $errors->has('direccion') ? 'error' : '' }}">
                <label class="control-label" for="name">Direccion</label>
                <div class="controls">
                    <input class="form-control" type="text" name="direccion" id="direccion" value="{{ Input::old('direccion') }}" />
                    {{ $errors->first('direccion', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            <!-- Activo -->
            <div class="control-group {{ $errors->has('activo') ? 'error' : '' }}">
                <label class="control-label" for="types">Activo</label>
                <div class="controls">
                    <select class="form-control" name="activo" id="type">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
            <!-- Plan -->
            <div class="control-group {{ $errors->has('id_plan') ? 'error' : '' }}">
                <label class="control-label" for="types">Plan</label>
                <div class="controls">
                    <select class="form-control" name="id_plan" id="id_plan">
                        @foreach ($planes as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Crear</button>
          </div>
        {{ Form::close() }}
      </div>
    </div>
</div>
@stop