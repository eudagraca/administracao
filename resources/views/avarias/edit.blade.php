@extends('layouts.admin')

@section('title-page')
    Resolução da avaria
@endsection
@section('links')
    <a class="uk-button-link" href="{{ route('avaria.index') }}">Avarias</a> / Resolucao
@endsection
@section('link')
    Formulário de Resolução da avarias
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">
                <form id="data" method="POST" action="{{ route('avaria.update', $avaria->id) }}"
                      class="uk-form-stacked">
                    <div class="uk-card-badge">
                        <a href="{{ route('avaria.resposta-detalhes', $avaria->id) }}"
                           class="uk-button uk-button-secondary uk-text-bolder uk-border-rounded uk-box-shadow-hover-large uk-align-right">
                            <i class="fas fa-long-arrow-alt-left"></i> resposta desta avaria
                        </a>
                    </div>

                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="uk-card-body uk-margin uk-grid">
                        <div class="uk-width-1-1">
                            <p class="uk-h4 uk-text-muted uk-text-normal"><span class="uk-text-bolder uk-text-primary">Avaria:<br></span>{{ $avaria->id }}
                            </p>
                        </div>

                        <div class="uk-width-1-1@s uk-align-right uk-margin-small-bottom">
                            <label for="localizacao" class="uk-form-label uk-float-right">
                                {{ __('Localização') }}
                            </label>
                        </div>

                        <div class="uk-width-1-1@s uk-align-right uk-margin-remove-left uk-margin-remove-bottom">

                            <div class="uk-form-control  uk-flex-right uk-flex">
                                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">

                                    <label class="uk-text-small"><input class="uk-radio"
                                                                        {{ $avaria->localizacao=="Matema Sede"? "checked" : '' }} value="Matema Sede"
                                                                        type="radio"
                                                                        name="localizacao">
                                        Matema Sede</label>
                                    <label class="uk-text-small"><input class="uk-radio" type="radio"
                                                                        {{ $avaria->localizacao=="Sucursal Cidade"? "checked" : '' }} value="Sucursal Cidade"
                                                                        name="localizacao"> Sucursal Cidade</label>
                                    <label class="uk-text-small"><input class="uk-radio" type="radio"
                                                                        {{ $avaria->localizacao=="Sucursal Moatize"? "checked" : '' }} value="Sucursal Moatize"
                                                                        name="localizacao"> Sucursal Moatize</label>
                                </div>
                            </div>


                            @error('localizacao')
                            <span
                                class="uk-text-danger uk-text-small uk-margin-remove-top uk-flex-right uk-flex">{{ $message }}</span>
                            @enderror
                            <p class="uk-margin-remove-top uk-margin-bottom">
                                <span
                                    class="uk-text-bolder uk-text-normal uk-text-primary">Sector: </span> {{ $avaria->sector->name }}
                            </p>
                            <span
                                class="uk-text-bolder uk-text-normal uk-text-primary">Requisitada por: </span> {{ $avaria->user->name }}</p>
                            <span
                                class="uk-text-bolder uk-text-normal uk-text-primary">Compartimento: </span> {{ $avaria->compartimento == NULL? 'Não Definido': $avaria->compartimento }}</p>
                        </div>

                        <div class="uk-width-1-1@s uk-margin-small">
                            <label for="proximo_passo" class="uk-form-label">
                                {{ __('Fornecedor de serviço') }} <small class="uk-text-warning">Obrigatório</small>
                            </label>
                            <div class="uk-form-control">
                                <input id="fornecedor_servico" type="text"
                                       value="{{ $avaria->resposta->tecnico->name }}"
                                       class="uk-input" readonly
                                       name="fornecedor_servico">
                            </div>
                        </div>

                        <label for="descricao" class="uk-form-label uk-margin-remove-top">
                            {{ __('Descrição') }}
                        </label>
                        <div class="uk-width-1-1 uk-margin-medium-left  uk-margin-remove-top uk-placeholder">
                            <p class="uk-text-normal">{{ $avaria->descricao }}</p>
                        </div>

                        <div class="uk-width-1-2@s">
                            <label for="obseracao" class="uk-form-label">
                                {{ __('Observação do gestor') }}
                            </label>

                            <div class="uk-placeholder uk-margin-remove-top">
                                @if($avaria->resposta)
                                    <p class="uk-text-normal">{{ $avaria->resposta->observacao?? '____________________________' }}</p>
                                @else
                                    <hr class="uk-divider-small">
                                @endif
                            </div>
                        </div>


                        <div class="uk-width-1-2@s">
                            <label for="responsavel" class="uk-form-label">
                                {{ __('Responável pela resolução') }}
                            </label>
                            <div class="uk-placeholder uk-margin-remove-top">
                                <p class="uk-text-normal">{{ $avaria->responsavel  }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-2@s uk-margin">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Diagnóstico') }}
                            </label>
                            <div class="uk-form-control">
                            <textarea class="uk-textarea @error('diagnostico') uk-form-danger @enderror"
                                      id="diagnostico" name="diagnostico" placeholder="Ex:. O computador não liga devido ao problema na fonte de alimentação"
                                      rows="4"
                                      autocomplete="off">{{  $avaria->diagnostico? $avaria->diagnostico : old('diagnostico') }}</textarea>
                                @error('diagnostico')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="uk-width-1-2@s uk-margin-top">
                            <label for="plano_reparacao" class="uk-form-label">
                                {{ __('Plano de reparação') }}
                            </label>
                            <div class="uk-form-control">
                            <textarea class="uk-textarea @error('plano_reparacao') uk-form-danger @enderror"
                                      id="plano_reparacao" name="plano_reparacao"
                                      placeholder="Descreva a plano de reparação" rows="4"
                                      autocomplete="off">{{ $avaria->plano_reparacao? $avaria->plano_reparacao : old('plano_reparacao') }}</textarea>
                                @error('plano_reparacao')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="uk-width-1-2@s">
                            <label for="plano_prevencao" class="uk-form-label">
                                {{ __('Plano de prevenção') }}
                            </label>
                            <div class="uk-form-control">
                            <textarea class="uk-textarea @error('plano_prevencao') uk-form-danger @enderror"
                                      id="plano_prevencao" name="plano_prevencao"
                                      placeholder="Descreva o plano de prevenção" rows="4"
                                      autocomplete="off">{{ $avaria->plano_prevencao? $avaria->plano_prevencao : old('plano_prevencao') }}</textarea>
                                @error('plano_prevencao')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="uk-width-1-4@s">
                            <label for="horas_duracao" class="uk-form-label">
                                {{ __('Horas de duração') }}
                            </label>
                            <div class="uk-form-control  @error('horas_duracao') uk-form-danger @enderror">
                                <input class="uk-input" type="number"
                                       value="{{ $avaria->horas_duracao? $avaria->horas_duracao : old('horas_duracao', 0) }}"
                                       min="0"
                                       id="horas_duracao" name="horas_duracao" placeholder="Horas de duracao">

                                @error('horas_duracao')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="uk-width-1-4@s">
                            <label for="minutos_duracao" class="uk-form-label">
                                {{ __('Minutos de duração') }}
                            </label>
                            <div class="uk-form-control  @error('minutos_duracao') uk-form-danger @enderror">
                                <input class="uk-input" type="number" id="minutos_duracao" min="0"
                                       value="{{ $avaria->minutos_duracao? $avaria->minutos_duracao : old('minutos_duracao', 0) }}"
                                       name="minutos_duracao" placeholder="Minutos de duração">

                                @error('minutos_duracao')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="table-responsive uk-margin">
                            <label for="dynamic_field" class="uk-form-label">
                                {{ __('Material necessário') }}
                            </label>
                            <table class="table" id="dynamic_field">
                                <thead>
                                <tr>
                                    <th scope="col">Material</th>
                                    <th scope="col">Fornecedor</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">&emsp;+</th>
                                </tr>
                                </thead>
                                @if(old('nome'))
                                    @for ($i = 1; $i <= count(old('nome')); ++$i)
                                        <tr>
                                            <td><input type="text" name="nome[{{$i}}]"
                                                       value="{{ old('nome')[$i] }}" placeholder="O material"
                                                       class="uk-input name_list"/></td>
                                            <td><input type="text" name="fornecedor[{{$i}}]"
                                                       value="{{ old('fornecedor')[$i]  }}"
                                                       placeholder="O fornecedor"
                                                       class="uk-input name_list"/></td>
                                            <td><input type="number" name="quantidade[{{$i}}]"
                                                       value="{{ old('quantidade')[$i]  }}"
                                                       placeholder="Quantidade"
                                                       class="uk-input name_list quantidade"/></td>
                                            <td><input type="number" name="preco[{{$i}}]"
                                                       value="{{ old('preco')[$i]  }}"
                                                       placeholder="Preço unitário"
                                                       class="uk-input preco"/></td>
                                            <td><input type="text" name="nr_requisicao[{{$i}}]"
                                                       value="{{ old('nr_requisicao')[$i]  }}"
                                                       placeholder="Req. N°"
                                                       class="uk-input nr_requisicao"/></td>

                                            <td>
                                                <button type="button" name="remove" id="{{$i}}"
                                                        class="btn btn-danger btn_remove"><span><i
                                                Fornece            class="fas fa-times-circle"></i></span></button>
                                            </td>
                                        </tr>
                                    @endfor
                                  @else

                                @endif
                            </table>
                            <td>
                                <button type="button" name="add" id="add"
                                        class="btn btn-dark uk-box-shadow-hover-medium"><span><i
                                            class="fa fa-plus-circle" aria-hidden="true"></i></span>
                                </button>
                            </td>

                            <tr>
                                <button type="button" name="add" id="calc"
                                        class="btn btn-success uk-box-shadow-hover-medium uk-align-right"><span><i
                                            class="fa fa-check-circle" aria-hidden="true"></i>  Calcular preço do
                                    material</span></button>
                            </tr>
                        </div>

                        <div class="uk-width-1-4@s uk-margin">
                            <label for="custo_do_material" class="uk-form-label">
                                {{ __('Custo do material') }}
                            </label>
                            <div class="uk-form-control ">
                                <input class="uk-input" type="number"
                                       value="{{ $avaria->custo_do_material? $avaria->custo_do_material : old('custo_do_material', 0) }}"
                                       disabled id="custo_do_material"
                                       name="custo_do_material">
                                @error('custo_do_material')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="uk-width-1-4@s uk-margin">
                            <label for="mao_obra_inicial" class="uk-form-label">
                                {{ __('Mão de obra inicial') }}
                            </label>
                            <div class="uk-form-control ">
                                <input class="uk-input" id="mao_obra_inicial" type="number"
                                       value="{{ $avaria->mao_obra_inicial? $avaria->mao_obra_inicial : old('mao_obra_inicial') }}"
                                       min="0"
                                       name="mao_obra_inicial">
                                @error('mao_obra_inicial')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="uk-width-1-4@s uk-margin">
                            <label for="mao_obra_final" class="uk-form-label">
                                {{ __('Mão de obra final') }}
                            </label>
                            <div class="uk-form-control ">
                                <input class="uk-input" id="mao_obra_final"
                                       value="{{ $avaria->mao_obra_final? $avaria->mao_obra_final : old('mao_obra_final') }}"
                                       min="0"
                                       type="number" name="mao_obra_final">
                                @error('mao_obra_final')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="uk-width-1-4@s uk-margin">
                            <label for="valor_total" class="uk-form-label">
                                {{ __('Valor total') }}
                            </label>
                            <div class="uk-form-control ">
                                <input class="uk-input" type="number" value="{{ $avaria->valor_total }}" disabled
                                       id="valor_total" name="valor_total">
                                @error('valor_total')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="uk-width-1-4@s uk-margin">
                            <label for="garantia" class="uk-form-label">
                                {{ __('Garantia') }}
                            </label>
                            <div class="uk-form-control">
                                <input class="uk-input" type="number" min="0" name="garantia" id="garantia" value="{{ old('garantia') }}">

                                @error('garantia')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="uk-width-1-4@s uk-margin">
                            <label for="unidade" class="uk-form-label">
                                {{ __('Unidade') }}
                            </label>
                            <div class="uk-form-control">
                                <select class="uk-select" id="unidade" name="unidade">
                                    <option disabled selected>Seleccione a unidade</option>
                                    <option value="Minutos">Minutos</option>
                                    <option value="Horas">Horas</option>
                                    <option value="Dias">Dias</option>
                                    <option value="Semanas">Semanas</option>
                                    <option value="Meses">Meses</option>
                                    <option value="Anos">Anos</option>
                                </select>
                                @error('unidade')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="uk-width-1-4@s uk-margin">
                            <label for="pagamento" class="uk-form-label">
                                {{ __('Forma de pagamento do técnico') }}
                            </label>
                            <div class="uk-form-control">

                                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                    <label class="uk-text-small">
                                        <input class="uk-radio" readonly type="radio" checked>
                                        {{ ucfirst($avaria->resposta->tecnico->pagamento )}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="uk-width-1-4@s uk-margin">
                            <label for="comprovativo" class="uk-form-label">
                                {{ __('Comprovativo') }}
                            </label>
                            <div class="uk-form-control">
                                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                    <label class="uk-text-small"><input class="uk-radio" type="radio"
                                        checked value="{{ $avaria->resposta->tecnico->comprovativo_pagamento }}"
                                        name="comprovativo"> {{ $avaria->resposta->tecnico->comprovativo_pagamento }}</label>
                                </div>
                            </div>
                            @error('comprovativo')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="estado" class="uk-form-label">
                                {{ __('Em que situação encontra-se a resolucção da avaria?') }}
                            </label>
                            <div class="uk-form-control">
                                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                    <label class="uk-text-small">
                                        <input class="uk-radio" type="radio" id="estado"
                                               name="estado"
                                               {{ $avaria->estado=="concluido"? "checked": "" }}
                                               value="concluido"> Concluída </label>

                                    <label class="uk-text-small">
                                        <input class="uk-radio" type="radio" id="estado"
                                               {{ $avaria->estado=="pendente"? "checked": "" }}
                                               name="estado"
                                               value="pendente"> Pendente</label>
                                    @error('estado')
                                    <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="uk-form-control uk-card-footer">
                        @if($avaria->estado !="concluido")
                            <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                                {{ __('Registar resolução') }}
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        var cont = 0;
         function getFornecedor(x) {
            id = "#";
            id = id.concat(x.getAttribute('id'));
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var fornecedor = $(id).val();
            $(document).ready(function () {
            //     $(id).keyup(function () {
                    var query = $(this).val();
                    console.log(id);

                    // if (query != '') {
                        $(id).autocomplete({
                            source: function (request, response) {
                                // Fetch data
                                $.ajax({
                                    url: "/getFornecedor",
                                    type: 'post',
                                    dataType: "json",
                                    data: {
                                        _token: CSRF_TOKEN,
                                        query: query,
                                        fornecedor: request.term
                                    },
                                    success: function (data) {
                                        response(data);
                                    },
                                    error: function (data) {
                                        console.log( data);
                                    }
                                });
                            },
                            select: function (event, ui) {
                                if(ui.item.value != null){
                                    $(id).val(ui.item.label +" - "+ui.item.value ); // display the selected text
                                }else{
                                    $("#fornecedor"+cont).val(''); // display the selected text
                                }
                                cont++;
                                return false;
                            }
                        });
                    // }
                });
            // });
        }
    </script>
@endsection
