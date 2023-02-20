@extends('layouts.admin')

@section('title-page')
    Lista de motoristas
@endsection
@section('links')
    Lista de motoristas
@endsection
@section('link')
    Lista de motoristas
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">
            <a href="{{ route('motorista.create') }}"
               class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-plus-circle"></i> Registar motorista</a>
{{--            <a class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i--}}
{{--                    class="fas fa-plus-circle"></i> Fazer relatório de pedido</a>--}}
        </div>
        <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$motoristas->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-overflow-auto">
                        <table id="avarias-tb" class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                            <thead>
                            <tr>
                                <th id="table-header" class="uk-table-shrink uk-text-nowrap">Nome</th>
                                <th id="table-header" class="uk-table-shrink uk-text-nowrap">Apelido</th>
                                <th id="table-header" class="uk-width-small uk-text-nowrap">Morada</th>
                                <th id="table-header" class="uk-width-small uk-text-nowrap">Número da carta</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($motoristas as $motorista)
                                <tr class="uk-background-muted">
                                    <td class="uk-text-bold  uk-table-link uk-text-normal uk-text-nowrap">
                                        <a class="uk-link-reset" href="{{route('motorista.show', $motorista)}}">
                                        {{ $motorista->name }}
                                        </a>
                                    </td>
                                    <td class="uk-table-link  uk-table-link  uk-text-normal">
                                        <a class="uk-link-reset" href="{{route('motorista.show', $motorista)}}">{{ $motorista->surname }}</a>
                                    </td>
                                    <td class="uk-text-truncate  uk-table-link  uk-text-normal">
                                        <a class="uk-link-reset" href="{{route('motorista.show', $motorista)}}">
                                        {{ $motorista->address }}
                                        </a>
                                    </td>
                                    <td class="uk-text-truncate  uk-table-link  uk-text-normal">
                                        <a class="uk-link-reset" href="{{route('motorista.show', $motorista)}}">
                                        {{ $motorista->licence_number }}
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
