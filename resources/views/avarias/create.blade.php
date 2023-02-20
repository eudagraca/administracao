@extends('layouts.admin')

@section('title-page')
    Registar Avaria
@endsection
@section('links')
    <a href="{{ route('avaria.index') }}" class="uk-button uk-button-text">Avarias</a> / Registo
@endsection
@section('link')
    Registro de Avaria
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">
                <form method="POST" action="{{ route('avaria.store') }}" class="uk-form-stacked">
                    {{ csrf_field() }}
                    <div class="uk-card-body uk-margin  uk-grid">

                        <div class="uk-width-1-1@s uk-align-left uk-margin-small-bottom">

                            <label for="localizacao" class="uk-form-label uk-float-left">
                                {{ __('Localização') }}
                            </label>
                        </div>
                        <div class="uk-width-1-1@s uk-align-right uk-margin-remove">
                            <div class="uk-form-control  uk-flex-left uk-flex">
                                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">

                                    <label class="uk-text-small"><input class="uk-radio" value="Matema Sede"
                                                                        required
                                                                        type="radio" {{ old('localizacao') == 'Matema Sede'? 'checked': '' }}
                                                                        name="localizacao">
                                        Matema Sede</label>
                                    <label class="uk-text-small"><input class="uk-radio" type="radio"
                                                                        value="Sucursal Cidade" {{ old('localizacao') == 'Sucursal Cidade'? 'checked': '' }}
                                                                        name="localizacao"> Sucursal Cidade</label>
                                    <label class="uk-text-small"><input class="uk-radio" type="radio"
                                                                        value="Sucursal Moatize" {{ old('localizacao') == 'Sucursal Moatize'? 'checked': '' }}
                                                                        name="localizacao"> Sucursal Moatize</label>
                                </div>
                            </div>

                            @error('localizacao')
                            <span
                                class="uk-text-danger uk-text-small uk-margin-remove-top uk-flex-right uk-flex">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="uk-width-1-2@s">
                            <label for="sector" class="uk-form-label">
                                {{ __('Sector') }}
                            </label>
                            <div class="uk-form-control">
                                <select id="sector"
                                        class="uk-select @error('sector_id') uk-form-danger @enderror" name="sector_id"
                                        required>

                                    <option disabled selected>Seleccione o sector</option>
                                    @foreach($sectores as $sector)
                                        <option value="{{ $sector->id }}" {{ $sector->id == old('sector_id')? 'selected': ''  }}>{{$sector->name}}</option>
                                    @endforeach

                                </select>
                                @error('sector_id')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="uk-width-1-2@s">
                            <label for="compartimento" class="uk-form-label">
                                {{ __('Compartimento') }}
                            </label>
                            <div class="uk-form-control">
                                <input id="compartimento" type="text"
                                       class="uk-input @error('compartimento') uk-form-danger @enderror" placeholder="Compartimento"
                                       name="compartimento" value="{{ old('compartimento') }}">
                                @error('compartimento')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="uk-width-1-2@s uk-margin">
                            <label for="prioridade" class="uk-form-label">
                                {{ __('Nível de prioridade') }}
                            </label>
                            <div class="uk-form-control">
                                <select id="prioridade" readonly type="text"
                                        class="uk-select @error('prioridade') uk-form-danger @enderror" name="prioridade"
                                        required>

                                    <option selected disabled>Qual é o nível de prioridade</option>
                                    @foreach($urgencias as $urgencia)
                                        <option value="{{ strtolower($urgencia) }}" {{ strtolower($urgencia)  == old('prioridade')? 'selected': ''  }}>{{$urgencia}}</option>
                                    @endforeach

                                </select>
                                @error('prioridade')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="uk-width-1-2@s uk-margin">
                            <label for="natureza" class="uk-form-label">
                                {{ __('Categoria da avaria') }}
                            </label>
                            <div class="uk-form-control">
                                <select id="natureza" readonly type="text"
                                        class="uk-select @error('natureza') uk-form-danger @enderror" name="natureza"
                                        required>

                                    <option selected disabled>Seleccione a natureza da avaria</option>
                                    @foreach($naturezas as $natureza)
                                        <option value="{{ $natureza->area }}" {{ $natureza->area  == old('natureza')? 'selected': ''  }}>{{$natureza->area}}</option>
                                    @endforeach

                                </select>
                                @error('natureza')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="uk-width-1-2@s">
                            <label for="descricao" class="uk-form-label">
                                {{ __('Descrição') }}
                            </label>
                            <div class="uk-form-control">
                            <textarea class="uk-textarea @error('descricao') uk-form-danger @enderror" id="descricao"
                                      name="descricao"
                                      placeholder="Descreva a avaria (Oque está a acontecer)"
                                      required rows="4" autocomplete="off">{{ old('descricao') }}</textarea>
                                @error('descricao')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="uk-width-1-2@s">
                            <label for="referencia" class="uk-form-label">
                                {{ __('Referência da avaria') }}
                            </label>
                            <div class="uk-form-control">
                                <textarea class="uk-textarea @error('referencia') uk-form-danger @enderror"
                                          id="referencia" name="referencia" rows="4" placeholder="Onde a avaria ocorreu?"
                                >{{ old('referencia') }}</textarea>
                                @error('referencia')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="uk-form-control uk-card-footer">
                        <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-secondary">
                            {{ __('Registar avaria') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
