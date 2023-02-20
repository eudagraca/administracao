@extends('layouts.admin')
@section('title-page')
    Detalhes da adenda
@endsection
@section('links')
    Adenda
@endsection
@section('link')
    Detalhes da adenda
@endsection
@section('content-main')
    @include('layouts.flash')

    <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <h3 class="uk-h4 uk-margin-remove-top uk-margin-remove-bottom uk-text-bold uk-card-header">Detalhes da
                adenda</h3>
            <form method="POST" action="{{ route('adenda.store') }}" class="uk-form-stacked">
                {{ csrf_field() }}
                <div class="uk-card-body uk-margin uk-margin-remove-top uk-grid">

                    <div class="uk-width-1-1 uk-margin-medium-bottom">
                        <a href="{{ route('adenda.pdf', $adenda->id) }}"
                           class="uk-button uk-button-danger uk-button-small uk-text-bolder uk-border-rounded uk-box-shadow-hover-large uk-align-right">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                        <a href="{{ redirect()->back()->getTargetUrl() }}"
                           class="uk-button uk-button-secondary uk-button-small uk-text-bolder uk-border-rounded uk-box-shadow-hover-large uk-align-right">
                            <i class="fa fa-long-arrow-alt-left"></i> IR PARA O CONTRATO
                        </a>

                    </div>

                    <div class="uk-width-1-3@s">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Contrato de :') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $adenda->contrato->name }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-3@s">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Feito a :') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ date('d - m - Y', strtotime($adenda->created_at)) }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-3@s">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Vigora a') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ date('d - m - Y', strtotime($adenda->apartir_de)) }}</p>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>

@endsection
