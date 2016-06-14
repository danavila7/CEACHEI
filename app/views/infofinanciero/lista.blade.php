@extends('layouts.layout')
@section('head')
@stop
@section('title')
Informe Financiero
<div class="pull-right">
        <a href="{{ URL::to('/') }}/admin/infofinanciero/edit" class="btn btn-success">Agregar Informe</a>
    </div>
@stop
@section('sidebar')
    @parent
@stop
@section('content')
    {{ $filter }}
    {{ $grid }}
@stop