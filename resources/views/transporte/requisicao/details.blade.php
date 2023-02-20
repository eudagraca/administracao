@extends('layouts.admin')

@section('title-page')
    Resposta à solicitação de transporte
@endsection
@section('links')
    <a class="uk-button uk-button-text" href="{{ route('requisicaoTransporte.index') }}">Requisições</a> / Resposta
@endsection
@section('link')
    Resposta à solicitação de transporte
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        @error('id')
        <div class="alert uk-alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <p>{{ $message}}</p>
        </div>
        @enderror
        <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">
                <form id="data" method="POST" action="{{ route('requisicaoTransporte.update', $preRequisicao->id) }}"
                      class="uk-form-stacked">
                    <div class="uk-card-badge uk-label ">{{ $preRequisicao->sector->name }}</div>
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="uk-card-body  uk-margin uk-grid">
                        <div class="uk-align-right uk-width-1-1 uk-margin-remove-bottom">
                            <div class="uk-align-right">
                                @if(Auth::check() and Auth::user()->hasRole('gestor-administracao') and $preRequisicao->estado == 'entregue' )
                                    <a href="{{route('requisicao.export', $preRequisicao->id)}}"
                                       class="uk-button uk-button-secondary uk-text-bolder uk-border-rounded uk-box-shadow-hover-large  uk-margin-top uk-align-right"><i
                                            class="fas fa-file-pdf"></i> IMPRIMIR</a>
                                @endif
                                <hr class="uk-divider-small uk-flex-right">
                                <label>Referência</label>
                                <div class="uk-width-1-1">
                                    <p class="uk-h4 uk-text-muted uk-text-normal uk-align-right uk-margin-remove-bottom">{{ $preRequisicao->requisicao->id }}</p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="uk-width-1-1@s uk-margin-medium-left {{ $preRequisicao->estado == 'pendente'? 'uk-alert-primary': ( $preRequisicao->estado == 'entregue' ? ( 'uk-alert-success' ) : ('uk-alert-warning'))  }}"
                            uk-alert>
                            A requisição está em estado de :
                            {{ $preRequisicao->estado }}
                        </div>
                        <div class="uk-width-1-4@s">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Remetente') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove">

                                <p class="uk-text-normal">{{ $preRequisicao->user->name }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-4@s">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Respondido por:') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove">

                                <p class="uk-text-normal">{{ $preRequisicao->requisicao->user->name }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-4@s">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Sector') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove">

                                <p class="uk-text-normal">{{ $preRequisicao->sector->name }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-4@s">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Mercadoria') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove">
                                <p class="uk-text-normal">{{ $preRequisicao->mercadoria }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-4@s uk-margin">
                            <label for="origem" class="uk-form-label">
                                {{ __('Origem') }}
                            </label>
                            <div class="uk-placeholder uk-padding-small uk-margin-remove">
                                <p class="uk-text-normal">{{ $preRequisicao->origem }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-4@s uk-margin">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Destino') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove">

                                <p class="uk-text-normal">{{ $preRequisicao->local->name }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-3@s uk-margin">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Motorista') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove">

                                <p class="uk-text-normal">{{ $preRequisicao->requisicao->motorista->name }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-3@s">
                            <label for="origem" class="uk-form-label">
                                {{ __('Transporte') }}
                            </label>
                            <div class="uk-placeholder uk-padding-small uk-margin-remove">
                                <p class="uk-text-normal">{{ $preRequisicao->requisicao->transporte->marca }}</p>
                            </div>
                        </div>


                        <div class="uk-width-1-3@s ">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Dia de saída') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove">
                                <p class="uk-text-normal">{{ $preRequisicao->requisicao->dia_exata != NULL? date('d-m-Y', strtotime($preRequisicao->requisicao->dia_exata)) :'Não defenida' }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-3@s ">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Hora de saída') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove">
                                <p class="uk-text-normal">{{ date('H:i', strtotime($preRequisicao->requisicao->dia_exata))}}</p>
                            </div>
                        </div>

                        @if($preRequisicao->mercadoria == "Mercadoria")
                            <div class="uk-width-1-2@s uk-margin">
                                <label for="obseracao" class="uk-form-label">
                                    {{ __('Volume') }}
                                </label>
                                <div class="uk-width-1-1 uk-placeholder uk-padding-small">

                                    <p class="uk-text-normal">{{ $preRequisicao->volume.' '.ucfirst($preRequisicao->unidade) }}</p>
                                </div>
                            </div>
                        @elseif($preRequisicao->mercadoria == "Pessoas")
                            <div class="uk-width-1-2@s uk-margin">
                                <label for="obseracao" class="uk-form-label">
                                    {{ __('Acompanhantes') }}
                                </label>
                                <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove-top">
                                    @foreach($preRequisicao->pessoas as $pessoa)
                                        <p class="uk-text-normal">{{ $pessoa->nome }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="uk-width-1-2@s uk-margin">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Observações') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove-top">

                                <p class="uk-text-normal">{{ $preRequisicao->requisicao->observacoes?? '____________________________' }}</p>
                            </div>
                        </div>

                        @if($preRequisicao->estado != 'pendente' and ($preRequisicao->requisicao->tarefa))

                            <div class="uk-width-1-4@s">
                                <label for="obseracao" class="uk-form-label">
                                    {{ __('Dia e hora de saída') }}
                                </label>
                                <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove-top">
                                    <p class="uk-text-normal">{{ date('d-m-Y', strtotime($preRequisicao->requisicao->tarefa->start_at))??'_________' }}
                                        às {{date('H:i', strtotime($preRequisicao->requisicao->tarefa->start_at))??'__________' }}
                                    </p>
                                </div>
                            </div>

                            <div class="uk-width-1-4@s">
                                <label for="obseracao" class="uk-form-label">
                                    {{ __('Dia e hora de conclusão') }}
                                </label>
                                <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove-top">
                                    @if($preRequisicao->requisicao->tarefa->end_at != NULL )
                                        <p class="uk-text-normal">{{ date('d-m-Y', strtotime($preRequisicao->requisicao->tarefa->end_at))??'_______' }}
                                            às {{date('H:i', strtotime($preRequisicao->requisicao->tarefa->end_at))??'_______' }}
                                        </p>

                                    @else
                                        <p class="uk-text-normal">_______________________
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="uk-width-1-4@s">
                                <label for="obseracao" class="uk-form-label">
                                    {{ __('Tempo gasto') }}
                                </label>
                                <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove-top">
                                    @if($preRequisicao->requisicao->tarefa->end_at != NULL )
                                        <p class="uk-text-normal">{{ (Carbon\Carbon::parse($preRequisicao->requisicao->tarefa->end_at)->diffForHumans(\Carbon\Carbon::parse($preRequisicao->requisicao->dia_exata)))??'_____________'}}
                                        </p>
                                    @else
                                        <p class="uk-text-normal">_______________________
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div class="uk-width-1-4@s">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Tempo estimado de viajem') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove-top">
                                <p class="uk-text-normal">{{ $preRequisicao->tempo_viajem}}
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
