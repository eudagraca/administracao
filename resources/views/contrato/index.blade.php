@extends('layouts.admin')

@section('title-page')
Contratos
@endsection

@section('link')
Contratos
@endsection

@section('links')
Contratos
@endsection

@section('content-main')
@include('layouts.flash')

<div class="row uk-width-1-1@s uk-padding-small">

    <div class="uk-align-right boundary uk-flex uk-flex-right uk-panel uk-margin-large-right uk-margin-remove-bottom">
        @if(Auth::user()->hasRole('gestor-recursos-humanos'))

        <a href="{{ route('contrato.all') }}" class="uk-margin-large-left uk-float-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                class="fas fa-list-ol"></i> Encontrar todos contratos
        </a>

        @endif

        <button class="uk-margin-large-left uk-float-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                class="fas fa-plus-circle"></i> Elaborar contrato
        </button>

        <div uk-dropdown="boundary: .boundary">
            <ul class="uk-nav uk-dropdown-nav">
                <li class="uk-nav-header">Elaborar Contrado de</li>
                <li class="uk-nav-divider"></li>
                <li class="uk-active uk-text-normal"><a href="{{route('contrato.createCps')}}">Contrato de Prestação de
                        serviço</a></li>
                <li class="uk-active uk-text-normal"><a href="{{ route('contrato.create') }}">Contrato de trabalho</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="row uk-margin-small-left" id="constratos_list">

    <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        @if(!$contratos->isEmpty())
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <div class="uk-overflow-auto">
                <table id="avarias-tb" class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                    <thead>
                        <tr>
                            <th id="table-header" class="uk-table-shrink">Referência</th>
                            <th id="table-header" class="uk-table-shrink">Nome</th>
                            <th id="table-header" class="uk-width-small">Cargo</th>
                            <th id="table-header" class="uk-width-small">Estado </th>
                            <th id="table-header" class="uk-width-small">Data da assinatura</th>
                            <th id="table-header" class="uk-width-small">Entrou em vigor a</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contratos as $contrato)
                        <tr class="uk-background-muted" style="{{ $contrato->estado == 'Rescindido'? 'back':'' }}">
                            <td class="uk-text-bold uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('contrato.show', $contrato->id) }}">
                                    {{ $contrato->id }}
                                </a>
                            </td>
                            <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('contrato.show', $contrato->id) }}">
                                    {{ $contrato->name }}
                                </a>
                            </td>

                            <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('contrato.show', $contrato->id) }}">
                                    {{ $contrato->cargo }}
                                </a>
                            </td>
                            <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('contrato.show', $contrato->id) }}">
                                    {{ $contrato->estado }}
                                </a>
                            </td>
                            <td class="uk-text-truncate uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('contrato.show', $contrato->id) }}">
                                    {{ date('d/m/Y', strtotime($contrato->created_at)) }}
                                </a>
                            </td>
                            <td class="uk-text-truncate uk-table-link uk-text-normal uk-text-nowrap">
                                <a class="uk-link-reset" href="{{ route('contrato.show', $contrato->id) }}">
                                    {{ date('d/m/Y', strtotime($contrato->data_contrato_vigor)) }}
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
<div class="uk-flex uk-flex-center" id="spinner"><span uk-spinner="ratio: 4.5"></span></div>
@endsection
