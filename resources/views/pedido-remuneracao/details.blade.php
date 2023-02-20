@extends('layouts.admin')

@section('title-page')
    Dados do pedido de aumento
@endsection
@section('links')
    <a href="{{ route('remuneracao.index') }}" class="uk-button uk-button-text">Pedidos</a> / Detalhes
@endsection
@section('link')
    Dados do pedido de aumento
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">
                <div class="uk-card-body uk-margin  uk-grid">
                    <div class="uk-width-1-1@s">
                        <div>
                            @if(Auth::user()->hasRole('gestor-recursos-humanos') and ($remuneracao->estado != 'Pendente' and $remuneracao->estado != 'Enviada'))
                            <p class="uk-align-right">
                                <a href="{{ route('contrato.user', $remuneracao->user) }}"
                                   class="uk-button  uk-border-rounded uk-text-bold text-white btn-warning">Abrir o contrato</a>

                            </p>

                            @endif
                        </div>
                    </div>

                    <div class="uk-width-1-2@s">
                        <label for="name" class="uk-form-label">
                            {{ __('Requisitante') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-placeholder">
                                {{ $remuneracao->user->name }}
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-4@s">
                        <label for="gender" class="uk-form-label">
                            {{ __('Submetido à:') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-form-control">
                                <div class="uk-placeholder">
                                    {{ date('d-m-Y', strtotime($remuneracao->created_at)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-4@s">
                        <label for="gender" class="uk-form-label">
                            {{ __('Situação da requisição:') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-form-control">
                                <div class="uk-placeholder">
                                    {{ $remuneracao->estado }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="uk-width-1-1@s">
                        <label class="uk-form-label">
                            {{ __('Motivação') }}
                        </label>
                        <div class="uk-placeholder uk-margin-remove">
                            {{ $remuneracao->motivacao }}
                        </div>
                    </div>

                    @auth
                        @if(Auth::user()->hasRole('gestor-recursos-humanos') and ($remuneracao->estado == 'Pendente' || $remuneracao->estado ==
                        'Enviada'))

                        <form method="POST" action="{{ route('remuneracao.update', $remuneracao) }}"
                            class="uk-form-stacked uk-width-1-1@s uk-margin-top">
                            @method('PUT')
                            @csrf
                            <div class="uk-width-1-1@s uk-margin-small-top">
                                <label for="estado" class="uk-form-label uk-margin-small-top uk-margin-bottom">
                                    {{ __('Responder ao pedido') }}
                                </label>
                                <div class="uk-form-control">
                                    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">

                                        <label class="uk-text-small">
                                            <input class="uk-radio" type="radio" id="status" name="estado" value="Autorizado">
                                            Autorizado</label>

                                        <label class="uk-text-small">
                                            <input class="uk-radio" type="radio" id="status" name="estado" value="Não Autorizado">
                                            Não Autorizado</label>

                                        @error('estado')
                                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="uk-form-control uk-card-footer">
                                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                                        {{ __('Enviar resposta') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endif
                    @endauth

                </div>
            </div>
        </div>
    </div>
@endsection
