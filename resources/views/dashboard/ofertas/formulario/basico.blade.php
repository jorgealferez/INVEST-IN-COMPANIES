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

        <div class="form-group {{ $errors->has('ofertatipo_id') ? ' has-danger' : '' }}">
            <label for="ofertatipo_id">{{ __('Tipo de oferta') }}(*)</label>

            <select name="ofertatipo_id" id="ofertatipo_id" class="form-control form-control-line {{ $errors->has('ofertatipo_id') ? ' form-control-danger' : '' }}" required>
                <option value="">{{ __('Selecciona tipo de oferta') }}</option>

                @if (!$ofertastipos->isEmpty() )
                @foreach ($ofertastipos as $ofertatipo)
                @if (old('ofertatipo_id'))
                <option value="{{ $ofertatipo->id }}" @if (old('ofertatipo_id')==$ofertatipo->id ) selected @endif >
                    {{$ofertatipo->name }}
                </option>
                @else
                <option value="{{ $ofertatipo->id }}" @if ( !is_null ($oferta->ofertatipo_id) && $oferta->ofertatipo_id== $ofertatipo->id) selected @endif >
                    {{$ofertatipo->name }}
                </option>
                @endif
                @endforeach
                @endif
            </select> @if ($errors->has('ofertatipo_id'))

            <div class="form-control-feedback">{{ $errors->first('ofertatipo_id') }}</div>
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
