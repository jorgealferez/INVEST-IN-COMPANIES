@if ($isAdmin ||
(empty($request) && ($isGestor||$isAsesor))
|| ($request->route()->getActionMethod() != "show") && ($isGestor||$isAsesor)
)

<div class="row">

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('cif') ? ' has-danger' : '' }}">
            <label for="cif">{{ __('Cif') }}(*)</label>
            <input type="text" value="{{ ((old( 'cif')) ? old( 'cif') : $oferta->cif ) }}" class="form-control form-control-line {{ $errors->has('cif') ? ' form-control-danger' : '' }}" id="cif" name="cif" required maxlength="9"> @if ($errors->has('cif'))

            <div class="form-control-feedback">{{ $errors->first('cif') }}</div>
            @endif

        </div>
    </div>


    <div class="col-md-6 text-right">

        <div class="form-group {{ $errors->has('año') ? ' has-danger' : '' }}">
            <label for="año">{{ __('Año de constitución') }}</label>
            <input type="number" value="{{ ((old( 'año')) ? old( 'año') : $oferta->año ) }}" class=" text-right form-control form-control-line {{ $errors->has('año') ? ' form-control-danger' : '' }}" id="año" name="año" maxlength="4"> @if ($errors->has('año'))

            <div class="form-control-feedback">{{ $errors->first('año') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('forma_id') ? ' has-danger' : '' }}">
            <label for="forma_id">{{ __('Forma Jurídica') }}(*)</label>
            <select name="forma_id" id="forma_id" class="form-control form-control-line {{ $errors->has('forma_id') ? ' form-control-danger' : '' }}" required>
                <option value="">{{ __('Selecciona forma') }}</option>
                @foreach ($formasJuridicas as $formaJuridica)
                @if (old('forma_id'))
                <option value="{{ $formaJuridica->id }}" @if (old('forma_id')==$formaJuridica->id ) selected @endif class="">
                    {{$formaJuridica->name }}
                </option>
                @else
                <option value="{{ $formaJuridica->id }}" @if (!is_null ($oferta->forma_id) && $oferta->forma_id== $formaJuridica->id) selected @endif class="">
                    {{$formaJuridica->name }}
                </option>
                @endif
                @endforeach
            </select> @if ($errors->has('forma_id'))

            <div class="form-control-feedback">{{ $errors->first('forma_id') }}</div>
            @endif
        </div>
    </div>
</div>

<hr>
@endif

<div class="row">

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('socios') ? ' has-danger' : '' }}">
            <label for="socios">{{ __('Socios') }}(*)</label>
            <input type="number" value="{{ ((old( 'socios')) ? old( 'socios') : $oferta->socios ) }}" class="form-control form-control-line {{ $errors->has('socios') ? ' form-control-danger' : '' }}" id="socios" name="socios" required> @if ($errors->has('socios'))

            <div class="form-control-feedback">{{ $errors->first('socios') }}</div>
            @endif

        </div>
    </div>


    <div class="col-md-6">

        <div class="form-group {{ $errors->has('empleados') ? ' has-danger' : '' }}">
            <label for="empleados">{{ __('Empleados') }}</label>
            <input type="number" value="{{ ((old( 'empleados')) ? old( 'empleados') : $oferta->empleados ) }}" class="form-control form-control-line {{ $errors->has('empleados') ? ' form-control-danger' : '' }}" id="empleados" name="empleados"> @if ($errors->has('empleados'))

            <div class="form-control-feedback">{{ $errors->first('empleados') }}</div>
            @endif

        </div>
    </div>
</div>

<hr>

<div class="row">

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('motivo') ? ' has-danger' : '' }}">
            <label for="motivo">{{ __('Motivo de la venta') }}(*)</label>

            <textarea name="motivo" id="motivo" class="form-control form-control-line {{ $errors->has('motivo') ? ' form-control-danger' : '' }}" rows="5" required>{{ ((old( 'motivo')) ? old( 'motivo') : $oferta->motivo ) }}</textarea> @if ($errors->has('motivo'))

            <div class="form-control-feedback">{{ $errors->first('motivo') }}</div>
            @endif
        </div>
    </div>

</div>


<div class="row">

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('sector_id') ? ' has-danger' : '' }}">
            <label for="sector_id">{{ __('Sector') }}</label>

            <select name="sector_id" id="sector_id" class="form-control form-control-line {{ $errors->has('sector_id') ? ' form-control-danger' : '' }}">
                <option value="">{{ __('Selecciona sector') }}</option>
                @foreach ($sectores as $sector)
                @if ( old('sector_id') )
                <option value="{{ $sector->id }}" @if ( old('sector_id')==$sector->id )
                    selected @endif class="">
                    {{$sector->name }}
                </option>
                @else
                <option value="{{ $sector->id }}" @if ( !is_null ($oferta->sector_id) && $oferta->sector_id== $sector->id)
                    selected @endif class="">
                    {{$sector->name }}
                </option>
                @endif
                @endforeach
            </select> @if ($errors->has('sector_id'))

            <div class="form-control-feedback">{{ $errors->first('sector_id') }}</div>
            @endif
        </div>
    </div>


    <div class="col-md-12 ">

        <div class="form-group">
            <label for="local">{{ __('Local propio') }}</label>

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

