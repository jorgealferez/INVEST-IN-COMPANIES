<aside class="left-sidebar">
    <!-- Sidebar scroll-->

    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">{{ __(strtoupper('Administración')) }}</li>
                <li>
                    <a href="{{ route('dashboard') }}" data-active="/dashboard"><i class="mdi mdi-poll-box"></i><span class="hide-menu">{{ __('Dashboard') }}</span></a>
                </li>

                <li>
                    <?php switch (Auth::user()->roles->first()->name) {

                            case 'Admin':?>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-security-home"></i><span class="hide-menu">{{ __('Asociaciones') }}</a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ e(route('dashboardAsociaciones')) }}" data-active="/asociaciones">Listado</a></li>
                        <li><a href="{{ e(route('dashboardAsociacionesNueva')) }}" data-active="/asociaciones/crear">Crear</a></li>
                    </ul>
                </li>
                <?php break;
                            case 'Asesor': ?>
                <a href="{{ e(route('dashboardAsociaciones')) }}" data-active="/asociaciones">
                    <i class="mdi mdi-security-home"></i><span class="hide-menu">{{ __('Mis asociaciones') }}
                    </span>
                </a>
                <?php
                            break;

                            case 'Gestor':
                            if(!Auth::user()->asociaciones->isEmpty()){?>
                <a href="{{ e(route('dashboardAsociacion', Auth::user()->asociaciones->first()->id)) }}" data-active="/asociaciones">
                    <i class="mdi mdi-security-home"></i>
                    <span class="hide-menu">{{ __('Mi Asociación') }}</span>
                </a>
                <?php
                    }
                            break;
                        } ?>
                </li>
                @if ( !Auth::user()->asociaciones->isEmpty() || Auth::user()->hasRole('admin'))
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-tag-text-outline"></i><span class="hide-menu">Ofertas</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ e(route('dashboardOfertas')) }}" data-active="/ofertas">Listado</a></li>
                        <li><a href="{{ e(route('dashboardOfertasNueva')) }}" data-active="/ofertas/crear">Crear</a></li>
                    </ul>
                </li>
                @endif @if(Auth::user()->hasAnyRole(['Admin','Asesor']) )
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Usuarios</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ e(route('dashboardUsuarios')) }}" data-active="/usuarios">Listado</a></li>
                        <li><a href="{{ e(route('dashboardUsuariosNuevo')) }}" data-active="/usuarios/crear">Crear</a></li>
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
                        <li>
                            <a href="{{ e(route('perfilUsuario')) }}" data-active="usuarios/perfil"> {{ __('Mi cuenta') }}</a>
                        </li>
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
