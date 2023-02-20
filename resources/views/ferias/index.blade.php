@extends('layouts.admin')

@section('title-page')
{{ $title?? 'Lista de pedidos de férias' }}
@endsection
@section('links')
{{ $title?? 'Lista de pedidos de férias' }}
@endsection
@section('link')
    {{ $title?? 'Lista de pedidos de férias' }}
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">

            @auth
            @if(Auth::user()->hasRole('gestor-recursos-humanos'))
            <a href="{{ route('feria.all') }}" class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-list-alt"></i> Encontrar pedidos de férias</a>
            @endif
            @endauth
            <a href="{{ route('feria.create') }}"
               class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-plus-circle"></i> Registar pedido de férias</a>
            <a href="{{ route('feria.subistacao') }}"
               class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-align-center"></i><span class="uk-text-warning"> {{ count($feriaP) }}</span> Lista de substituição</a>
        </div>
        <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$ferias->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-overflow-auto">
                        <table id="avarias-tb"
                               class="uk-table uk-table-hover uk-table-responsive uk-table-middle uk-table-divider">
                            <thead>
                            <tr>
                                <th id="table-header" class="uk-width-small">Requisitante</th>
                                <th id="table-header" class="uk-width-small">Substituto</th>

                                <th id="table-header" class="uk-table-shrink uk-text-nowrap">Parecer do RH</th>
                                <th id="table-header" class="uk-table-shrink uk-text-nowrap">Parecer do Substituto</th>
                                <th id="table-header" class="uk-width-small">Data de início</th>
                                <th id="table-header" class="uk-table-shrink uk-text-nowrap">Data de término</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($ferias as $feria)
                                <tr class="uk-background-muted uk-table-link">
                                    <td class="uk-text-bold uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('feria.show', $feria->id) }}">
                                            {{ $feria->user->name }}
                                        </a>
                                    </td>

                                    <td class="uk-text-normal uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{ route('feria.show', $feria->id) }}">  {{ $feria->substituto->name }}
                                        </a>
                                    </td>

                                    <td class="uk-text-truncate uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('feria.show', $feria->id) }}">
                                            {{ ucfirst($feria->estado) }}
                                        </a>
                                    </td>

                                    <td class="uk-text-truncate uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('feria.show', $feria->id) }}">
                                            {{ $feria->confirmed == 'Sim'?'Aceite': ($feria->confirmed == 'Nao'? 'Negado': 'Pendente') }}
                                        </a>
                                    </td>

                                    <td class="uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('feria.show', $feria->id) }}">
                                            {{ date('d/m/Y', strtotime($feria->data_inicio)) }}
                                        </a>
                                    </td>
                                    <td class="uk-text-nowrap uk-table-link uk-text-normal">
                                        <a class="uk-link-reset" href="{{ route('feria.show', $feria->id) }}">
                                            {{ date('d/m/Y', strtotime($feria->data_termino)) }}
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