<hr>

<div class="row">

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('address') ? ' has-danger' : '' }}">
            <label for="address">{{ __('Dirección') }}</label>
            <input type="text" value="{{ ((old( 'address')) ? old( 'address') : $oferta->address ) }}" class="form-control form-control-line {{ $errors->has('address') ? ' form-control-danger' : '' }}" id="address" name="address"> @if ($errors->has('address'))

            <div class="form-control-feedback">{{ $errors->first('address') }}</div>
            @endif

        </div>
    </div>
</div>

<div class="row">


    <div class="col-md-6">

        <div class="form-group {{ $errors->has('provincia_id') ? ' has-danger' : '' }}">
            <label for="provincia_id">{{ __('Provincia') }}(*)</label>

            <select name="provincia_id" id="provincia_id" class="form-control form-control-line {{ $errors->has('provincia_id') ? ' form-control-danger' : '' }}" required>
                <option value="">{{ __('Selecciona provincia') }}</option>
                @foreach ($provincias as $provincia)
                @if (old('provincia_id'))
                <option value="{{ $provincia->id }}" @if ( old('provincia_id')==$provincia->id ) selected @endif >
                    {{$provincia->name }}
                </option>
                @else
                <option value="{{ $provincia->id }}" @if ( !is_null ($oferta->provincia_id) && $oferta->provincia_id== $provincia->id) selected @endif >
                    {{$provincia->name }}
                </option>
                @endif
                @endforeach
            </select> @if ($errors->has('provincia_id'))

            <div class="form-control-feedback">{{ $errors->first('provincia_id') }}</div>
            @endif
        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('poblacion_id') ? ' has-danger' : '' }}">
            <label for="poblacion_id">{{ __('Población') }}(*)</label>

            <select name="poblacion_id" id="poblacion_id" class="form-control form-control-line {{ $errors->has('poblacion_id') ? ' form-control-danger' : '' }}" required>
                <option value="">{{ __('Selecciona poblacion') }}</option>

                @if (!$poblaciones->isEmpty() )
                @foreach ($poblaciones as $poblacion)
                @if (old('poblacion_id'))
                <option value="{{ $poblacion->id }}" @if (old('poblacion_id')==$poblacion->id ) selected @endif >
                    {{$poblacion->name }}
                </option>
                @else
                <option value="{{ $poblacion->id }}" @if ( !is_null ($oferta->poblacion_id) && $oferta->poblacion_id== $poblacion->id) selected @endif >
                    {{$poblacion->name }}
                </option>
                @endif
                @endforeach
                @endif
            </select> @if ($errors->has('poblacion_id'))

            <div class="form-control-feedback">{{ $errors->first('poblacion_id') }}</div>
            @endif
        </div>
    </div>
</div>

<hr>

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
                <input type="url" value="{{ ((old( 'web')) ? old( 'web') : $oferta->web ) }}" class="form-control form-control-line {{ $errors->has('web') ? ' form-control-danger' : '' }}" id="web" name="web">
            </div>
            @if ($errors->has('web'))

            <div class="form-control-feedback">{{ $errors->first('web') }}</div>
            @endif

        </div>
    </div>
</div>


<hr>

<div class="row">

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('valoracion') ? ' has-danger' : '' }}">
            <label for="valoracion">{{ __('Valoración de la compañía') }}(*)</label>

            <div class="input-group">
                <input type="number" value="{{ (old( 'valoracion')) ?  old( 'valoracion') : $oferta->valoracion  }}" class="form-control form-control-line {{ $errors->has('valoracion') ? ' form-control-danger' : '' }}" id="valoracion" name="valoracion" required>

                <div class="input-group-append">
                    <span class="input-group-text">€</span>
                </div>
            </div>
            @if ($errors->has('valoracion'))

            <div class="form-control-feedback">{{ $errors->first('valoracion') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('endeudamiento') ? ' has-danger' : '' }}">
            <label for="endeudamiento">{{ __('Endeudamiento') }}</label>

            <div class="input-group">
                <input type="number" value="{{ ((old( 'endeudamiento')) ? old( 'endeudamiento') : $oferta->endeudamiento ) }}" class="form-control form-control-line
                    {{ $errors->has('endeudamiento') ? ' form-control-danger' : '' }}" id="endeudamiento" name="endeudamiento">

                <div class="input-group-append">
                    <span class="input-group-text">€</span>
                </div>
            </div>
            @if ($errors->has('endeudamiento'))

            <div class="form-control-feedback">{{ $errors->first('endeudamiento') }}</div>
            @endif

        </div>
    </div>
</div>

<hr>
