@extends('layouts.layout')
@section('head')

{{ HTML::script('js/functions/listaopex.js') }}
@stop
@section('titulo')
CMA/Lista Opex
@stop
@section('sidebar')
    @parent
@stop
@section('content')
	{{ $filter }}
	{{ $grid }}
@stop