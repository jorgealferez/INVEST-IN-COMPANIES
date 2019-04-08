@if($isAdmin)

<div class="row">

	<div class="col-md-12">

		<div class="form-group {{ $errors->has('asociacion_id') ? ' has-danger' : '' }}">
			<label for="asociacion_id"><i class="mdi mdi-security-home"></i> {{ __('Entidad') }}</label>
			<select name="asociacion_id" id="asociacion_id" class="form-control form-control-line {{ $errors->has('asociacion_id') ? ' form-control-danger' : '' }}"
			 required>
                <option value="">{{ __('Seleciona entidad') }}</option>
                @foreach ($asociacionesDisponibles as $asociacion)
                @if ( old('asociacion_id'))
                <option value="{{ $asociacion->id }}" @if ( old('asociacion_id')==$asociacion->id) selected @endif >
                    {{$asociacion->name }}
                </option>
                @else
                <option value="{{ $asociacion->id }}" @if (!empty($oferta->asociacion) && (!empty($oferta->asociacion)) && $asociacion->id==$oferta->asociacion()->first()->id)) selected @endif >
                    {{$asociacion->name }}
                </option>
                @endif
                @endforeach
            </select>
		</div>
	</div>


	<div class="col-md-12">

		<div class="form-group {{ $errors->has('user_id') ? ' has-danger' : '' }}">
			<label for="user_id"><i class="mdi mdi-account-multiple"></i> {{ __('Gestor') }}</label>
			<select name="user_id" id="user_id" class="form-control form-control-line {{ $errors->has('user_id') ? ' form-control-danger' : '' }}"
			 required @if (!$usuariosAsociacion){{ e( 'disabled' ) }} @endif>
                @if ($usuariosAsociacion)
                {{-- && !Request::is('dashboard/ofertas/crear')) --}}
                @foreach ($usuariosAsociacion as $usuarioAsociacion)
                @if ( old('user_id'))
                <option value="{{ $usuarioAsociacion->id }}" @if ( old('user_id')==$usuarioAsociacion->id) selected @endif >
                    {{$usuarioAsociacion->name }}
                </option>
                @else
                <option value="{{ $usuarioAsociacion->id }}" @if ( !empty($usuariosAsociacion) && $usuarioAsociacion->id==$oferta->user_id) selected @endif >
                    {{$usuarioAsociacion->name }}
                </option>
                @endif
                @endforeach
                @endif
            </select>
		</div>
	</div>
</div>
@endif @if($isAsesor)

<div class="row">

	<div class="col-md-12">

		<div class="form-group {{ $errors->has('user_id') ? ' has-danger' : '' }}">
			<label for="user_id" class="col-md-12 col-form-label ">{{ __('Gestor') }}</label>

			<select name="user_id" id="user_id" class="form-control form-control-line {{ $errors->has('user_id') ? ' form-control-danger' : '' }}"
			 required>
                <option value="">{{ __('Seleciona usuario') }}</option>
                @foreach ($usuariosAsociacion as $usuarioAsociacion)
                @if ( old('user_id'))
                <option value="{{ $usuarioAsociacion->id }}" @if ( old('user_id')==$usuarioAsociacion->id) selected @endif class="">
                    {{$usuarioAsociacion->name }}
                </option>
                @else
                <option value="{{ $usuarioAsociacion->id }}" @if ( !is_null ($oferta->user_id) && $oferta->user_id== $usuarioAsociacion->id) selected @endif class="">
                    {{$usuarioAsociacion->name }}
                </option>
                @endif
                @endforeach
            </select>
		</div>
	</div>
</div>
@endif