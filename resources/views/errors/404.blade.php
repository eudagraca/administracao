@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row text-center uk-flex uk-flex-center uk-position-center">
            <div class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3 col-12 p-3 error-main">
                <div class="row">
                    <div class="col-lg-8 col-12 col-sm-10 offset-lg-2 offset-sm-1">
                        <h1 class="uk-h1 uk-heading-bullet uk-text-bolder">404</h1>
                        <h3>Página não encontrada </h3>
                        <p>Esta página não está disponível para sí.</p>
                        <a href="{{route('normal.dashboard') }}" class="uk-button uk-button-secondary uk-border-rounded uk-box-shadow-hover-xlarge">Página inicial</a>
                        <a href="{{ redirect()->back()->getTargetUrl() }}" class="uk-button uk-button-secondary uk-border-rounded uk-box-shadow-hover-xlarge">Página anterior</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
