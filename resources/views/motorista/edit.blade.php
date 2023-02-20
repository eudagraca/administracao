@extends('layouts.admin')

@section('title-page')
Editar dados do Motorista
@endsection
@section('links')
<a href="{{ route('motorista.index') }}" class="uk-button uk-button-text">Motoristas</a> / Actualização
@endsection
@section('link')
Editar dados do Motorista
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')
    <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <form method="POST" action="{{ route('motorista.update', $motorista->id) }}"
            class="uk-form-stacked">
            @method('PUT')
            {{ csrf_field() }}
                <div class="uk-card-body uk-margin  uk-grid">
                    <div class="uk-width-1-2@s uk-margin">
                        <label for="name" class="uk-form-label">
                            {{ __('Primeiros nomes') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('name') uk-form-danger @enderror" id="name" name="name" type="text"
                                value="{{ $motorista->name }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-2@s">
                        <label for="email" class="uk-form-label">
                            {{ __('Apelido') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('surname') uk-form-danger @enderror" id="surname" name="surname"
                                type="text" value="{{ $motorista->surname }}" required autocomplete="surname" autofocus>
                            @error('surname')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label for="telefone" class="uk-form-label">
                            {{ __('Telefone') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('phone') uk-form-danger @enderror" id="phone" name="phone"
                                type="tel" value="{{ $motorista->phone }}" required autocomplete="phone" autofocus>
                            @error('phone')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label for="address" class="uk-form-label">
                            {{ __('Morada') }}
                        </label>
                        <input id="address" type="text" class="uk-input @error('address') uk-form-danger @enderror" name="address"
                        value="{{ $motorista->address }}"
                            required autocomplete="address">
                        @error('address')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="uk-width-1-2@s uk-margin">
                        <label for="gender" class="uk-form-label">
                            {{ __('Sexo') }}
                        </label>
                        <div class="uk-form-control">
                           <select name="gender" class="uk-select @error('gender') uk-form-danger @enderror">

                            <option disabled selected>Seleccione o sexo</option>
                            @foreach ($genders as $gender)
                            <option value="{{ $gender->gender }}" {{ $motorista->gender == $gender->gender ? 'selected':'' }}>{{ $gender->gender }}</option>
                            @endforeach
                        </select>
                            @error('gender')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="uk-width-1-2@s uk-margin">
                        <label for="licence_number" class="uk-form-label">
                            {{ __('Número da carta de Condução') }}
                        </label>
                        <input id="licence_number" type="text" class="uk-input @error('licence_number') uk-form-danger @enderror" name="licence_number" required value="{{ $motorista->licence_number }}"
                            autocomplete="licence_number">
                        @error('licence_number')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                        {{ __('Actualizar dados do motorista') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
