@extends('layouts.admin')

@section('title-page')
Pedidos de rescisão
@endsection

@section('link')
Pedidos de rescisão
@endsection

@section('links')
Pedidos de rescisão
@endsection

@section('content-main')

<div class="container">
    @include('layouts.flash')
<div class="container">
    <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <form method="POST" action="{{ route('pedidoRescisao.store') }}" id="rescisaoForm"
                  class="uk-form-stacked">
                {{ csrf_field() }}
                <div class="uk-h4 uk-margin-remove-top uk-text-bold uk-card-header ">
                    Rescisão de contrato
                </div>

                <div class="uk-panel uk-padding uk-padding-remove-bottom">
                    <div class="uk-panel-badge uk-card-badge badge badge-success"> Recursos humanos</div>
                    <h3 class="uk-panel-title uk-h5 uk-text-bold uk-text-small">Dados da rescisão</h3>
                    <hr class="uk-divider-small">
                    <div class="uk-grid-small" uk-grid>
                        <div class="uk-width-1-2@s uk-margin">
                            <label for="motivos" class="uk-form-label">
                                {{ __('Motivo') }}
                            </label>
                            <div class="uk-form-control">
                            <textarea class="uk-textarea @error('motivo') uk-form-danger @enderror"
                                      id="motivos" name="motivo" data-rule-required="true"
                                      placeholder="Motivos que lhe levam a rescindir o contrato" rows="4"
                                      autocomplete="off"
                                      autofocus></textarea>
                                @error('motivo')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="uk-width-1-2@s">
                            <br>
                            <label for="antecedencia" class="uk-form-label">Data em que pretende sair</label>
                            <input class="uk-input @error('antecedencia') uk-form-danger @enderror" id="antecedencia"
                                   data-rule-required="true"  name="antecedencia" type="text" placeholder="ANO/MES/DIA">
                            <br><small class="uk-text-warning">Deve informar uma data de antecipação com mínimo de 15 dias de diferença</small>
                            @error('antecedencia')
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
@endsection
