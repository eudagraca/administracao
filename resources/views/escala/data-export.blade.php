@extends('layouts.admin')
@section('title-page')
    Pré relatório de escala
@endsection
@section('links')
    <a class="uk-button uk-button-text"
       href="{{route('requisicaoTransporte.index')}}">Requisções</a> / Relatório
@endsection
@section('link')
    Pré relatório de escala
@endsection
@section('content-main')

    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">

        </div>
        <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$escalas->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-overflow-auto">
                        <table id="tableDatatableEscalas" class="uk-table uk-table-hover uk-table-responsive uk-table-middle uk-table-divider">
                            <thead>
                                <tr>
                                    <th id="table-header" class="uk-width-small">Referência</th>
                                    <th id="table-header" class="uk-width-small">Requisitante</th>
                                    <th id="table-header" class="uk-width-small">Sector</th>
                                    <th id="table-header" class="uk-width-small">Data da nova escala</th>
                                    <th id="table-header" class="uk-table-shrink uk-text-nowrap">Hora da nova escala</th>

                                    <th id="table-header" class="uk-width-small">Data da submissão</th>

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

                                    <td class="uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('escala.show', $escala->id) }}">
                                            {{ date('d/m/Y', strtotime($escala->created_at)) }}
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
