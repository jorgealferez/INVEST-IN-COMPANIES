<form method="POST" class="form-control-line form-material" action="" id="formBorrar">
    @csrf @method('POST')
    <input type="hidden" value="" name="id_borrar" id="id_borrar">
    <input type="hidden" value="" name="modalborrar_action" id="modalborrar_action">

    <div id="borrarModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="borrarModal" aria-hidden="true">

        <div class="modal-dialog  modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-body">
                    <h4 id="texto-modal-borrar"></h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">{{ __('Cancelar') }}</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light" id="BotonEliminar">{{ __('Eliminar') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>
