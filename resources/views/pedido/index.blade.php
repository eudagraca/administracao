@extends('layouts.admin')

@section('title-page')
Pedidos
@endsection

@section('link')
Pedidos
@endsection

@section('links')
Pedidos
@endsection

@section('content-main')
@include('layouts.flash')

<div class="row uk-width-1-1@s uk-padding-small">
    <div class="uk-margin ">

        <form class="uk-search uk-search-default">
            <span class="uk-search-icon-flip" uk-search-icon></span>
            <input class="uk-search-input uk-width-1-1@s" style="border-color: black" id="search_contractos"
                type="search" placeholder="Nome ou cargo">
            {{-- <input class="uk-search-input" type="search" placeholder="Search...">--}}
        </form>

        <small id="searchHelp" class="form-text uk-text-small">Encontre os Pedidos registados</small>
    </div>

    <div class="uk-align-right boundary uk-panel uk-margin-large-right uk-margin-remove-bottom">
        <button class="uk-margin-large-left uk-float-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                class="fas fa-plus-circle"></i> Elaborar contrato
        </button>

        <div uk-dropdown="boundary: .boundary">
            <ul class="uk-nav uk-dropdown-nav">
                <li class="uk-nav-header">Elaborar pedido de</li>
                <li class="uk-nav-divider"></li>
                <li class="uk-active uk-text-normal"><a href="{{route('contrato.createCps')}}">Pedido de dispensa</a></li>
                <li class="uk-active uk-text-normal"><a href="{{ route('contrato.create') }}">Pedido de prolongamento</a>
                </li>
                <li class="uk-active uk-text-normal"><a href="{{ route('contrato.create') }}">Pedido de aumento de remuneração</a>
                </li>
                <li class="uk-active uk-text-normal"><a href="{{ route('contrato.create') }}">Pedido de Alteração de escala</a>
                </li>
                <li class="uk-active uk-text-normal"><a href="{{ route('contrato.create') }}">Troca de sector</a>
                </li>
            </ul>
        </div>
    </div>
</div>

@endsection
