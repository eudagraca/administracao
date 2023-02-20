@extends('layouts.admin')

@section('title-page')
    Dados do Motorista
@endsection
@section('links')
    <a href="{{ route('motorista.index') }}" class="uk-button uk-button-text">Motoristas</a> / Detalhes
@endsection
@section('link')
    Dados do Motorista
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
                                    href="{{ route('motorista.edit', $motorista->id) }}"
                                    class="uk-button  uk-border-rounded uk-text-bold text-white btn-warning">Editar</a>
                                <button uk-toggle="target: #my-id" type="button"
                                        class="uk-button uk-button-danger uk-text-bold uk-border-rounded">
                                    Apagar
                                </button>
                            </p>
                        </div>
                    </div>

                    <div class="uk-width-1-2@s">
                        <label for="name" class="uk-form-label">
                            {{ __('Nome completo') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-placeholder">
                                {{ $motorista->name }} {{ $motorista->surname }}
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-4@s">
                        <label for="gender" class="uk-form-label">
                            {{ __('Sexo') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-form-control">
                                <div class="uk-placeholder">
                                    {{ $motorista->gender }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="uk-width-1-4@s">
                        <label class="uk-form-label">
                            {{ __('Morada') }}
                        </label>
                        <div class="uk-placeholder uk-margin-remove">
                            {{ $motorista->address }}
                        </div>
                    </div>

                    <div class="uk-width-1-3@s">
                        <label for="area" class="uk-form-label">
                            {{ __('Número da carta de Condução') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-placeholder">
                                {{ $motorista->licence_number?? '_________________' }}
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-3@s">
                        <label for="telefone" class="uk-form-label">
                            {{ __('Telefone') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-placeholder">
                                {{ $motorista->phone }}
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-3@s">
                        <label class="uk-form-label">
                            {{ __('Situação actual') }}
                        </label>
                        <div class="uk-placeholder uk-margin-remove">
                            {{ $motorista->is_active? 'Motorista': 'Ex Motorista' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @component('layouts.delete-alert')
        @slot('model_title')
            O(A) motorista(a)
        @endslot
        @slot('info_title')
            {{ $motorista->name }}
        @endslot
        @slot('slot')

            <form class="uk-inline" method="POST" action="{{ route('motorista.destroy', $motorista) }}">
                @method('DELETE')
                @csrf
                <button
                    class="uk-button uk-button-danger uk-border-rounded uk-box-shadow-hover-small">Remover
                </button>
            </form>

        @endslot
    @endcomponent
@endsection
