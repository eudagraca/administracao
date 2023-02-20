@extends('layouts.admin')

@section('title-page')
    Lista de fornecedores
@endsection
@section('links')
    Lista de fornecedores
@endsection
@section('link')
    Lista de fornecedores
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        @auth
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">

                @if(Auth::user()->hasRole('gestor-manutencao') || Auth::user()->hasRole('super-admin'))
            <a href="{{ route('fornecedor.create') }}"
               class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-plus-circle"></i> Registar fornecedor</a>
        @endif
        </div>


        @endauth
        <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$fornecedores->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-overflow-auto">
                        <table id="avarias-tb"
                               class="uk-table uk-table-hover uk-table-responsive uk-table-middle uk-table-divider">
                            <thead>
                            <tr>
                                <th id="table-header" class="uk-width-small">Nome</th>
                                <th id="table-header" class="uk-width-small">Endereço</th>
                                <th id="table-header" class="uk-table-shrink">Contacto</th>
                                <th id="table-header" class="uk-width-small">Nuit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($fornecedores as $fornecedor)
                                <tr class="uk-background-muted uk-table-link">
                                    <td class="uk-text-bold uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('fornecedor.show', $fornecedor) }}">
                                            {{ $fornecedor->nome }}
                                        </a>
                                    </td>

                                    <td class="uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('fornecedor.show', $fornecedor) }}">
                                            {{ $fornecedor->endereco }}
                                        </a>
                                    </td>
                                    <td class="uk-text-truncate uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('fornecedor.show', $fornecedor) }}">
                                            {{ $fornecedor->contacto }}
                                        </a>
                                    </td>
                                    <td class="uk-text-truncate uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('fornecedor.show', $fornecedor) }}">
                                            {{ $fornecedor->nuit }}
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
