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
	{{ $grid }}
@stop