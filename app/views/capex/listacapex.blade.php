@extends('layouts.layout')
@section('head')
@stop
@section('titulo')
CMA/Lista Capex
@stop
@section('sidebar')
    @parent
@stop
@section('content')
	{{ $filter }}
	{{ $grid }}
@stop