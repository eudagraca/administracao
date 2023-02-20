@extends('layouts.admin')

@section('title-page')
Registar Técnico
@endsection
@section('links')
<a href="{{ route('tecnico.index') }}" class="uk-button uk-button-text">Técnico</a> / Registro
@endsection
@section('link')
Registar Técnico
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')
    <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <form method="POST" action="{{ route('tecnico.store') }}" class="uk-form-stacked">
                {{ csrf_field() }}
                <div class="uk-card-body uk-margin  uk-grid">
                    <div class="uk-width-1-2@s uk-margin">
                        <label for="name" class="uk-form-label">
                            {{ __('Nome completo') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('name') uk-form-danger @enderror" id="name" name="name"
                                type="text" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-2@s">
                        <label for="gender" class="uk-form-label">
                            {{ __('Sexo') }}
                        </label>
                        <div class="uk-form-control">
                            <select name="gender" id="gender"
                                class="uk-select @error('gender') uk-form-danger @enderror">
                                <option disabled selected>Seleccione o sexo</option>
                                @foreach ($genders as $gender)
                                <option value="{{ $gender->gender }}"
                                    {{ old('gender') ==$gender->gender ? 'selected':'' }}>{{ $gender->gender }}</option>
                                @endforeach
                            </select>
                            @error('gender')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-2@s">
                        <label for="area" class="uk-form-label">
                            {{ __('Área de trabalho') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('area') uk-form-danger @enderror" id="area" name="area"
                                type="text" value="{{ old('area') }}" required autocomplete="area" autofocus>
                            @error('area')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label for="phone" class="uk-form-label">
                            {{ __('Telefone') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('phone') uk-form-danger @enderror" id="phone" name="phone"
                                type="tel" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                            @error('phone')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="uk-width-1-2@s uk-margin">
                        <label for="address" class="uk-form-label">
                            {{ __('Morada') }}
                        </label>
                        <input id="address" type="text" class="uk-input @error('morada') uk-form-danger @enderror"
                            name="morada" value="{{ old('morada') }}" required autocomplete="address">
                        @error('morada')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="uk-width-1-2@s uk-margin">
                        <label for="pagamento" class="uk-form-label">
                            {{ __('Formas de pagamento') }}
                        </label>
                        <div class="uk-form-control">

                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                <label class="uk-text-small">
                                    <input class="uk-radio" value="cash" type="radio"
                                        {{ old('pagamento') == 'cash'? 'checked': '' }} name="pagamento">
                                    Cash</label>
                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio"
                                        {{ old('pagamento') == 'cheque'? 'checked': '' }} value="cheque"
                                        name="pagamento"> Cheque</label>
                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio"
                                        {{ old('pagamento') == 'conta corrente'? 'checked': '' }} value="conta corrente"
                                        name="pagamento"> Conta corrente</label>
                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio"
                                        {{ old('pagamento') == 'transferência'? 'checked': '' }} value="transferência"
                                        name="pagamento"> Trans.
                                    bancária</label>
                            </div>
                        </div>
                        @error('pagamento')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="uk-width-1-2@s">
                        <label for="comprovativo_pagamento" class="uk-form-label">
                            {{ __('Comprovativo') }}
                        </label>
                        <div class="uk-form-control">

                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                <label class="uk-text-small">
                                    <input class="uk-radio" value="Factura" type="radio"
                                        {{ old('comprovativo_pagamento') == 'Factura'? 'checked': '' }}
                                        name="comprovativo_pagamento">
                                    Factura</label>
                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio"
                                        {{ old('comprovativo_pagamento') == 'ISP'? 'checked': '' }} value="ISP"
                                        name="comprovativo_pagamento"> ISP</label>
                                <label class="uk-text-small">
                                    <input class="uk-radio" type="radio"
                                        {{ old('comprovativo_pagamento') == 'VD'? 'checked': '' }} value="VD"
                                        name="comprovativo_pagamento"> VD</label>
                            </div>
                        </div>
                        @error('pagamento')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-secondary">
                        {{ __('Registar técnico') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
