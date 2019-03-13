<div class="row">

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
            <label for="name">{{ __('Nombre') }}</label>
            <input type="text " value="{{ ((old( 'name')) ? old( 'name') : $oferta->name ) }}" class="form-control form-control-line
                        {{ $errors->has('name') ? ' form-control-danger'
                    : '' }}" id="name" name="name" required> @if ($errors->has('name'))

            <div class="col-md-12 form-control-feedback">{{ $errors->first('name') }}</div>
            @endif

        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('descripcion') ? ' has-danger' : '' }}">
            <label for="descripcion">{{ __('Descripción') }}</label>
            <textarea name="descripcion" id="descripcion" class="form-control form-control-line {{ $errors->has('descripcion') ? ' form-control-danger' : '' }}" rows="5" required>{{ ((old( 'descripcion')) ? old( 'descripcion') : $oferta->descripcion ) }}</textarea>
            @if ($errors->has('descripcion'))

            <div class="form-control-feedback">{{ $errors->first('descripcion') }}</div>
            @endif

        </div>
    </div>
</div>
