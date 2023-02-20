@extends('layouts.admin')

@section('title-page')
Cartas
@endsection

@section('link')
Cartas
@endsection

@section('links')
Cartas
@endsection

@section('content-main')
@include('layouts.flash')

<div class="row uk-margin-small-left">

   <div class="uk-child-width-1-4@m uk-grid-small uk-grid-match" uk-grid>
    <div>
        <div class="uk-card uk-card-default uk-card-hover">
            <div class="uk-card-header">
            <h4 class="uk-card-title">Alteração de<br> escala</h4>
            </div>
            <div class="uk-card-footer">
                <a href="{{ route('escala.index') }}" class="uk-button uk-button-text">Ver</a>
            </div>
        </div>
    </div>

    <div>
        <div class="uk-card uk-card-default uk-card-hover">
            <div class="uk-card-header">
                <h4 class="uk-card-title">Justificação de faltas</h4>
            </div>
            <div class="uk-card-footer">
                <a href="{{ route('justificacao.index') }}" class="uk-button uk-button-text">Ver</a>
            </div>
        </div>
    </div>

    <div>
        <div class="uk-card uk-card-default uk-card-hover">
            <div class="uk-card-header">
                <h4 class="uk-card-title">Rescisão de contrato</h4>
            </div>
            <div class="uk-card-footer">
                <a href="{{ route('rescisao.index') }}" class="uk-button uk-button-text">Ver</a>
            </div>
        </div>
    </div>

    <div>
        <div class="uk-card uk-card-default uk-card-hover">
            <div class="uk-card-header">
                <h4 class="uk-card-title">Pedido de <br>ferias</h4>
            </div>
            <div class="uk-card-footer">
                <a href="{{ route('feria.index') }}" class="uk-button uk-button-text">Ver</a>
            </div>
        </div>
    </div>

    <div>
        <div class="uk-card uk-card-default uk-card-hover">
            <div class="uk-card-header">
                <h4 class="uk-card-title">Pedido de <br>prolongamento</h4>
            </div>
            <div class="uk-card-footer">
                <a href="{{ route('prolongamento.index') }}" class="uk-button uk-button-text">Ver</a>
            </div>
        </div>
    </div>

    <div>
        <div class="uk-card uk-card-default uk-card-hover">
            <div class="uk-card-header">
                <h4 class="uk-card-title">Pedido de avaliação de desempenho</h4>
            </div>
            <div class="uk-card-footer">
                <a href="{{ route('remuneracao.index') }}" class="uk-button uk-button-text">Ver</a>
            </div>
        </div>
    </div>

</div>
</div>
@endsection
