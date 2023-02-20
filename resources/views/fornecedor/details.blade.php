@extends('layouts.admin')

@section('title-page')
    Dados do Fornecedor
@endsection
@section('links')
    <a href="{{ route('fornecedor.index') }}" class="uk-button uk-button-text">Fornecedors</a> / Detalhes
@endsection
@section('link')
    Dados do Fornecedor
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">
                <div class="uk-card-body uk-margin  uk-grid">
                    <div class="uk-width-1-1@s">
                        <div>
                            <p class="uk-align-right">
                                <a
                                    href="{{ route('fornecedor.edit', $fornecedor) }}"
                                    class="uk-button  uk-border-rounded uk-text-bold text-white btn-warning">Editar</a>
                                <button uk-toggle="target: #my-id" type="button"
                                        class="uk-button uk-button-danger uk-text-bold uk-border-rounded">
                                    Remover este fornecedor
                                </button>
                            </p>
                        </div>
                    </div>

                    <div class="uk-width-1-2@s">
                        <label for="name" class="uk-form-label">
                            {{ __('Nome do fornecedor') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-placeholder">
                                {{ $fornecedor->nome }}
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-4@s">
                        <label for="gender" class="uk-form-label">
                            {{ __('Contacto') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-form-control">
                                <div class="uk-placeholder">
                                    {{ $fornecedor->contacto }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-4@s">
                        <label for="area" class="uk-form-label">
                            {{ __('Endereço') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-placeholder">
                                {{ $fornecedor->endereco }}
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-3@s">
                        <label for="telefone" class="uk-form-label">
                            {{ __('Número de Identificação Tributária') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-placeholder">
                                {{ $fornecedor->nuit }}
                            </div>
                        </div>
                    </div>

                    <div class="uk-width-1-3@s">
                        <label class="uk-form-label">
                            {{ __('Situação actual') }}
                        </label>
                        <div class="uk-placeholder uk-margin-remove">
                            {{ $fornecedor->is_active? 'Fornecedor': 'Ex Fornecedor' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @component('layouts.delete-alert')
        @slot('model_title')
            O(A) Fornecedor(a)
        @endslot
        @slot('info_title')
            {{ $fornecedor->nome }}
        @endslot
        @slot('slot')

            <form class="uk-inline" method="POST" action="{{ route('fornecedor.destroy', $fornecedor) }}">
                @method('DELETE')
                @csrf
                <button
                    class="uk-button uk-button-danger uk-border-rounded uk-box-shadow-hover-small">Remover
                </button>
            </form>

        @endslot
    @endcomponent
@endsection
