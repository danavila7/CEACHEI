
@extends('layouts.layout')
@section('head')
@stop
@section('title')
Crear Administrador/Recepción
@stop
@section('sidebar')
    @parent
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Datos Administrador/Recepción</h3>
        </div>
        {{ Form::open(array('url' => 'admin/administracion/crear', 'method' => 'post')) }}
          <div class="box-body">
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
                    <input class="form-control datepicker" type="text" name="fecha_nacimiento" id="datepicker" value="{{ Input::old('fecha_nacimiento') }}" />
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
            <div class="control-group {{ $errors->has('rol') ? 'error' : '' }}">
                <label class="control-label" for="types">Rol</label>
                <div class="controls">
                    <select class="form-control" name="rol">
                        <option value="7">Administrador</option>
                        <option value="8">Recepción</option>
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