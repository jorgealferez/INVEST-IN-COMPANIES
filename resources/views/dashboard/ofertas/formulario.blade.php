@if(Auth::user()->hasRole(['Admin']))
<h3 class="card-title">{{ __('Usuario') }}</h3>
<hr>

<div class="row">

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('asociacion_id') ? ' has-danger' : '' }}">
            <label for="asociacion_id" class="col-md-12 col-form-label ">{{ __('Asociación') }}</label>
            <select name="asociacion_id" id="asociacion_id" class="form-control form-control-line {{ $errors->has('asociacion_id') ? ' form-control-danger' : '' }}" required>
                <option value="">{{ __('Seleciona asociación') }}</option>
                @foreach ($asociacionesDisponibles as $asociacion)
                <option value="{{ $asociacion->id }}" @if ( old('asociacion_id')==$asociacion->id || (!empty($oferta) && $asociacion->id==$oferta->asociacion()->first()->id))
                    selected
                    @endif
                    class="">{{$asociacion->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('usuario') ? ' has-danger' : '' }}">
            <label for="user_id" class="col-md-12 col-form-label ">{{ __('Gestor') }}</label>
            <select name="user_id" id="user_id" class="form-control form-control-line {{ $errors->has('user_id') ? ' form-control-danger' : '' }}" required @if (!$usuariosAsociacion){{ e( 'disabled' ) }} @endif>
                @if ($usuariosAsociacion)
                {{-- && !Request::is('dashboard/ofertas/crear')) --}}
                @foreach ($usuariosAsociacion as $usuarioAsociacion)
                <option value="{{ $usuarioAsociacion->id }}" @if ( old('user_id')==$usuarioAsociacion->id || (!empty($oferta) && $usuarioAsociacion->id==$oferta->usuario->id))
                    selected
                    @endif class="">{{$usuarioAsociacion->name }} </option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
@endif @if(Auth::user()->hasRole(['Asesor']))
<h3 class="card-title">{{ __('Gestión de la oferta') }}</h3>
<hr>

