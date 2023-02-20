@extends('layouts.admin')

@section('title-page')
Alterações de escala
@endsection
@section('links')
Alterações de escala
@endsection
@section('link')
    Alterações de escala
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">

            @auth
            @if(Auth::user()->hasRole('gestor-recursos-humanos'))
            <a href="{{ route('escala.all') }}" class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-list-alt"></i> Encontrar escalas</a>
            @endif
            @endauth
            <a href="{{ route('escala.create') }}"
               class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-plus-circle"></i> Registar alteração de escala</a>
        </div>
        <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$escalas->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-overflow-auto">
                        <table id="avarias-tb"
                               class="uk-table uk-table-hover uk-table-responsive uk-table-middle uk-table-divider">
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
                                        <a class="uk-link-reset"
                                           href="{{ route('escala.show', $escala->id) }}">  {{ $escala->sector->name }}
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
@endsection
