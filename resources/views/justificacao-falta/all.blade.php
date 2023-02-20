@extends('layouts.admin')

@section('title-page')
Encontre justificações
@endsection
@section('links')
<a class="uk-button uk-button-text" href="{{route('justificacao.index')}}">justificações</a> / Relatorio
@endsection
@section('link')
Encontre justificações
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')

   <div class="uk-width-1-1@s uk-padding-small uk-grid">

    <div class="uk-width-1-4@s">
        <label for="data_search" class="uk-form-label">Data inicial</label>
        <input class="uk-input" id="data_search" name="data_inicial" data-uk-datepicker="{format:'DD.MM.YYYY'}"
            placeholder="Data inicial  (Ano/mm/dd)" autocomplete="off" />
    </div>

    <div class="uk-width-1-4@s">
        <label for="data_search_two" class="uk-form-label">Data final</label>
        <input class="uk-input" id="data_search_two" name="data_final" data-uk-datepicker="{format:'DD.MM.YYYY'}"
            placeholder="Data final  (Ano/mm/dd)" autocomplete="off" />
    </div>

    <div class="uk-width-1-4@s">
        <label for="sector_id" class="uk-form-label">Sector</label>
        <input class="uk-input" id="sector_search" placeholder="Sector" />
        <input hidden name="sector" id="sector_id" />

    </div>

    <div class="uk-width-1-4@s">
        <label for="user_id" class="uk-form-label">Usuário</label>
        <input id="user_search" class="uk-input" placeholder="Nome do usuário">
        <input hidden name="user" id="user_id" class="uk-input" placeholder="Nome do usuário">
    </div>

    <div class="uk-width-1-4@s uk-margin-top">
        <button id="btn_report_justificacao"
            class="uk-button uk-text-normal uk-button-danger uk-box-shadow-hover-large uk-border-rounded">
            <span><img width="20px" src="{{  url("storage/icons/pdf.svg") }}"></span>
            Emitir relatório
        </button>
    </div>

    <div class="uk-width-1-4@s uk-margin-top">
        <button id="reset"
            class="uk-button uk-text-normal uk-button-secondary uk-box-shadow-hover-large uk-border-rounded">
            Limpar campos
        </button>
    </div>

</div>

    <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        @if(!$justificacoes->isEmpty())
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <div class="uk-overflow-auto">
                <table id="avarias-tb"
                    class="uk-table uk-table-hover uk-table-responsive uk-table-middle uk-table-divider">
                    <thead>
                        <tr>
                            <th id="table-header" class="uk-width-small">Referência</th>
                            <th id="table-header" class="uk-width-small">Colaborador</th>
                            <th id="table-header" class="uk-width-small">Data da submissão</th>

                            <th id="table-header" class="uk-table-shrink uk-text-nowrap">Parecer do chefe</th>
                            <th id="table-header" class="uk-width-small">Parecer do RH</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($justificacoes as $justificacao)
                        <tr class="uk-background-muted uk-table-link">
                            <td class="uk-text-bold uk-table-link uk-text-normal">
                                <a class="uk-link-reset" href="{{ route('justificacao.show', $justificacao->id) }}">
                                    {{ $justificacao->id }}
                                </a>
                            </td>
                            <td class="uk-text-bold uk-table-link uk-text-normal">
                                <a class="uk-link-reset" href="{{ route('justificacao.show', $justificacao->id) }}">
                                    {{ $justificacao->user->name }}
                                </a>
                            </td>

                            <td class="uk-text-normal uk-table-link">
                                <a class="uk-link-reset" href="{{ route('justificacao.show', $justificacao->id) }}">
                                    {{ date('d/m/Y', strtotime($justificacao->created_at))}}
                                </a>
                            </td>

                            <td class="uk-text-nowrap uk-table-link uk-text-normal">
                                <a class="uk-link-reset" href="{{ route('justificacao.show', $justificacao->id) }}">
                                    {{ $justificacao->parecer_chefe?? '____________' }}
                                </a>
                            </td>

                            <td class="uk-table-link uk-text-nowrap uk-text-normal">
                                <a class="uk-link-reset" href="{{ route('justificacao.show', $justificacao->id) }}">
                                    {{ $justificacao->parecer_rh?? '____________' }}
                                </a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        @include('layouts.empty')
        @endif
    </div>
</div>
@component('layouts.alertDate')
@endcomponent
@endsection
