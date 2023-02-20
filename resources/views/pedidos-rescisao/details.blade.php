@extends('layouts.admin')

@section('title-page')
Detalhes do pedido de rescisão
@endsection
@section('links')
<a class="uk-button uk-button-text" href="{{ route('pedidoRescisao.index') }}">Pedidos de rescisão</a> / Detalhes
@endsection
@section('link')
Detalhes do pedido de rescisão
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')
    <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">

            <div class="uk-card-body uk-margin-remove-bottom uk-grid">

                <div class="uk-width-1-1 uk-margin-medium-bottom">

                    <a href="{{route('contrato.user', $pedidoRescisao->user_id)}}"
                        class="uk-button uk-button-secondary uk-text-bolder uk-border-rounded uk-box-shadow-hover-large uk-align-right">
                        <i class="fas fa-file"></i> Abrir Contrato
                    </a>
                </div>
                <h4>Estado do pedido: <span class="uk-text-danger uk-text-bolder">{{ ucfirst($pedidoRescisao->estado) }}</span> </h4>
                <div class="uk-width-1-1@s uk-margin">
                    <div class=" uk-placeholder">
                        <label for="diagnostico" class="uk-form-label">
                            {{ __('Motivo') }}
                        </label>
                        <p class="uk-text-normal uk-margin-remove-top">
                            {{ $pedidoRescisao->motivo}}</p>
                    </div>
                </div>
                <div class="uk-width-1-3@s">
                    <div class=" uk-placeholder">
                        <label for="diagnostico" class="uk-form-label">
                            {{ __('Remetente') }}
                        </label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ $pedidoRescisao->user->name }}</p>
                    </div>
                </div>

                <div class="uk-width-1-3@s">
                    <div class=" uk-placeholder">
                        <label for="diagnostico" class="uk-form-label">
                            {{ __('Data em que pretende sair') }}
                        </label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ date('d - m - Y', strtotime(($pedidoRescisao->antecedencia))) }}</p>
                    </div>
                </div>


                <div class="uk-width-1-3@s">
                    <div class=" uk-placeholder">
                        <label for="diagnostico" class="uk-form-label">
                            {{ __('Submetido a') }}
                        </label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ date('d - m - Y', strtotime(($pedidoRescisao->created_at))) }}</p>
                    </div>
                </div>

                @if($pedidoRescisao->estado == 'lida' || $pedidoRescisao->estado == 'nao lida')
                <form method="POST" action="{{ route('pedidoRescisao.update', $pedidoRescisao) }}" class="uk-form-stacked uk-width-1-1@s uk-margin-remove-top">
                    @method('PUT')
                    @csrf
                    <div class="uk-card-body uk-margin  uk-grid">

                        <div class="uk-width-1-1@s uk-margin-small-top">


                            <label for="estado" class="uk-form-label uk-margin-small-top">
                                {{ __('Responder ao pedido') }}
                            </label>
                            <div class="uk-form-control">
                                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">


                                    <label class="uk-text-small">
                                        <input class="uk-radio" type="radio" id="status" name="status" value="aceite"> Aceitar pedido
                                        de rescisão</label>

                                    <label class="uk-text-small">
                                        <input class="uk-radio" type="radio" id="status" name="status" value="negada"> Negar o pedido
                                        de rescisão</label>
                                    @error('status')
                                    <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="uk-form-control uk-card-footer">
                        <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                            {{ __('Enviar resposta') }}
                        </button>
                    </div>
                </form>

                @endif


            </div>

        </div>

    </div>
</div>
@endsection
