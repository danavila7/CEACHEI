@extends('layouts.layout')
@section('head')
@stop
@section('title')
Matriculas
<div class="pull-right">
         <a href="{{ URL::to('/') }}/admin/matriculas/edit" class="btn btn-success">Crear Nueva</a>
</div>
@stop
@section('sidebar')
    @parent
@stop
@section('content')
	{{ $filter }}
    <div class="checkbox pull-right">
    <label>
      <input id="cuotas-completas" type="checkbox" @if($incompleta) checked @endif> Cuotas Incompletas
    </label>
  </div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
	           {{ $grid }}
            </div>
        </div>
    </div>
</div>
@stop