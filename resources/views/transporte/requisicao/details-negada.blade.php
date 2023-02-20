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
                                <hr class="uk-divider-small uk-flex-right">
                            </div>
                        </div>

                        <div
                            class="uk-width-1-1@s uk-margin-medium-left uk-alert-danger"
                            uk-alert>
                            A requisição foi Negada
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

                                <p class="uk-text-normal">{{ $preRequisicao->requisicaoNegada->user->name }}</p>
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

                                <p class="uk-text-normal">{{ $preRequisicao->destino }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-3@s uk-margin">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Dia de saída') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove">
                                <p class="uk-text-normal">{{ date('d-m-Y', strtotime($preRequisicao->dia_saida)) }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-3@s ">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Hora de saída') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove">
                                <p class="uk-text-normal">{{ date('H:i', strtotime($preRequisicao->hora_saida)) }}</p>
                            </div>
                        </div>

                        @if($preRequisicao->mercadoria == "Mercadoria")
                            <div class="uk-width-1-2@s">
                                <label for="obseracao" class="uk-form-label">
                                    {{ __('Volume') }}
                                </label>
                                <div class="uk-width-1-1 uk-placeholder uk-padding-small uk-margin-remove">

                                    <p class="uk-text-normal">{{ ucfirst($preRequisicao->volume) }}</p>
                                </div>
                            </div>
                        @elseif($preRequisicao->mercadoria == "Pessoas")
                            <div class="uk-width-1-2@s">
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

                                <p class="uk-text-normal">{{ $preRequisicao->observacoes?? '____________________________' }}</p>
                            </div>
                        </div>
                        <div class="uk-width-1-4@s uk-margin">
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
