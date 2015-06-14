@extends('layouts.layout')
@section('head')
@stop
@section('titulo')
CMA/Labores
@stop
@section('sidebar')
    @parent
@stop
@section('content')
	{{ $filter }}
	{{ $grid }}
@stop