<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->

        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/public.css') }}" rel="stylesheet"> {{--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    </head>

    <body>
        @include('public.header')


        <main role="main">

            <div id="myCarousel" class="carousel slide mb-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                    <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                </ol>

                <div class="carousel-inner">

                    <div class="carousel-item carousel-item-next carousel-item-left">
                        <img src="images/slider/home1.jpg" alt="">

                        <div class="container">

                            <div class="carousel-caption text-left">
                                <h1>Un plan especialmente pensado</h1>
                                <p>para PYMES</p>
                                <p><a class="btn-invest" href="#" role="button">Ver más</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">

                        <img src="images/slider/home2.jpg" alt="" srcset="">

                        <div class="container">

                            <div class="carousel-caption">
                                <h1>Another example headline.</h1>
                                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida
                                    at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item active carousel-item-left">

                        <img src="images/slider/home3.jpg" alt="">

                        <div class="container">

                            <div class="carousel-caption text-right">
                                <h1>One more for good measure.</h1>
                                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida
                                    at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>


            <!-- Marketing messaging and featurettes
  ================================================== -->
            <!-- Wrap the rest of the page in another container to center all the content. -->

            @yield('contenido')
            <!-- /.container -->
            @include('public.footer')

        </main>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        @yield('scripts')

    </body>

</html>
