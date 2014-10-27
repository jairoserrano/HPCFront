<section class="top-content"></section>
<section class="menu">
<ul id="sidebar-menu" class="nav nav-sidebar">
    <li class="{{ (Request::url() === route('projects.index')) ? 'active' : null }}"><a href="{{route('projects.index')}}"><i class="glyphicon glyphicon-briefcase"></i><span>Projectos</span></a></li>
    <li class="{{ (Request::url() === route('executables.index')) ? 'active' : null }}"><a href="{{route('executables.index')}}"><i class="glyphicon glyphicon-cog"></i><span>Apps</span></a></li>
</ul>
</section>