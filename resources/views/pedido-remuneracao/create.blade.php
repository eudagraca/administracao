@extends('layouts.admin')

@section('title-page')
Pedido de remuneração
@endsection
@section('links')
<a href="{{ route('transportes.index') }}" class="uk-button uk-button-text">Remunerações</a> / Registo
@endsection
@section('link')
Pedido de remuneração
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')
    <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <form method="POST" action="{{ route('remuneracao.store') }}" class="uk-form-stacked">
                {{ csrf_field() }}
                <div class="uk-card-body uk-margin  uk-grid">


                    <div class="uk-width-1-2@s">
                        <label for="colab" class="uk-form-label">
                            {{ __('Colaborador') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input" readonly
                                type="text" value="{{ Auth::user()->name }}">
                        </div>
                    </div>

                    <div class="uk-width-1-2@s">
                        <label for="colab" class="uk-form-label">
                            {{ __('Sector') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input" readonly
                                type="text" value="{{ Auth::user()->getSector()->name }}">
                        </div>
                    </div>
                    <div class="uk-width-1-1@s uk-margin">
                        <label for="motivacao" class="uk-form-label">
                            {{ __('Motivação') }}
                        </label>
                        <div class="uk-form-control">
                            <textarea class="uk-textarea @error('motivacao') uk-form-danger @enderror" id="motivacao" name="motivacao" rows="4" required></textarea>
                            @error('motivacao')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-secondary">
                        {{ __('Enviar pedido') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
