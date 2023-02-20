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


        <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$avarias->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-overflow-auto">
                        <table id="tableDatatableAvarias"
                               class="uk-table uk-table-hover uk-table-responsive uk-table-middle uk-table-divider">
                            <thead>
                            <tr>
                                <th id="table-header" class="uk-text-small uk-text-nowrap uk-table-shrink">Código</th>
                                <th id="table-header" class="uk-text-small uk-table-shrink uk-text-nowrap">Est. avaria
                                </th>
                                <th id="table-header" class="uk-text-small uk-width-small">Data de solicitação</th>
                                <th id="table-header" class="uk-text-small uk-table-shrink">Sector</th>
                                <th id="table-header" class="uk-text-small uk-text-nowrap uk-table-shrink">Est.
                                    solicitação
                                </th>
                                <th id="table-header" class="uk-text-small uk-text-nowrap uk-table-shrink">Prioridade
                                </th>
                                <th id="table-header" class="uk-text-small uk-text-nowrap uk-table-shrink">Resposta
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($avarias as $avaria)
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
                                    <td class="uk-text-nowrap uk-text-bold uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('avaria.show', $avaria)}}">
                                            {{ ucfirst($avaria->foi_lida) }}
                                        </a>
                                    </td>
                                    <td class="uk-text-nowrap  uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('avaria.resposta-detalhes', $avaria)}}">
                                            {{ ucfirst($avaria->prioridade) }}
                                        </a>
                                    </td>
                                    <td class="uk-text-nowrap uk-text-small uk-text-bold uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('avaria.resposta-detalhes', $avaria)}}">
                                            {{ $avaria->resposta == NULL? 'Sem resposta': 'Com Resposta'  }}
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
