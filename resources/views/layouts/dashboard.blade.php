<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
        <!-- Bootstrap Core CSS -->
        {{-- <link href="{{ asset('js/dashboard/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('js/dashboard/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
        <!-- This page CSS -->
        <!-- chartist CSS -->
        <link href="{{ asset('js/dashboard/plugins/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
        <link href="{{ asset('js/dashboard/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
        <!--c3 CSS -->
        <link href="{{ asset('js/dashboard/plugins/c3-master/c3.min.css') }}" rel="stylesheet">
        <!--Toaster Popup message CSS -->
        <link href="{{ asset('js/dashboard/plugins/toast-master/css/jquery.toast.css') }}" rel="stylesheet"> --}}
        @yield('estilos')
        <!-- Custom CSS -->
        {{-- <link href="{{ asset('css/dashboard/style.css') }}" rel="stylesheet">
        <!-- Dashboard 1 Page CSS -->
        <link href="{{ asset('css/dashboard/pages/dashboard1.css') }}" rel="stylesheet">
        <!-- You can change the theme colors from here -->
        <link href="{{ asset('css/dashboard/colors/default-dark.css') }}" id="theme-dark" rel="stylesheet"> --}}
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <link href="{{ asset('css/dashboard.css') }}" id="theme" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="fix-header fix-sidebar card-no-border">

        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Admin Pro</p>
            </div>
        </div>

        <div id="main-wrapper">

            @include('dashboard.header')

            @include('dashboard.sidebar')
            <div class="page-wrapper">
                @yield('content')
                @include('dashboard.footer')
            </div>

        </div>

        {{-- <script src="{{ asset('js/dashboard/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('js/dashboard/plugins/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('js/dashboard/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/dashboard/perfect-scrollbar.jquery.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('js/dashboard/waves.js') }}"></script> --}}
        {{-- <script src="{{ asset('js/dashboard/sidebarmenu.js') }}"></script> --}}

        {{-- <script src="{{ asset('js/dashboard/plugins/sparkline/jquery.sparkline.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('js/dashboard/plugins/chartist-js/dist/chartist.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('js/dashboard/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('js/dashboard/plugins/d3/d3.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('js/dashboard/plugins/c3-master/c3.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('js/dashboard/plugins/toast-master/js/jquery.toast.js') }}"></script>
        <script src="{{ asset('js/dashboard/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script> --}}
        <script src="{{ asset('js/dashboard.js') }}"></script>
        <script>
            $(function () {
                "use strict";
                $(function () {
                    $(".preloader").fadeOut();
                });
                jQuery(document).on('click', '.mega-dropdown', function (e) {
                    e.stopPropagation()
                });
                // ==============================================================
                // Para el Heeader y Sidebar
                // ==============================================================
                var set = function () {
                    var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
                    var topOffset = 0;
                    if (width < 1170) {
                        $("body").addClass("mini-sidebar");
                        $('.navbar-brand span').hide();
                        $(".sidebartoggler i").addClass("ti-menu");
                    } else {
                        $("body").removeClass("mini-sidebar");
                        $('.navbar-brand span').show();
                    }

                    var height = ((window.innerHeight > 0) ? window.innerHeight : this.screen.height) - 1;
                    height = height - topOffset;
                    if (height < 1) height = 1;
                    if (height > topOffset) {
                        $(".page-wrapper").css("min-height", (height) + "px");
                    }

                };
                $(window).ready(set);
                $(window).on("resize", set);

                // ==============================================================
                // Theme options
                // ==============================================================
                $(".sidebartoggler").on('click', function () {
                    if ($("body").hasClass("mini-sidebar")) {
                        $("body").trigger("resize");
                        $("body").removeClass("mini-sidebar");
                        $('.navbar-brand span').show();

                    } else {
                        $("body").trigger("resize");
                        $("body").addClass("mini-sidebar");
                        $('.navbar-brand span').hide();

                    }
                });

                // Icono de cierre en vista movil
                $(".nav-toggler").click(function () {
                    $("body").toggleClass("show-sidebar");
                    $(".nav-toggler i").toggleClass("ti-menu");
                    $(".nav-toggler i").addClass("ti-close");
                });


                // ==============================================================
                // Auto Seleccion Menu lateral
                // ==============================================================
                $(function () {
                    var url = window.location;
                    
                    var element = $('ul#sidebarnav a').filter(function () {
                        var string = $(this).data('active')+" ";
                        var string3 = string.split("/");
                        if(window.location.pathname == '/dashboard'+$(this).data('active') ){
                            return true;
                        }else {
                            if(string3.length<=2 && $(this).data('active')!=undefined && (window.location.pathname!= $(this).data('active')==false) ){
                               
                                return true;
                              
                            }else {
                                return false;
                            }
                        }
                    }).addClass('active').parent().addClass('active');
                    while (true) {
                        if (element.is('li')) {
                            element = element.parent().addClass('in').parent().addClass('active');
                        } else {
                            break;
                        }
                    }

                });


                // ==============================================================
                // Sidebarmenu
                // ==============================================================
                $(function () {
                    $('#sidebarnav').AdminMenu();
                });

                // ==============================================================
                // Perfact scrollbar
                // ==============================================================
                $('.scroll-sidebar, .right-side-panel, .message-center, .right-sidebar').perfectScrollbar();

                // ==============================================================
                // Resize all elements
                // ==============================================================
                $("body").trigger("resize");



            });

        </script>

        @yield('scripts')

    </body>

</html>
