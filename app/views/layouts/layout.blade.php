<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"/> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><html lang="en" class="no-js"><![endif]-->
<html>
<head>
<title>PANEL CONTROL CMA @if (Auth::check()) | {{Auth::user()->usuario}} @endif</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="author" content="Davila">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
  <!-- JS -->
  <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
  {{ HTML::script('js/lib/jquery.validate.js') }}
  {{ HTML::script('js/lib/additional-methods.min.js') }}
  {{ HTML::script('js/functions/indexcma.js') }}
  {{ HTML::script('js/lib/underscore.js') }}
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  {{ HTML::script('js/lib/bootstrap-datepicker.js') }}
  {{ HTML::script('js/lib/bootstrap-fileupload.js') }}

  <!-- CSS -->
  {{ HTML::style('css/font-awesome-4.2.0/css/font-awesome.css'); }}
  <!--{{ HTML::style('css/jquery.mobile.css'); }}-->

<!-- script especiales -->
  
  @yield('head')
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  {{ Rapyd::styles() }} 
</head>
    <body>
    {{ Rapyd::scripts() }}
    {{ HTML::script('js/functions/general.js') }}
    <input type="hidden" id="baseurl" value="{{ URL::to('/');}}" />
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ URL::to('/');}}/indexcma">Centro de Manejo Avanzado</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a class="brand"> 
          <img class="avatar img-circle" src="{{ URL::to('/') }}/img/avatar-default.jpeg" height="30px" width="30px"></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <img  src="{{ URL::to('/');}}/img/glyphicons/png/glyphicons_136_cogwheel.png" height="25px" width="25px"/>
          <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Acciones aquí</a></li>
            <li class="divider"></li>
            <li><a href="CerrarSesion" class="pointer dropdown-menu-text">Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  @show

        <div class="container-fluid">
            @yield('content')
        </div>
    </body>
</html>