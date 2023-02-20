@extends('layouts.admin')
@section('title-page')
Detalhes da jsutificação
@endsection
@section('links')
<a href="{{ route('justificacao.index') }}" class="uk-button uk-button-text">Jsutificação</a> / Detalhes
@endsection
@section('link')
Detalhes da jsutificação
@endsection
@section('content-main')
@include('layouts.flash')
<div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
    <div class="uk-card uk-card-default uk-width-1-1@s">
        <h3 class="uk-h4 uk-margin-remove-top uk-margin-remove-bottom uk-text-bold uk-card-header">Detalhes da
            jsutificação
            @if((Auth::user()->hasRole('gestor-recursos-humanos') and $justificaoFalta->parecer_rh == NULL ))
            <a href="{{ route('justificacao.parecer', $justificaoFalta->id) }}" type="button"
                class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                {{ __('Dar parecer') }}
            </a>

            @endif

            @if(Auth::user()->sector)
            @if(Auth::user()->sector->id == $justificaoFalta->sector_id and $justificaoFalta->parecer_chefe == NULL)

            <a href="{{ route('justificacao.parecer.chefe', $justificaoFalta->id) }}" type="button"
                class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                {{ __('Dar parecer') }}
            </a>
            @endif
            @endif
        </h3>

        <div class="uk-card-body uk-margin uk-margin-remove-top uk-grid">

            <div class="uk-width-1-1 uk-margin-medium-bottom">

                @if((Auth::check() and Auth::user()->hasRole('gestor-recursos-humanos')) and $justificaoFalta->parecer_rh != NULL )
                <a href="{{ route('justificacao.edit',$justificaoFalta->id )}}"
                    class="uk-button uk-button-secondary uk-button-small uk-text-bolder uk-border-rounded uk-box-shadow-hover-large uk-align-right">
                    <i class="fa fa-file-alt"></i> Imprimir</a>

                @endif

            </div>

            <div class="uk-width-1-3@s">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Colaborador') }}
                    </label>
                    <p class="uk-text-normal uk-margin-remove-top">{{ $justificaoFalta->user->name }}</p>
                </div>
            </div>
            <div class="uk-width-1-3@s">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Tipo de colaborador') }}
                    </label>
                    <p class="uk-text-normal uk-margin-remove-top">{{ $justificaoFalta->tipo_colaborador }}</p>
                </div>
            </div>
            <div class="uk-width-1-3@s">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Pedido de:') }}
                    </label>
                    <p class="uk-text-normal uk-margin-remove-top">{{ $justificaoFalta->tipo_justificacao }}</p>
                </div>
            </div>

            <div class="uk-width-1-3@s uk-margin">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Sector :') }}
                    </label>
                    <p class="uk-text-normal uk-margin-remove-top">{{ $justificaoFalta->sector->name }}
                    </p>
                </div>
            </div>

            <div class="uk-width-1-3@s uk-margin">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Forma de compensação') }}
                    </label>
                    <p class="uk-text-normal uk-margin-remove-top">{{ $justificaoFalta->forma_compensacao }}</p>
                </div>
            </div>
            <div class="uk-width-1-3@s uk-margin">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Data da submissão') }}
                    </label>
                    <p class="uk-text-normal uk-margin-remove-top">
                        {{ date('d/m/Y', strtotime($justificaoFalta->created_at))}}</p>
                </div>
            </div>


            <div class="uk-width-1-3@s uk-margin">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Parecer do Chefe do sector') }}
                    </label>
                    <p class="uk-text-normal uk-margin-remove-top">
                        {{ $justificaoFalta->parecer_chefe?? 'Não aplicado' }}</p>
                </div>
            </div>

            <div class="uk-width-1-3@s uk-margin">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Parecer do RH') }}
                    </label>
                    <p class="uk-text-normal uk-margin-remove-top">{{ $justificaoFalta->parecer_rh?? 'Não aplicado' }}
                    </p>
                </div>
            </div>

            <div class="uk-width-1-3@s uk-margin">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Estado') }}
                    </label>
                    <p class="uk-text-normal uk-text-primary uk-margin-remove-top">{{ $justificaoFalta->is_active? 'Pedido aberto': 'Pedido fechado' }}
                    </p>
                </div>
            </div>

            <div class="uk-panel uk-padding-remove-top table-responsive-m">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dynamic_justificacao">
                        <thead>
                            <tr>
                                <th class="uk-text-small" colspan="4">Dados de escala</th>
                                <th class="uk-text-small" colspan="2">Dados de falta</th>

                            </tr>
                            <tr>
                                <th class="uk-text-small">Datas</th>
                                <th class="uk-text-small">Hora de inicio</th>
                                <th class="uk-text-small">Intervalo</th>
                                <th class="uk-text-small">Hora do fim</th>
                                <th class="uk-text-small">Hora de início</th>
                                <th class="uk-text-small">Hora do fim</th>
                            </tr>
                        </thead>
                        @foreach($justificaoFalta->dados as $dados)
                        <tr>
                            <td><input value="{{ date('d-m-Y', strtotime($dados->data_escala)) }}" readonly class="uk-input" /></td>
                            <td><input type="text" value="{{ $dados->hora_inicio_escala }}" readonly class="uk-input" />
                            </td>
                            <td><input type="text" readonly value="{{ $dados->intervalo }}" class="uk-input" /></td>
                            <td><input type="text" readonly value="{{ $dados->hora_fim_escala }}" class="uk-input" />
                            </td>
                            <td><input value="{{ $dados->hora_inicio_falta }}" readonly class="uk-input" /></td>
                            <td><input value="{{ $dados->hora_fim_falta }}" readonly class="uk-input" /></td>
                        </tr>
                        @endforeach
                    </table>

                </div>


            </div>


            <div class="uk-panel uk-padding-remove-top">
                <div class="table-responsive">
            <table class="table table-bordered" >
                <thead>
                    <tr>
                        <th class="uk-text-small" colspan="4">Prolongamento do turno</th>

                    </tr>
                    <tr>
                        <th class="uk-text-small">Data</th>
                        <th class="uk-text-small">Hora de inicio</th>
                        <th class="uk-text-small">Intervalo</th>
                        <th class="uk-text-small">Hora do fim</th>
                    </tr>
                </thead>
                @foreach($justificaoFalta->dados as $dado)
                <tr>
                    <td><input value="{{ date('d-m-Y',strtotime($dado->data_rh) )}}" readonly class="uk-input" /></td>
                    <td><input readonly value="{{ $dado->hora_inicio_rh }}" readonly class="uk-input" /></td>
                    <td><input type="text" value="{{ $dado->intervalo_rh }}" readonly
                            class="uk-input" /></td>
                    <td><input type="text" value="{{ $dado->hora_fim_rh }}" readonly class="uk-input" /></td>
                </tr>
                @endforeach
            </table>
                </div>
            </div>

            <div class="uk-width-1-2@s">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Motivo') }}
                    </label>
                    <p class="uk-text-normal uk-margin-remove-top">{{ $justificaoFalta->motivo }}</p>
                </div>
            </div>
            <div class="uk-width-1-2@s">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Observação') }}
                    </label>
                    <p class="uk-text-normal uk-margin-remove-top">{{ $justificaoFalta->parecer_rh?? 'Não aplicado' }}
                    </p>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
