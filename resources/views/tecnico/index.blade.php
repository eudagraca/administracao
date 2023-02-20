@extends('layouts.admin')

@section('title-page')
    Lista de técnicos
@endsection
@section('links')
    Lista de técnicos
@endsection
@section('link')
    Lista de técnicos
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">
            <a href="{{ route('tecnico.create') }}"
               class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-plus-circle"></i> Registar técnico</a>
        </div>
        <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$tecnicos->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-overflow-auto">
                        <table id="avarias-tb"
                               class="uk-table uk-table-hover uk-table-responsive uk-table-middle uk-table-divider">
                            <thead>
                            <tr>
                                <th id="table-header" class="uk-width-small">Nome</th>
                                <th id="table-header" class="uk-width-small">Área de trabalho</th>
                                <th id="table-header" class="uk-width-small">Morada</th>
                                <th id="table-header" class="uk-table-shrink">Contacto</th>
                                <th id="table-header" class="uk-width-small">Sexo</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tecnicos as $tecnico)
                                <tr class="uk-background-muted uk-table-link">
                                    <td class="uk-text-bold uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('tecnico.show', $tecnico) }}">
                                            {{ $tecnico->name }}
                                        </a>
                                    </td>

                                    <td class="uk-text-normal uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{ route('tecnico.show', $tecnico) }}">  {{ $tecnico->area }}
                                        </a>
                                    </td>
                                    <td class="uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('tecnico.show', $tecnico) }}">
                                            {{ $tecnico->morada }}
                                        </a>
                                    </td>
                                    <td class="uk-text-truncate uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('tecnico.show', $tecnico) }}">
                                            {{ $tecnico->phone }}
                                        </a>
                                    </td>
                                    <td class="uk-text-truncate uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('tecnico.show', $tecnico) }}">
                                            {{ $tecnico->gender }}
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
