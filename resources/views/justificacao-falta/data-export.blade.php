@extends('layouts.admin')
@section('title-page')
    Pré relatório de pedido de justificação de falta
@endsection
@section('links')
    <a class="uk-button uk-button-text"
       href="{{route('justificacao.all')}}">Pedidos</a> / Relatório
@endsection
@section('link')
    Pré relatório de pedido de justificação de falta
@endsection
@section('content-main')

    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">

        </div>
        <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$justificacoes->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-overflow-auto">
                        <table id="tableDatatableJustificacoes" class="uk-table uk-table-hover uk-table-responsive uk-table-middle uk-table-divider">
                            <thead>
                                <tr>
                                    <th id="table-header" class="uk-width-small">Referência</th>
                                    <th id="table-header" class="uk-width-small">Colaborador</th>
                                    <th id="table-header" class="uk-width-small">Sector</th>

                                    <th id="table-header" class="uk-table-shrink uk-text-nowrap">Parecer do chefe</th>
                                    <th id="table-header" class="uk-width-small">Parecer do RH</th>

                                    <th id="table-header" class="uk-width-small">Data da submissão</th>
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

                                    <td class="uk-text-bold uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('justificacao.show', $justificacao->id) }}">
                                            {{ $justificacao->sector->name }}
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

                                    <td class="uk-text-normal uk-table-link">
                                        <a class="uk-link-reset" href="{{ route('justificacao.show', $justificacao->id) }}">
                                            {{ date('d/m/Y', strtotime($justificacao->created_at))}}
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
    <script src="{{ asset('js/ajax-requests.js') }}" defer></script>

@endsection
