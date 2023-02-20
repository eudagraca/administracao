@extends('layouts.admin')

@section('title-page')
    Resposta do sector de manutenção
@endsection
@section('links')
    <a class="uk-button uk-button-text" href="{{ route('avaria.index') }}">Avarias</a> / Resposta
@endsection
@section('link')
    Resposta do sector de manutenção
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        @if($avaria->resposta != NULL)

            <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-card-badge uk-label">{{ $avaria->estado }}</div>
                    <div class="uk-card-body uk-margin uk-grid">
                        <div class="uk-width-1-1 uk-margin-medium-bottom">
                            <a href="{{ $avaria->estado == "concluido"? route('avaria.show', $avaria->id): route('avaria.edit', $avaria->id) }}"
                               class="uk-button uk-button-secondary uk-text-bolder uk-border-rounded uk-box-shadow-hover-large uk-align-right">
                                ir para a avaria <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                            <p class="uk-h4 uk-text-muted uk-text-normal"><span
                                    class="uk-text-bold uk-text-small uk-text-primary">Referência</span><br>{{ $avaria->id }}
                            </p>

                            <p class="uk-h4 uk-text-muted uk-text-normal"><span
                                    class="uk-text-bold uk-text-small uk-text-primary">Progresso da avaria</span><br>{{ ucfirst($avaria->estado) }}
                            </p>
                        </div>

                        <div class="uk-width-1-2@s">
                            <div class=" uk-placeholder">
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('Observação do gestor') }}
                                </label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ $avaria->resposta->observacao?? '_____________________' }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-4@s">
                            <div class="uk-placeholder">
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('Remetente') }}
                                </label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ $avaria->user->name }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-4@s">
                            <div class="uk-placeholder">
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('Resposta de:') }}
                                </label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ $avaria->resposta->user->name }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-3@s uk-margin-small-top">
                            <div class=" uk-placeholder">
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('Responsável pela resolução') }}
                                </label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ $avaria->responsavel }}</p>
                            </div>
                        </div>
                        <div class="uk-width-1-3@s uk-margin-small-top">
                            <div class=" uk-placeholder">
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('Responsável pela resolução') }}
                                </label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ $avaria->resposta->tecnico->phone }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-4@s uk-margin-small-top">
                            <div class="uk-placeholder">
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('Data para resolução') }}
                                </label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ date('d/m/Y', strtotime($avaria->data_para_resolucao)) }}
                                    às {{ date('H:i', strtotime($avaria->hora_para_resolucao)) }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-4@s uk-margin-top">

                            <div class="uk-placeholder">
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('O seu parecer') }}
                                </label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ ucfirst($avaria->estado_requisitante) }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-4@s uk-margin">

                            <div class="uk-placeholder">
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('Respondida a:') }}
                                </label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ date('d/m/Y', strtotime($avaria->resposta->created_at)) }}
                                    às {{ date('H:i', strtotime($avaria->hora_para_resolucao)) }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-1@s uk-margin-medium-left uk-placeholder">
                            <p class="uk-text-bold uk-h4">Informações sobre a resolução</p>
                            @if($avaria->fornecedor_servico)
                                <p class="uk-text-normal  uk-text-italic">Fornecedor de serviço defenido</p>
                            @endif

                            @if(count($avaria->materiais)>0)

                                <p class="uk-text-normal uk-text-italic">Material necessário já defenido</p>
                            @endif

                            @if($avaria->diagnostico)
                                <p class="uk-text-normal uk-text-italic">Diagnóstico disponível</p>
                            @endif

                            @if($avaria->plano_reparacao)
                                <p class="uk-text-normal uk-text-italic">Plano de reparação defenido</p>
                            @endif

                            @if($avaria->estado)
                                <p class="uk-text-normal uk-text-italic">A avaria está em estado de {{ ucfirst($avaria->estado)}}</p>
                            @endif
                        </div>

                        @if($avaria->estado == 'concluido' and $avaria->estado_requisitante != 'concluida')
                            <form method="POST" action="{{route('avaria.feedback', $avaria)}}" class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                @method('PUT')
                                @csrf
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('Confirma que a resolução da avaria já está concluída?') }}
                                </label>
                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio" id="estado_requisitante"
                                           name="estado_requisitante"
                                           {{ $avaria->estado_requisitante=="não concluida"? "checked": "" }}
                                           value="não concluida"> Não</label>

                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio" id="estado_requisitante"
                                           {{ $avaria->estado=="concluida"? "checked": "" }}
                                           name="estado_requisitante"
                                           value="concluida"> Sim</label>
                                @error('estado_requisitante')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror

                                <button type="submit" class="uk-button uk-button-small uk-button-primary uk-margin-left uk-border-rounded uk-box-shadow-hover-large" >Submeter</button>
                            </form>

                        @endif

                    </div>
                </div>
            </div>
        @else
            @component('layouts.empty')
                @slot('title')
                    A requisição para resolução da avaria ainda não foi respondida
                @endslot
            @endcomponent
        @endif
    </div>
@endsection
