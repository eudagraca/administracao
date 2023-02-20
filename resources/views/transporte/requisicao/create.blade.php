@extends('layouts.admin')

@section('title-page')
    Requição de transporte
@endsection
@section('links')
    <a class="uk-button uk-button-text"
       href="{{ route('requisicaoTransporte.index') }}">Requisições</a> / Requisição de transporte
@endsection
@section('link')
    Requição de transporte
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')

        <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">

            <div class="uk-card uk-card-default uk-width-1-1@s">

                <div class="card-header">
                    <div class="uk-child-width-1-1@l">
                        <div>
                            <a href="{{route('pre-requisicao.PDF', $preRequisicao->id)}}"
                               class="uk-button uk-button-secondary uk-text-bolder uk-border-rounded uk-box-shadow-hover-large uk-align-right"><i
                                    class="fas fa-file-pdf"></i> PDF</a>
                        </div>
                    </div>
                </div>
                <div
                    class="uk-grid uk-margin-medium-left uk-margin-medium-right uk-margin-top uk-placeholder">
                    <div class="uk-child-width-1-2@s">
                        <label class="uk-form-label">Sector</label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ $preRequisicao->sector->name }}</p>
                    </div>

                    <div class="uk-child-width-1-2@ uk-margin-left">
                        <label class="uk-form-label">Nível de prioridade</label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ ucfirst($preRequisicao->prioridade) }}</p>
                    </div>

                    <div class="uk-child-width-1-2@ uk-margin-left">
                        <label class="uk-form-label">Remetente</label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ $preRequisicao->user->name }}</p>
                    </div>

                    <div class="uk-child-width-1-2@ uk-margin-left">
                        <label class="uk-form-label">Data da requisição</label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ date( 'd - m - Y' , strtotime($preRequisicao->created_at)) }}
                            às {{ date( 'H:i' , strtotime($preRequisicao->created_at))}}</p>
                    </div>

                    <div class="uk-child-width-1-2@ uk-margin-left">
                        <label class="uk-form-label">Estado a requisição</label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ ucfirst($preRequisicao->estado) }}</p>
                    </div>
                </div>

                <div
                    class="uk-grid uk-margin-medium-left uk-margin-medium-right uk-margin-top uk-placeholder">
                    <div class="uk-child-width-1-2@ uk-margin-remove-left">
                        <label class="uk-form-label">Tipo de viajem</label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ $preRequisicao->tipo_viajem }}</p>
                    </div>

                    <div class="uk-child-width-1-2@ uk-margin-left">
                        <label class="uk-form-label">Origem</label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ ucfirst($preRequisicao->origem) }}</p>
                    </div>

                    <div class="uk-child-width-1-2@ uk-margin-left">
                        <label class="uk-form-label">Destino</label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ $preRequisicao->local->name }}</p>
                    </div>

                    <div class="uk-child-width-1-2@ uk-margin-left">
                        <label class="uk-form-label">Tempo estimado de viajem</label>
                        <p class="uk-text-normal uk-margin-remove-top">{{$preRequisicao->tempo_viajem}}</p>
                    </div>

                    <div class="uk-child-width-1-2@ uk-margin-left">
                        <label class="uk-form-label">Carga</label>
                        <p class="uk-text-normal uk-margin-remove-top">{{ ucfirst($preRequisicao->mercadoria) }}</p>
                    </div>

                    <div class="uk-child-width-1-2@ uk-margin-left">
                        <label class="uk-form-label">Dia e hora de saída proposta</label>
                        <p class="uk-text-normal uk-margin-remove-top">
                            {{ date('d-m-Y', strtotime($preRequisicao->dia_saida)) }}
                            às {{ date('H:i', strtotime($preRequisicao->hora_saida))  }}</p>
                    </div>
                </div>

                @if(count($preRequisicao->pessoas)>0)
                    <div
                        class="uk-grid uk-margin-medium-left uk-margin-medium-right uk-margin-top uk-placeholder">

                        <div class="uk-child-width-1-1@ uk-margin-remove-left">
                            <p class="uk-h4 uk-text-muted uk-text-bold uk-heading-bullet">{{ $preRequisicao->quantidade }}
                                Acompanhantes</p>
                            @foreach($preRequisicao->pessoas as $pessoa)
                                <p class="uk-text-normal uk-margin-remove-top uk-margin-remove-bottom">{{ $pessoa->nome }}</p>
                            @endforeach
                        </div>
                    </div>
                @elseif($preRequisicao->volume != NULL)

                    <div
                        class="uk-grid uk-margin-medium-left uk-margin-medium-right uk-margin-top uk-placeholder">

                        <div class="uk-child-width-1-1@ uk-margin-remove-left">
                            <p class="uk-h4 uk-text-muted uk-text-bold uk-heading-bullet">
                                Volume</p>

                            <p class="uk-text-normal uk-margin-remove-top uk-margin-remove-bottom">{{ $preRequisicao->volume .' '.$preRequisicao->unidade}}</p>
                        </div>
                    </div>
                @endif

                @if(Auth::check() and Auth::user()->hasRole('gestor-administracao'))
                    <form method="POST" action="{{ route('requisicaoTransporte.store') }}"
                          class="uk-form-stacked">
                        {{ csrf_field() }}

                        <div class="uk-card-body setup-content uk-grid">
                            <input name="user_id" class="uk-invisible" hidden value="{{ Auth::id() }}">
                            <input name="pre_requisicao_id" class="uk-invisible" hidden value="{{ $preRequisicao->id}}">

                            <div class="uk-width-1-3@s">
                                <label for="motorista_id" class="uk-form-label">
                                    {{ __('Motorista') }}
                                </label>
                                <select id="motorista_id" name="motorista_id"

                                        class="uk-select @error('motorista_id') uk-form-danger @enderror">
                                    <option disabled selected>Seleccione o motorista</option>
                                    @foreach($motoristas as $motorista)
                                        <option
                                            value="{{$motorista->id}}" {{ $motorista->id == old('motorista_id')? 'selected':'' }}>{{ $motorista->name }}</option>
                                    @endforeach
                                </select>
                                @error('motorista_id')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="uk-width-1-3@s">
                                <label for="transporte_id" class="uk-form-label">
                                    {{ __('Transporte') }}
                                </label>
                                <select id="transporte_id" name="transporte_id"

                                        class="uk-select @error('transporte_id') uk-form-danger @enderror">
                                    <option disabled selected>Seleccione o motorista</option>
                                    @foreach($transportes as $transporte)
                                        <option
                                            value="{{$transporte->id}}" {{ $transporte->id == old('transporte_id')? 'selected':'' }}>{{ $transporte->marca }}</option>
                                    @endforeach
                                </select>
                                @error('transporte_id')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="uk-width-1-3@s">
                                <label for="hora_saida" class="uk-form-label">
                                    {{ __('Hora de saída') }}
                                </label>
                                <input id="hora_saida" name="hora_exata"
                                       placeholder="Hora de saída"

                                       type="text" value="{{ old('hora_exata') }}"
                                       class="uk-input @error('hora_exata') uk-form-danger @enderror">


                                @error('hora_exata')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="uk-width-1-3@s uk-margin-top">
                                <label for="dia_saida" class="uk-form-label">
                                    {{ __('Dia de saída') }}
                                </label>
                                <input id="dia_saida" name="dia_exata"
                                       type="text" value="{{ old('dia_exata') }}"
                                       placeholder="Dia de saída"
                                       class="uk-input @error('dia_exata') uk-form-danger @enderror">


                                @error('dia_exata')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="uk-width-1-3@s uk-margin-top">
                                <label for="observacoes" class="uk-form-label">
                                    {{ __('Observação') }} <small class="uk-text-warning">Opcional</small>
                                </label>
                                <textarea id="observacoes" name="observacoes"
                                          rows="3"
                                          class="uk-textarea @error('observacoes') uk-form-danger @enderror"></textarea>
                                @error('observacoes')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="uk-width-1-3@s uk-margin-top">
                                <label for="estado" class="uk-form-label">
                                    {{ __('Aceitar esta requisição?') }}
                                </label>
                                <div class="uk-form-control">
                                    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                        <label class="uk-text-small">
                                            <input class="uk-radio" type="radio" id="foi_aceite"
                                                   name="foi_aceite"
                                                   value="aceite"> Sim </label>

                                        <label class="uk-text-small">
                                            <input class="uk-radio" type="radio" id="foi_aceite"
                                                   name="foi_aceite"
                                                   value="negado"> Não</label>

                                        @error('foi_aceite')
                                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-1@s uk-align-right uk-card-footer">
                            <button type="submit"
                                    class="uk-button uk-margin-remove-bottom uk-align-right uk-border-rounded uk-button-primary">
                                {{ __('Responder a requisição de transporte') }}
                            </button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
@endsection
