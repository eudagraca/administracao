@extends('layouts.admin')
@section('title-page')
    Elaboração de adenda
@endsection
@section('links')
    <a href="{{ route('contrato.index') }}" class="uk-button uk-button-text">Contratos</a> / Registo
@endsection
@section('link')
    Alaboração de adenda
@endsection
@section('content-main')
    @include('layouts.flash')

    <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <h3 class="uk-h4 uk-margin-remove-top uk-margin-remove-bottom uk-text-bold uk-card-header">Elaboração de
                adenda</h3>
            <form method="POST" action="{{ route('adenda.store') }}" id="adendaForm" class="uk-form-stacked">
                {{ csrf_field() }}
                <div class="uk-card-body uk-margin uk-margin-remove-top uk-grid">

                    <div class="uk-width-1-1 uk-margin-medium-bottom">
                        <a href="{{ route('contrato.show', $contrato->id) }}"
                           class="uk-button uk-button-secondary uk-button-small uk-text-bolder uk-border-rounded uk-box-shadow-hover-large uk-align-right">
                            <i class="fas fa-long-arrow-alt-left"></i> ir para o contrato
                        </a>

                    </div>

                    <div class="uk-width-1-1@s">
                        @error('contrato_id')
                        <div class="alert uk-alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p>{{ $message }}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="uk-width-1-3@s">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Situação') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $contrato->esta_activo? 'Activo': 'Expirado' }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-3@s">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Nome completo') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $contrato->name }}</p>
                        </div>
                    </div>

                    <input hidden name="contrato_id" value="{{$contrato->id}}">
                    <div class="uk-width-1-3@s">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Número de BI') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $contrato->bi }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-3@s uk-margin">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Salário bruto Mensal') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $contrato->salario_bruto }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-3@s uk-margin">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Salário bruto (Actual)') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $contrato->adenda() == NULL? $contrato->salario_bruto : $contrato->adenda()->salario_actual }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-3@s uk-margin-bottom uk-margin">
                        <label for="apartir_de" class="uk-form-label">
                            {{ __('Data de Vigor do contrato') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input data_contrato @error('apartir_de') uk-form-danger @enderror"
                                   id="apartir_de" value="{{ old('apartir_de') }}" required
                                   name="apartir_de" placeholder="Data de vigor do contrato"/>
                            @error('apartir_de')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label">
                            {{ __('Motivo') }}
                        </label>
                        <div class="uk-width-1-1@s">
                            <textarea class="uk-textarea uk-width-1-1@s" id="motivo" name="motivo" placeholder="Qual é o motivo?" rows="3"
                                required></textarea>
                        </div>
                    </div>


                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label">
                            {{ __('Cláusula') }}
                        </label>
                            <div class="uk-width-1-1@s">
                            <input
                                class="uk-input uk-width-1-1@s"
                                id="clausula" name="clausula" placeholder="Cláusula"
                                required>
                            </div>
                    </div>
                    <div class="uk-width-1-1@s uk-margin">
                        <label class="uk-form-label">
                            {{ __('Descrição') }}
                        </label>
                            <div class="uk-width-1-1@s">
                            <textarea
                                class="uk-textarea uk-width-1-1@s"
                                id="descricao" name="descricao" placeholder="Descrição" rows="3"
                                required></textarea>
                            </div>
                    </div>
                </div>

                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-secondary">
                        {{ __('Confirmar a adenda') }}
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection
