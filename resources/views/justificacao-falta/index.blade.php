@extends('layouts.admin')

@section('title-page')
Lista de justificações
@endsection
@section('links')
Lista de justificações
@endsection
@section('link')
Lista de justificações
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')
    <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">
        @auth
        @if(Auth::user()->hasRole('gestor-recursos-humanos'))
        <a href="{{ route('justificacao.all') }}" class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                class="fas fa-list-alt"></i> Encontrar justificações</a>
        @endif
        @endauth
        <a href="{{ route('justificacao.create') }}"
            class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                class="fas fa-plus-circle"></i> Enviar justificação</a>
    </div>
    <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        @if(!$justificacoes->isEmpty())
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <div class="uk-overflow-auto">
                <table id="avarias-tb"
                    class="uk-table uk-table-hover uk-table-responsive uk-table-middle uk-table-divider">
                    <thead>
                        <tr>
                            <th id="table-header" class="uk-width-small">Referência</th>
                            <th id="table-header" class="uk-width-small">Colaborador</th>
                            <th id="table-header" class="uk-width-small">Data da submissão</th>

                            <th id="table-header" class="uk-table-shrink uk-text-nowrap">Parecer do chefe</th>
                            <th id="table-header" class="uk-width-small">Parecer do RH</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($justificacoes as $justificacao)
                        <tr class="uk-background-muted uk-table-link">
                            <td class="uk-text-bold uk-table-link uk-text-normal">
                                <a class="uk-link-reset" href="{{ route('justificacao.show', $justificacao->id) }}">
                                    {{ $justificacao->id }}
                                </a>
                            </td>
                            <td class="uk-text-bold uk-table-link uk-text-normal">
                                <a class="uk-link-reset" href="{{ route('justificacao.show', $justificacao->id) }}">
                                    {{ $justificacao->user->name }}
                                </a>
                            </td>

                            <td class="uk-text-normal uk-table-link">
                                <a class="uk-link-reset" href="{{ route('justificacao.show', $justificacao->id) }}">
                                    {{ date('d/m/Y', strtotime($justificacao->created_at))}}
                                </a>
                            </td>

                            <td class="uk-text-nowrap uk-table-link uk-text-normal">
                                <a class="uk-link-reset" href="{{ route('justificacao.show', $justificacao->id) }}">
                                    {{ $justificacao->parecer_chefe?? '____________' }}
                                </a>
                            </td>

                            <td class="uk-table-link uk-text-nowrap uk-text-normal">
                                <a class="uk-link-reset" href="{{ route('justificacao.show', $justificacao->id) }}">
                                    {{ $justificacao->parecer_rh?? '____________' }}
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
