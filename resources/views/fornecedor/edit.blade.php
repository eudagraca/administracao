@extends('layouts.admin')

@section('title-page')
    Editar dados do Fornecedor
@endsection
@section('links')
    <a href="{{ route('fornecedor.index') }}" class="uk-button uk-button-text">Fornecedores</a> / Actualização
@endsection
@section('link')
    Editar dados do fornecedor
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">
                <form method="POST" action="{{ route('fornecedor.update', $fornecedor->id) }}"
                      class="uk-form-stacked">
                    @method('PUT')
                    {{ csrf_field() }}
                    <div class="uk-card-body uk-margin  uk-grid">
                        <div class="uk-width-1-2@s uk-margin">
                            <label for="nome" class="uk-form-label">
                                {{ __('Nome do fornecedor') }}
                            </label>
                            <div class="uk-form-control">
                                <input class="uk-input @error('nome') uk-form-danger @enderror" id="nome" name="nome"
                                       type="text"
                                       value="{{ $fornecedor->nome }}" required autocomplete="nome" autofocus>
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
                                       type="text" value="{{ $fornecedor->endereco }}" required autocomplete="endereco" autofocus>
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
                                       type="tel" value="{{ $fornecedor->contacto }}" required autocomplete="contacto" autofocus>
                                @error('contacto')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="uk-width-1-2@s">
                            <label for="nuit" class="uk-form-label">
                                {{ __('Número de Identificação Tributária') }}
                            </label>
                            <input id="nuit" type="text" class="uk-input @error('nuit') uk-form-danger @enderror"
                                   name="nuit"
                                   value="{{ $fornecedor->nuit }}"
                                   required autocomplete="nuit">
                            @error('nuit')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-form-control uk-card-footer">
                        <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                            {{ __('Actualizar dados do Fornecedor') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
