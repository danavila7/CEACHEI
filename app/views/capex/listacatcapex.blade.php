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
{{ HTML::link('ListaCapex','Lista Capex',array( 'type' => 'button', 'class' => 'btn btn-default')) }}
	{{ $filter }}
	{{ $grid }}
@stop