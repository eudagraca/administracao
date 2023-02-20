@extends('layouts.admin')

@section('title-page')
Advertências
@endsection

@section('link')
Advertências
@endsection

@section('links')
Advertências
@endsection

@section('content-main')
@include('layouts.flash')

<div class="row uk-width-1-1@s uk-padding-small">

    <div class="uk-align-right boundary uk-panel uk-margin-large-right uk-margin-remove-bottom">
        <a href="{{ route('advertencia.create') }}" class="uk-margin-large-left uk-float-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                class="fas fa-plus-circle"></i> Emitir Advertência
        </a>

        @if(Auth::user()->hasRole('gestor-recursos-humanos'))

            <a href="{{ route('advertencia.all') }}"
                class="uk-margin-large-left uk-float-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-plus-circle"></i> Todas advertências
            </a>

        @endif
    </div>
</div>

<div class="row uk-margin-small-left" id="constratos_list">

    <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        @if(!$advertencias->isEmpty())
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <div class="uk-overflow-auto">
                <table id="avarias-tb" class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                    <thead>
                        <tr>
                            <th id="table-header" class="uk-table-shrink">Referência</th>
                            <th id="table-header" class="uk-table-shrink">Data</th>
                            <th id="table-header" class="uk-table-shrink">Funcionario</th>
                            <th id="table-header" class="uk-width-small">Motivo</th>
                            <th id="table-header" class="uk-width-small">Advertido por</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($advertencias as $advertencia)
                        <tr class="uk-background-muted">

                            <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('advertencia.show', $advertencia->id) }}">
                                    {{ $advertencia->id }}</a>
                            </td>

                            <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('advertencia.show', $advertencia->id) }}">
                                    {{ date('d - m - Y', strtotime($advertencia->created_at)) }} às {{ date('H:i', strtotime($advertencia->created_at)) }}</a>
                            </td>

                            <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('advertencia.show', $advertencia->id) }}">
                                    {{ $advertencia->user->name }}</a>
                            </td>

                            <td class="uk-table-link uk-text-normal uk-text-truncate">
                                <a class="uk-link-reset" href="{{ route('advertencia.show', $advertencia->id) }}">
                                    {{ $advertencia->motivo }}</a>
                            </td>

                            <td class="uk-table-link uk-text-normal uk-text-truncate">
                                <a class="uk-link-reset" href="{{ route('advertencia.show', $advertencia->id) }}">
                                    {{ $advertencia->adversor->name }}</a>
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
