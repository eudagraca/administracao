@extends('layouts.admin')

@section('title-page')
    Registar Fornecedor
@endsection
@section('links')
    <a href="{{ route('fornecedor.index') }}" class="uk-button uk-button-text">Fornecedor</a> / Registro
@endsection
@section('link')
    Registar Fornecedor
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">
                <form method="POST" action="{{ route('fornecedor.store') }}"
                      class="uk-form-stacked">
                    {{ csrf_field() }}
                    <div class="uk-card-body uk-margin  uk-grid">
                        <div class="uk-width-1-2@s uk-margin">
                            <label for="nome" class="uk-form-label">
                                {{ __('Nome') }}
                            </label>
                            <div class="uk-form-control">
                                <input class="uk-input @error('nome') uk-form-danger @enderror" id="nome" name="nome"
                                       type="text" placeholder="Nome do fornecedor"
                                       value="{{ old('nome') }}" required autocomplete="nome" >
                                @error('nome')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="uk-width-1-2@s">
                            <label for="endereco" class="uk-form-label">
                                {{ __('Endereço') }}
                            </label>
                            <div class="uk-form-control">
                                <input class="uk-input @error('endereco') uk-form-danger @enderror" id="endereco" name="endereco"
                                placeholder="Endereço do fornecedor"
                                       type="text" value="{{ old('endereco') }}" required autocomplete="endereco" >
                                @error('endereco')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="uk-width-1-2@s">
                            <label for="contacto" class="uk-form-label">
                                {{ __('Contacto') }}
                            </label>
                            <div class="uk-form-control">
                                <input class="uk-input @error('contacto') uk-form-danger @enderror" id="contacto" name="contacto"
                                placeholder="Contacto do fornecedor"
                                value="{{ old('contacto') }}" required autocomplete="contacto" >
                                @error('contacto')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="uk-width-1-2@s ">
                            <label for="nuit" class="uk-form-label">
                                {{ __('Número de Identificação Tributária') }}
                            </label>
                            <input id="nuit" type="text" class="uk-input @error('nuit') uk-form-danger @enderror"
                                   name="nuit"
                                   placeholder="Número de Identificação Tributária do fornecedor"
                                   value="{{ old('nuit') }}"
                                   required autocomplete="nuit">
                            @error('nuit')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="uk-form-control uk-card-footer">
                        <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-secondary">
                            {{ __('Registar Fornecedor') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
