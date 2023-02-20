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
        <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$requisicoes->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s uk-padding-small">
                    <div class="uk-overflow-auto">
                        <table id="tableDatatable"
                               class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                            <thead>
                            <tr>
                                <th id="table-header" class=" uk-text-nowrap">N° da requisição</th>
                                <th id="table-header" class=" uk-text-nowrap">Data da requisição</th>
                                <th id="table-header">Requisitante</th>
                                <th id="table-header">Origem</th>
                                <th id="table-header">Destino</th>
                                <th id="table-header">Motorista</th>
                                <th id="table-header">Transporte</th>
                                <th id="table-header">Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($requisicoes as $preRequisicao)

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
                                                {{ \App\MyUtils::dataToPT(date('Y', strtotime($preRequisicao->created_at)), date('M', strtotime($preRequisicao->created_at)), date('d', strtotime($preRequisicao->created_at)))  }}
                                            </a>
                                        </td>
                                        <td class="uk-text-nowrap uk-table-link uk-text-normal">
                                            <a class="uk-link-reset"
                                               href="{{route('pre.read', $preRequisicao)}}">
                                                {{ ucfirst($preRequisicao->user->name) }}
                                            </a>
                                        </td>
                                        <td class="uk-text-nowrap uk-table-link  uk-text-normal">
                                            <a class="uk-link-reset"
                                               href="{{route('pre.read', $preRequisicao)}}">
                                            {{ $preRequisicao->origem }}</td>
                                        <td class="uk-text-nowrap uk-table-link  uk-text-normal ">
                                            <a class="uk-link-reset"
                                               href="{{route('pre.read', $preRequisicao)}}">
                                            {{ $preRequisicao->destino }}</td>
                                        <td class="uk-text-nowrap uk-table-link uk-text-small uk-text-bold">
                                            <a class="uk-link-reset"
                                               href="{{route('pre.read', $preRequisicao)}}">
                                                {{ ucfirst($preRequisicao->requisicao->motorista->name) }}
                                            </a>
                                        </td>
                                        <td class="uk-text-nowrap uk-table-link  uk-text-small uk-text-bold">
                                            <a class="uk-link-reset"
                                               href="{{route('pre.read', $preRequisicao)}}">
                                                {{ ucfirst($preRequisicao->requisicao->transporte->marca) }} - {{ ucfirst($preRequisicao->requisicao->transporte->modelo) }}
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
