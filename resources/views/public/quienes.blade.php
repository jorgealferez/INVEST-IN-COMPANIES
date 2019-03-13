@extends('layouts.public')
@section('contenido')


<div class="container my-5">

    <div class="row">

        <div class="col-md-12  text-center p-5">
            <h2 class="text-uppercase">{{ __('¿Quiénes somos?') }}</h2>
        </div>
    </div>

    <div class="row   text-justify">

        <div class="col-md-12">
            <h4 class="mb-5">La Confederación Española de la Pequeña y Mediana Empresa (CEPYME) es una organización profesional de carácter
                confederativo e intersectorial, de ámbito nacional, para la defensa, representación y fomento de los intereses
                de la pequeña y mediana empresa y del empresario autónomo. CEPYME está reconocida como organización empresarial
                más representativa en el ámbito estatal.</h4>
            <p>Entre sus funciones se encuentran la atención a las necesidades de información, asesoramiento, asistencia técnica,
                investigación y perfeccionamiento de las organizaciones, empresas y empresarios afiliados, estudiando y divulgando
                cuantos temas puedan afectar a la potenciación de la pequeña y mediana empresa y del empresario autónomo,
                en el marco de las funciones y competencias señaladas en el artículo séptimo de la Constitución Española.
            </p>


        </div>

    </div>


    <div class="row text-justify mt-5">


        <div class="col-md-6 mx-auto">

            <div class="row">

                <div class="col-md-12 mx-auto">
                    <img src="images/titulo_organigrama.png" class="img-fluid">
                </div>

                <div class="col-md-2 col-xs-1">
                    <a href="/consultoria-cc-y-retail">
                        <img src="images/pgs_comunicacion.png" class="img-fluid" alt="PGS Comunicación">
                    </a>
                </div>

                <div class="col-md-2 col-xs-1">
                    <a href="/fusiones-y-adquisiciones">
                        <img src="images/pgs_consultoria.png" class="img-fluid" alt="PGS Consultoría e Inversión">
                    </a>
                </div>

                <div class="col-md-2 col-xs-2">
                    <a href="/inversion-inmobiliaria">
                        <img src="images/pgs_inmo_invest_03.png" class="img-fluid" alt="PGS Inmo Invest">
                    </a>
                </div>

                <div class="col-md-2 col-xs-2">
                    <a href="/corporate-finance">
                        <img src="images/pgs_finance_03.png" class="img-fluid" alt="PGS Finance">
                    </a>
                </div>

                <div class="col-md-2 col-xs-2">
                    <a href="/consultoria-franquicias">
                        <img src="images/pgs_franquicias_03.png" class="img-fluid" alt="PGS Franquicias">
                    </a>
                </div>

                <div class="col-md-2 col-xs-2">
                    <a href="/corporate-finance">
                        <img src="images/pgs_asesoria_contable.png" class="img-fluid" alt="PGS Asesoría Contable">
                    </a>
                </div>

            </div>
        </div>

        <div class="col-md-6 ">
            <p><strong>Grupo PGS</strong> es una consultora estratégica especializada con más de 10 años de experiencia que se involucra con
                los intereses de sus clientes para aumentar el valor de su proyecto, a través del diseño de estrategias personalizadas
                y el asesoramiento necesario para ejecutarlas adecuadamente. </p>
            <p>Se trata de una compañía líder en valoración
                de empresas, preparación para la venta y/o búsqueda de inversión, consultoría de franquicias, consultoría
                de inversión en la compraventa inmobiliaria, intermediación financiera a pymes y particulares, consultoría
                estratégica a grandes superficies comerciales y consultoría para la atracción de inversión en ciudades. </pp>
        </div>
    </div>

    <div class="row text-justify mb-5">


    </div>


</div>
@endsection

@section('scripts')
@endsection
