@extends('layouts.admin')

@section('title-page')
    Lista de transportes
@endsection
@section('links')
    Lista de transportes
@endsection
@section('link')
    Lista de transportes
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">
            <a href="{{ route('transportes.create') }}"
               class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-plus-circle"></i> Registar
                transporte</a>
            <a href="{{route('requisicaoTransporte.index')}}"
               class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-route"></i>Requisições de transporte</a>
        </div>
        <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$transportes->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-overflow-auto">
                        <table id="avarias-tb" class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                            <thead>
                            <tr>
                                <th id="table-header" class="uk-table-shrink">Matrícula</th>
                                <th id="table-header" class="uk-table-shrink">Veículo</th>
                                <th id="table-header" class="uk-width-small">Modelo</th>
                                <th id="table-header" class="uk-width-small">Marca</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($transportes as $transporte)
                                <tr class="uk-background-muted">
                                    <td class="uk-text-bold uk-table-link uk-text-normal uk-text-nowrap">
                                        <a class="uk-link-reset" href="{{ route('transportes.show', $transporte) }}">
                                        {{ $transporte->matricula }}
                                        </a>
                                    </td>
                                    <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                        <a class="uk-link-reset" href="{{ route('transportes.show', $transporte) }}">
                                            {{ $transporte->veiculo }}</a>
                                    </td>
                                    <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                        <a class="uk-link-reset" href="{{ route('transportes.show', $transporte) }}">
                                        {{ $transporte->modelo }}
                                        </a>
                                    </td>
                                    <td class="uk-text-truncate uk-table-link uk-text-normal uk-text-nowrap">
                                        <a class="uk-link-reset" href="{{ route('transportes.show', $transporte) }}">
                                        {{ $transporte->marca }}
                                        </a>
                                    </td>
                                </tr>@endforeach </tbody>
                        </table>
                    </div>
                </div>
            @else
                @include('layouts.empty')
            @endif
        </div>
    </div>
@endsection
