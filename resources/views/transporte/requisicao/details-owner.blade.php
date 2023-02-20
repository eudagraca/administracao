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
        <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">
                <form id="data" method="POST" action="{{ route('requisicao.concluir', $requisicao->id) }}"
                      class="uk-form-stacked">
                    <div class="uk-card-badge uk-label ">{{ $requisicao->sector->name }}</div>
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="uk-card-body  uk-margin uk-grid">
                        <div class="uk-align-right uk-width-1-1 uk-margin-remove-bottom">
                            <div class="uk-align-right">
                                <hr class="uk-divider-small uk-flex-right">
                                <label>Data da requisição</label>
                                <div class="uk-width-1-1">
                                    <p class="uk-h4 uk-text-muted uk-text-normal uk-align-right uk-margin-remove-bottom">{{ date('d/m/Y', strtotime($requisicao->created_at)) }}</p>
                                </div>
                            </div>
                        </div>

                        @if($requisicao->observacoes_gestor==NULL)
                            <label class="uk-text-bolder uk-width-1-1@s uk-text-warning">O gestor recebeu mas ainda não respondeu a sua solicitação ... Aguarde</label>
                        @endif

                        @if($requisicao->estado=="entregue")
                            <p class="uk-text-normal uk-flex uk-flex-right uk-margin-small-top uk-margin-remove-bottom uk-width-1-1@s uk-align-right uk-text-warning">O processo desta solicitação foi concluído</p>
                        @endif

                        <div class="uk-width-1-3@s uk-margin">
                            <label for="origem" class="uk-form-label">
                                {{ __('Origem') }}
                            </label>
                            <div class="uk-placeholder uk-padding-small">
                                <p class="uk-text-normal">{{ $requisicao->origem }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-3@s uk-margin">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Destino') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small">

                                <p class="uk-text-normal">{{ $requisicao->destino }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-3@s uk-margin">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Sector') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small">

                                <p class="uk-text-normal">{{ $requisicao->sector->name }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-3@s ">
                            <label for="origem" class="uk-form-label">
                                {{ __('Data') }}
                            </label>
                            <div class="uk-placeholder uk-padding-small">
                                <p class="uk-text-normal">{{date('d / m / Y', strtotime($requisicao->data)) }}</p>
                            </div>
                        </div>


                        <div class="uk-width-1-3@s ">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Transportador') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small">

                                <p class="uk-text-normal">{{ $requisicao->motorista->name }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-3@s ">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Estado') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small">

                                <p class="uk-text-normal">{{ ucfirst($requisicao->estado) }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-1@s uk-margin">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Observações') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small">

                                <p class="uk-text-normal">{{ ucfirst($requisicao->observacoes) }}</p>
                            </div>
                        </div>
                        <div class="uk-width-1-2@s uk-margin-bottom">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Resposta da sua solicitação') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder uk-padding-small">

                                <p class="uk-text-normal">Sua solicitação foi {{ $requisicao->foi_aceite }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-2@s">
                            <label for="responsavel" class="uk-form-label">
                                {{ __('Observação do gestor') }}
                            </label>

                            <div class="uk-width-1-1 uk-placeholder uk-padding-small">

                                <p class="uk-text-normal">{{ $requisicao->observacoes_gestor? $requisicao->observacoes_gestor: "____________________" }}</p>
                            </div>
                        </div>

                        <input name="id" hidden value="{{ $requisicao->id }}">

                        <div class="uk-width-1-2@s">
                            @if($requisicao->foi_aceite=="aceite" and $requisicao->estado=="pendente")
                            <label for="responsavel" class="uk-form-label">
                                {{ __('Confirmar entrega?') }}
                            </label>
                            <div class="uk-form-control">
                                <div class="uk-grid-small uk-child-width-auto uk-grid">
                                    <label class="uk-text-small"><input class="uk-radio" value="entregue"
                                                                        type="radio"
                                                                        name="estado"> Sim</label>
                                    <label class="uk-text-small"><input class="uk-radio" value="pendente"
                                                                        type="radio"
                                                                        name="estado"> Não</label>
                                </div>
                            </div>
                            @error('estado')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                            @elseif($requisicao->foi_aceite=="negado")
                                <label for="responsavel" class="uk-form-label">
                                    {{ __('A sua solicitação não foi aprovada') }}
                                </label>
                            @else
                                <label for="responsavel" class="uk-form-label">
                                    {{ __("A sua solicitação foi: ") }}
                                </label>

                                <p>
                                    {{ __(ucfirst($requisicao->foi_aceite)) }}
                                </p>
                            @endif

                        </div>

                    </div>
                    @if($requisicao->foi_aceite=="aceite" and $requisicao->estado=="pendente")
                    <div class="uk-form-control uk-card-footer">
                        <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                            {{ __('Confirmar entrega') }}
                        </button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
