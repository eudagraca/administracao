@extends('layouts.admin')
@section('title-page')
Elaboração de contrato
@endsection
@section('links')
<a href="{{ route('contrato.index') }}" class="uk-button uk-button-text">Contratos</a> / Elaboração
@endsection
@section('link')
Elaborar contrato
@endsection
@section('content-main')
@include('layouts.flash')
<div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
    <div class="uk-card uk-card-default uk-width-1-1@s">
        <h3 class="uk-h4 uk-margin-remove-top uk-text-bold uk-card-header">@yield('card-title', '')</h3>
        <form method="POST" id="contrato" action="{{ route('contrato.store') }}" class="uk-form-stacked">
            {{ csrf_field() }}
            <div class="uk-card-body uk-margin  uk-grid">

                <div class="uk-width-1-3@s">
                    <label for="name" class="uk-form-label">
                        {{ __('Primeiros nomes') }}
                    </label>
                    <div class="uk-form-control">
                        <input class="uk-input @error('name') uk-form-danger @enderror" id="name" name="name"
                            value="{{ old('name') }}" placeholder="Primeiros nomes" required />
                        @error('name')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="uk-width-1-3@s">
                    <label for="surname" class="uk-form-label">
                        {{ __('Apelido') }}
                    </label>
                    <div class="uk-form-control">
                        <input class="uk-input @error('surname') uk-form-danger @enderror" id="surname" name="surname"
                            value="{{ old('surname') }}" placeholder="Apelido" required />
                        @error('surname')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @yield('tipo')
                <div class="uk-width-1-3@s">
                    <label for="bi" class="uk-form-label">
                        {{ __('Tipo de documento de identificação') }}
                    </label>
                    <div class="uk-form-control">
                        <select class="uk-select @error('tipo_documento') uk-form-danger @enderror" id="tipo_documento"
                            name="tipo_documento" required>
                            <option value="" disabled selected>Tipo de documento</option>
                            @foreach($tipo_documentos as $documento)
                            <option value="{{$documento->name}}"
                                {{ $documento->name == old('tipo_documento')? 'selected': '' }}>{{$documento->name}}
                            </option>
                            @endforeach
                        </select>
                        @error('tipo_documento')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="uk-width-1-3@s uk-margin">
                    <label for="bi" class="uk-form-label">
                        {{ __('Número do Bilhete de Identificação') }}
                    </label>
                    <div class="uk-form-control">
                        <input class="uk-input @error('bi') uk-form-danger @enderror" id="bi" name="bi"
                            value="{{ old('bi') }}" placeholder="N° de Bilhete de Identificação" required />
                        @error('bi')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="uk-width-1-3@s uk-margin">
                    <label for="estado_civil" class="uk-form-label">
                        {{ __('Estado Civíl') }}
                    </label>
                    <div class="uk-form-control">
                        <select class="uk-select @error('estado_civil') uk-form-danger @enderror" id="estado_civil"
                            name="estado_civil" required>
                            <option class="uk-text-muted" disabled selected>Seleccione o estado civil</option>
                            @foreach($estados as $estado)
                            <option value="{{ $estado->estado  }}"
                                {{ $estado->estado == old('estado_civil')? 'selected':'' }}>{{ $estado->estado }}
                            </option>
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
                        <select id="nacionalidade" required name="nacionalidade"
                            class="js-example-placeholder-single js-states form-control  @error('nacionalidade') uk-form-danger @enderror">
                            <option></option>
                            @foreach($nacionalidades as $nacionalidade)
                            <option value="{{$nacionalidade->gentilico }}"
                                {{$nacionalidade->gentilico == old('nacionalidade')? 'selected':''}}>
                                {{ ucfirst($nacionalidade->gentilico) }}</option>
                            @endforeach
                        </select>
                        @error('nacionalidade')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="uk-width-1-3@s">
                    <label for="residencia" class="uk-form-label">
                        {{ __('Residência') }}
                    </label>

                    <div class="uk-form-control">
                        <input class="uk-input @error('residencia') uk-form-danger @enderror" id="residencia"
                            name="residencia" value="{{ old('residencia') }}" placeholder="Residência" required />
                        @error('residencia')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="uk-width-1-3@s">
                    <label for="habilitacoes" class="uk-form-label">
                        {{ __('Nível académico') }}
                    </label>
                    <div class="uk-form-control">
                        <select class="uk-select @error('habilitacoes') uk-form-danger @enderror" id="habilitacoes"
                            name="habilitacoes" required>
                            <option class="uk-text-muted" disabled selected>Selecione a habilitação</option>
                            @foreach($habilitacoes as $habilitacao)
                            <option value="{{ $habilitacao->name }}"
                                {{ $habilitacao->name == old('habilitacoes')? 'selected':'' }}>
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
                    <label for="area_formacao" class="uk-form-label">
                        {{ __('Área de formação') }}
                    </label>
                    <div class="uk-form-control">
                        <select id="area_formacao" required name="area_formacao"
                            class="js-example-placeholder js-states form-control  @error('area_formacao') uk-form-danger @enderror">
                            <option></option>
                            @foreach($areas as $area)
                            <option value="{{$area->name }}" {{$area->name == old('area_formacao')? 'selected':''}}>
                                {{ ucfirst($area->name) }}</option>
                            @endforeach
                        </select>

                        @error('area_formacao')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="uk-width-1-3@s uk-margin">
                    <label for="data_contrato_vigor" class="uk-form-label">
                        {{ __('Data de Vigor do contrato') }}
                    </label>

                    <div class="uk-form-control">
                        <input class="uk-input data_contrato @error('data_contrato_vigor') uk-form-danger @enderror"
                            id="data_contrato_vigor" value="{{ old('data_contrato_vigor') }}" name="data_contrato_vigor"
                            placeholder="Data de vigor do contrato" required />
                        @error('data_contrato_vigor')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="uk-width-1-3@s uk-margin">
                    <label for="cargo" class="uk-form-label">
                        {{ __('Cargo') }}
                    </label>
                    <div class="uk-form-control">
                        <select class="uk-select @error('habilitacoes') uk-form-danger @enderror" id="cargo" name="cargo"
                            required>
                            <option class="uk-text-muted" disabled selected>Seleccione o cargo</option>
                            @foreach($cargos as $cargo)
                            <option value="{{ $cargo->name }}" {{ $cargo->name == old('cargo')? 'selected':'' }}>
                                {{ $cargo->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('cargo')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                @yield('subcidio')

                @yield('vigencia')

                <div class="uk-width-1-3@s uk-margin">
                    <label for="salario_bruto" class="uk-form-label">
                        {{ __('Salário bruto Mensal') }}
                    </label>

                    <div class="uk-form-control">
                        <input class="uk-input @error('salario_bruto') uk-form-danger @enderror" id="salario_bruto"
                            value="{{ old('salario_bruto') }}" type="number" min="1" name="salario_bruto"
                            placeholder="Salário bruto Mensal" required />
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
                        <input class="uk-input @error('data_assinatura') uk-form-danger @enderror" id="data_assinatura"
                            value="{{ old('data_assinatura') }}" required name="data_assinatura" type="text"
                            placeholder="Data de Assinatura do contrato" />
                        @error('data_assinatura')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- <hr class="uk-divider-icon uk-width-1-1">
                <h3 class="uk-text-bold uk-margin">
                    {{ __('Cláusulas') }}
                </h3>
               <div id="clausulas" class="uk-width-1-1@s">

                <div class="uk-width-1-1@s uk-margin">
                    <label for="nr_clausula" class="uk-form-label">
                        {{ __('Titulo') }}
                    </label>

                    <div class="uk-form-control">
                        <input class="uk-input @error('data_assinatura') uk-form-danger @enderror" id="nr_clausula"
                            value="Cláusula primeira" name="nr_clausula[0]" placeholder="Ex: Primeira Cláusula">
                        @error('nr_clausula')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="descricao_clausula" class="uk-form-label uk-margin">
                        {{ __('Descrição da cláusula') }}
                    </label>

                    <div class="uk-form-control">
                        <input class="uk-input @error('descricao_clausula') uk-form-danger @enderror" id="descricao_clausula"
                            value="{{ old('descricao_clausula[0]') }}" name="descricao_clausula[0]"
                            placeholder="Ex: Responsabilidades do contratado">
                        @error('descricao_clausula[0]')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="uk-form-control uk-margin">
                        <textarea class="uk-textarea @error('clausula[0]') uk-form-danger @enderror" id="clausula"
                            name="clausula[0]" rows="4" required placeholder="Oque diz a cláusula">{{ old('clausula[0]') }}</textarea>
                        @error('clausula[0]')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
               </div>

               <p>
                   <button id="add-clausulas" type="button" class="uk-button uk-button-secondary uk-box-shadow-small uk-border-rounded uk-text-bolder uk-text-large">+</button>
               </p> --}}
            </div>

            <div class="uk-form-control uk-card-footer">
                <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-secondary">
                    {{ __('Registar contrato') }}
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
