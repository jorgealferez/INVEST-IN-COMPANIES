@extends('layouts.public') 
@section('contenido')


<div class="container my-5">

    <div class="row">

        <div class="col-md-12  text-center p-5">
            <h2 class="text-uppercase">{{ __('Vende tu empresa') }}</h2>
        </div>
    </div>

    <div class="row   text-justify">

        <div class="col-md-5">
            <img src="images/about2.jpg" alt="" class="img-fluid img-thumbnail">
        </div>

        <div class="col-md-7">
            <ul class="lista text-justify">
                <li>
                    <i class="fas fa-check"></i>¿Se aproxima la edad de jubilación y no cuentas con herederos que quieran
                    <strong>continuar con la actividad</strong> de la empresa?
                </li>
                <li>
                    <i class="fas fa-check"></i>¿La falta de <strong>medios financieros, organizativos o técnicos</strong>                    te impiden continuar con tu proyecto?
                </li>
                <li>
                    <i class="fas fa-check"></i>¿Necesitas obtener <strong>liquidez</strong>?
                </li>
                <li>
                    <i class="fas fa-check"></i>¿La <strong>obsolescencia tecnológica</strong> te obliga a realizar inversiones
                    que no puedes afrontar?
                </li>
            </ul>


        </div>

    </div>

    <div class="row mt-5 text-justify">

        <div class="col-md-12">
            <p>Puede que alguna o varias de estas razones sean la causa de la venta. En cualquier caso, una vez tomada la decisión,
                lo importante es hacerlo de la forma adecuada, entendiendo y aplicando la normativa vigente en esta materia,<br>
                <strong>¿y qué mejor manera que hacerlo de la mano de CEPYME y >PGS?</strong>.</p>

        </div>
    </div>

    <div class="row text-justify">

        <div class="col-md-12">
            <p>La decisión de vender una empresa es posiblemente <strong>una de las decisiones más difíciles en la vida de un empresario</strong>.
                Por otra parte, el propio proceso de transmisión de empresas se considera como la principal barrera para
                la conclusión de contratos de compraventa de empresas. Este problema se pone especialmente de manifiesto
                en caso de emprendedores y pequeñas empresas, ya que las grandes empresas pueden normalmente encontrar sin
                excesivos problemas el asesoramiento fiscal y legal apropiado.</p>

        </div>
    </div>



    <div class="row">

        <div class="col-md-12  text-center p-5">
            <h3 class="text-uppercase">{{ __('Servicios') }}</h3>
        </div>
    </div>

    <div class="row   text-justify">

        <div class="col-md-6 ">

            <div class="servicio">
                <h4 class="text-center">
                    <i class="icon-cloud-download"></i>Servicio</h4>

                <div class="row">

                    <div class="col-md-12">
                        Integer mollis elit sed tortor scelerisque, at convallis purus pharetra. Vivamus venenatis eget urna in varius. Duis augue
                        turpis, iaculis eu tempor eleifend, vulputate at diam. Vivamus nec interdum purus. Class aptent taciti
                        sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec accumsan tortor sapien,
                        eu luctus diam dapibus non. Quisque et neque ex. Vivamus a purus
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6 ">

            <div class="servicio">
                <h4 class="text-center">
                    <i class="icon-cloud-download"></i>Servicio</h4>

                <div class="row">

                    <div class="col-md-12">
                        Integer mollis elit sed tortor scelerisque, at convallis purus pharetra. Vivamus venenatis eget urna in varius. Duis augue
                        turpis, iaculis eu tempor eleifend, vulputate at diam. Vivamus nec interdum purus. Class aptent taciti
                        sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec accumsan tortor sapien,
                        eu luctus diam dapibus non. Quisque et neque ex. Vivamus a purus
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<div class="container-fluid info py-5">
    <div class="container">
        <a name="formulario"></a>


        <div class="row row justify-content-center">
            <div class="col-md-12   p-5">
                <h2 class="text-uppercase text-center pb-5">{{ __('Vende tu empresa') }}</h2>
                <p class="text-justify">Con la Plataforma Invest in Companies, lograrás sortear los problemas que encontrarías por el camino de la
                    venta, si lo recorrieses solo, y estarías acompañado y asesorado en todo momento por grandes profesionales
                    y especialistas en el sector.</p>
            </div>
            <div class="col-md-3 text-right">
                <div class="row">

                    <div class="col-md-12 py-3">
                        <a href="mailto:{{ Config::get('app.email') }}" target="_blank"><i class="fa fa-envelope"></i> {{ Config::get('app.email') }}</a>
                    </div>

                    <div class="col-md-12 py-3">
                        <i class="fa fa-phone"></i>
                        <p>91 762 456 123</p>
                    </div>

                </div>
            </div>
            <div class="col-md-5">
                @if (session()->has('enviado'))

                <div class="row">

                    <div class="col-md-12 pt-4">
                        <h4>{{ __('Gracias por ponerte en contacto con nosotros') }}</h4>
                        {{ __('en breve nos pondremos en contacto contigo.') }}
                    </div>
                </div>
                @else
                <form method="POST" class="" action="{{ action('PublicController@vendeContacto')}}">
                    @csrf @method('PUT')
                    <input type="hidden" name="tab" value="modificar">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                                <input placeholder="{{ __('Nombre y apellidos') }}" type="text " value="{{ ((old( 'name')) ? old( 'name') : $request->name ) }}"
                                    class="form-control form-control-line
                                            {{ $errors->has('name') ? ' form-control-danger'
                                        : '' }}" id="name" name="name" required> @if ($errors->has('name'))

                                <div class="col-md-12 form-control-feedback">{{ $errors->first('name') }}</div>
                                @endif

                            </div>
                        </div>


                        <div class="col-md-12">

                            <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                                <input placeholder="{{ __('Email de contacto') }}" type="email " name="email" id="email" class="form-control form-control-line {{ $errors->has('email') ? ' form-control-danger' : '' }}">{{
                                ((old( 'email')) ? old( 'email') : $request->email ) }} @if ($errors->has('email'))

                                <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                                @endif

                            </div>
                        </div>

                        <div class="col-md-12">

                            <div class="form-group {{ $errors->has('phone') ? ' has-danger' : '' }}">
                                <input placeholder="{{ __('Teléfono') }}" type="text " name="phone" id="phone" class="form-control form-control-line {{ $errors->has('phone') ? ' form-control-danger' : '' }}"
                                    maxlength="9">{{ ((old( 'phone')) ? old( 'phone') : $request->phone
                                ) }} @if ($errors->has('phone'))

                                <div class="form-control-feedback">{{ $errors->first('phone') }}</div>
                                @endif

                            </div>
                        </div>
                    </div>


                    <div class="row py-4">

                        <div class="col-md-12 ">

                            <div class="form-group">
                                <button class="btn-invest bg-transparent text-uppercase verde">{{ __('Enviar') }}</button>

                            </div>
                        </div>
                    </div>
                </form>
                @endif
            </div>


        </div>
    </div>


</div>
@endsection
 
@section('scripts')
@endsection