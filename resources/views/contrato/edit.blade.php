@extends('layouts.admin')
@section('title-page')
    Registo de contrato
@endsection
@section('links')
    <a href="{{ route('contrato.index') }}" class="uk-button uk-button-text">Contratos</a> / Registo
@endsection
@section('link')
    Registro de contrato
@endsection
@section('content-main')
    @include('layouts.flash')
    <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <h3 class="uk-h4 uk-margin-remove-top uk-text-bold uk-card-header">Registo de contrato</h3>
            <form method="POST" action="{{ route('contrato.update', $contrato->id) }}" class="uk-form-stacked">
                @method('PUT')
                {{ csrf_field() }}
                <div class="uk-card-body uk-margin  uk-grid">

                    <div class="uk-width-1-3@s">
                        <label for="contrato" class="uk-form-label">
                            {{ __('Tipo de contrato') }}
                        </label>
                        <div class="uk-form-control">
                            <select class="uk-select @error('contrato') uk-form-danger @enderror" id="contrato"
                                    name="contrato" required>
                                <option class="uk-text-muted" disabled selected>Selecione o tipo de contrato</option>
                                @foreach($tiposContrato as $tipoContrato)
                                    <option
                                        value="{{ $tipoContrato->name }}" {{ $tipoContrato->name== $contrato->contrato? 'selected':''}}>{{ $tipoContrato->name }}</option>
                                @endforeach
                            </select>
                            @error('contrato')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-3@s">
                        <label for="name" class="uk-form-label">
                            {{ __('Nome completo') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('name') uk-form-danger @enderror" id="name"
                                   name="name" value="{{ $contrato->name }}"
                                   placeholder="Nome completo"
                                   required/>
                            @error('name')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-3@s">
                        <label for="estado_civil" class="uk-form-label">
                            {{ __('Estado Civil') }}
                        </label>
                        <div class="uk-form-control">
                            <select class="uk-select @error('estado_civil') uk-form-danger @enderror" id="estado_civil"
                                    name="estado_civil" required>
                                <option class="uk-text-muted" disabled selected>Seleccione o estado civil</option>
                                @foreach($estados as $estado)
                                    <option
                                        value="{{ $estado->estado  }}" {{ $estado->estado == $contrato->estado_civil? 'selected':'' }}>{{ $estado->estado }}</option>
                                @endforeach
                            </select>
                            @error('estado_civil')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-3@s uk-margin">
                        <label for="nacionalidade" class="uk-form-label">
                            {{ __('Nacionalidade') }}
                        </label>

                        <div class="uk-form-control">
                            <select id="nacionalidade" name="nacionalidade"
                                    class="js-example-placeholder-single js-states form-control  @error('nacionalidade') uk-form-danger @enderror">
                                <option></option>
                                @foreach($nacionalidades as $nacionalidade)
                                    <option
                                        value="{{$nacionalidade->gentilico }}" {{$nacionalidade->gentilico == $contrato->nacionalidade? 'selected':''}}>{{ ucfirst($nacionalidade->gentilico) }}</option>
                                @endforeach
                            </select>
                            @error('nacionalidade')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-3@s  uk-margin">
                        <label for="bi" class="uk-form-label">
                            {{ __('Bilhete de Identificação') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('bi') uk-form-danger @enderror" id="bi"
                                   name="bi" value="{{ $contrato->bi }}" placeholder="N° de Bilhete de Identificação"
                                   required/>
                            @error('bi')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-3@s uk-margin">
                        <label for="residencia" class="uk-form-label">
                            {{ __('Residência') }}
                        </label>

                        <div class="uk-form-control">
                            <input class="uk-input @error('residencia') uk-form-danger @enderror" id="residencia"
                                   name="residencia" value="{{ $contrato->residencia }}" placeholder="Residência" required/>
                            @error('residencia')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-3@s">
                        <label for="habilitacoes" class="uk-form-label">
                            {{ __('Habilitações') }}
                        </label>
                        <div class="uk-form-control">
                            <select class="uk-select @error('habilitacoes') uk-form-danger @enderror" id="habilitacoes"
                                    name="habilitacoes" required>
                                <option class="uk-text-muted" disabled selected>Selecione a habilitação</option>
                                @foreach($habilitacoes as $habilitacao)
                                    <option
                                        value="{{ $habilitacao->name }}" {{ $habilitacao->name == $contrato->habilitacoes? 'selected':'' }} >
                                        {{ $habilitacao->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('habilitacoes')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-3@s">
                        <label for="data_contrato_vigor" class="uk-form-label">
                            {{ __('Data de Vigor do contrato') }}
                        </label>

                        <div class="uk-form-control">
                            <input class="uk-input data_contrato @error('data_contrato_vigor') uk-form-danger @enderror"
                                   id="data_contrato_vigor" value="{{ $contrato->data_contrato_vigor }}"
                                   name="data_contrato_vigor" placeholder="Data de vigor do contrato" required/>
                            @error('data_contrato_vigor')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-3@s">
                        <label for="cargo" class="uk-form-label">
                            {{ __('Cargo') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('cargo') uk-form-danger @enderror" id="cargo"
                                   name="cargo" placeholder="Cargo" value="{{ $contrato->cargo }}"
                                   required/>
                            @error('cargo')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-3@s uk-margin">
                        <label for="salario_bruto" class="uk-form-label">
                            {{ __('Salário bruto Mensal') }}
                        </label>

                        <div class="uk-form-control">
                            <input class="uk-input @error('salario_bruto') uk-form-danger @enderror" id="salario_bruto"
                                   value="{{ $contrato->salario_bruto }}"
                                   name="salario_bruto" placeholder="Salário bruto Mensal" required/>
                            @error('salario_bruto')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-3@s uk-margin">
                        <label for="data_assinatura" class="uk-form-label">
                            {{ __('Data de Assinatura do contrato') }}
                        </label>

                        <div class="uk-form-control">
                            <input class="uk-input @error('data_assinatura') uk-form-danger @enderror"
                                   id="data_assinatura" value="{{ $contrato->data_assinatura }}"
                                   name="data_assinatura" type="text" placeholder="Data de Assinatura do contrato"
                            />
                            @error('data_assinatura')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-3@s uk-margin">
                        <label for="numero" class="uk-form-label">
                            {{ __('N°') }}
                        </label>

                        <div class="uk-form-control">
                            <input class="uk-input @error('numero') uk-form-danger @enderror"
                                   id="numero" value="{{ $contrato->numero }}"
                                   name="numero" type="text" placeholder="Número"/>
                            @error('numero')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                        {{ __('Actualizar dados do contrato') }}
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection
