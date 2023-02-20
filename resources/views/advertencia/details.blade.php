@extends('layouts.admin')

@section('title-page')
    Detalhes da advertência
@endsection
@section('links')
    <a class="uk-button uk-button-text" href="{{ route('advertencia.index') }}">Advertências</a> / Detalhes
@endsection
@section('link')
    Detalhes da advertência
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">

                <div class="uk-card-badge uk-label">{{ $advertencia->is_open? 'Lida pelo advertido': 'Não lida pelo advertido' }}</div>
                <div class="uk-card-body uk-margin uk-margin-remove-bottom uk-grid">

                    <div class="uk-width-1-1 uk-margin-medium-bottom">

                        <a href="{{ route('advertencia.PDF', $advertencia->id) }}"
                            class="uk-button uk-button-secondary uk-text-bolder uk-border-rounded uk-box-shadow-hover-large uk-align-right">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>

                        <p class="uk-h4 uk-text-muted uk-text-normal uk-margin-small-top"><span
                                class="uk-text-bold uk-text-primary">Referência</span><br><span>{{ $advertencia->id }}</span>
                        </p>
                    </div>
                    <div class="uk-width-1-2@s">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Advertido') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $advertencia->user->name }}</p>
                        </div>
                    </div>
                    <div class="uk-width-1-2@s">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Adversor') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $advertencia->adversor->name }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-1@s uk-margin-small-top">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Motivo') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $advertencia->motivo }}</p>
                        </div>
                    </div>
                    <div class="uk-width-1-2@s uk-margin-small-top">

                        <div class="uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Advertência registada a') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ date('d - m - Y', strtotime($advertencia->created_at)) }} às {{ date('H:i', strtotime($advertencia->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="uk-width-1-2@s uk-margin-small-top">

                        <div class="uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Parecer do Gestor do RH') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $advertencia->parecer }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('advertencia.update', $advertencia->id) }}"
                        class="uk-form-stacked uk-width-1-1@s uk-margin-remove-top">
                        @method('PUT')
                        @csrf
                        @if((Auth::check() and Auth::user()->hasRole('gestor-recursos-humanos')) and $advertencia->parecer == 'Pendente' and
                        $advertencia->is_open)
                        <div class="uk-margin uk-grid">
                            <div class="uk-width-1-2@s uk-margin-small-top">
                                <label for="estado" class="uk-form-label uk-margin-small-top">
                                    {{ __('Como Gestor dos Recursos Humanos, concorda com está advertência ? ') }}
                                </label>
                                <div class="uk-form-control">
                                    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                        <label class="uk-text-small">
                                            <input class="uk-radio" type="radio" id="status" name="parecer" value="Confirmada">
                                            Confirmar </label>

                                        <label class="uk-text-small">
                                            <input class="uk-radio" type="radio" id="status" name="parecer" value="Recusada"> Recusar
                                        </label>
                                        @error('parecer')
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
    </div>
@endsection
