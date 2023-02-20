<!-- This is the modal -->
<div id="my-id" uk-modal>
      <div class="uk-modal-dialog uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Aviso</h2>
        </div>
        <div class="uk-modal-body">
            <p>Deseja remover {{  $model_title }} <strong> {{ $info_title }}</strong> ? Esta acção é inreversível</p>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-border-rounded uk-box-shadow-hover-small uk-modal-close"
                type="button">Cancelar</button>
            {{ $slot }}
        </div>
    </div>
</div>
