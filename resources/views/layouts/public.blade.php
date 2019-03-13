<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        @include('public.head')

    </head>

    <body>
        @include('public.header')


        <main role="main">


            @include('public.carrusel')


            @yield('contenido')
            <!-- /.container -->
            @include('public.footer')

        </main>

        @yield('scripts')
        <script>
            $(document).ready(function () {
                console.log(window.location.href);

                // -----------------------------------------------------------------------
                $.each($('#menu-principal ul').find('li'), function () {
                    $(this).toggleClass('active',
                        window.location.href == $(this).find('a').attr('href'));
                });
                // -----------------------------------------------------------------------
            });

        </script>
    </body>

</html>
