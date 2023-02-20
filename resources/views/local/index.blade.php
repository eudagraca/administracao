@extends('layouts.admin')

@section('title-page')
    Lista de locais
@endsection
@section('links')
    Lista de locais
@endsection
@section('link')
    Lista de locais
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">
            <a href="{{ route('local.create') }}"
               class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-plus-circle"></i> Registar local</a>
        </div>
        <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$locais->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-overflow-auto">
                        <table id="avarias-tb" class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                            <thead>
                            <tr>
                                <th id="table-header" class="uk-table-shrink uk-text-nowrap">Nome</th>
                                <th id="table-header" class="uk-table-shrink uk-text-nowrap">Endereço</th>
                                <th id="table-header" class="uk-width-small uk-text-nowrap">Designação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($locais as $local)
                                <tr class="uk-background-muted">
                                    <td class="uk-text-bold  uk-table-link uk-text-normal uk-text-nowrap">
                                        <a class="uk-link-reset" href="{{route('local.show', $local)}}">
                                        {{ $local->name }}
                                        </a>
                                    </td>
                                    <td class="uk-table-link  uk-table-link  uk-text-normal">
                                        <a class="uk-link-reset" href="{{route('local.show', $local)}}">{{ $local->endereco }}</a>
                                    </td>
                                    <td class="uk-text-truncate  uk-table-link  uk-text-normal">
                                        <a class="uk-link-reset" href="{{route('local.show', $local)}}">
                                        {{ $local->designacao }}
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
