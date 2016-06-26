@extends('layouts.layout')
@section('head')
@stop
@section('title')
Labores
    <div class="pull-right">
        <a href="{{ URL::to('/') }}/admin/labores/edit" class="btn btn-success">Agregar Nueva</a>
    </div>
@stop
@section('sidebar')
    @parent
@stop
@section('content')
	{{ $filter }}
    <br>
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