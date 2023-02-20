@extends('layouts.admin')
@section('title-page')
    Pré relatório de pedido de prolongamento
@endsection
@section('links')
    <a class="uk-button uk-button-text"
       href="{{route('prolongamento.all')}}">Requisções</a> / Relatório
@endsection
@section('link')
    Pré relatório de pedido de prolongamento
@endsection
@section('content-main')

    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">

        </div>
        <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$prolongamentos->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-overflow-auto">
                        <table id="tableDatatableProlongamentos" class="uk-table uk-table-hover uk-table-responsive uk-table-middle uk-table-divider">
                            <thead>
                                <tr>
                                    <th id="table-header" class="uk-width-small">Referência</th>
                                    <th id="table-header" class="uk-width-small">Requisitante</th>
                                    <th id="table-header" class="uk-width-small">Sector</th>

                                    <th id="table-header" class="uk-width-small">Data</th>
                                    <th id="table-header" class="uk-table-shrink uk-text-nowrap">Hora do início</th>
                                    <th id="table-header" class="uk-table-shrink uk-text-nowrap">Data da submissão</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prolongamentos as $prolongamento)
                                <tr class="uk-background-muted uk-table-link">
                                    <td class="uk-text-bold uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('prolongamento.show', $prolongamento->id) }}">
                                            {{ $prolongamento->id }}
                                        </a>
                                    </td>
                                    <td class="uk-text-bold uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('prolongamento.show', $prolongamento->id) }}">
                                            {{ $prolongamento->user->name }}
                                        </a>
                                    </td>

                                    <td class="uk-text-normal uk-table-link">
                                        <a class="uk-link-reset" href="{{ route('prolongamento.show', $prolongamento->id) }}">
                                            {{ $prolongamento->sector->name }}
                                        </a>
                                    </td>

                                    <td class="uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('prolongamento.show', $prolongamento->id) }}">
                                            {{ date('d/m/Y', strtotime($prolongamento->dados->data_prolongamento)) }}
                                        </a>
                                    </td>
                                    <td class="uk-text-nowrap uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('prolongamento.show', $prolongamento->id) }}">
                                            {{ date('H:i', strtotime($prolongamento->dados->hora_inicio_prolongamento)) }}
                                        </a>
                                    </td>

                                    <td class="uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('prolongamento.show', $prolongamento->id) }}">
                                            {{ date('d/m/Y', strtotime($prolongamento->created_at)) }}
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