<div class="row">

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('user_id') ? ' has-danger' : '' }}">
            <label for="user_id" class="col-md-12 col-form-label ">{{ __('Gestor') }}</label>

            <select name="user_id" id="user_id" class="form-control form-control-line {{ $errors->has('user_id') ? ' form-control-danger' : '' }}" required>
                <option value="">{{ __('Seleciona usuario') }}</option>
                @foreach ($usuariosAsociacion as $usuarioAsociacion)
                <option value="{{ $usuarioAsociacion->id }}" @if ( old('asociacion_id')==$usuarioAsociacion->id || (!empty($oferta) && $usuarioAsociacion->id==$oferta->usuario->id))
                    selected
                    @endif class="">{{$usuarioAsociacion->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
@endif
<h3 class="card-title m-t-40">{{ __('Empresa') }}</h3>
<hr>

<div class="row">

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
            <label for="name">{{ __('Nombre') }}</label>
            <input type="text " value="{{ (isset($oferta)) ?  $oferta->name : (old( 'name')) }}" class="form-control form-control-line
                {{ $errors->has('name') ? ' form-control-danger'
            : '' }}" id="name" name="name" required> @if ($errors->has('name'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('name') }}</div>
            @endif

        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('cif') ? ' has-danger' : '' }}">
            <label for="cif">{{ __('Cif') }}</label>
            <input type="text" value="{{ (isset($oferta)) ?  $oferta->cif : (old( 'cif')) }}" class="form-control form-control-line {{ $errors->has('cif') ? ' form-control-danger' : '' }}" id="cif" name="cif" required maxlength="9"> @if ($errors->has('cif'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('cif') }}</div>
            @endif

        </div>
    </div>

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('forma_id') ? ' has-danger' : '' }}">
            <label for="forma_id">{{ __('Forma Jurídica') }}</label>

            <select name="forma_id" id="forma_id" class="form-control form-control-line {{ $errors->has('forma_id') ? ' form-control-danger' : '' }}">
                <option value="">{{ __('Selecciona forma') }}</option>
                @foreach ($formasJuridicas as $formaJuridica)
                <option value="{{ $formaJuridica->id }}" @if ( old('forma_id')==$formaJuridica->id || (!empty($oferta) && $oferta->forma_id==$formaJuridica->id))
                    selected
                    @endif class="">{{$formaJuridica->name }}</option>
                @endforeach
            </select> @if ($errors->has('forma_id'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('forma_id') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-4">

        <div class="form-group {{ $errors->has('socios') ? ' has-danger' : '' }}">
            <label for="socios">{{ __('Socios') }}</label>
            <input type="text" value="{{ (isset($oferta)) ?  $oferta->socios : (old( 'socios')) }}" class="form-control form-control-line {{ $errors->has('socios') ? ' form-control-danger' : '' }}" id="socios" name="socios"> @if ($errors->has('socios'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('socios') }}</div>
            @endif

        </div>
    </div>


    <div class="col-md-4">

        <div class="form-group {{ $errors->has('empleados') ? ' has-danger' : '' }}">
            <label for="empleados">{{ __('Nº Empleados') }}</label>
            <input type="text" value="{{ (isset($oferta)) ?  $oferta->empleados : (old( 'empleados')) }} " class="form-control form-control-line {{ $errors->has('empleados') ? ' form-control-danger' : '' }}" id="empleados" name="empleados"> @if ($errors->has('empleados'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('empleados') }}</div>
            @endif

        </div>
    </div>

    <div class="col-md-4">

        <div class="form-group {{ $errors->has('año') ? ' has-danger' : '' }}">
            <label for="año">{{ __('Año de constitucion') }}</label>
            <input type="text" value="{{ (isset($oferta)) ?  $oferta->año : (old( 'año')) }} " class="form-control form-control-line {{ $errors->has('año') ? ' form-control-danger' : '' }}" id="año" name="año"> @if ($errors->has('año'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('año') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('motivo') ? ' has-danger' : '' }}">
            <label for="motivo">{{ __('Motivo de la venta') }}</label>

            <textarea name="motivo" id="motivo" class="form-control form-control-line {{ $errors->has('motivo') ? ' form-control-danger' : '' }}" rows="5">{{ (isset($oferta)) ?  $oferta->motivo : (old( 'motivo')) }} </textarea> @if ($errors->has('motivo'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('motivo') }}</div>
            @endif
        </div>
    </div>

</div>



<div class="row">

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('sector_id') ? ' has-danger' : '' }}">
            <label for="sector_id">{{ __('Sector') }}</label>

            <select name="sector_id" id="sector_id" class="form-control form-control-line {{ $errors->has('sector_id') ? ' form-control-danger' : '' }}">
                <option value="">{{ __('Selecciona sector') }}</option>
                @foreach ($sectores as $sector)
                <option value="{{ $sector->id }}" @if ( old('sector_id')==$sector->id || (!empty($oferta) && $oferta->sector_id==$sector->id))
                    selected
                    @endif >{{$sector->name }}</option>
                @endforeach
            </select> @if ($errors->has('sector_id'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('sector_id') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-4">

        <div class="form-group {{ $errors->has('valoracion') ? ' has-danger' : '' }}">
            <label for="valoracion">{{ __('Valoracion') }}</label>
            <input type="text" value="{{ (isset($oferta)) ?  $oferta->valoracion : (old( 'valoracion')) }} " class="form-control form-control-line {{ $errors->has('valoracion') ? ' form-control-danger' : '' }}" id="valoracion" name="valoracion"> @if ($errors->has('valoracion'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('valoracion') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-2">

        <div class="form-group">
            <label for="local">{{ __('Local') }}</label>

            <div class="switch">
                <label>
                    <input type="checkbox" @if ( old('local') || (!empty($oferta) && $oferta->local==1))
                    checked
                    @endif
                    id="local" name="local" value="1">
                    <span class="lever switch-col-grey"></span>
                </label>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('address') ? ' has-danger' : '' }}">
            <label for="address">{{ __('Dirección') }}</label>
            <input type="text" value="{{ (isset($oferta)) ?  $oferta->address : (old( 'address')) }} " class="form-control form-control-line {{ $errors->has('address') ? ' form-control-danger' : '' }}" id="address" name="address"> @if ($errors->has('address'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('address') }}</div>
            @endif

        </div>
    </div>
</div>

<div class="row">


    <div class="col-md-6">

        <div class="form-group {{ $errors->has('provincia_id') ? ' has-danger' : '' }}">
            <label for="provincia_id">{{ __('Provincia') }}</label>

            <select name="provincia_id" id="provincia_id" class="form-control form-control-line {{ $errors->has('provincia_id') ? ' form-control-danger' : '' }}" required>
                <option value="">{{ __('Selecciona provincia') }}</option>
                @foreach ($provincias as $provincia)
                <option value="{{ $provincia->id }}" @if ( old('provincia_id')==$provincia->id || (!empty($oferta) && $oferta->provincia_id == $provincia->id ))
                    selected
                    @endif >{{$provincia->name }}</option>
                @endforeach
            </select> @if ($errors->has('provincia_id'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('provincia_id') }}</div>
            @endif
        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('poblacion_id') ? ' has-danger' : '' }}">
            <label for="poblacion_id">{{ __('Población') }}</label>

            <select name="poblacion_id" id="poblacion_id" class="form-control form-control-line {{ $errors->has('poblacion_id') ? ' form-control-danger' : '' }}" required>
                <option value="">{{ __('Selecciona poblacion') }}</option>

            </select> @if ($errors->has('poblacion_id'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('poblacion_id') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('web') ? ' has-danger' : '' }}">
            <label for="web">{{ __('Página Web') }}</label>

            <div class="input-group">

                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="ti-world"></i>
                    </span>
                </div>
                <input type="text" value="{{ (isset($oferta)) ?  $oferta->web : (old( 'web')) }} " class="form-control form-control-line {{ $errors->has('web') ? ' form-control-danger' : '' }}" id="web" name="web">
            </div>
            @if ($errors->has('web'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('web') }}</div>
            @endif

        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-4">

        <div class="form-group {{ $errors->has(['explotacion1','explotacion2','explotacion3']) ? ' has-danger' : '' }}">
            <label class="form-control-label" for="explotacion1">{{ __('explotacion1') }}</label>
            <input type="text" value="{{ (isset($oferta)) ?  $oferta->explotacion1 : (old( 'explotacion1')) }}" class="form-control form-control-line {{ $errors->has('explotacion1') ? ' form-control-danger' : '' }}" id="explotacion1" name="explotacion1">
        </div>
    </div>

    <div class="col-md-4">

        <div class="form-group {{ $errors->has(['explotacion1','explotacion2','explotacion3']) ? ' has-danger' : '' }}">
            <label class="form-control-label" for="explotacion2">{{ __('explotacion2') }}</label>
            <input type="text" value="{{ (isset($oferta)) ?  $oferta->explotacion2 : (old( 'explotacion2')) }}" class="form-control form-control-line {{ $errors->has('explotacion2') ? ' form-control-danger' : '' }}" id="explotacion2" name="explotacion2">
        </div>
    </div>

    <div class="col-md-4">

        <div class="form-group {{ $errors->has(['explotacion1','explotacion2','explotacion3']) ? ' has-danger' : '' }}">
            <label class="form-control-label" for="explotacion3">{{ __('explotacion3') }}</label>
            <input type="text" value="{{ (isset($oferta)) ?  $oferta->explotacion3 : (old( 'explotacion3')) }}" class="form-control form-control-line {{ $errors->has('explotacion3') ? ' form-control-danger' : '' }}" id="explotacion3" name="explotacion3">
        </div>
    </div>

    @if ($errors->has(['explotacion1','explotacion2','explotacion3']))

    <div class="col-md-12 form-control-feedback">{{ $errors->first('explotacion1') }}</div>
    @endif

