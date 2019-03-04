@extends('layouts.dashboard')
@section('estilos')
@endsection

@section('content')

<div class="container-fluid">

    @include('dashboard.alertas')

    <div class="row">


        @include('dashboard.usuarios.tarjeta')

        <div class="col-lg-8 col-xlg-9 col-md-7">

            <div class="card">

                <div class="card-body">


                    <h4 class="card-title mb-0 title-section">
                        <i class="mdi mdi-account-multiple"></i>
                        {{ __('Modificar mis datos') }}
                    </h4>

                </div>
                <hr class="mt-0">

                <div class="card-body">

                    <form method="POST" class="form-control-line form-material" action="{{ action('Dashboard\UsuariosController@profileUpdate',['id' => $usuario->id])}}">
                        @csrf @method('POST')


                        @include('dashboard.usuarios.formulario')

                        <div class="form-group">

                            <div class="col-sm-12">
                                <button class="btn btn-verde  waves-effect waves-light">{{ __('Actualizar') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

</div>
@endsection

@section('scripts')


@endsection
