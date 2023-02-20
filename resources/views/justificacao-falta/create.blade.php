@extends('layouts.admin')

@section('title-page')
Justificação de faltas
@endsection
@section('links')
<a href="{{ route('justificacao.index') }}" class="uk-button uk-button-text">Justificações</a> / Registro
@endsection
@section('link')
Justificação de faltas
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')
    <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <form method="POST" action="{{ route('justificacao.store') }}" id="justificacao_falta" class="uk-form-stacked">
                {{ csrf_field() }}
                <div class="uk-h4 uk-margin-remove-top uk-text-bold uk-card-header ">
                    Carta de Justificação de faltas
                </div>
                <div class="uk-panel uk-padding uk-padding-remove-bottom">
                    <div class="uk-panel-badge uk-card-badge badge badge-success"> Recursos humanos</div>
                    <h3 class="uk-panel-title uk-h5 uk-text-bold uk-text-small">Dados do colaborador</h3>
                    <hr class="uk-divider-small">
                    <div class="uk-grid-small" uk-grid>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label">Sector</label>
                            <input class="uk-input" readonly value="{{ Auth::user()->getSector()->name }}" >
                        </div>
                        <div class="uk-width-1-2@s">
                            <label for="name" class="uk-form-label">Nome</label>
                            <input class="uk-input" readonly type="text" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid uk-margin-medium-top">
                            <label class="uk-text-small">
                                <input class="uk-radio" value="Prestador" type="radio" name="tipo_colaborador">
                                Prestador</label> <label class="uk-text-small">
                                <input class="uk-radio" value="Efectivo" type="radio" name="tipo_colaborador">
                                Efectivo</label>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="uk-panel uk-padding uk-padding-remove-top">
                    <h3 class="uk-panel-title uk-h5 uk-text-bold uk-text-small">Pedido de: </h3>
                    <hr class="uk-divider-small">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th colspan="2">
                                    <div
                                        class="uk-margin uk-margin-top uk-grid-small uk-child-width-auto uk-grid uk-margin-remove-bottom uk-margin-small">
                                        <label class="uk-text-small">
                                            <input class="uk-radio" value="Justificação de falta" type="radio" name="tipo_justificacao">
                                            Justificação de falta</label>
                                        <label class="uk-text-small">
                                            Justificação de atraso
                                            <input class="uk-radio" value="Justificação de atraso" type="radio" name="tipo_justificacao">
                                        </label>
                                    </div>
                                </th>
                                <th colspan="2">
                                    <div
                                        class="uk-margin uk-grid-small uk-margin-top uk-child-width-auto uk-grid uk-margin-remove-bottom uk-margin-small">
                                        <label class="uk-text-small">
                                            <input class="uk-radio" value="Dispensa" type="radio" name="tipo_justificacao">Dispensa</label>
                                        <label class="uk-text-small">
                                            <input class="uk-input uk-text-meta uk-child-width-auto" type="text"
                                                placeholder="Assunto . . ." name="assunto">
                                            <small class="uk-text-light uk-text-small">Indique o assunto</small>
                                        </label>
                                    </div>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="uk-panel uk-padding uk-padding-remove-top table-responsive-m">
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
                            <tr>
                                <td><input name="data_escala[0]" value="" placeholder="Data" type="date"
                                        class="uk-input data name_list" /></td>
                                <td><input type="text" name="hora_inicio_escala[0]" value="" placeholder="HH:mm"
                                        class="hora_justificacao uk-input name_list" /></td>
                                <td><input type="text" name="intervalo[0]" value="" placeholder="HH:mm - HH:mm"
                                        class="uk-input intervalo name_list" /></td>
                                <td><input type="text" name="hora_fim_escala[0]" value="" placeholder="HH:mm"
                                        class="uk-input hora_justificacao" /></td>
                                <td><input name="hora_inicio_falta[0]" value="" placeholder="HH:mm"
                                        class="uk-input hora_justificacao" /></td>
                                <td><input name="hora_fim_falta[0]" value="" placeholder="HH:mm"
                                        class="uk-input hora_justificacao" /></td>
                            </tr>
                        </table>
                        <hr>
                    <div class="uk-width-1-1@s uk-grid uk-margin-top">

                        <div class="uk-width-1-2@s uk-margin">
                            <label class="uk-form-label">Formas de compensação</label>
                            <p>
                                <label class="uk-text-small">
                                    <input class="uk-radio" value="Alteração de turno" type="radio" name="forma_compensacao">
                                    Alteração de turno
                                </label>
                            </p>
                            <p>
                                <label class="uk-text-small">
                                    <input class="uk-radio" value="Desconto no salário" type="radio" name="forma_compensacao">
                                    Desconto no salário
                                </label>
                            </p>

                            <p>
                                <label class="uk-text-small">
                                    <input class="uk-radio" value="Trabalho voluntário" type="radio" name="forma_compensacao">
                                    Abáte no período de férias
                                </label>
                            </p>
                        </div>


                        <div class="uk-width-1-2@s">
                            <label for="responsavel" class="uk-form-label">
                                {{ __('Motivo') }}
                            </label>
                            <div class="uk-form-control">
                                <textarea class="uk-textarea @error('motivo') uk-form-danger @enderror" id="motivo" name="motivo"
                                    placeholder="Motivo" rows="5" autocomplete="off"></textarea>
                                @error('motivo')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                        <td>
                            <button type="button" name="add-justificacao_form" id="add-justificacao_form"
                                class="btn btn-dark uk-box-shadow-hover-medium"><span><i class="fa fa-plus-circle"
                                        aria-hidden="true"></i></span>
                            </button>
                        </td>
                    </div>
                </div>

                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-secondary">
                        {{ __('Enviar justificação') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
