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

        <div class="uk-card uk-card-default uk-padding uk-width-1-1@s">
            <div class="uk-margin-remove-top uk-text-primary uk-text-bold uk-card-header ">
                Justificação <span class="uk-h4 uk-text-danger">{{ $justificaoFalta->id }}</span>
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
                        @foreach($dadosJustificacao as $dados)
                        <tr>
                            <td><input value="{{ date('d-m-Y', strtotime($dados->data_escala)) }}" readonly
                                    class="uk-input" /></td>
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

            @if($justificaoFalta->parecer_rh == NULL || $justificaoFalta->parecer_chefe == NULL)
            <form id="rh_jt_form" method="POST" action="{{ route('justificacao.update', $justificaoFalta->id) }}"
                class="uk-form-stacked">
                @method('PUT')
                @csrf
                @if((Auth::check() and Auth::user()->hasRole('gestor-recursos-humanos')) and $justificaoFalta->parecer_rh == NULL)
                <div class="uk-h4 uk-margin-remove-top uk-text-bold uk-card-header ">
                    Reservado ao RH
                </div>
                <table class="table table-bordered" id="dynamic_rh_jt">
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
                    <tr>
                        <td><input name="data_rh[0]"  placeholder="Data" type="date"
                                class="uk-input data name_list" /></td>
                        <td><input type="text" name="hora_inicio_rh[0]"  placeholder="Hora"
                                class="hora_justificacao uk-input name_list" /></td>
                        <td><input type="text" name="intervalo_rh[0]"  placeholder="11:30 - 12:00"
                                class="uk-input intervalo name_list" /></td>
                        <td><input type="text" name="hora_fim_rh[0]" placeholder="Hora do fim"
                                class="uk-input hora_justificacao" /></td>
                    </tr>
                </table>

                <td>
                    <button type="button" name="add-rh_parecer" id="add-rh_parecer"
                        class="btn btn-dark uk-box-shadow-hover-medium"><span><i class="fa fa-plus-circle"
                                aria-hidden="true"></i></span>
                    </button>
                </td>

                <hr>
                <div class="uk-width-1-1@s uk-margin">
                    <label for="responsavel" class="uk-form-label">
                        {{ __('Observações') }}
                    </label>
                    <div class="uk-form-control">
                        <textarea class="uk-textarea @error('observacoes') uk-form-danger @enderror" id="observacoes"
                            name="observacoes" placeholder="Observações" rows="3" autocomplete="off"
                            autofocus></textarea>
                        @error('observacoes')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="uk-margin  uk-grid">

                    <div class="uk-width-1-1@s uk-margin-small-top">
                        <label for="parecer_rh" class="uk-form-label uk-margin-small-top">
                            {{ __('Responder ao pedido') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio" id="status" name="parecer_rh"
                                        value="Reúne requisitos"> Reúne
                                    requisitos</label>

                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio" id="status" name="parecer_rh"
                                        value="Não Reúne requisitos"> Não
                                    reúne requisitos</label>
                                @error('parecer_rh')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                @endif

                @if(Auth::user()->sector)
                @if(Auth::user()->sector->id == $justificaoFalta->sector_id and $justificaoFalta->parecer_chefe == NULL)
                <div class="uk-margin  uk-grid">
                    <p for="estado" class="uk-h3 uk-margin-small-top">
                        {{ __('Parecer do chefe do sector') }}
                    </p>
                    <div class="uk-width-1-1@s uk-margin-small-top">
                        <label for="estado" class="uk-form-label uk-margin-small-top">
                            {{ __('Responder ao pedido') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio" id="status" name="parecer_chefe" value="Favorável">
                                    Favorável</label>

                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio" id="status" name="parecer_chefe"
                                        value="Não Favorável"> Não
                                    Favorável</label>
                                @error('parecer_chefe')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endif

                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                        {{ __('Enviar parecer') }}
                    </button>
                </div>
            </form>

            @endif
        </div>
    </div>
</div>
@endsection
