@extends('layouts.admin')
@section('title-page')
    Pré relatório de pedido de aumento de remuneração
@endsection
@section('links')
    <a class="uk-button uk-button-text"
       href="{{route('remuneracao.all')}}">Pedidos</a> / Relatório
@endsection
@section('link')
    Pré relatório de pedido de aumento de remuneração
@endsection
@section('content-main')

    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">

        </div>
        <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$remuneracoes->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-overflow-auto">
                        <table id="tableDatatableRemuneracoes" class="uk-table uk-table-hover uk-table-responsive uk-table-middle uk-table-divider">
                          <thead>
                            <tr>
                                <th id="table-header" class="uk-table-shrink">Requisitante</th>

                                <th id="table-header" class="uk-width-small">Sector</th>

                                <th id="table-header" class="uk-width-small">Situação da requisição</th>

                                <th id="table-header" class="uk-table-shrink">Data de submissão</th>
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
                                        {{ $remuneracao->estado }}
                                    </a>
                                </td>

                                <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                    <a class="uk-link-reset" href="{{ route('remuneracao.show', $remuneracao->id) }}">
                                        {{ date('d-m-Y', strtotime($remuneracao->created_at)) }}</a>
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

    @component('layouts.alertDate')
    @endcomponent
    <script src="{{ asset('js/ajax-requests.js') }}" defer></script>

@endsection
