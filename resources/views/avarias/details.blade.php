@extends('layouts.admin')

@section('title-page')
    Detalhes da avaria
@endsection
@section('links')
    <a class="uk-button uk-button-text" href="{{ route('avaria.index') }}">Avarias</a> / Detalhes
@endsection
@section('link')
    Detalhes da avarias
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">

                <div class="uk-card-badge uk-label">{{ $avaria->estado }}</div>
                <div class="uk-card-body uk-margin uk-grid">
                    <div class="uk-width-1-1 uk-margin-medium-bottom">
                        <a href="{{route('avaria.export', $avaria->id)}}" class="uk-button uk-button-secondary uk-text-bolder uk-border-rounded uk-box-shadow-hover-large uk-align-right"><i class="fas fa-file-pdf"></i>  PDF</a>
                        <p class="uk-h4 uk-text-muted uk-text-normal"><span class="uk-text-bold uk-text-small uk-text-primary">Referência</span><br>{{ $avaria->id }}</p>
                        <p class="uk-h4 uk-text-muted uk-text-normal uk-margin-small-top"><span class="uk-text-bold uk-text-primary">Sector</span><br><span>{{ $avaria->sector->name }}</span></p>
                    </div>
                    <label for="descricao" class="uk-form-label">
                        {{ __('Fornecedor de Serviço') }}
                    </label>
                    <div class="uk-width-1-1 uk-margin-medium-left uk-placeholder">
                        <p class="uk-text-normal uk-margin-remove-top">{{ $avaria->fornecedor_servico }}</p>
                    </div>
                    <label for="descricao" class="uk-form-label">
                        {{ __('Descrição') }}
                    </label>
                    <div class="uk-width-1-1 uk-margin-medium-left uk-placeholder">
                        <p class="uk-text-normal uk-margin-remove-top">{{ $avaria->descricao }}</p>
                    </div>
                    <label for="obseracao" class="uk-form-label">
                        {{ __('Observação') }}
                    </label>
                    <div class="uk-width-1-1 uk-margin-medium-left uk-placeholder">

                        <p class="uk-text-normal uk-margin-remove-top">{{ $avaria->observacao?? '_____________________' }}</p>
                    </div>


                        <div class="uk-width-1-2@s">
                            <div class=" uk-placeholder">
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('Diagnóstico') }}
                                </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $avaria->diagnostico }}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-2@s" >
                            <div class="uk-placeholder">
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('Plano de reparação') }}
                                </label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ $avaria->plano_reparacao }}</p>
                            </div>
                        </div>


                        <div class="uk-width-1-2@s uk-margin-small-top">
                            <div class=" uk-placeholder">
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('Plano de prevenção') }}
                                </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $avaria->plano_prevencao }}</p>
                            </div>
                        </div>

                    <div class="uk-width-1-2@s uk-margin-small-top">

                    <div class="uk-placeholder">
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('Responável pela resolução') }}
                                </label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ $avaria->responsavel }}</p>
                            </div>
                        </div>

                    <div class="table-responsive uk-margin-small-top">
                        <label for="dynamic_field" class="uk-form-label">
                            {{ __('Material necessário') }}
                        </label>
                        <table class="table table table-bordered" id="dynamic_field">
                            <thead>
                            <tr>
                                <th scope="col">Material</th>
                                <th scope="col">Fornecedor</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Req. N°</th>
                            </tr>
                            </thead>
                            @for ($i = 0; $i < count($avaria->materiais); $i++)
                                <tr>
                                    <td> {{ $avaria->materiais[$i]->nome }} </td>
                                    <td> {{ $avaria->materiais[$i]->fornecedor->nome }} </td>
                                    <td> {{ $avaria->materiais[$i]->quatidade }} </td>
                                    <td> {{ $avaria->materiais[$i]->preco }} </td>
                                    <td> {{ $avaria->materiais[$i]->nr_requisicao }} </td>
                                </tr>
                            @endfor
                        </table>
                    </div>

                    <div class="table-responsive uk-margin-small-top">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Custo do material</th>
                            <th scope="col">Mão de obra inicial</th>
                            <th scope="col">Mão de obra final</th>
                            <th scope="col">Valor total</th>
                        </tr>
                        </thead>
                        <tr>
                            <th>{{ $avaria->custo_do_material }}</th>
                            <th>{{ $avaria->mao_obra_inicial}}</th>
                            <td>{{ $avaria->mao_obra_final }}</td>
                            <td>{{ $avaria->valor_total }}</td>
                        </tr>
                    </table>
                    </div>

                    <div class="uk-width-1-2@s uk-margin-small-top" >
                        <div class="uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Garantia') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ $avaria->garantia }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-2@s uk-margin-small-top" >
                    <div class="uk-placeholder">
                            <label for="diagnostico" class="uk-form-label">
                                {{ __('Forma de pagamento usada') }}
                            </label>
                            <p class="uk-text-normal uk-margin-remove-top">{{ ucfirst($avaria->resposta->tecnico->pagamento) }}</p>
                        </div>
                    </div>

                    <div class="uk-width-1-2@s uk-margin">
                        <label for="responsavel_resolucao" class="uk-form-label">
                            {{ __('Comprovativo') }}
                        </label>
                        <div class="uk-form-control">

                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                <label class="uk-text-small">{{$avaria->comprovativo}}</label>
                            </div>
                        </div>
                    </div>

                    @if($avaria->estado == 'concluido')
                    <div class="uk-width-1-2@s uk-margin">
                        <label for="responsavel_resolucao" class="uk-form-label">
                            {{ __('Situação da avaria') }}
                        </label>
                        <div class="uk-form-control">

                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                <label class="uk-text-small">{{ ucfirst($avaria->estado) }}</label>
                            </div>
                        </div>
                    </div>

                    @else

                        <form class="col-6" action="{{route('avaria.estado', $avaria)}}" method="POST">
                            @method('PUT')
                            @csrf
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

                            <button type="submit" class="uk-button uk-button-small uk-button-primary uk-margin-left uk-border-rounded uk-box-shadow-hover-large" >Submeter</button>

                        </form>

                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
