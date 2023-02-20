@extends('layouts.admin')

@section('title-page')
Lista de pedidos de remuneração
@endsection
@section('links')
Lista de pedidos de remuneração
@endsection
@section('link')
Lista de pedidos de remuneração
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')
    <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">
        <a href="{{ route('remuneracao.create') }}"
            class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                class="fas fa-plus-circle"></i> Pedir aumento de
            remuneração</a>
        @auth
        @if(Auth::user()->hasRole('gestor-recursos-humanos'))
        <a href="{{route('remuneracao.all')}}"
            class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                class="fas fa-list-alt"></i> Todos
            pedidos</a>
        @endif
        @endauth

    </div>
    <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        @if(!$remuneracoes->isEmpty())
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <div class="uk-overflow-auto">
                <table id="avarias-tb" class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                    <thead>
                        <tr>
                            <th id="table-header" class="uk-table-shrink">Requisitante</th>
                            <th id="table-header" class="uk-table-shrink">Sector</th>
                            <th id="table-header" class="uk-table-shrink">Data do pedido</th>
                            <th id="table-header" class="uk-width-small">Situação da requisicao</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($remuneracoes as $remuneracao)
                        <tr class="uk-background-muted">
                            <td class="uk-text-bold uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('remuneracao.show', $remuneracao->id) }}">
                                    {{ $remuneracao->user->name }}
                                </a>
                            </td>

                            <td class="uk-text-bold uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('remuneracao.show', $remuneracao->id) }}">
                                    {{ $remuneracao->sector->name }}
                                </a>
                            </td>
                            <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('remuneracao.show', $remuneracao->id) }}">
                                    {{ date('d-m-Y', strtotime($remuneracao->created_at)) }}</a>
                            </td>
                            <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('remuneracao.show', $remuneracao->id) }}">
                                    {{ $remuneracao->estado }}
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
