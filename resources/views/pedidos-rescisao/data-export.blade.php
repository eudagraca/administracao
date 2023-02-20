@extends('layouts.admin')

@section('title-page')
Pré relatório de pedidos de rescisão
@endsection

@section('link')
Pré relatório de pedidos de rescisão
@endsection

@section('links')
Pré relatório de pedidos de rescisão
@endsection

@section('content-main')

    @include('layouts.flash')
    <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        @if(!$pedidosR->isEmpty())
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <div class="uk-overflow-auto">
                <table id="rescisoes-tb" class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                    <thead>
                        <tr>
                            <th id="table-header" class="uk-table-shrink">Data da Requisitação</th>
                            <th id="table-header" class="uk-table-shrink">Requisitante</th>
                            <th id="table-header" class="uk-table-shrink">Data antecedente</th>
                            <th id="table-header" class="uk-table-shrink">Estado</th>
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
