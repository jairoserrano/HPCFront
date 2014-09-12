
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
                {{ link_to('#', 'UTB', array('class' => 'navbar-brand')) }}
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        {{ link_to('http://bienestar.unitecnologica.edu.co/', 'Bienestar Institucional') }}
                    </li>
                    <li>
                        {{ link_to('http://www.utbvirtual.edu.co/', 'SAVIO') }}
                    </li>
                    <li>
                        {{ link_to('#', 'SIRIUS') }}
                    </li>
                    <li>
                        {{ link_to('http://primo.gsl.com.mx:1701/', 'Bibliotecas') }}
                    </li>
                    <li>
                       {{ link_to('http://correo.utbvirtual.edu.co/', 'Correo') }}
                    </li>
                </ul>
            </div>

        </nav>
    </div>
</div>