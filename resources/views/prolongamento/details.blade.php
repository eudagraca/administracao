@extends('layouts.admin')

@section('title-page')
{{ ucfirst($prolongamento->tipo) }}
@endsection
@section('links')
<a class="uk-button uk-button-text" href="{{ route('prolongamento.index') }}">Prolongamentos</a> / Detalhes
@endsection
@section('link')
{{ ucfirst($prolongamento->tipo) }}
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')
    <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">

            <div class="uk-card-badge uk-label">{{ $prolongamento->estado }}</div>
            <div class="uk-card-body uk-margin uk-margin-remove-bottom uk-grid">

                <div class="uk-width-1-1 uk-margin-medium-bottom">

                    @if($prolongamento->parecer_chefe != NULL and $prolongamento->parecer_rh != NULL)
                    <a href="{{route('prolongamento.pdf', $prolongamento->id)}}"
                        class="uk-button uk-button-secondary uk-text-bolder uk-border-rounded uk-box-shadow-hover-large uk-align-right">
                        <i class="fas fa-file-pdf"></i> PDF
                    </a>
                    @endif

                    <p class="uk-h4 uk-text-muted uk-text-normal uk-margin-small-top"><span
                            class="uk-text-bold uk-text-primary">Referência</span><br><span>{{ $prolongamento->id }}</span>
                    </p>

                    <p class="uk-h4 uk-text-muted uk-text-normal uk-margin-small-top uk-width-1-1 uk-m">
                        {{ __('Dados do colaborador') }}
                    </p>
                    <hr>
                </div>

                <div class="uk-width-1-3@s">
                    <div class=" uk-placeholder">
                        <label for="diagnostico" class="uk-form-label">
                            {{ __('Nome') }}
                        </label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ $prolongamento->user->name }}</p>
                    </div>
                </div>
                <div class="uk-width-1-3@s">
                    <div class=" uk-placeholder">
                        <label for="diagnostico" class="uk-form-label">
                            {{ __('Sector') }}
                        </label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ $prolongamento->sector->name }}</p>
                    </div>
                </div>


                <div class="uk-width-1-3@s">
                    <div class=" uk-placeholder">
                        <label for="diagnostico" class="uk-form-label">
                            {{ __('Colaborador:') }}
                        </label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ $prolongamento->tipo_colaborador }}</p>
                    </div>
                </div>

                <div class="uk-width-1-1 uk-margin-remove-bottom">
                    <p class="uk-h4 uk-text-muted uk-text-normal uk-margin-small-top uk-width-1-1 uk-m">
                        {{ __('Dados do pedido') }}
                    </p>
                    <hr>
                </div>

                <div class="uk-width-1-2@s  uk-margin-small-top">
                    <div class=" uk-placeholder">
                        <label for="diagnostico" class="uk-form-label">
                            {{ __('Pedido de:') }}
                        </label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ ucfirst($prolongamento->tipo) }}</p>
                    </div>
                </div>
                <div class="uk-width-1-2@s uk-margin-small-top">
                    <div class=" uk-placeholder">
                        <label for="diagnostico" class="uk-form-label">
                            {{ __('Quem pede:') }}
                        </label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ $prolongamento->pedido_de }}</p>
                    </div>
                </div>


                <div class="uk-width-1-1@s  uk-margin-small-top">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="uk-h5" colspan="4">Dados do prolongamento</th>

                                </tr>
                                <tr>
                                    <th class="uk-text-small">Datas</th>
                                    <th class="uk-text-small">Hora de início</th>
                                    <th class="uk-text-small">Hora final</th>
                                </tr>
                            </thead>
                            <tr>
                                <td><input
                                        value="{{ date('d-m-Y', strtotime($prolongamento->dados->data_prolongamento)) }}"
                                        readonly class="uk-input " /></td>
                                <td><input type="text" value="{{ $prolongamento->dados->hora_inicio_prolongamento }}"
                                        readonly class="uk-input" /></td>
                                <td><input type="text" value="{{ $prolongamento->dados->hora_fim_prolongamento }}"
                                        readonly class="uk-input" /></td>

                            </tr>
                        </table>
                    </div>
                </div>

                <div class="uk-width-1-3@s uk-margin-small-top">
                    <div class=" uk-placeholder">
                        <label for="diagnostico" class="uk-form-label">
                            {{ __('Forma de compensação') }}
                        </label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ $prolongamento->forma_compensacao }}</p>
                    </div>
                </div>

                @if($prolongamento->parecer_rh != NULL)
                <div class="uk-width-1-3@s uk-margin-small-top">
                    <div class=" uk-placeholder">
                        <label for="diagnostico" class="uk-form-label">
                            {{ __('Parecer do RH') }}
                        </label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ $prolongamento->parecer_rh }}</p>
                    </div>
                </div>
                @endif
                @if($prolongamento->parecer_chefe != NULL)
                <div class="uk-width-1-3@s uk-margin-small-top">
                    <div class=" uk-placeholder">
                        <label for="diagnostico" class="uk-form-label">
                            {{ __('Parecer do Chefe do sector') }}
                        </label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ $prolongamento->parecer_chefe }}</p>
                    </div>
                </div>
                @endif

                <div class="uk-width-1-2@s uk-margin-small-top">

                    <div class="uk-placeholder">
                        <label for="diagnostico" class="uk-form-label">
                            {{ __('Motivo') }}
                        </label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ $prolongamento->motivo }}</p>
                    </div>
                </div>

                @if($prolongamento->observacoes != NULL)
                <div class="uk-width-1-2@s uk-margin-small-top">
                    <div class=" uk-placeholder">
                        <label for="diagnostico" class="uk-form-label">
                            {{ __('Observação') }}
                        </label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ $prolongamento->observacoes }}</p>
                    </div>
                </div>
                @endif

                @if($prolongamento->parecer_rh == NULL || $prolongamento->parecer_chefe == NULL)

                @if((Auth::check() and Auth::user()->hasRole('gestor-recursos-humanos')) and $prolongamento->parecer_rh == NULL)

                <form method="POST" action="{{ route('prolongamento.update', $prolongamento) }}"
                    class="uk-form-stacked uk-width-1-1@s uk-margin-remove-top">
                    @method('PUT')
                    @csrf
                    <div class="uk-margin  uk-grid">
                        <div class="uk-width-1-2@s uk-margin-small-top">
                            <label for="estado" class="uk-form-label uk-margin-small-top">
                                {{ __('Responder ao pedido') }}
                            </label>

                            <div class="uk-form-control">
                                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">

                                    <label class="uk-text-small">
                                        <input class="uk-radio" type="radio" id="status" name="parecer_rh"
                                            value="Reúne Requisitos">
                                        Reúne Requisitos</label>

                                    <label class="uk-text-small">
                                        <input class="uk-radio" type="radio" id="status" name="parecer_rh"
                                            value="Não Reúne Requisitos">
                                        Não Reúne Requisitos</label>
                                    @error('parecer_rh')
                                    <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="uk-width-1-2@s">
                            <label for="observacao" class="uk-form-label">
                                {{ __('Observação') }}
                            </label>
                            <div class="uk-form-control">
                                <textarea class="uk-textarea @error('motivo') uk-form-danger @enderror" id="motivo"
                                    name="observacao" placeholder="Observação" rows="2" autocomplete="off"></textarea>
                                @error('observacao')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="uk-form-control uk-card-footer">
                        <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                            {{ __('Enviar resposta') }}
                        </button>
                    </div>
                </form>

                @elseif(Auth::user()->sector)

                @if((Auth::user()->sector->id == $prolongamento->sector_id) and $prolongamento->parecer_chefe == NULL)
                <form method="POST" action="{{ route('prolongamento.update', $prolongamento) }}"
                    class="uk-form-stacked uk-width-1-1@s uk-margin-remove-top">
                    @method('PUT')
                    @csrf
                    <div class="uk-width-1-1@s uk-margin-small-top">
                        <label for="estado" class="uk-form-label uk-margin-small-top">
                            {{ __('Responder ao pedido') }}
                        </label>
                        <div class="uk-form-control">
                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">

                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio" id="status" name="parecer_chefe"
                                        value="Favorável">
                                    Favorável</label>

                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio" id="status" name="parecer_chefe"
                                        value="Não Favorável">
                                    Não Favorável</label>
                                @error('parecer_chefe')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="uk-form-control uk-card-footer">
                            <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                                {{ __('Enviar resposta') }}
                            </button>
                        </div>
                    </div>
                </form>
                @endif
                @endif
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
            <p>Deseja rescindir o contrato com <strong> {{$prolongamento->name }}</strong> ? Esta acção é
                inreversível
            </p>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <form method="POST" action="{{route('contrato.destroy', $prolongamento->id)}}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <div class="form-group">
                    <button
                        class="uk-button uk-button-default uk-border-rounded uk-box-shadow-hover-small uk-modal-close"
                        type="button">Cancelar
                    </button>
                    <input type="submit" class="uk-button uk-border-rounded uk-button-danger" value="Rescindir">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
