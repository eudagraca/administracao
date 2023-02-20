<div class="container">
    <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <form method="POST" action="{{ route('carta.store') }}" id="justificacao"
                  class="uk-form-stacked">
                {{ csrf_field() }}
                <div class="uk-h4 uk-margin-remove-top uk-text-bold uk-card-header ">
                    Carta de pedido de férias
                </div>

                <div class="uk-panel uk-padding uk-padding-remove-bottom">
                    <div class="uk-panel-badge uk-card-badge badge badge-success"> Recursos humanos</div>
                    <h3 class="uk-panel-title uk-h5 uk-text-bold uk-text-small">Dados do colaborador</h3>
                    <hr class="uk-divider-small">
                    <div class="uk-grid-small" uk-grid>
                        <div class="uk-width-1-4@s">
                            <label for="sector_id" class="uk-form-label">Sector</label>
                            <select class="uk-select"
                                    name="states">
                                <option>Seleccione o sector</option>
                                @foreach($sectores as $sector)
                                    <option value="{{$sector->id}}">{{ $sector->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="uk-width-1-2@s">
                            <label for="name" class="uk-form-label">Nome</label>
                            <input class="uk-input @error('name') uk-form-danger @enderror" type="text"
                                   placeholder="Nome completo">
                            @error('name')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="uk-width-1-4@s">
                            <label for="funcao" class="uk-form-label">Função</label>
                            <input class="uk-input @error('funcao') uk-form-danger @enderror" id="funcao"
                                   style="border-radius: 0px"
                                   name="funcao">
                            @error('funcao')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="uk-panel uk-padding">
                    <div class="uk-grid-small" uk-grid>

                        <div class="uk-width-1-6@s">
                            <label for="experiencia" class="uk-form-label">Anos de trabalho</label>
                            <input class="uk-input @error('experiencia') uk-form-danger @enderror" type="number"
                                   placeholder="Ex:. 3">
                            @error('experiencia')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="uk-width-1-4@s">
                            <label for="data_inicio" class="uk-form-label">Data de início</label>
                            <input class="uk-input @error('data_inicio') uk-form-danger @enderror" id="data_inicio"
                                   name="data_inicio" type="date" placeholder="Da de início">
                            @error('data_inicio')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="uk-width-1-4@s">
                            <label for="data_termino" class="uk-form-label">Data de término</label>
                            <input class="uk-input @error('data_termino') uk-form-danger @enderror" name="data_termino"
                                   id="data_termino" type="date" placeholder="Data de término">
                            @error('data_termino')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="uk-width-1-3@s">
                            <label for="substituto" class="uk-form-label">Susbtituto</label>
                            <input class="uk-input @error('subsituto') uk-form-danger @enderror" name="substituto"
                                   id="substituto" type="text" placeholder="Nome do substituto">
                            @error('substituto')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-secondary">
                        {{ __('Enviar pedido') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
