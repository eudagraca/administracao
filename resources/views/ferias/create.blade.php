@extends('layouts.admin')

@section('title-page')
Registar Pedido de Férias
@endsection
@section('links')
<a href="{{ route('feria.index') }}" class="uk-button uk-button-text">Férias</a> / Registro
@endsection
@section('link')
Registar Pedido de Férias
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')
    <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <form method="POST" action="{{ route('feria.store') }}" id="justificacao" class="uk-form-stacked">
                {{ csrf_field() }}
                <div class="uk-h4 uk-margin-remove-top uk-text-bold uk-card-header ">Pedido de férias
                </div>

                <div class="uk-panel uk-padding uk-padding-remove-bottom">
                    <div class="uk-panel-badge uk-card-badge badge badge-success"> Recursos humanos</div>
                    <h3 class="uk-panel-title uk-h5 uk-text-bold uk-text-small">Dados do colaborador</h3>
                    <hr class="uk-divider-small">
                    <div class="uk-grid-small" uk-grid>

                        <div class="uk-width-1-2@s">
                            <label for="name" class="uk-form-label">Nome</label>
                            <input class="uk-input" readonly type="text" value="{{ Auth::user()->name }}">

                        </div>
                        <div class="uk-width-1-2@s">
                            <label for="funcao" class="uk-form-label">Função</label>
                            <input class="uk-input @error('funcao') uk-form-danger @enderror" id="funcao"
                                style="border-radius: 0px" name="funcao">
                            @error('funcao')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="uk-panel uk-padding">
                    <div class="uk-grid-small" uk-grid>

                        <div class="uk-width-1-6@s">
                            <label for="anos_trabalho" class="uk-form-label">Tempo de serviço</label>
                            <input class="uk-input @error('anos_trabalho') uk-form-danger @enderror" name="anos_trabalho" type="number"
                                placeholder="Ex:. 3">
                            @error('anos_trabalho')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="uk-width-1-5@s">
                            <label for="anos_trabalho" class="uk-form-label">Periodo</label>
                            <select class="uk-select @error('anos_trabalho') uk-form-danger @enderror" name="periodo" id="periodo">
                                <option selected disabled>Seleccione o periodo</option>
                                <option value="Meses">Meses</option>
                                <option value="Anos">Anos</option>
                            </select>

                            @error('periodo')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="uk-width-1-4@s">
                            <label for="data_inicio" class="uk-form-label">Data de início</label>
                            <input class="uk-input @error('data_inicio') uk-form-danger @enderror" id="data_inicio"
                                name="data_inicio" placeholder="Da de início">
                            @error('data_inicio')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="uk-width-1-4@s">
                            <label for="data_termino" class="uk-form-label">Data de término</label>
                            <input class="uk-input @error('data_termino') uk-form-danger @enderror" name="data_termino"
                                id="data_termino" placeholder="Data de término">
                            @error('data_termino')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="uk-width-1-3@s">
                            <input hidden name="user" id="user_id">
                            <label for="user_search" class="uk-form-label">Susbtituto</label>
                            <input class="uk-input @error('user') uk-form-danger @enderror"
                                id="user_search" type="text" placeholder="Nome do substituto">
                            @error('user')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-secondary">
                        {{ __('Submeter pedido') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
