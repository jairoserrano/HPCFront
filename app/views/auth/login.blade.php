
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>HPFront - Login</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style(asset('assets/bootstrap/dist/css/bootstrap.min.css')) }}
    <!-- Custom styles for this template -->
    {{ HTML::style(asset('css/signin.css')) }}


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        {{ HTML::script(asset('assets/html5shiv/dist/html5shiv.min.js')) }}
        {{ HTML::script(asset('assets/respond/dest/respond.min.js')) }}
    <![endif]-->
  </head>

  <body>

    <div class="container">

      {{ Form::open(array('route' => 'auth', 'class' => 'form-signin', 'role' => 'form')) }}
        <h2 class="form-signin-heading">Ingresar a HPCFront</h2>
        @if(Session::has('login_error'))
        <p>Error</p>
        @endif
        {{ Form::text('uid', null, array('class' => 'form-control', 'placeholder'=> 'Cod Sirius', 'autofocus' => 'autofocus', 'required' => 'required')) }}
        {{ Form::password('password', array('class' => 'form-control', 'placeholder'=> 'Contraseña', 'required' => 'required')) }}
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      {{ Form::close() }}

    </div> <!-- /container -->

  </body>
</html>
