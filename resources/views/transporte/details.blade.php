@extends('layouts.admin')

@section('title-page')
    Dados do Transporte
@endsection
@section('links')
    <a href="{{ route('transportes.index') }}" class="uk-button uk-button-text">Transportes</a> / Detalhes
@endsection
@section('link')
    Dados do Transporte
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
                                <a href="{{ route('transportes.edit', $transporte) }}"
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
                            {{ __('Transporte') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-placeholder">
                                {{ $transporte->marca }} {{ $transporte->modelo }}
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-4@s">
                        <label for="gender" class="uk-form-label">
                            {{ __('Veículo') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-form-control">
                                <div class="uk-placeholder">
                                    {{ $transporte->veiculo }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="uk-width-1-4@s">
                        <label class="uk-form-label">
                            {{ __('Matricula') }}
                        </label>
                        <div class="uk-placeholder uk-margin-remove">
                            {{ $transporte->matricula }}
                        </div>
                    </div>

                    <div class="uk-width-1-3@s">
                        <label for="area" class="uk-form-label">
                            {{ __('Em serviço') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-placeholder">
                                {{ $transporte->em_servico? 'Disponível': 'Está em serviço' }}
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-3@s">
                        <label for="telefone" class="uk-form-label">
                            {{ __('Resgistado a') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-placeholder">
                                {{ date('d-m-Y', strtotime($transporte->created_at)) }}
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-3@s">
                        <label class="uk-form-label">
                            {{ __('Situação actual') }}
                        </label>
                        <div class="uk-placeholder uk-margin-remove">
                            {{ $transporte->is_active? 'Transporte em dia': 'Não dispoínel' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @component('layouts.delete-alert')
        @slot('model_title')
            O(A) transporte(a)
        @endslot
        @slot('info_title')
            {{ $transporte->marca }} {{ $transporte->modelo }}
        @endslot
        @slot('slot')
            <form class="uk-inline" method="POST" action="{{ route('transportes.destroy', $transporte) }}">
                @method('DELETE')
                @csrf
                <button
                    class="uk-button uk-button-danger uk-border-rounded uk-box-shadow-hover-small">Remover
                </button>
            </form>
        @endslot
    @endcomponent
@endsection
