@extends('layouts.admin')

@section('title-page')
    Todas avarias
@endsection
@section('links')
    <a class="uk-button uk-button-text" href="{{route('avaria.index')}}">Avarias</a> / Todas
@endsection
@section('link')
    Todas avarias
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">
            <a href="{{ route('avaria.create') }}"
               class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-plus-circle"></i> Registar avaria</a>
        </div>
        @if(Auth::check() && !Auth::user()->hasRole('gestor-manutencao') && !$avarias)

            <p class="uk-margin-medium-left">
                Simbolos
                <br>
                &ensp;<i class="fas fa-clipboard"></i> Resposta da avaria</p>

        @endif
        <div class="uk-width-1-1@s uk-padding-small uk-grid">


            <div class="uk-width-1-4@s">
                <label for="data_search" class="uk-form-label">Data inicial</label>
                <input class="uk-input"
                       id="data_search" name="data_inicial"
                       data-uk-datepicker="{format:'DD.MM.YYYY'}"
                       placeholder="Data inicial  (Ano/mm/dd)"
                       autocomplete="off"/>
            </div>

            <div class="uk-width-1-4@s">
                <label for="data_search_two" class="uk-form-label">Data final</label>
                <input class="uk-input"
                       id="data_search_two" name="data_final"
                       data-uk-datepicker="{format:'DD.MM.YYYY'}"
                       placeholder="Data final  (Ano/mm/dd)"
                       autocomplete="off"/>
            </div>

            <div class="uk-width-1-4@s">
                <label for="sector_id" class="uk-form-label">Sector</label>
                <input class="uk-input" id="sector_search" placeholder="Sector"/>
                <input hidden name="sector_id" id="sector_id"/>

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
            @if(!$totalAvarias->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-overflow-auto">
                        <table id="avarias-tb-ralatorio"
                               class="uk-table uk-table-hover uk-table-responsive uk-table-middle uk-table-divider">
                            <thead>
                            <tr>
                                <th id="table-header" class="uk-text-small uk-text-nowrap uk-table-shrink">Código</th>
                                <th id="table-header" class="uk-text-small uk-table-shrink uk-text-nowrap">Est. avaria
                                </th>
                                <th id="table-header" class="uk-text-small uk-width-small">Data de solicitação</th>
                                <th id="table-header" class="uk-text-small uk-table-shrink">Sector</th>

                                <th id="table-header" class="uk-text-small uk-text-nowrap uk-table-shrink">Prioridade
                                </th>
                                <th id="table-header" class="uk-text-small uk-text-nowrap uk-table-shrink">Tempo de resposta
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($totalAvarias as $avaria)
                                <tr class="uk-background-muted {{ $avaria->prioridade == 'média'? 'table-warning': ($avaria->prioridade == 'alta'? ('table-danger'):'table-light') }} uk-background-blend-multiply">
                                    <td class="uk-text-bold uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('avaria.show', $avaria)}}">
                                            {{ $avaria->id }}
                                        </a>
                                    </td>
                                    <td class="uk-text-truncate uk-table-link uk-text-bold">
                                        <a class="uk-link-reset"
                                           href="{{route('avaria.show', $avaria)}}"> {{ ucfirst($avaria->estado) }} </a>
                                    </td>
                                    <td class="uk-text-nowrap uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('avaria.show', $avaria)}}">
                                            {{ date( 'd / m / Y' , strtotime($avaria->created_at)) }}
                                            às {{ date( 'H:i' , strtotime($avaria->created_at)) }}
                                        </a>
                                    </td>
                                    <td class="uk-text-nowrap uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('avaria.show', $avaria)}}">
                                            {{ $avaria->sector->name }}
                                        </a>
                                    </td>

                                    <td class="uk-text-nowrap  uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('avaria.resposta-detalhes', $avaria)}}">
                                            {{ ucfirst($avaria->prioridade) }}
                                        </a>
                                    </td>

                                    <td class="uk-text-nowrap uk-text-bold uk-table-link">
                                        <a class="uk-link-reset" href="{{route('avaria.show', $avaria)}}">
                                            {{ ucfirst($avaria->foi_lida) }}
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
