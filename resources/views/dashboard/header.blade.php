<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">


            <ul class="navbar-nav mr-auto">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a>                    </li>
                <li class="nav-item">
                    <a class="nav-link navbar-brand waves-effect waves-dark" href="index.html">
                        <!-- Logo text --><span>
                                <!-- dark Logo text -->
                                <img src="{{ asset('images/logo-text.png') }}" alt="homepage" class="dark-logo" />
                                <!-- Light Logo text -->
                                <img src="{{ asset('images/logo-light-text.png') }}" class="light-logo" alt="homepage" /></span>                        </a>
                </li>
            </ul>

        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto">

            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                {{--
                <!-- ============================================================== -->
                <!-- Language -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-us"></i></a>
                    <div class="dropdown-menu dropdown-menu-right animated bounceInDown"> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> India</a> <a class="dropdown-item"
                            href="#"><i class="flag-icon flag-icon-fr"></i> French</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> China</a>                        <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a> </div>
                </li> --}}
                <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="round {{ Auth::user()->getRoleClass() }} roleMedium" >{{ substr(Auth::user()->getRoleClass(),4,1) }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><span class="round {{ Auth::user()->getRoleClass() }}">{{ substr(Auth::user()->getRoleClass(),4,1) }}</span></div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->name }}</h4>
                                        <p class="text-muted">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ e(route('perfilUsuario')) }}" data-active="usuarios/perfil"><i class="ti-settings"></i> {{ __('Mi cuenta') }}</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> {{ __('Salir') }}
                                </a>
                                <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
