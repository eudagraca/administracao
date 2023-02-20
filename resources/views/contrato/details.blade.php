@extends('layouts.admin')

@section('title-page')
    Detalhes do contrato
@endsection
@section('links')
    <a class="uk-button uk-button-text" href="{{ route('contrato.index') }}">Contratos</a> / Detalhes
@endsection
@section('link')
    Detalhes do contrato
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">

                <div class="uk-card-badge uk-label">{{ $contrato->estado }}</div>
                <div class="uk-card-body uk-margin uk-margin-remove-bottom uk-grid">

                    <div class="uk-width-1-1 uk-margin-medium-bottom">


                        @if($contrato->estado == 'Em Contrato')

                        <a href="{{route('contrato.pdfNormal', $contrato->id)}}"
                            class="uk-button uk-button-secondary uk-text-bolder uk-border-rounded uk-box-shadow-hover-large uk-align-right">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>

                            <a href="{{route('adenda.edit', $contrato->id)}}"
                               class="uk-button uk-button-default uk-text-bolder uk-border-rounded uk-box-shadow-hover-large uk-align-right">
                                <i class="fas fa-pencil-alt"></i> Elaborar adenda</a>

                            <button uk-toggle="target: #my-id"
                                    class="uk-button uk-button-primary uk-text-bolder uk-border-rounded uk-box-shadow-hover-large uk-align-right">
                                <i class="fas fa-cut"></i> Rescindir contrato
                            </button>

                            @elseif($contrato->estado == 'Rescindido')
                            <a href="{{route('contrato.pdfNormal', $contrato->id)}}"
                                class="uk-button uk-button-secondary uk-text-bolder uk-border-rounded uk-box-shadow-hover-large uk-align-right">
                                <i class="fas fa-file-pdf"></i> Imprimir folha de rescisão
                            </a>
                            @endif

                        <p class="uk-h4 uk-text-muted uk-text-normal uk-margin-small-top"><span
                                class="uk-text-bold uk-text-primary">Número</span><br><span>{{ $contrato->id }}</span>
                        </p>
                    </div>
                    <div class="uk-width-1-3@s">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Situação') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $contrato->esta_activo? 'Activo': 'Expirado' }}</p>
                        </div>
                    </div>
                    <div class="uk-width-1-3@s">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Nome completo') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $contrato->name }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-3@s">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Estado Civil') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $contrato->estado_civil }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-3@s  uk-margin-small-top">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Nacionalidade') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ ucfirst($contrato->nacionalidade) }}</p>
                        </div>
                    </div>
                    <div class="uk-width-1-3@s uk-margin-small-top">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Tipo de documento') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $contrato->tipo_documento }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-3@s  uk-margin-small-top">
                        <div class="uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Bilhete de Identificação') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $contrato->bi }}</p>
                        </div>
                    </div>


                    <div class="uk-width-1-3@s uk-margin-small-top">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Residência') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $contrato->residencia }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-3@s uk-margin-small-top">

                        <div class="uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Habilitações') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $contrato->habilitacoes }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-3@s uk-margin-small-top">
                        <div class="uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Data de Vigor do contrato') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ date('d/m/Y', strtotime($contrato->data_contrato_vigor)) }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-3@s uk-margin-small-top">
                        <div class="uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Cargo') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $contrato->cargo }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-3@s uk-margin-small-top">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Salário bruto Mensal') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $contrato->salario_bruto }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-3@s uk-margin-small-top">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Data de Assinatura do contrato') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ date('d / m / Y', strtotime($contrato->data_assinatura)) }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-3@s uk-margin-small-top">
                        <div class=" uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Salário bruto Mensal ') }}<span class="uk-text-warning">Actual</span>
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $contrato->adenda() == NULL? $contrato->salario_bruto : $contrato->adenda()->salario_actual }}</p>
                        </div>
                    </div>

                </div>


                <div class="uk-card-body uk-margin-remove-top">
                    @if(count($contrato->adendas) > 0)
                    <h3 class="uk-heading-bullet uk-text-bold">Adendas</h3>
                    <div id="constratos_list" class="uk-grid-column-small uk-grid-row-large uk-child-width-1-3@s"
                         uk-grid>
                        @foreach($contrato->adendas as $adenda)
                            <div>
                                <div
                                    class="uk-card uk-card-default uk-card-body card-k uk-border-rounded uk-text-break uk-transition-toggle uk-padding-remove uk-grid-collapse uk-grid"
                                    style="border: 1px solid rgb(0,0,0);">

                                    <div class="uk-width-expand uk-border-rounded">
                                        <p class="uk-text-bold uk-padding-small uk-border-rounded"
                                           style="background-color: rgb(250,250,250);">
                                            {{ date('d - m - Y', strtotime($adenda->apartir_de)) }}</p>
                                        <p class=" uk-padding-small uk-padding-remove-top uk-padding-remove-bottom uk-margin-remove uk-text-truncate uk-text-normal uk-text-light">
                                             {{ $adenda->motivo }}</p>
                                        <span class="uk-comment-meta uk-margin-remove-top">
                                            <small
                                                class="uk-text-normal uk-margin-left">{{ date('d/m/Y', strtotime($adenda->created_at)) }}</small><br>
                                            <small
                                                class="uk-transition-fade uk-transition-slide-right-small uk-position-bottom-right"
                                                style="bottom: 10px; right: 10px"><span><i
                                                        class="fa fa-long-arrow-alt-right">
                                                    </i>
                                                </span>
                                            </small>
                                        </span>
                                        <a href="{{  route('adenda.show', $adenda->id) }}"><span
                                                style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; z-index: 1;"
                                                class="linkSpanner"></span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- This is the modal -->
    <div id="my-id" uk-modal>
        <div class="uk-modal-dialog uk-margin-auto-vertical">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Rescisão de contrato</h2>
            </div>
            <div class="uk-modal-body">
                <p>Deseja rescindir o contrato com <strong> {{$contrato->name }}</strong> ? Esta acção é
                    inreversível
                </p>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <form method="POST" action="{{route('contrato.destroy', $contrato->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <div class="form-group">
                        <button
                            class="uk-button uk-button-default uk-border-rounded uk-box-shadow-hover-small uk-modal-close"
                            type="button">Cancelar
                        </button>
                        <input type="submit" class="uk-button uk-border-rounded uk-button-danger"
                               value="Rescindir">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
