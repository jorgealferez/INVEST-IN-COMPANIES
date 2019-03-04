<div class="row">

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('contact') ? ' has-danger' : '' }}">
            <label for="contact">{{ __('Nombre') }}</label>

            <div class="input-group">

                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="ti-user"></i>
                    </span>
                </div>
                <input type="text" value="{{ ((old( 'contact')) ? old( 'contact') : $oferta->contact ) }}" class="form-control form-control-line {{ $errors->has('contact') ? ' form-control-danger' : '' }}" id="contact" name="contact">
            </div>
            @if ($errors->has('contact'))

            <div class="form-control-feedback">{{ $errors->first('contact') }}</div>
            @endif

        </div>
    </div>

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('contactSurname') ? ' has-danger' : '' }}">
            <label for="contactSurname">{{ __('Apellidos') }}</label>

            <div class="input-group">

                <input type="text" value="{{ ((old( 'contactSurname')) ? old( 'contactSurname') : $oferta->contactSurname ) }}" class="form-control form-control-line {{ $errors->has('contactSurname') ? ' form-control-danger' : '' }}" id="contactSurname" name="contactSurname">

                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="ti-user"></i>
                    </span>
                </div>
            </div>
            @if ($errors->has('contactSurname'))

            <div class="form-control-feedback">{{ $errors->first('contactSurname') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('contactEmail') ? ' has-danger' : '' }}">
            <label for="contactEmail">{{ __('Email') }}</label>

            <div class="input-group">

                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="ti-email"></i>
                    </span>
                </div>
                <input type="text" value="{{ ((old( 'contactEmail')) ? old( 'contactEmail') : $oferta->contactEmail ) }}" class="form-control form-control-line {{ $errors->has('contactEmail') ? ' form-control-danger' : '' }}" id="contactEmail" name="contactEmail">
            </div>
            @if($errors->has('contactEmail'))

            <div class="form-control-feedback">{{ $errors->first('contactEmail') }}</div>
            @endif

        </div>
    </div>

    <div class="col-md-12">

        <div class="form-group {{ $errors->has('contactPhone') ? ' has-danger' : '' }}">
            <label for="contactPhone">{{ __('Teléfono') }}</label>

            <div class="input-group">

                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="ti-mobile"></i>
                    </span>
                </div>
                <input type="text" value="{{ ((old( 'contactPhone')) ? old( 'contactPhone') : $oferta->contactPhone ) }}" class="form-control form-control-line
                {{ $errors->has('contactPhone') ? ' form-control-danger' : '' }}" id="contactPhone" name="contactPhone" maxlength="9">
            </div>
            @if($errors->has('contactPhone'))

            <div class="form-control-feedback">{{ $errors->first('contactPhone') }}</div>
            @endif

        </div>
    </div>
</div>
