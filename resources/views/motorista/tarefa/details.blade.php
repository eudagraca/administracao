@extends('layouts.admin')

@section('title-page')
    Requisição {{$preRequisicao->requisicao->id }}
@endsection
@section('links')
    <a class="uk-button uk-button-text"
       href="{{ route('tarefa.index') }}">Tarefas</a> / {{$preRequisicao->requisicao->id }}
@endsection
@section('link')
    Tarefa
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
                <form id="estado-task" method="POST" action="{{ route('tarefa.update', $tarefa->id) }}"
                      class="uk-form-stacked">
                    <div class="uk-card-badge uk-label ">{{ $preRequisicao->sector->name }}</div>
                    {{ csrf_field() }}
                    @method('PUT')

                    <input name="pre_requisicao" hidden value="{{ $preRequisicao->id}}">
                    <div class="uk-card-body  uk-margin uk-grid">
                        <div class="uk-align-right uk-width-1-1">
                            <div class="uk-align-right">
                                <hr class="uk-divider-small uk-flex-right">
                                <label>Referência</label>
                                <div class="uk-width-1-1">
                                    <p class="uk-h4 uk-text-muted uk-text-normal uk-align-right uk-margin-remove-bottom">{{ $preRequisicao->requisicao->id }}</p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="uk-width-1-1@s uk-margin-medium-left uk-margin-remove-top {{ $preRequisicao->estado == 'pendente'? 'uk-alert-primary': ( $preRequisicao->estado == 'entregue' ? ( 'uk-alert-success' ) : ('uk-alert-warning'))  }}"
                            uk-alert>
                            A requisição está em estado de :
                            {{ ucfirst($preRequisicao->estado) }}
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
                                {{ __('Data de saída') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove">
                                <p class="uk-text-normal">{{ date('d-m-Y', strtotime($preRequisicao->requisicao->dia_exata)) }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-3@s ">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Hora de saída') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove">
                                <p class="uk-text-normal">{{ date('H:i', strtotime($preRequisicao->requisicao->dia_exata )) }}</p>
                            </div>
                        </div>

                        @if($preRequisicao->mercadoria == "Mercadoria")
                            <div class="uk-width-1-2@s uk-margin">
                                <label for="obseracao" class="uk-form-label">
                                    {{ __('Volume') }}
                                </label>
                                <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove-top">

                                    <p class="uk-text-normal">{{ ucfirst($preRequisicao->volume) }}</p>
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
                                <p class="uk-text-normal">{{ $preRequisicao->requisicao->observacoes?? '______________________' }}</p>
                            </div>
                        </div>

                        @if(Auth::user()->hasRole('motorista'))
                            @if($preRequisicao->estado == 'pendente')
                                <div class="uk-width-1-2@s">
                                    <label for="estado" class="uk-form-label">
                                        {{ __('Já / está a iniciar com a actividade? ') }}
                                    </label>
                                    <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove">
                                        <div class="uk-form-control">
                                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">

                                                <label class="uk-text-small">
                                                    <input class="uk-radio" type="radio" id="id_estado"
                                                           name="estado" required
                                                           value="andamento"> Sim</label>

                                                <label class="uk-text-small">
                                                    <input class="uk-radio" type="radio" id="id_estado"
                                                           name="estado" required
                                                           value="pendente"> Não </label>
                                                @error('estado')
                                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($preRequisicao->estado == 'andamento')

                                <div class="uk-width-1-4@s">
                                    <label for="obseracao" class="uk-form-label">
                                        {{ __('Já concluíu a actividade? ') }}
                                    </label>
                                    <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove">
                                        <div class="uk-form-control">
                                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                                <label class="uk-text-small">
                                                    <input class="uk-radio" type="radio" id="id_estado"
                                                           name="estado" required
                                                           value="entregue"> Sim </label>

                                                <label class="uk-text-small">
                                                    <input class="uk-radio" type="radio" id="id_estado"
                                                           name="estado" required
                                                           value="andamento"> Não </label>

                                                @error('estado')
                                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @elseif($preRequisicao->estado == 'entregue')

                                <div class="uk-width-1-4@s">
                                    <label for="obseracao" class="uk-form-label">
                                        {{ __('Dia e hora de saída') }}
                                    </label>
                                    <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove-top">
                                        <p class="uk-text-normal">{{ date('d-m-Y', strtotime($preRequisicao->requisicao->tarefa->start_at)) }}
                                            às {{date('H:i', strtotime($preRequisicao->requisicao->tarefa->start_at)) }}
                                        </p>
                                    </div>
                                </div>

                                <div class="uk-width-1-4@s">
                                    <label for="obseracao" class="uk-form-label">
                                        {{ __('Dia e hora de conclusão') }}
                                    </label>
                                    <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove-top">
                                        <p class="uk-text-normal">{{ date('d-m-Y', strtotime($preRequisicao->requisicao->tarefa->end_at)) }}
                                            às {{date('H:i', strtotime($preRequisicao->requisicao->tarefa->end_at)) }}
                                        </p>
                                    </div>
                                </div>

                                <div class="uk-width-1-4@s">
                                    <label for="obseracao" class="uk-form-label">
                                        {{ __('Tempo gasto') }}
                                    </label>
                                    <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove-top">
                                        <p class="uk-text-normal">{{ Carbon\Carbon::parse($preRequisicao->requisicao->tarefa->end_at)->diffForHumans(\Carbon\Carbon::parse($preRequisicao->requisicao->tarefa->start_at))}}
                                        </p>
                                    </div>
                                </div>
                            @endif

                                <div class="uk-width-1-4@s">
                                    <label for="obseracao" class="uk-form-label">
                                        {{ __('Tempo estimado') }}
                                    </label>
                                    <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove-top">
                                        <p class="uk-text-normal">{{ $preRequisicao->tempo_viajem}}
                                        </p>
                                    </div>
                                </div>

                            @if($preRequisicao->estado != 'entregue')
                                <div class="uk-width-1-4@s uk-margin-top">
                                    <button type="submit"
                                            class="uk-button uk-margin-remove-bottom uk-align-center uk-border-rounded uk-button-primary">
                                        {{ __('Confirmar') }}
                                    </button>
                                </div>
                            @endif
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
