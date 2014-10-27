<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>HPFront - @section('page_title')@show</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style(asset('assets/bootstrap/dist/css/bootstrap.min.css')) }}
    {{-- HTML::style(asset('assets/bootstrap/dist/css/bootstrap-theme.min.css')) --}}

    {{ HTML::style(asset('css/docs.min.css')) }}
    {{ HTML::style(asset('css/dashboard.css')) }}

    @section('styles')
        @show


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        {{ HTML::script(url("https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js")) }}
        {{ HTML::script(url("https://oss.maxcdn.com/respond/1.4.2/respond.min.js")) }}
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">HPCFront</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">{{{ Auth::user()->full_name }}}</a></li>
            <li><a href="{{{ route('logout') }}}">Salir</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div id="sidebar" class="col-sm-3 col-md-2 sidebar">
            @include('layouts.sidebar')
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          @yield('content')
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {{ HTML::script(asset("assets/jquery/dist/jquery.min.js")) }}
    {{ HTML::script(asset("assets/bootstrap/dist/js/bootstrap.min.js")) }}
    @section('scripts')
        @show
  </body>
</html>