<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"/> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><html lang="en" class="no-js"><![endif]-->
<!-- AGREGANDO EL MODULO APP (ANGULARJS) -->
<html>
<head>
<title>PANEL DE CONTROL @if (Auth::check()) | {{Auth::user()->usuario}} @endif</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="author" content="Davila">
<meta property="og:title" content=""/>
<meta property="og:image" content=""/>
<meta property="og:description" content=""/>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
{{ Rapyd::styles() }} 
</head>
<body>
  <!--[if lt IE 7]>
  <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
  <![endif]-->
<main id="content" role="main">
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    {{ Rapyd::scripts() }}
    {{ HTML::script('js/functions/indexcma.js') }}
    <div class="container container-view">
      <div class="row">
      <div class="col-lg-12 col-lg-offset-4">
        <div class="col-lg-3">
          <p class="bg-success">Iniciar Sesión</p>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Ingresar email">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Ingresar Password">
          </div>
          <button type="button" id="login" class="btn btn-default">Submit</button>
        <div class="alert alert-danger hide" id="alert-login" role="alert">Usuario y contraseña incorrecto. Vuelva a intentarlo</div>
      </div>
      </div>
    </div>
    </div>
    <input type="hidden" id="usuario_id" value="@if (Auth::check()) {{Auth::user()->id}} @endif" />
    <input type="hidden" id="baseurl" value="{{ URL::to('/');}}" />
    <input type="hidden" id="isLoggin" value="false" />
    </main>
    </body>
</html>