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
        <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">
                <form id="formTransporte" method="POST" action="{{ route('preRequest.store') }}"
                      class="uk-form-stacked">
                    {{ csrf_field() }}

                    <div id="step-1" class="uk-card-body setup-content uk-grid">
                        <input name="user_id" class="uk-invisible" hidden value="{{ Auth::id() }}">

                        <div class="uk-width-1-3@s">
                            <label for="tipo_viajem" class="uk-form-label">
                                {{ __('Tipo de viajem') }}
                            </label>
                            <select id="tipo_viajem" name="tipo_viajem"
                                    class="uk-select @error('tipo_viajem') uk-form-danger @enderror dynamic"
                                    data-dependent="local_id">
                                <option disabled selected>Seleccione a viajem</option>
                                @foreach($tiposDeViajem as $tipoDeViajem)
                                    <option value="{{ $tipoDeViajem }}">{{ $tipoDeViajem }}</option>
                                @endforeach
                            </select>
                            @error('tipo_viajem')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="uk-width-1-3@s">
                            <label for="origem" class="uk-form-label">
                                {{ __('Origem da empresa') }}
                            </label>

                            <select name="origem" id="origem" class="uk-select @error('origem') uk-form-danger @enderror">
                                <option disabled selected>Seleccione a origem da viajem</option>
                                @foreach($sucursais as $sucursal)
                                    <option value="{{ $sucursal->nome }}" {{ $sucursal->nome == old('origem')? 'sleceted':'' }}>{{ $sucursal->nome }}</option>
                                @endforeach
                            </select>
                            @error('origem')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="uk-width-1-3@s">
                            <label for="local_id" class="uk-form-label">
                                {{ __('Destino de viajem') }}
                            </label>
                            <select id="local_id" name="local_id"
                                    class="uk-select @error('local_id') uk-form-danger @enderror">
                                <option disabled selected>Seleccione o destino</option>
                            </select>
                            @error('local_id')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="uk-width-1-3@s uk-margin-top">
                            <label for="sector" class="uk-form-label">
                                {{ __('Sector') }}
                            </label>
                            <div class="uk-form-control">
                                <select id="sector"
                                        class="uk-select @error('sector_id') uk-form-danger @enderror" name="sector_id"
                                        required>

                                    <option disabled selected>Seleccione o sector</option>
                                    @foreach($sectores as $sector)
                                        <option
                                            value="{{ $sector->id }}" {{ $sector->id == old('sector_id')? 'selected': ''  }}>{{$sector->name}}</option>
                                    @endforeach

                                </select>
                                @error('sector_id')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="uk-width-1-3@s uk-margin-top">
                            <label for="tempo_viajem" class="uk-form-label">
                                {{ __('Tempo de viajem') }}
                            </label>
                            <input id="tempo_viajem" name="tempo_viajem"
                                   placeholder="Ex:. 1 Dia" value="{{ old('tempo_viajem') }}"
                                   class="uk-input @error('tempo_viajem') uk-form-danger @enderror">


                            @error('tempo_viajem')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="uk-width-1-3@s uk-margin-top">
                            <label for="prioridade" class="uk-form-label">
                                {{ __('Prioridade') }}
                            </label>
                            <select id="prioridade" name="prioridade"
                                    class="uk-select @error('prioridade') uk-form-danger @enderror">
                                <option disabled selected>Seleccione o prioridade</option>
                                <option value="Alta" {{old('prioridade') == "Alta"? 'selected': ''}}>Alta</option>
                                <option value="Média" {{old('prioridade') == "Média"? 'selected': ''}}>Média</option>
                                <option value="Baixa" {{old('prioridade') == "Baixa"? 'selected': ''}}>Baixa</option>
                            </select>
                            @error('prioridade')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="uk-width-1-3@s uk-margin-top">
                            <label for="hora_saida" class="uk-form-label">
                                {{ __('Hora de saída') }}
                            </label>
                            <input id="hora_saida" name="hora_saida"
                                   placeholder="Hora de saída"
                                   type="text" value="{{ old('hora_saida') }}"
                                   class="uk-input @error('hora_saida') uk-form-danger @enderror">


                            @error('hora_saida')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="uk-width-1-3@s uk-margin-top">
                            <label for="dia_saida" class="uk-form-label">
                                {{ __('Dia de saída') }}
                            </label>
                            <input id="dia_saida" name="dia_saida"
                                   type="text" value="{{ old('dia_saida') }}"
                                   placeholder="Dia de saída"
                                   class="uk-input @error('dia_saida') uk-form-danger @enderror">


                            @error('dia_saida')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="uk-width-1-3@s uk-margin">
                            <label for="mercadoria" class="uk-form-label">
                                {{ __('Mercadoria') }}
                            </label>
                            <select id="mercadoria" name="mercadoria"
                                    class="uk-select @error('mercadoria') uk-form-danger @enderror">
                                <option disabled selected>Seleccione a tipo de mercadoria</option>
                                <option value="Mercadoria">Mercadoria</option>
                                <option value="Pessoas">Pessoas</option>
                            </select>
                            @error('mercadoria')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div id="volume_input" hidden="true" class="uk-width-1-3@s ">
                            <label for="volume" class="uk-form-label">
                                {{ __('Volume') }}
                            </label>
                            <input id="volume" name="volume"
                                   class="uk-input @error('volume') uk-form-danger @enderror">
                            @error('volume')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="volume_unidade" hidden="true" class="uk-width-1-3@s ">
                            <label for="unidade" class="uk-form-label">
                                {{ __('Unidade') }}
                            </label>
                            <select class="uk-select @error('unidade') uk-form-danger @enderror" name="unidade" id="unidade">
                                <option selected disabled>Seleccione a unidade</option>
                                <option value="Gramas">Gramas</option>
                                <option value="Kilogramas">Kilogramas</option>
                                <option value="Toneladas">Toneladas</option>
                                <option value="Litro">Litros</option>
                            </select>

                            @error('unidade')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div id="container_pessoas" hidden="true" class="uk-width-1-1@s">
                            <label for="pessoas" class="uk-width-1-1@s uk-form-label">
                                {{ __('Pessoas que acompanham na viajem') }}
                            </label>
                            <div class="uk-width-1-2@s uk-margin-small-bottom">
                                <input id="pessoas" name="pessoas[0]"
                                       class="uk-input">
                            </div>
                            <div class="uk-width-1-1@s uk-grid" id="pessoas_container">

                            </div>
                        </div>

                        <div class="uk-width-1-2@s" hidden="true" id="add_button">
                            <button id="add_pessoa" type="button"
                                    class="uk-button uk-button-primary uk-border-rounded uk-margin-top"><i
                                    class="fa fa-plus-circle"></i> uma
                            </button>

                        </div>

                        <div class="uk-width-1-1@s uk-margin-small-top">
                            <label for="descricao" class="uk-form-label">
                                {{ __('Descrição') }}
                            </label>
                            <textarea id="descricao" name="descricao"
                                      rows="3" required
                                      class="uk-textarea @error('descricao') uk-form-danger @enderror">{{old('descricao')}}</textarea>
                            @error('descricao')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>
                    <div class="uk-width-1-1@s uk-align-right uk-card-footer">

                        <button type="submit"
                                class="uk-button uk-margin-remove-bottom uk-align-right uk-border-rounded uk-button-secondary">
                            {{ __('Requisitar transporte') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
