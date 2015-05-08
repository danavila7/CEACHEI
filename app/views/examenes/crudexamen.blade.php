@extends('layouts.layout')
@section('head')
{{ HTML::script('js/functions/crearexamen.js') }}
@stop
@section('titulo')
CMA/Crear Examen
@stop
@section('sidebar')
    @parent
@stop
@section('content')
{{ $edit }}
@stop