@extends('layouts.dashboard')


@section('estilos')
@endsection


@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            
            @if (session()->has('success'))
            <div class="row"> 
                <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        {{ __('Los cambios se han guardado correctamente') }}
                </div>
            </div>
            @endif
          
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30"> <span class="round {{ $usuario->getRoleClass() }} roleBig">{{ $usuario->roles->first()->name }}</span>
                        <h4 class="card-title m-t-10">{{ e($usuario->name." ".$usuario->surname) }}</h4>
                    </center>
                </div>
                
                    <hr>
                <div class="card-body">
                    <form method="POST" class="form-control-line form-material" action="{{ action('dashboard\UsuariosController@profileUpdate',['id' => $usuario->id])}}">
                        @csrf
                        @method('POST')
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

{{-- <script src="{{ asset('js/dashboard/plugins/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('js/dashboard/plugins/switchery/dist/switchery.min.js') }}"></script>
<script src="{{ asset('js/dashboard/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dashboard/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('js/dashboard/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dashboard/plugins/dff/dff.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('js/dashboard/plugins/multiselect/js/jquery.multi-select.js') }}"></script> --}}



<script>
$(function() {
        // For select 2
        $(".select2").select2();

        // $('.selectpicker').selectpicker();
    });
</script>
@endsection
