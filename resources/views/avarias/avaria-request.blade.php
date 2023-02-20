@extends('layouts.admin')

@section('title-page')
    Responder a resolução da avaria
@endsection
@section('links')
    <a class="uk-button uk-button-text" href="{{ route('avaria.index') }}">Avarias</a> / Resposta
@endsection
@section('link')
    Formulário de resposta à resolução da avarias
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">
                <form id="data" method="POST" action="{{ route('avaria.response', $avaria->id) }}"
                      class="uk-form-stacked">
                    <div class="uk-card-badge uk-label ">{{ $avaria->user->name }}</div>
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="uk-card-body  uk-margin uk-grid">
                        <div class="uk-grid uk-width-1-1@s uk-margin-medium-left uk-placeholder" uk-grid>
                            <div class="uk-child-width-1-2@s">
                                <label class="uk-form-label">Sector</label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ $avaria->sector->name }}</p>
                            </div>

                            @if($avaria->compartimento != NULL)
                                <div class="uk-child-width-1-2@s">
                                    <label class="uk-form-label">Compartimento</label>
                                    <p class="uk-text-normal uk-margin-remove-top">{{ $avaria->sector->name }}</p>
                                </div>
                            @endif

                            <div class="uk-child-width-1-2@ uk-margin-left">
                                <label class="uk-form-label">Nível de prioridade</label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ ucfirst($avaria->prioridade) }}</p>
                            </div>

                            <div class="uk-child-width-1-2@ uk-margin-left">
                                <label class="uk-form-label">Remetente</label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ $avaria->user->name }}</p>
                            </div>

                            <div class="uk-child-width-1-2@ uk-margin-left">
                                <label class="uk-form-label">Data da requisição</label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ date( 'd - m - Y' , strtotime($avaria->created_at)) }}
                                    às {{ date( 'H:i' , strtotime($avaria->created_at))}}</p>
                            </div>

                            <div class="uk-child-width-1-2@ uk-margin-left">
                                <label class="uk-form-label">Estado a requisição</label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ ucfirst($avaria->estado) }}</p>
                            </div>
                        </div>
                        <input name="criacao" value="{{ date('Y/m/d', strtotime($avaria->created_at)) }}"
                               hidden>
                        <div class="uk-align-right uk-width-1-1 uk-margin-remove-bottom">
                            <div class="uk-align-right">
                                <hr class="uk-divider-small uk-flex-right">
                                <label>Referência da avaria</label>
                                <div class="uk-width-1-1">
                                    <p class="uk-h4 uk-text-muted uk-text-normal uk-align-right uk-margin-remove-bottom">{{ $avaria->id }}</p>
                                </div>
                            </div>
                        </div>


                        <div class="uk-width-1-2@s uk-margin">
                        <label for="descricao" class="uk-form-label">
                            {{ __('Descrição') }}
                        </label>
                        <div class="uk-width-1-1 uk-placeholder">
                            <p class="uk-text-normal">{{ $avaria->descricao }}</p>
                        </div>
                        </div>
                        <div class="uk-width-1-2@s uk-margin">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Onde a avaria está situada') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder">

                                <p class="uk-text-normal">{{ $avaria->referencia }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-3@s">

                            <label for="obseracao" class="uk-form-label">
                                {{ __('Categoria da avaria ') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder">

                                <p class="uk-text-normal">{{ $avaria->natureza }}</p>
                            </div>
                        </div>
                        <div class="uk-width-1-3@s">

                            <label for="obseracao" class="uk-form-label">
                                {{ __('Tempo de resolução desejado') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder">

                                <p class="uk-text-normal">{{ ucfirst($avaria->tempo_prioridade) }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-3@s">

                            <label for="obseracao" class="uk-form-label">
                                {{ __('Avaria detectada em:') }}
                            </label>
                            <div class="uk-width-1-1 uk-placeholder">

                                <p class="uk-text-normal">{{ $avaria->localizacao }}</p>
                            </div>
                        </div>

                        @if(Auth::check() and Auth::user()->hasRole('gestor-manutencao'))
                            <div class="uk-width-1-2@s uk-margin-top">
                                <label for="observacao" class="uk-form-label">
                                    {{ __('Observação') }}
                                </label>
                                <div class="uk-form-control">
                            <textarea class="uk-textarea @error('observacao') uk-form-danger @enderror"
                                      id="observacao" name="observacao"
                                      placeholder="Escreva algo para o sector {{ $avaria->sector->name }}"
                                      rows="4"
                                      {{ $avaria->estado == "concluido"? "readonly": '' }}
                                      autocomplete="off">{{ $avaria->observacao? $avaria->observacao : old('observacao') }}</textarea>
                                    @error('observacao')
                                    <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="uk-width-1-2@s uk-margin-top">
                            <label for="responsavel" class="uk-form-label">
                                {{ __('Técnico esponável pela resolução') }}
                            </label>
                            <div class="uk-form-control">
                                <select class="uk-select @error('responsavel') uk-form-danger @enderror"
                                        id="responsavel" name="responsavel">
                                    <option disabled selected>Seleccione o técnico para reparação</option>
                                    @foreach($tecnicosC as $tecnico)
                                        <option value="{{$tecnico->id }}">{{ $tecnico->name }}</option>
                                    @endforeach

                                </select>
                                @error('responsavel')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="uk-width-1-2@s uk-margin">
                            <label for="responsavel"
                                   class="uk-form-label   uiLibrary: 'bootstrap4', format: 'yyyy/mm/dd'});rm-label">
                                {{ __('Data prevista para resolução') }}
                            </label>
                            <div class="uk-form-control">
                                <input class="uk-input @error('data_para_resolucao') uk-form-danger @enderror"
                                       {{ $avaria->estado == "concluido"? "readonly": '' }}
                                       id="data_para_resolucao" name="data_para_resolucao"
                                       value="{{ $avaria->data_para_resolucao? date('Y/m/d', strtotime($avaria->data_para_resolucao)):  old('data_para_resolucao') }}"
                                       data-uk-datepicker="{format:'DD.MM.YYYY'}"
                                       placeholder="Data previsata para resolução (Ano/mes/dia)"
                                       autocomplete="off"/>
                                @error('data_para_resolucao')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <input
                            name="created_at"
                            hidden
                            value="{{ $avaria->created_at }}"/>

                        <div class="uk-width-1-2@s uk-margin">
                            <label for="hora_para_resolucao" class="uk-form-label">
                                {{ __('Hora prevista para resolução') }}
                            </label>
                            <div class="uk-form-control">

                                <input class="uk-input @error('hora_para_resolucao') uk-form-danger @enderror"
                                       id="hora_para_resolucao" name="hora_para_resolucao"
                                       {{ $avaria->estado == "concluido"? "disabled": '' }}
                                       placeholder="Hora previsata para resolução" type="time"
                                       value="{{ $avaria->hora_para_resolucao? $avaria->hora_para_resolucao : old( 'hora_para_resolucao') }}"
                                       autocomplete="off"/>
                                <small class="uk-text-small uk-text-bold uk-text-secondary">AM => Periodo da
                                    manhã</small>
                                <small class="uk-text-small uk-text-bold uk-text-primary">| PM => Periodo da tarde até a
                                    noite</small>
                                @error('hora_para_resolucao')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <input value="{{ $controller?? 'false' }}" id="controllerModal" hidden>

                        @if($controller == true)
                            {{--                            <a data-toggle="modal" href="#tallModal" class="btn btn-primary">Wide, Tall Content</a>--}}
                            <div class="uk-width-1-2@s uk-margin">
                                <br>
                                <a class="uk-button uk-border-rounded uk-button-primary uk-button-default"
                                   href="#modal-sections" uk-toggle>Lista de técnicos</a>
                            </div>
                        @endif
                    </div>
                    @if($avaria->estado != 'concluido')
                        <div class="uk-form-control uk-card-footer">
                            <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                                {{ __('Responder solicitação') }}
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        @if($controller)
            @component('tecnico.pre-lista', ['tecnicos'=>$tecnicos])
            @endcomponent
        @endif
    </div>
@endsection
