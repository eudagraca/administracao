@extends('layouts.admin')

@section('title-page')
    Dados do Técnico
@endsection
@section('links')
    <a href="{{ route('tecnico.index') }}" class="uk-button uk-button-text">Técnicos</a> / Detalhes
@endsection
@section('link')
    Dados do técnico
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
                                    href="{{ route('tecnico.edit', $tecnico) }}"
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
                                {{ $tecnico->name }}
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
                                    {{ $tecnico->gender }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-4@s">
                        <label for="area" class="uk-form-label">
                            {{ __('Área') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-placeholder">
                                {{ $tecnico->area }}
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-3@s">
                        <label for="telefone" class="uk-form-label">
                            {{ __('Telefone') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-placeholder">
                                {{ $tecnico->phone }}
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-3@s">
                        <label class="uk-form-label">
                            {{ __('Pagamento aceite') }}
                        </label>
                        <div class="uk-placeholder uk-margin-remove">
                            {{ ucfirst($tecnico->pagamento) }}
                        </div>
                    </div>
                    <div class="uk-width-1-3@s">
                        <label class="uk-form-label">
                            {{ __('Situação actual') }}
                        </label>
                        <div class="uk-placeholder uk-margin-remove">
                            {{ $tecnico->is_active? 'Técnico': 'Ex Técnico' }}
                        </div>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label">
                            {{ __('Morada') }}
                        </label>
                        <div class="uk-placeholder uk-margin-remove">
                            {{ $tecnico->morada }}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    @component('layouts.delete-alert')
        @slot('model_title')
            O(A) técnico(a)
        @endslot
        @slot('info_title')
            {{ $tecnico->name }}
        @endslot
        @slot('slot')

            <form class="uk-inline" method="POST" action="{{ route('tecnico.destroy', $tecnico) }}">
                @method('DELETE')
                @csrf
                <button
                    class="uk-button uk-button-danger uk-border-rounded uk-box-shadow-hover-small">Remover
                </button>
            </form>

        @endslot
    @endcomponent
@endsection
