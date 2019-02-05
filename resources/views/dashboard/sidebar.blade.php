<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">{{  __(strtoupper('Administración')) }}</li>
                <li>
                    
                    <a href="{{ route('dashboard') }}" data-active="/dashboard"><i class="mdi mdi-gauge"></i><span class="hide-menu">{{ __('Dashboard') }}</span></a>
                    {{-- <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="index.html">Minimal </a></li>
                        <li><a href="index2.html">Analytical</a></li>
                        <li><a href="index3.html">Demographical</a></li>
                        <li><a href="index4.html">Modern</a></li>
                    </ul> --}}
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Asociaciones</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ e(route('dashboardAsociaciones')) }}" data-active="/asociaciones">Listado</a></li>
                        <li><a href="{{ e(route('dashboardAsociacionesNueva')) }}"  data-active="/asociaciones/crear">Crear</a></li>
                    </ul>
                </li>
               
                <li class="nav-devider"></li>
                <li class="user-profile">
                        <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <?php $usuario_asociacionRole= Auth::user()->roles->first()->name; ?>
                            <span class="round role{{ substr($usuario_asociacionRole,0,2) }}" style="width: 30px;height: 30px;line-height: 30px;">{{ substr($usuario_asociacionRole,0,1) }}</span>
                            <span class="hide-menu">{{ Auth::user()->name }} </span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="javascript:void()">My Profile </a></li>
                            <li><a href="javascript:void()">My Balance</a></li>
                            <li><a href="javascript:void()">Inbox</a></li>
                            <li><a href="javascript:void()">Account Setting</a></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
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
