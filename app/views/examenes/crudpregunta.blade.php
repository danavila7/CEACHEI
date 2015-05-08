@extends('layouts.layout')
@section('head')
{{ HTML::script('js/functions/crearpregunta.js') }}
@stop
@section('titulo')
CMA/Crear Pregunta
@stop
@section('sidebar')
    @parent
@stop
@section('content')
{{ $edit }}
@stop