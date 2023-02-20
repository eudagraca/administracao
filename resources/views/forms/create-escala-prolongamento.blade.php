@extends('layouts.admin')

@section('title-page')
@yield('title-p')
@endsection
@section('links')
@yield('lnks')
@endsection
@section('link')
@yield('lnk')
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')
    <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <form method="POST" action="@yield('action')" id="escala"
                  class="uk-form-stacked">
                {{ csrf_field() }}
                <div class="uk-h4 uk-margin-remove-top uk-text-bold uk-card-header ">
                    @yield('card-title')
                </div>
                <div class="uk-panel uk-padding uk-padding-remove-bottom">
                    <div class="uk-panel-badge uk-card-badge badge badge-success"> Recursos humanos</div>
                    <h3 class="uk-panel-title uk-h5 uk-text-bold uk-text-small">Dados do colaborador</h3>
                    <hr class="uk-divider-small">
                    <div class="uk-grid-small" uk-grid>

                        <div class="uk-width-1-4@s">
                            <label for="sector_id" class="uk-form-label">Sector</label>
                            <input class="uk-input" readonly value="{{ Auth::user()->getSector()->name }}">
                        </div>
                        <div class="uk-width-1-2@s">
                            <label for="name" class="uk-form-label">Nome</label>
                            <input class="uk-input" readonly value="{{ Auth::user()->name }}">
                        </div>
                        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid uk-margin-medium-top">
                            <label class="uk-text-small">
                                <input class="uk-radio" value="Prestador" type="radio" name="tipo_colaborador">
                                Prestador</label> <label class="uk-text-small">
                                <input class="uk-radio" value="Efectivo" type="radio" name="tipo_colaborador">
                                Efectivo</label>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="uk-panel uk-padding uk-padding-remove-top">
                    <div style="display: flex; justify-content: space-between">

                        <h5 class="uk-text-bold uk-text-small">Dados do pedido: </h5>
                        <h5 class="uk-align-right uk-text-small uk-text-bold">Quem pede: </h5>
                    </div>

                    <hr class="uk-divider-small uk-margin-remove-top">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th colspan="2">
                                <div
                                    class="uk-margin uk-margin-top uk-grid-small uk-child-width-auto uk-grid uk-margin-remove-bottom uk-margin-small">
                                    @yield('tipo_escala')
                                </div>
                            </th>
                            <th colspan="2">
                                <div
                                    class="uk-margin uk-grid-small uk-margin-top uk-child-width-auto uk-grid uk-margin-remove-bottom uk-margin-small">

                                    <p>
                                        <label class="uk-text-small">
                                            <input class="uk-radio" value="Colaborador" type="radio" name="pedido_de">
                                            Colaborador
                                        </label>
                                        <label class="uk-text-small uk-margin-small-left">
                                            Chefe do sector
                                            <input class="uk-radio" value="Chefe do sector" type="radio" name="pedido_de">

                                        </label>
                                    </p>
                                </div>
                                <p>
                                    <label class="uk-text-small">
                                        <input class="uk-radio" value="Direcção" type="radio" name="pedido_de">
                                        Direcção
                                    </label>
                                    <label class="uk-text-small uk-margin-medium-left">
                                        Recursos Humanos
                                        <input class="uk-radio"  value="Reursos Humanos" type="radio" name="pedido_de">
                                    </label>
                                </p>
                            </th>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="uk-panel uk-padding uk-padding-remove-top table-responsive-m">


                    @yield('escala')

                    @yield('prolongamento')

                    @yield('nova-escala')

                    <div class="uk-width-1-1@s uk-grid uk-margin-top">


                        <div class="uk-width-1-2@s uk-margin">
                            <label class="uk-form-label">Forma de compensação</label>
                            <p>
                                <label class="uk-text-small">
                                    <input class="uk-radio" value="Alteração de turno / Escala" type="radio" name="forma_compensacao">
                                    Alteração de turno / Escala
                                </label>
                            </p>
                            <p>
                                <label class="uk-text-small">
                                    <input class="uk-radio" value="Horas extras" type="radio" name="forma_compensacao">
                                    Horas extras
                                </label>
                            </p>

                            <p>
                                <label class="uk-text-small">
                                    <input class="uk-radio" value="Trabalho voluntário" type="radio" name="forma_compensacao">
                                    Trabalho voluntário
                                </label>
                            </p>

                        </div>


                        <div class="uk-width-1-2@s">
                            <label for="responsavel" class="uk-form-label">
                                {{ __('Motivo') }}
                            </label>
                            <div class="uk-form-control">
                            <textarea class="uk-textarea @error('motivo') uk-form-danger @enderror"
                                      id="motivo" name="motivo"
                                      placeholder="Motivo" rows="5"
                                      autocomplete="off"></textarea>
                                @error('motivo')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                </div>

                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-secondary">
                        {{ __('Enviar pedido') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
