@extends('layouts.admin')

@section('title-page')
    Encontre escalas
@endsection
@section('links')
    <a class="uk-button uk-button-text" href="{{route('escala.index')}}">Escalas</a> / Relatorio
@endsection
@section('link')
    Encontre escalas
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')

        <div class="uk-width-1-1@s uk-padding-small uk-grid">

            <div class="uk-width-1-4@s">
                <label for="data_search" class="uk-form-label">Data inicial</label>
                <input class="uk-input"
                       id="data_search" name="data_inicial"
                       data-uk-datepicker="{format:'DD.MM.YYYY'}"
                       placeholder="Data inicial  (Ano/mm/dd)"
                       autocomplete="off"/>
            </div>

            <div class="uk-width-1-4@s">
                <label for="data_search_two" class="uk-form-label">Data final</label>
                <input class="uk-input"
                       id="data_search_two" name="data_final"
                       data-uk-datepicker="{format:'DD.MM.YYYY'}"
                       placeholder="Data final  (Ano/mm/dd)"
                       autocomplete="off"/>
            </div>

            <div class="uk-width-1-4@s">
                <label for="sector_id" class="uk-form-label">Sector</label>
                <input class="uk-input" id="sector_search" placeholder="Sector"/>
                <input hidden name="sector_id" id="sector_id"/>

            </div>

            <div class="uk-width-1-4@s">
                <label for="user_id" class="uk-form-label">Usuário</label>
                <input id="user_search" class="uk-input" placeholder="Nome do usuário">
                <input hidden name="user" id="user_id" class="uk-input" placeholder="Nome do usuário">
            </div>

            <div class="uk-width-1-4@s uk-margin-top">
                <button id="btn_report_escalas"
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
            @if(!$escalas->isEmpty())
            <div class="uk-card uk-card-default uk-width-1-1@s">
                <div class="uk-overflow-auto">
                    <table id="avarias-tb" class="uk-table uk-table-hover uk-table-responsive uk-table-middle uk-table-divider">
                        <thead>
                            <tr>
                                <th id="table-header" class="uk-width-small">Referência</th>
                                <th id="table-header" class="uk-width-small">Requisitante</th>
                                <th id="table-header" class="uk-width-small">Sector</th>

                                <th id="table-header" class="uk-table-shrink">Estado</th>
                                <th id="table-header" class="uk-width-small">Data da nova escala</th>
                                <th id="table-header" class="uk-table-shrink uk-text-nowrap">Hora da nova escala</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($escalas as $escala)
                            <tr class="uk-background-muted uk-table-link">
                                <td class="uk-text-bold uk-table-link uk-text-normal">
                                    <a class="uk-link-reset" href="{{ route('escala.show', $escala->id) }}">
                                        {{ $escala->id }}
                                    </a>
                                </td>
                                <td class="uk-text-bold uk-table-link uk-text-normal">
                                    <a class="uk-link-reset" href="{{ route('escala.show', $escala->id) }}">
                                        {{ $escala->user->name }}
                                    </a>
                                </td>

                                <td class="uk-text-normal uk-table-link">
                                    <a class="uk-link-reset" href="{{ route('escala.show', $escala->id) }}">
                                        {{ $escala->sector->name }}
                                    </a>
                                </td>

                                <td class="uk-text-truncate uk-table-link uk-text-normal">
                                    <a class="uk-link-reset" href="{{ route('escala.show', $escala->id) }}">
                                        {{ ucfirst($escala->estado) }}
                                    </a>
                                </td>

                                <td class="uk-table-link uk-text-normal">
                                    <a class="uk-link-reset" href="{{ route('escala.show', $escala->id) }}">
                                        {{ date('d/m/Y', strtotime($escala->dados->data_nova_escala)) }}
                                    </a>
                                </td>
                                <td class="uk-text-nowrap uk-table-link uk-text-normal">
                                    <a class="uk-link-reset" href="{{ route('escala.show', $escala->id) }}">
                                        {{ date('H:i', strtotime($escala->dados->hora_inicio_nova_escala)) }}
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
