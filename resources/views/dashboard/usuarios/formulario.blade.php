<div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
    <label class="col-md-12 form-control-label" for="error">{{ __('Nombre') }}</label>

    <div class="col-md-12">
        <input type="text" value="{{ old('name')?old('name'): e($usuario->name) }}" placeholder="{{ e($usuario->name) }}" class="form-control form-control-line {{ $errors->has('name') ? ' form-control-danger' : '' }}"
            id="name" name="name" required>
    </div>
    @if ($errors->has('name'))

    <div class="col-md-12 form-control-feedback">{{ $errors->first('name') }}</div>
    @endif

</div>

<div class="form-group {{ $errors->has('surname') ? ' has-danger' : '' }}">
    <label class="col-md-12 form-control-label" for="error">{{ __('Apellidos') }}</label>

    <div class="col-md-12">
        <input type="text" value="{{ old('surname')?old('surname'): e($usuario->surname) }}" placeholder="{{ e($usuario->surname) }}"
            class="form-control form-control-line {{ $errors->has('surname') ? ' form-control-danger' : '' }}" id="surname" name="surname"
            required>
    </div>

    @if ($errors->has('surname'))

    <div class="col-md-12 form-control-feedback">{{ $errors->first('surname') }}</div>
    @endif

</div>
<div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
    <label class="col-md-12 form-control-label" for="error">{{ __('Email') }}</label>

    <div class="col-md-12">
        <input type="text" value="{{ old('email')?old('email'): e($usuario->email) }}" placeholder="{{ e($usuario->email) }}" class="form-control form-control-line {{ $errors->has('email') ? ' form-control-danger' : '' }}"
            id="email" name="email" required>
    </div>
    @if ($errors->has('email'))

    <div class="col-md-12 form-control-feedback">{{ $errors->first('email') }}</div>
    @endif

</div>

<div class="form-group {{ $errors->has('phone') ? ' has-danger' : '' }}">
    <label class="col-md-12 form-control-label" for="error">{{ __('Teléfono') }}</label>

    <div class="col-md-12">
        <input type="text" value="{{ old('phone')?old('phone'): e($usuario->phone) }}" placeholder="{{ e($usuario->phone) }}" class="form-control form-control-line {{ $errors->has('phone') ? ' form-control-danger' : '' }}"
            id="phone" name="phone" required maxlength="9">
    </div>
    @if ($errors->has('phone'))

    <div class="col-md-12 form-control-feedback">{{ $errors->first('phone') }}</div>
    @endif

</div>
