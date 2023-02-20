@extends('layouts.admin')

@section('title-page')
Pedidos de rescisão
@endsection

@section('link')
Pedidos de rescisão
@endsection

@section('links')
Pedidos de rescisão
@endsection

@section('content-main')

    @include('layouts.flash')

    <div class="uk-width-1-1@s uk-grid">

        <div class="uk-width-1-4@s">
            <label for="data_search" class="uk-form-label">Data inicial</label>
            <input class="uk-input" id="data_search" name="data_inicial" data-uk-datepicker="{format:'DD.MM.YYYY'}"
                placeholder="Data inicial  (Ano/mm/dd)" autocomplete="off" />
        </div>

        <div class="uk-width-1-4@s">
            <label for="data_search_two" class="uk-form-label">Data final</label>
            <input class="uk-input" id="data_search_two" name="data_final" data-uk-datepicker="{format:'DD.MM.YYYY'}"
                placeholder="Data final  (Ano/mm/dd)" autocomplete="off" />
        </div>
        <div class="uk-width-1-4@s">
            <label for="user_id" class="uk-form-label">Usuário</label>
            <input id="user_search" class="uk-input" placeholder="Nome do usuário">
            <input hidden name="user" id="user_id" class="uk-input" placeholder="Nome do usuário">
        </div>

        <div class="uk-width-1-3@s uk-margin-top">
            <button id="btn_report_rescisoes"
                class="uk-button uk-text-normal uk-button-danger uk-box-shadow-hover-large uk-border-rounded">
                <span><img width="20px" src="{{  url("storage/icons/pdf.svg") }}"></span>
                Emitir relatório
            </button>
        </div>

        <div class="uk-width-1-4@s uk-margin-top">
            <button id="reset"
                class="uk-button uk-text-normal uk-button-secondary uk-box-shadow-hover-large uk-border-rounded">
                Limpar campos
            </button>
        </div>

    </div>
    <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        @if(!$pedidosR->isEmpty())
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <div class="uk-overflow-auto">
                <table id="avarias-tb" class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                    <thead>
                        <tr>
                            <th id="table-header" class="uk-table-shrink">Data da Requisitação</th>
                            <th id="table-header" class="uk-table-shrink">Requisitante</th>
                            <th id="table-header" class="uk-table-shrink">Data antecedente</th>
                            <th id="table-header" class="uk-table-shrink">Estado do pedido</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidosR as $pedidoR)
                        <tr class="uk-background-muted">

                            <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('pedidoRescisao.show', $pedidoR) }}">
                                    {{ date('d/m/Y', strtotime($pedidoR->created_at)) }}</a>
                            </td>

                            <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('pedidoRescisao.show', $pedidoR) }}">
                                    {{ $pedidoR->user->name }}</a>
                            </td>


                            <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('pedidoRescisao.show', $pedidoR) }}">
                                    {{ date('d/m/Y', strtotime($pedidoR->antecedencia)) }}</a>
                            </td>

                            <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('pedidoRescisao.show', $pedidoR) }}">
                                    {{ ucfirst($pedidoR->estado) }}</a>
                            </td>



                        </tr>@endforeach </tbody>
                </table>
            </div>
        </div>
        @else

        @include('layouts.empty')
        @endif
    </div>
<div class="uk-flex uk-flex-center" id="spinner"><span uk-spinner="ratio: 4.5"></span></div>
@endsection
