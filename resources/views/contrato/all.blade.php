@extends('layouts.admin')

@section('title-page')
Encontre contratos
@endsection

@section('link')
Contratos
@endsection

@section('links')
<a href="{{ route('contrato.index') }}" class="uk-button uk-button-text">Contratos</a> / Gerar relatório
@endsection

@section('content-main')
@include('layouts.flash')

<div class="row uk-margin-small-left" id="constratos_list">

    <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        @if(!$contratos->isEmpty())
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <div class="uk-overflow-auto">
                <table id="contratos-tb" class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                    <thead>
                        <tr>
                            <th id="table-header" class="uk-table-shrink">Referência</th>
                            <th id="table-header" class="uk-table-shrink">Nome</th>
                            <th id="table-header" class="uk-width-small">Cargo</th>
                            <th id="table-header" class="uk-width-small">Estado </th>
                            <th id="table-header" class="uk-width-small">Data da assinatura</th>
                            <th id="table-header" class="uk-width-small">Tipo de contrato</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contratos as $contrato)
                        <tr class="uk-background-muted" style="{{ $contrato->estado == 'Rescindido'? 'background: #e5e5e5':'' }}">
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
                                    {{ $contrato->tipo_id }}
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
