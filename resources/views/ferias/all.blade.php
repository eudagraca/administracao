@extends('layouts.admin')

@section('title-page')
Encontre ferias
@endsection
@section('links')
<a class="uk-button uk-button-text" href="{{route('escala.index')}}">ferias</a> / Relatorio
@endsection
@section('link')
Encontre ferias
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')

    <div class="uk-width-1-1@s uk-padding-small uk-grid">


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
            <label for="sector_id" class="uk-form-label">Sector</label>
            <input class="uk-input" id="sector_search" placeholder="Sector" />
            <input hidden name="sector_id" id="sector_id" />

        </div>

        <div class="uk-width-1-4@s">
            <label for="status" class="uk-form-label">Estado da requisção</label>
            <select class="uk-select" name="estado" id="estado_search">
                <option value="" selected>Seleccione um estado</option>
                <option value="andamento">Andamento</option>
                <option value="concluido">Concluído</option>
                <option value="pendente">Pendente</option>
            </select>
        </div>

        <div class="uk-width-1-4@s uk-margin-small-top">
            <label for="user_id" class="uk-form-label">Usuário</label>
            <input id="user_search" class="uk-input" placeholder="Nome do usuário">
            <input hidden name="user" id="user_id" class="uk-input" placeholder="Nome do usuário">
        </div>

        <div class="uk-width-1-4@s uk-margin-small-top">
            <label for="sucursal" class="uk-form-label">Sucursal</label>
            <select class="uk-select" name="sucursal" id="sucursal_search">
                <option value="" selected>Seleccione a sucursal</option>
                <option value="Matema Sede">Matema Sede</option>
                <option value="Sucursal Cidade">Sucursal Cidade</option>
                <option value="Sucursal Moatize">Sucursal Moatize</option>
            </select>
        </div>


        <div class="uk-width-1-4@s uk-margin-small-top">
            <label for="tecnico_search" class="uk-form-label">Técnico</label>
            <input id="tecnico_search" class="uk-input" placeholder="Nome do técnico">
            <input hidden name="tecnico" id="tecnico_id" class="uk-input">
        </div>
        <div class="uk-width-1-3@s uk-margin-top">
            <button id="btn_report_avarias"
                class="uk-button uk-text-normal uk-button-danger uk-box-shadow-hover-large uk-border-rounded">
                <span><img width="20px" src="{{  url("storage/icons/pdf.svg") }}"></span>
                Emitir relatório
            </button>
        </div>

        <div class="uk-width-1-3@s uk-margin-top">
            <button id="reset"
                class="uk-button uk-text-normal uk-button-secondary uk-box-shadow-hover-large uk-border-rounded">
                Limpar campos
            </button>
        </div>

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

                            <th id="table-header" class="uk-table-shrink">Estado</th>
                            <th id="table-header" class="uk-width-small">Data de início</th>
                            <th id="table-header" class="uk-table-shrink">Data de término</th>

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
                                <a class="uk-link-reset" href="{{ route('feria.show', $feria->id) }}">
                                    {{ $feria->substituto->name }}
                                </a>
                            </td>

                            <td class="uk-text-truncate uk-table-link uk-text-normal">
                                <a class="uk-link-reset" href="{{ route('feria.show', $feria->id) }}">
                                    {{ ucfirst($feria->estado) }}
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
@component('layouts.alertDate')
@endcomponent
@endsection