</div>

<div class="row">

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('endeudamiento') ? ' has-danger' : '' }}">
            <label for="endeudamiento">{{ __('Endeudamiento') }}</label>

            <div class="input-group">
                <input type="text" value="{{ (isset($oferta)) ?  $oferta->endeudamiento : (old( 'endeudamiento')) }}" class="form-control form-control-line
                {{ $errors->has('endeudamiento') ? ' form-control-danger' : '' }}" id="endeudamiento" name="endeudamiento">

                <div class="input-group-append">
                    <span class="input-group-text">€</span>
                </div>
            </div>
            @if ($errors->has('endeudamiento'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('endeudamiento') }}</div>
            @endif

        </div>
    </div>
</div>


<h3 class="card-title m-t-40">{{ __('Información de contacto') }}</h3>
<hr>

<div class="row">

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('contact') ? ' has-danger' : '' }}">
            <label for="contact">{{ __('Nombre') }}</label>

            <div class="input-group">

                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="ti-user"></i>
                    </span>
                </div>
                <input type="text" value="{{ (isset($oferta)) ?  $oferta->contact : (old( 'contact')) }}" class="form-control form-control-line {{ $errors->has('contact') ? ' form-control-danger' : '' }}" id="contact" name="contact">
            </div>
            @if ($errors->has('contact'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('contact') }}</div>
            @endif

        </div>
    </div>

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('contactSurname') ? ' has-danger' : '' }}">
            <label for="contactSurname">{{ __('Apellidos') }}</label>

            <div class="input-group">

                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="ti-user"></i>
                    </span>
                </div>
                <input type="text" value="{{ (isset($oferta)) ?  $oferta->contactSurname : (old( 'contactSurname')) }}" class="form-control form-control-line {{ $errors->has('contactSurname') ? ' form-control-danger' : '' }}" id="contactSurname" name="contactSurname">
            </div>
            @if ($errors->has('contactSurname'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('contactSurname') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('contactEmail') ? ' has-danger' : '' }}">
            <label for="contactEmail">{{ __('Email') }}</label>

            <div class="input-group">

                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="ti-email"></i>
                    </span>
                </div>
                <input type="text" value="{{ (isset($oferta)) ?  $oferta->contactEmail : (old( 'contactEmail')) }}" class="form-control form-control-line {{ $errors->has('contactEmail') ? ' form-control-danger' : '' }}" id="contactEmail" name="contactEmail">
            </div>
            @if($errors->has('contactEmail'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('contactEmail') }}</div>
            @endif

        </div>
    </div>

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('contactPhone') ? ' has-danger' : '' }}">
            <label for="contactPhone">{{ __('Teléfono') }}</label>

            <div class="input-group">

                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="ti-mobile"></i>
                    </span>
                </div>
                <input type="text" value="{{ (isset($oferta)) ?  $oferta->contactPhone : (old( 'contactPhone')) }}" class="form-control form-control-line
                {{ $errors->has('contactPhone') ? ' form-control-danger' : '' }}" id="contactPhone" name="contactPhone">
            </div>
            @if($errors->has('phone'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('phone') }}</div>
            @endif

        </div>
    </div>
</div>
