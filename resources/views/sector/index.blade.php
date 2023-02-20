@extends('layouts.admin')

@section('title-page')
    Lista de sectores
@endsection
@section('links')
    Lista de sectores
@endsection
@section('link')
    Lista de sectores
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">
            <a href="{{ route('sector.create') }}"
               class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-plus-circle"></i> Registar sector</a>
            <a class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-plus-circle"></i> Troca de sector</a>
        </div>
        <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$sectores->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-overflow-auto">
                        <table id="avarias-tb" class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                            <thead>
                            <tr>
                                <th id="table-header" class="uk-table-shrink uk-text-nowrap">Sector</th>
                                <th id="table-header" class="uk-table-shrink uk-text-nowrap">Responável</th>
                                <th id="table-header" class="uk-table-shrink uk-text-nowrap">N° de colaboradores</th>
                                <th id="table-header" class="uk-table-shrink uk-text-right uk-margin-large-right">
                                    Acção
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($sectores as $sector)
                                <tr class="uk-background-muted">
                                    <td class="uk-table-link">
                                        <a class="uk-link-reset" href="">{{ $sector->name }}</a>
                                    </td>
                                    <td class="uk-text-nowrap">{{ $sector->user->name }}</td>
                                    <td class="uk-text-nowrap">{{ count($sector->users) }}</td>
                                    <td class="uk-text-nowrap">
                                        <p uk-margin class="uk-align-right">
                                            <a
                                                href="{{ route('sector.edit', $sector) }}"
                                                class="uk-button uk-button-default uk-border-rounded uk-text-bold uk-box-shadow-hover-medium">Editar</a>
                                        </p>
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
