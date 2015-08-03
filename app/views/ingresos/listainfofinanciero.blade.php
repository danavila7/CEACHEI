@extends('layouts.layout')
@section('head')
@stop
@section('titulo')
CMA/Informe Financiero
@stop
@section('sidebar')
    @parent
@stop
@section('content')
	{{ $filter }}
	{{ $grid }}
@stop