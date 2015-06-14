@extends('layouts.layout')
@section('head')
@stop
@section('titulo')
CMA/Matricula
@stop
@section('sidebar')
    @parent
@stop
@section('content')
	{{ $filter }}
	{{ $grid }}
@stop