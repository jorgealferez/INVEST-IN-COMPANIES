<header>
    <div class="d-flex flex-column flex-md-row align-items-center bg-primary text-white rss-header">
        <h5 class="my-0 mr-auto"><i class="fas fa-phone"></i> 91 762 456 123</h5>
        <nav class="">
            <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">

                <li class="nav-item">
                    <a class="nav-link px-3 py-2 text-white mx-auto" href="#"><i class="fas fa-rss"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 text-white" href="#"><i class="fab fa-twitter"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 text-white" href="#"><i class="fab fa-tumblr"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 text-white" href="#"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 text-white" href="#"><i class="fas fa-search"></i></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="py-3 text-center">
        <img class="d-block mx-auto p-4 img-fluid" src="{{ asset('images/logo.png') }}" alt="{{ __('INVESTin Company') }}" width="547"
            height="85">
    </div>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary text-white">

        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
        <div class="navbar-collapse collapse  menu-principal" id="navbarCollapse" style="">
            <ul class="navbar-nav ml-auto mr-auto  text-center">
                <li class="nav-item ">
                    <a class="nav-link " href="{{ route('home') }}">{{ __('Home') }}<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">{{ __('Vende tu empresa') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">{{ __('Compra una empresa') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">{{ __('Buscador') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">{{ __('Documentación') }}</a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">{{ __('¿Quiénes Somos?') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="
                    @if (Auth::user())
                    {{ url('/dashboard') }}
                    @else
                    {{ route('login') }}
                    @endif

                    ">
                    @if (Auth::user())
                    {{ __('Admin') }}
                    @else
                    {{ __('Acceso') }}
                    @endif</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
