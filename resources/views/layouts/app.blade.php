<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        @include('public.head')

    </head>

    <body>
        <main role="main">
            @yield('content')
        </main>

        @yield('scripts')
    </body>

</html>
