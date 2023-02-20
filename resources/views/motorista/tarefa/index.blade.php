@extends('layouts.admin')

@section('title-page')
    Minhas Tarefas
@endsection
@section('links')
    Minhas Tarefas
@endsection
@section('link')
    Tarefas
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">
        </div>
        <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$minhasTarefas->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-overflow-auto">
                        <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                            <thead>
                            <tr>
                                <th id="table-header" class="uk-table-shrink uk-text-nowrap">Req n°</th>
                                <th id="table-header" class="uk-text-nowrap uk-table-shrink">Dia de saída</th>
                                <th id="table-header" class="uk-text-nowrap uk-table-shrink">Hora de saída</th>
                                <th id="table-header" class="uk-text-nowrap uk-table-shrink">Transporte</th>
                                <th id="table-header" class="uk-text-nowrap uk-table-shrink">Tipo de carga</th>
                                <th id="table-header" class="uk-text-nowrap uk-table-shrink">Prioridade</th>
                                <th id="table-header" class="uk-text-nowrap uk-table-shrink">Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($minhasTarefas as $tarefa)
                                <tr class="uk-background-muted @if($tarefa->requisicaoTransporte->preRequisicao->prioridade == 'Média') table-info @elseif ($tarefa->requisicaoTransporte->preRequisicao->prioridade == 'Alta') table-danger @endif
                                    }}">
                                    <td class="uk-text-bold uk-text-nowrap uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('tarefa.show', $tarefa)}}">
                                            {{ $tarefa->requisicaoTransporte->id }}
                                        </a>
                                    </td>
                                    <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                        <a class="uk-link-reset"
                                           href="{{route('tarefa.show', $tarefa)}}">{{ date('d-m-Y', strtotime($tarefa->requisicaoTransporte->dia_exata)) }}</a>
                                    </td>
                                    <td class="uk-text-normal uk-text-nowrap uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('tarefa.show', $tarefa)}}">
                                            {{ date('H:i', strtotime($tarefa->requisicaoTransporte->hora_exata)) }}
                                        </a>
                                    </td>
                                    <td class="uk-text-normal uk-text-nowrap uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('tarefa.show', $tarefa)}}">
                                            {{ $tarefa->requisicaoTransporte->transporte->marca }}
                                            - {{ $tarefa->requisicaoTransporte->transporte->modelo }}
                                        </a>
                                    </td>
                                    <td class="uk-text-normal uk-text-nowrap uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('tarefa.show', $tarefa)}}">
                                            {{ $tarefa->requisicaoTransporte->preRequisicao->mercadoria }}
                                        </a>
                                    </td>
                                    <td class="uk-text-normal uk-text-nowrap uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('tarefa.show', $tarefa)}}">
                                            {{ $tarefa->requisicaoTransporte->preRequisicao->prioridade }}
                                        </a>
                                    </td>
                                    <td class="uk-text-bold uk-text-nowrap uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('tarefa.show', $tarefa)}}">
                                            {{ ucfirst($tarefa->requisicaoTransporte->preRequisicao->estado) }} |
                                            {{ \Carbon\Carbon::parse($tarefa->requisicaoTransporte->dia_exata )->lt(\Carbon\Carbon::now())? 'Atrasada':'Em dia' }}
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                @component('layouts.empty')
                    @slot('title')
                        Não tens tarefas agendadas
                    @endslot
                @endcomponent
            @endif
        </div>
    </div>
@endsection
