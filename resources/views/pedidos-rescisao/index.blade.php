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

<div class="container">
    @include('layouts.flash')

    <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">
    @if(!empty(Auth::user()->contrato) )
        <a href="{{ route('pedidoRescisao.create') }}"
            class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                class="fas fa-plus-circle"></i> Rescindir contrato</a>
    @endif

    @if(Auth::user()->hasRole('gestor-recursos-humanos'))
        <a href="{{ route('pedidoRescisao.all') }}"
            class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i class="fas fa-list-ol"></i>
            Todos pedidos de rescisão</a>
    @endif

    </div>
    <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        @if(!$pedidosR->isEmpty())
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <div class="uk-overflow-auto">
                <table id="avarias-tb" class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                    <thead>
                        <tr>
                            <th id="table-header" class="uk-table-shrink">Data da Requisitação</th>
                            <th id="table-header" class="uk-table-shrink">Requisitante</th>
                            <th id="table-header" class="uk-table-shrink">Data antecedente</th>
                            <th id="table-header" class="uk-table-shrink">Estado</th>
                            <th id="table-header" class="uk-width-small">Motivo</th>

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


                            <td class="uk-table-link text-truncate uk-text-normal uk-text-truncate">
                                <a class="uk-link-reset" href="{{ route('pedidoRescisao.show', $pedidoR) }}">
                                    {{ $pedidoR->motivo }}</a>
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
<div class="uk-flex uk-flex-center" id="spinner"><span uk-spinner="ratio: 4.5"></span></div>
@endsection
