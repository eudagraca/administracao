@extends('layouts.admin')
@section('title-page')
    Escrever carta
@endsection
@section('links')
    Escrever
@endsection
@section('link')
    Escrever carta
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">

            <div class="uk-width-1-1@s">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="alteracao-de-escala-tab" data-toggle="tab"
                           href="#alteracao-de-escala" role="tab"
                           aria-controls="alteracao-de-escala"
                           aria-selected="true">Alteração de escala</a>
                    </li>

                    @if(Auth::check() and Auth::user()->hasRole('gestor-recursos-humanos'))
                    <li class="nav-item">
                        <a class="nav-link" id="advertencia-tab" data-toggle="tab"
                           href="#advertencia" role="tab"
                           aria-controls="advertencia"
                               aria-selected="true">Advertência de serviço</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" id="justificacao-de-faltas-tab" data-toggle="tab"
                           href="#justificacao-de-faltas" role="tab"
                           aria-controls="justificacao-de-faltas"
                           aria-selected="true">Justificação de faltas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rescisao-tab" data-toggle="tab"
                           href="#rescisao" role="tab"
                           aria-controls="rescisao"
                           aria-selected="true">Rescisão de contrato</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="pedido-ferias-tab" data-toggle="tab"
                           href="#pedido-ferias" role="tab"
                           aria-controls="pedido-ferias"
                           aria-selected="true">Pedido de férias</a>
                    </li>
                </ul>
                <hr>
                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="alteracao-de-escala" role="tabpanel"
                         aria-labelledby="alteracao-de-escala-tab">
                        @include('forms.alteracao-de-escala')
                    </div>

                    <div class="tab-pane fade show" id="advertencia" role="tabpanel"
                         aria-labelledby="advertencia-tab">
                        @include('forms.advertencia')
                    </div>

                    <div class="tab-pane fade show" id="justificacao-de-faltas" role="tabpanel"
                         aria-labelledby="justificacao-de-faltas-tab">
                        @include('forms.justificacao-de-faltas')
                    </div>

                    <div class="tab-pane fade show" id="rescisao" role="tabpanel"
                         aria-labelledby="rescisao-tab">
                        @include('forms.rescisao')
                    </div>

                    <div class="tab-pane fade show" id="pedido-ferias" role="tabpanel"
                         aria-labelledby="pedido-ferias-tab">
                        @include('forms.pedido-de-ferias')
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/ajax-requests.js') }}"></script>

@endsection
