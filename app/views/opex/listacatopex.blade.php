@extends('layouts.layout')
@section('head')

{{ HTML::script('js/functions/listacatopex.js') }}
@stop
@section('titulo')
CMA/Lista Opex
@stop
@section('sidebar')
    @parent
@stop
@section('content')
{{ HTML::link('admin/ListaOpex','Lista Opex',array( 'type' => 'button', 'class' => 'btn btn-default')) }}
	{{ $filter }}
	{{ $grid }}
@stop