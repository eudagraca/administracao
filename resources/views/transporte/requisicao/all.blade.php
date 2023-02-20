@extends('layouts.admin')
@section('title-page')
    Todas requisições
@endsection
@section('links')
    <a class="uk-button uk-button-text"
       href="{{route('requisicaoTransporte.index')}}">Requisções</a> / Todas requisições
@endsection
@section('link')
    Todas requisições
@endsection
@section('content-main')

    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">

        </div>
        <div class="uk-width-1-1@s uk-padding-small uk-grid">


            <div class="uk-width-1-3@s">
                <label for="data_search" class="uk-form-label">Data inicial</label>
                <input class="uk-input"
                       id="data_search" name="data_inicial"
                       data-uk-datepicker="{format:'DD.MM.YYYY'}"
                       placeholder="Data inicial (Ano/mm/dd)"
                       autocomplete="off"/>
            </div>

            <div class="uk-width-1-3@s">
                <label for="data_search_two" class="uk-form-label">Data final</label>
                <input class="uk-input"
                       id="data_search_two" name="data_final"
                       data-uk-datepicker="{format:'DD.MM.YYYY'}"
                       placeholder="Data final (Ano/mm/dd)"
                       autocomplete="off"/>
            </div>

            <div class="uk-width-1-3@s">
                <label for="sector_id" class="uk-form-label">Sector</label>
                <input class="uk-input" id="sector_search" placeholder="Sector"/>
                <input hidden name="sector" id="sector_id"/>

            </div>

            <div class="uk-width-1-4@s uk-margin-small-top">
                <label for="status" class="uk-form-label">Estado da requisção</label>
                <select class="uk-select" name="estado" id="status">
                    <option value="">Seleccione o estado</option>
                    <option value="andamento">Andamento</option>
                    <option value="entregue">Concluído</option>
                    <option value="pendente">Pendente</option>
                </select>
            </div>

            <div class="uk-width-1-4@s uk-margin-small-top">
                <label for="user_id" class="uk-form-label">Usuário</label>
                <input id="user_search" class="uk-input" placeholder="Nome do usuário">
                <input hidden name="user" id="user_id" class="uk-input" placeholder="Nome do usuário">
            </div>

            <div class="uk-width-1-4@s uk-margin-medium-top">
                <button id="btn_report_requisicoes"
                        class="uk-button uk-text-normal uk-button-danger uk-box-shadow-hover-large uk-border-rounded">
                    <span><img width="20px" src="{{  url("storage/icons/pdf.svg") }}"></span>
                    Emitir relatório
                </button>
            </div>

            <div class="uk-width-1-4@s uk-margin-medium-top">
                <button id="reset"
                        class="uk-button uk-text-normal uk-button-secondary uk-box-shadow-hover-large uk-border-rounded">
                    Limpar campos
                </button>
            </div>

        </div>

        <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$preRequisicoes->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s uk-padding-small">
                    <div class="uk-overflow-auto">
                        <table id="avarias-tb-ralatorio"
                               class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                            <thead>
                            <tr>
                                <th id="table-header" class=" uk-text-nowrap">Req N°</th>
                                <th id="table-header" class=" uk-text-nowrap">Data Req.</th>
                                <th id="table-header">Requisitante</th>
                                <th id="table-header">Origem</th>
                                <th id="table-header">Destino</th>
                                <th id="table-header">Motorista</th>
                                <th id="table-header">Transporte</th>
                                <th id="table-header">Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($preRequisicoes as $preRequisicao)

                                @if($preRequisicao->requisicao)
                                    <tr class="uk-background-muted">
                                        <td class="uk-text-bold uk-table-link  uk-text-small uk-text-nowrap">
                                            <a class="uk-link-reset"
                                               href="{{route('pre.read', $preRequisicao)}}">
                                                {{ $preRequisicao->requisicao->id }}
                                            </a>
                                        </td>
                                        <td class="uk-text-bold uk-table-link uk-text-small uk-text-nowrap">
                                            <a class="uk-link-reset"
                                               href="{{route('pre.read', $preRequisicao)}}">
                                                {{ date('d/m/Y', strtotime($preRequisicao->created_at)) }}
                                            </a>
                                        </td>
                                        <td class="uk-text-truncate uk-table-link uk-text-normal">
                                            <a class="uk-link-reset"
                                               href="{{route('pre.read', $preRequisicao)}}">
                                                {{ ucfirst($preRequisicao->user->name) }}
                                            </a>
                                        </td>
                                        <td class="uk-text-nowrap uk-table-link  uk-text-normal">
                                            <a class="uk-link-reset"
                                               href="{{route('pre.read', $preRequisicao)}}">
                                            {{ $preRequisicao->origem }}</td>
                                        <td class="uk-text-truncate uk-table-link  uk-text-normal ">
                                            <a class="uk-link-reset"
                                               href="{{route('pre.read', $preRequisicao)}}">
                                            {{ $preRequisicao->destino }}</td>
                                        <td class="uk-text-truncate uk-table-link uk-text-small uk-text-bold">
                                            <a class="uk-link-reset"
                                               href="{{route('pre.read', $preRequisicao)}}">
                                                {{ ucfirst($preRequisicao->requisicao->motorista->name) }}
                                            </a>
                                        </td>
                                        <td class="uk-text-truncate uk-table-link  uk-text-small uk-text-bold">
                                            <a class="uk-link-reset"
                                               href="{{route('pre.read', $preRequisicao)}}">
                                                {{ ucfirst($preRequisicao->requisicao->transporte->marca) }}
                                            </a>
                                        </td>
                                        <td class="uk-text-truncate uk-table-link  uk-text-small uk-text-bold {{ $preRequisicao->estado == 'pendente'? 'uk-text-warning': '' }}">
                                            <a class="uk-link-reset"
                                               href="{{route('pre.read', $preRequisicao)}}">
                                                {{ ucfirst($preRequisicao->estado) }}
                                            </a>
                                        </td>
                                    </tr>
                                @endif
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
    <script src="{{ asset('js/ajax-requests.js') }}" defer></script>

@endsection
