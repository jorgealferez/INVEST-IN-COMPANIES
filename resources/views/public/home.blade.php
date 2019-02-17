@extends('layouts.public')
@section('contenido')

<div class="container  pt-0 pb-5">
    <div class="row">
        <div class="col-md-12  text-center p-5">
            <h2 class="text-uppercase">Noticias</h2>
        </div>
    </div>
    <div class="row pb-5">
        <div class="col-lg-4 ">
            <img src="images/slider/noticia1.jpg" alt="" class="img-fluid">
            <h3 class="pt-5 pb-2 text-center">Suspendisse accumsan consequat</h3>
            <p class="p-3">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula
                ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
        </div>
        <div class="col-lg-4 ">
            <img src="images/slider/noticia2.jpg" alt="" class="img-fluid">
            <h3 class="pt-5 pb-2 text-center">Suspendisse accumsan consequat</h3>
            <p class="p-3">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula
                ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
        </div>
        <div class="col-lg-4 ">
            <img src="images/slider/noticia3.jpg" alt="" class="img-fluid">
            <h3 class="pt-5 pb-2 text-center">Suspendisse accumsan consequat</h3>
            <p class="p-3">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula
                ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
        </div>
    </div>
    <!-- /.col-lg-4 -->
</div>
<!-- /.row -->



<div class="featurette bg-primary">
    <form method="POST" class="" action="">
        @csrf @method('POST')


        <div class="container">
            <div class="row">
                <div class="col-md-12  px-5 pt-5 pb-3">
                    <h2 class=" text-uppercase text-center text-white mx-auto">Buscador</h2>
                </div>
            </div>
            <div class="row py-0 px-0">
                <div class="col-md-3 ">
                    <div class="form-group ">
                        <label for="provincia" class="col-md-12 col-form-label text-white text-uppercase">{{ __('Provincia') }}</label>
                        <div class="col-md-12">
                            <select name="provincia" id="provincia" class="form-control ">
                                    <option value="0">{{ __('Selecciona Perfil') }}</option>
                                    @foreach ($provincias as $provincia)
                                    <option value="{{ $provincia->id }}" >{{ $provincia->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="form-group ">
                        <label for="provincia" class="col-md-12 col-form-label text-white text-uppercase">{{ __('Provincia') }}</label>
                        <div class="col-md-12">
                            <select name="provincia" id="provincia" class="form-control ">
                                    <option value="0">{{ __('Selecciona Perfil') }}</option>
                                    @foreach ($provincias as $provincia)
                                    <option value="{{ $provincia->id }}" >{{ $provincia->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="form-group ">
                        <label for="provincia" class="col-md-12 col-form-label text-white text-uppercase">{{ __('Provincia') }}</label>
                        <div class="col-md-12">
                            <select name="provincia" id="provincia" class="form-control ">
                                    <option value="0">{{ __('Selecciona Perfil') }}</option>
                                    @foreach ($provincias as $provincia)
                                    <option value="{{ $provincia->id }}" >{{ $provincia->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="form-group ">
                        <label for="provincia" class="col-md-12 col-form-label text-white text-uppercase">{{ __('Provincia') }}</label>
                        <div class="col-md-12">
                            <select name="provincia" id="provincia" class="form-control ">
                                    <option value="0">{{ __('Selecciona Perfil') }}</option>
                                    @foreach ($provincias as $provincia)
                                    <option value="{{ $provincia->id }}" >{{ $provincia->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center p-5">
                    <button class="btn-invest d-inline-block bg-transparent text-uppercase fa-1x" type="submit">{{ __('Buscar') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container  pt-0">
    <div class="row">
        <div class="col-md-12  text-center p-5">
            <h2 class="text-uppercase">{{ __('Puntos de atención') }}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ">
            <img src="images/mapa.jpg" alt="" class="img-fluid">
        </div>
    </div>
    <!-- /.col-lg-4 -->
</div>


<hr class="featurette-divider mb-0">


<div class="featurette bg-gris py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12   px-5 pt-5 pb-3" ">
                <h4 class="text-center text-uppercase ">{{ __('Patrocinadores') }}</h4>
            </div>
        </div>
        <div class="row patrocinadores ">
            <div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
                <img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
            </div>
            <div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
                <img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
            </div>
            <div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
                <img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
            </div>
            <div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
                <img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
            </div>
            <div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
                <img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
            </div>
            <div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
                <img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
            </div>
        </div>
    </div>
    <div class="container ">
        <div class="row ">
            <div class="col-md-12 px-5 pt-5 pb-3 " ">
                <h4 class="text-center text-uppercase ">{{ __('Patrocinadores') }}</h4>
            </div>
        </div>
        <div class="row patrocinadores pb-5">
            <div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
                <img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
            </div>
            <div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
                <img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
            </div>
            <div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
                <img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
            </div>
            <div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
                <img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
            </div>
            <div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
                <img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
            </div>
            <div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
                <img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
