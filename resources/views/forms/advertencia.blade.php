<div class="container">
    <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <form method="POST" action="{{ route('rescisao.store') }}" id="advertenciaForm"
                  class="uk-form-stacked">
                {{ csrf_field() }}
                <div class="uk-h4 uk-margin-remove-top uk-text-bold uk-card-header ">
                    Advertência de serviço
                </div>

                <div class="uk-panel uk-padding uk-padding-remove-bottom">
                    <div class="uk-panel-badge uk-card-badge badge badge-success"> Recursos humanos</div>
                    <h3 class="uk-panel-title uk-h5 uk-text-bold uk-text-small">Dados da advertência de serviço</h3>
                    <hr class="uk-divider-small">
                    <div class="uk-grid-small" uk-grid>

                        <div class="uk-width-1-2@s">
                            <label for="desinatario" class="uk-form-label">Para: </label>
                            <input class="uk-input @error('desinatario') uk-form-danger @enderror"
                                   id="desinatario"
                                   data-rule-required="true" name="desinatario" type="text" placeholder="Para: . . . "/>
                            @error('desinatario')
                            <span id="errorDate" class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="uk-width-1-2@s">
                            <label for="advertido" class="uk-form-label">
                                {{ __('Advertido') }}
                            </label>
                            <div class="uk-form-control">
                                <input class="uk-input @error('advertido') uk-form-danger @enderror"
                                       id="advertido" name="advertido" data-rule-required="true"
                                       placeholder="Nome do advertido"
                                       autocomplete="off"
                                       autofocus/>
                                @error('advertido')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="uk-width-1-2@s uk-margin">
                            <br>
                            <label for="motivo_advertencia" class="uk-form-label">Motivo da advertência</label>
                            <textarea class="uk-textarea @error('motivos') uk-form-danger @enderror" id="motivo_advertencia"
                                   data-rule-required="true" rows="3"  name="motivos" type="text" placeholder="Motivos"></textarea>
                            @error('motivos')
                            <span id="errorDate" class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="uk-form-control uk-card-footer">
                    <button type="submit" id="btn-rescisao" class="uk-button uk-align-right uk-border-rounded uk-button-secondary">
                        {{ __('Enviar pedido de rescisão') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
