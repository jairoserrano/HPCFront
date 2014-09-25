
<!-- Menú auxiliar, este menú se usará para todos los sitios, allí van los accesos más comunes, savio, sirius, etc -->
<div id="alternative-menu" class="clearfix alternative-menu hidden-sm hidden-xs">
    <nav class="navbar navbar-default navbar-inverse top-menu" role="navigation">
        <div class="navbar-header">
            <a href="{{ url('#') }}" class="navbar-brand"><span class="glyphicon glyphicon-arrow-left"></span>  UTB</a>
        </div>

        <div class="collapse navbar-collapse">
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