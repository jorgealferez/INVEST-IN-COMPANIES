<div id="Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">

    <div class="modal-dialog  modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-body">
                <h4 id="titular-modal"></h4>
                <p id="texto-modal"></p>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect waves-light" id="BotonAceptar" data-dismiss="modal">{{ __('Aceptar') }}</button>
            </div>
        </div>
    </div>
</div>

<div id="ModalInvitado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalInvitado" aria-hidden="true">

    <div class="modal-dialog  modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-body">
                <h4 id="titular-modal">{{ __('Solicitud de información') }}</h4>
                <p id="texto-modal">{{ __('Tienes que estar registrado para solcitar información') }}</p>
            </div>

            <div class="modal-footer">
                <a href="{{ route('compraEmpresa') }}#formulario" type="button" class="btn btn-success waves-effect waves-light">{{ __('Quiero registrarme') }}</a>
                <button type="button" class="btn btn-dark waves-effect waves-light" data-dismiss="modal">{{ __('Cancelar') }}</button>
            </div>
        </div>
    </div>
</div>
