<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">{{  __(strtoupper('Administración')) }}</li>
                <li>
                    <a href="{{ route('dashboard') }}" data-active="/dashboard"><i class="mdi mdi-gauge"></i><span class="hide-menu">{{ __('Dashboard') }}</span></a>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Asociaciones</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ e(route('dashboardAsociaciones')) }}" data-active="/asociaciones">Listado</a></li>
                        <li><a href="{{ e(route('dashboardAsociacionesNueva')) }}"  data-active="/asociaciones/crear">Crear</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Ofertas</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ e(route('dashboardOfertas')) }}" data-active="/ofertas">Listado</a></li>
                        <li><a href="{{ e(route('dashboardOfertasNueva')) }}"  data-active="/ofertas/crear">Crear</a></li>
                    </ul>
                </li>
                @if(Auth::user()->hasRole('admin'))
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Usuarios</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ e(route('dashboardUsuarios')) }}" data-active="/usuarios">Listado</a></li>
                        <li><a href="{{ e(route('dashboardUsuariosNuevo')) }}"  data-active="/usuarios/crear">Crear</a></li>
                    </ul>
                </li>
                @endif
                <li class="nav-devider"></li>
                <li class="user-profile">
                        <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <span class="round {{ Auth::user()->getRoleClass() }} roleSmall">{{ substr(Auth::user()->getRoleClass(),4,1) }} </span>
                            &nbsp;
                            <span class="hide-menu">{{ Auth::user()->name }} </span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ e(route('perfilUsuario')) }}" data-active="usuarios/perfil"> {{ __('Mi cuenta') }}</a></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    {{ __('Salir') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                </form>
                            </li>
                        </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
