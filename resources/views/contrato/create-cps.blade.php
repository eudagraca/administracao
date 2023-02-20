@extends('contrato.create')

@section('card-title')
Elaborar Contrato de Prestação de Serviço
@endsection

@section('subcidio')
<div class="uk-width-1-3@s uk-margin">
    <label for="subcidio" class="uk-form-label">
        {{ __('Subcídio de urgência') }}
    </label>
    <div class="uk-form-control">
        <input class="uk-input @error('subcidio') uk-form-danger @enderror" id="subcidio" name="subcidio" type="number"
            min="0" placeholder="Subcídio de urgência" value="{{ old('subcidio') }}" required />
        @error('subcidio')
        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
        @enderror
    </div>
</div>
@endsection

@section('tipo')
<input name="tipo" value="CPS" hidden>
@endsection

@section('vigencia')
<div class="uk-width-1-3@s uk-margin">
    <label for="data_vigencia" class="uk-form-label">
        {{ __('Data de vigência') }}
    </label>
    <div class="uk-form-control">
        <input class="uk-input data_vigencia  @error('_data_vigencia') uk-form-danger @enderror" id="data_vigencia"
            name="data_vigencia" placeholder="Data de vigência" value="{{ old('data_vigencia') }}" required />
        @error('_data_vigencia')
        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
        @enderror
    </div>
</div>
@endsection
