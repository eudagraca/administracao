@extends('layouts.admin')
@section('title-page')
Detalhes do pedido de férias
@endsection
@section('links')
<a href="{{ route('feria.index') }}" class="uk-button uk-button-text">Férias</a> / Detalhes
@endsection
@section('link')
Detalhes do pedido de férias
@endsection
@section('content-main')
@include('layouts.flash')
<div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
    <div class="uk-card uk-card-default uk-width-1-1@s">
        <h3 class="uk-h4 uk-margin-remove-top uk-margin-remove-bottom uk-text-bold uk-card-header">Detalhes do pedido de
            férias</h3>

        <div class="uk-card-body uk-margin uk-margin-remove-top uk-grid">

            <div class="uk-width-1-1 uk-margin-medium-bottom">

                @if((Auth::check() and (Auth::user()->hasRole('gestor-recursos-humanos') || $feria->user_id == Auth::id())) and ($feria->estado == 'aceite' and $feria->confirmed != 'Pendente'))
                <a href="{{ route('feria.edit',$feria->id )}}"
                    class="uk-button uk-button-secondary uk-button-small uk-text-bolder uk-border-rounded uk-box-shadow-hover-large uk-align-right">
                    <i class="fa fa-file-alt"></i> Imprimir</a>
                    @endif

            </div>

            <div class="uk-width-1-4@s">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Requisitante') }}
                    </label>
                    <p class="uk-text-normal uk-margin-remove-top">{{ $feria->user->name }}</p>
                </div>
            </div>
            <div class="uk-width-1-4@s">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Substituto:') }}
                    </label>
                    <p class="uk-text-normal uk-margin-remove-top">{{ $feria->substituto->name }}</p>
                </div>
            </div>

            <div class="uk-width-1-4@s">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Requisitado a :') }}
                    </label>
                    <p class="uk-text-normal uk-margin-remove-top">{{ date('d/m/Y', strtotime($feria->created_at)) }}
                    </p>
                </div>
            </div>

            <div class="uk-width-1-4@s">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Estado do pedido') }}
                    </label>
                    <p class="uk-text-normal uk-margin-remove-top">{{ ucfirst($feria->estado) }}</p>
                </div>
            </div>

            <div class="uk-width-1-4@s uk-margin">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Parecer do substituto') }}
                    </label>
                    <p class="uk-text-normal uk-margin-remove-top">{{ $feria->confirmed == 'Sim'?'Aceite': ($feria->confirmed == 'Nao'? 'Negado': 'Pendente') }}</p>
                </div>
            </div>
            @if($feria->estado == 'negada')

            <div class="uk-width-1-2@s uk-margin">
                <div class=" uk-placeholder">
                    <label for="diagnostico" class="uk-form-label">
                        {{ __('Parecer do substituto') }}
                    </label>
                    <p class="uk-text-normal uk-margin-remove-top">{{ $feria->justificacao }}</p>
                </div>
            </div>

            @endif
            <form method="POST" action="{{ route('feria.update', $feria->id) }}"
                class="uk-form-stacked uk-width-1-1@s uk-margin-remove-top">
                @method('PUT')
                @csrf
                @if((Auth::check() and Auth::user()->hasRole('gestor-recursos-humanos')) and $feria->estado == 'lida' || $feria->estado == 'nao lida')
                <div class="uk-margin uk-grid">
                    <div class="uk-width-1-2@s uk-margin-small-top">
                        <label for="estado" class="uk-form-label uk-margin-small-top">
                            {{ __('Responder ao pedido') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio" id="status" name="estado" value="aceite">
                                    Aceitar pedido de férias</label>

                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio" id="status" name="estado" value="negada"> Negar o pedido de férias</label>
                                @error('estado')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="uk-width-1-2@s" id="justificacao_input" hidden>
                        <label for="justificacao" class="uk-form-label">Justificaçào</label>
                        <textarea class="uk-textarea @error('justificacao') uk-form-danger @enderror" name="justificacao" rows="3"
                            placeholder="Porquê recusa?"></textarea>
                        @error('justificacao')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                        {{ __('Enviar resposta') }}
                    </button>
                </div>
                @elseif(($feria->estado == 'aceite' and $feria->substituto_id == Auth::id()) and $feria->confirmed == 'Pendente')

                <div class="uk-margin  uk-grid">
                    <div class="uk-width-1-1@s uk-margin-small-top">
                        <label for="estado" class="uk-form-label uk-margin-small-top">
                            {{ __('Irá substituir o ') .' '. $feria->user->name }}?
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio" id="status" name="confirmed" value="Sim">
                                    Sim</label>

                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio" id="status" name="confirmed" value="Nao"> Não</label>
                                @error('confirmed')
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
                @endif
            </form>

        </div>
    </div>
</div>

@endsection
