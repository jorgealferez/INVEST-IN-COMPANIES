@extends('layouts.dashboard')
@section('estilos')
@endsection

@section('content')

<div class="container-fluid">

    @include('dashboard.alertas')

    <div class="row">

        <div class="col-lg-4 col-xlg-3 col-md-5">



            <div class="card card-profile">

                <div class="card-body text-center  bg-gray">
                    <span class="round {{ $usuario->getRoleClass() }} roleBig profile-rol">{{ $usuario->roles->first()->name }}</span>
                </div>

                <div class="card-body pro-img text-center pt-5">
                    <h4 class="card-title m-t-10">{{ e($usuario->name." ".$usuario->surname) }}</h4>
                    @if ($usuario->asociaciones)
                    <small class="text-muted">
                    </small> @foreach ($usuario->asociaciones as $asociacion)
                    <h6 class="card-subtitle">{{ e($asociacion->name)}}</h6>
                    @endforeach
                    @endif
                </div>

                <hr class="m-0">

                <div class="card-body ">
                    <small class="text-muted"><i class="ti-email"></i> {{ __('Email') }}</small>
                    <a href="mailto:{{ e($usuario->email) }}" class="link text-muted">
                        <h6>{{ e($usuario->email) }}</h6>
                    </a>
                    <small class="text-muted"><i class="ti-mobile"></i> {{ __('Teléfono') }}</small>
                    <h6>{{ e($usuario->phone) }}</h6>

                    <div class="row ">

                        <div class="col-md-12 ">

                        </div>

                        <div class="col-md-12">

                        </div>
                    </div>

                </div>
            </div>
        </div>

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

                        <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label class="col-md-12 form-control-label" for="error">{{ __('Nombre') }}</label>

                            <div class="col-md-12">
                                <input type="text" value="{{ old('name')?old('name'): e($usuario->name) }}" placeholder="{{ e($usuario->name) }}" class="form-control form-control-line {{ $errors->has('name') ? ' form-control-danger' : '' }}" id="name" name="name" required>
                            </div>
                            @if ($errors->has('name'))

                            <div class="col-md-12 form-control-feedback">{{ $errors->first('name') }}</div>
                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('surname') ? ' has-danger' : '' }}">
                            <label class="col-md-12 form-control-label" for="error">{{ __('Apellidos') }}</label>

                            <div class="col-md-12">
                                <input type="text" value="{{ old('surname')?old('surname'): e($usuario->surname) }}" placeholder="{{ e($usuario->surname) }}" class="form-control form-control-line {{ $errors->has('surname') ? ' form-control-danger' : '' }}" id="surname" name="surname" required>
                            </div>
                            @if ($errors->has('surname'))

                            <div class="col-md-12 form-control-feedback">{{ $errors->first('surname') }}</div>
                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label class="col-md-12 form-control-label" for="error">{{ __('Email') }}</label>

                            <div class="col-md-12">
                                <input type="text" value="{{ old('email')?old('email'): e($usuario->email) }}" placeholder="{{ e($usuario->email) }}" class="form-control form-control-line {{ $errors->has('email') ? ' form-control-danger' : '' }}" id="email" name="email" required>
                            </div>
                            @if ($errors->has('email'))

                            <div class="col-md-12 form-control-feedback">{{ $errors->first('email') }}</div>
                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('phone') ? ' has-danger' : '' }}">
                            <label class="col-md-12 form-control-label" for="error">{{ __('Teléfono') }}</label>

                            <div class="col-md-12">
                                <input type="text" value="{{ old('phone')?old('phone'): e($usuario->phone) }}" placeholder="{{ e($usuario->phone) }}" class="form-control form-control-line {{ $errors->has('phone') ? ' form-control-danger' : '' }}" id="phone" name="phone" required>
                            </div>
                            @if ($errors->has('phone'))

                            <div class="col-md-12 form-control-feedback">{{ $errors->first('phone') }}</div>
                            @endif

                        </div>

                        <div class="form-group">

                            <div class="col-sm-12">
                                <button class="btn btn-success">{{ __('Actualizar') }}</button>
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
