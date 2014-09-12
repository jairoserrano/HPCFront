<!DOCTYPE html>
<html lang="es"><head>
    <meta charset="utf-8">
    <title>
        @section('page_title')
        @show
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->

    <!--[if lt IE 9]>
      {{ HTML::script('assets/html5shiv/dist/html5shiv.min.js') }}
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/images/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/images/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/images/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/images/apple-touch-icon-57-precomposed.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    {{--Le styles--}}
    {{ HTML::style('assets/bootstrap/dist/css/bootstrap.min.css')  }}
    {{ HTML::style('assets/bootstrap/dist/css/bootstrap-theme.min.css')  }}
    @section('styles')
    @show
</head>
<body>
    <!-- El container es la caja principal, allí se ponen todos los contenidos, se recomienda mantener -->
        <div class="container">

            <!-- Menú auxiliar, este menú se usará para todos los sitios, allí van los accesos más comunes, savio, sirius, etc -->
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <nav class="navbar navbar-default navbar-inverse" role="navigation">
                        <div class="navbar-header">
                             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">UTB</a>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li> <a href="http://bienestar.unitecnologica.edu.co/">Bienestar Institucional</a>	</li>
                                <li><a href="http://www.utbvirtual.edu.co/">SAVIO</a>	</li>
                                <li><a href="#">SIRIUS</a></li>
                                <li><a href="http://primo.gsl.com.mx:1701/">Bibliotecas</a>	</li>
                                <li><a href="http://correo.utbvirtual.edu.co/">Correo</a>
                                </li>
                            </ul>
                        </div>

                    </nav>
                </div>
            </div>

            <!-- Área encabezado ppal, Incluye logo, nombre, slogan, buscador y redes sociales -->
            <div class="row clearfix">
                <!-- Logo -->
                <div class="col-md-3 column">
                    <img alt="Logo UTB" src="{{ asset('assets/images/logo.png') }}">
                </div>

                <!-- Título y slogan -->
                <div class="col-md-5 column">
                    <h3>Universidad Tecnológica de Bolívar</h3>
                </div>

            </div>

            <div class="row clearfix">
                <!-- Logo -->
                <div class="col-md-3 column">
                    @section('sidebar')
                    @show
                </div>

                <!-- Título y slogan -->
                <div class="col-md-5 column">
                    @yield('content')
                </div>

            </div>

            <hr>

            <!-- Área pie de pagina 3 columnas color definido en el archivo style.css -->
            <div class="row clearfix" id="pie_pagina">

PIE

            </div>

            <!-- Area copyright color definido en el archivo style.css-->
            <div class="row clearfix" id="copy">

            </div>

        </div>

        {{--Le scripts--}}
        {{ HTML::script('assets/jquery/dist/jquery.min.js') }}
        {{ HTML::script('assets/jquery/dist/jquery.min.map') }}

        {{ HTML::script('assets/bootstrap/dist/js/bootstrap.min.js') }}
        @section('scripts')
        @show
</body>
</html>
