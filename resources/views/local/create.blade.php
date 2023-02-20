@extends('layouts.admin')

@section('title-page')
Registro de Local
@endsection
@section('links')
<a href="{{ route('local.index') }}" class="uk-button uk-button-text">Locais</a> / Registro
@endsection
@section('link')
Registro de Local
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')
    <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <form id="form_motorista" method="POST" action="{{ route('local.store') }}"
            class="uk-form-stacked">
            {{ csrf_field() }}
                <div class="uk-card-body uk-margin  uk-grid">

                    <div class="uk-width-1-3@s">
                        <label for="name" class="uk-form-label">
                            {{ __('Nome') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('name') uk-form-danger @enderror" id="name" name="name" type="text"
                                value="{{ old('name') }}" required
                                   placeholder="Nome do local"
                                    autofocus>
                            @error('name')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-3@s">
                        <label for="endereco" class="uk-form-label">
                            {{ __('Endereço') }}
                        </label>
                        <input id="endereco" type="text" class="uk-input @error('endereco') uk-form-danger @enderror" name="endereco"
                        placeholder="Endereço do local"
                            value="{{ old('endereco') }}" autocomplete="endereco">
                        @error('endereco')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="uk-width-1-3@s">
                        <label for="designacao" class="uk-form-label">
                            {{ __('Designação') }}
                        </label>
                        <div class="uk-form-control">
                            <select id="designacao" name="designacao" class="uk-select @error('designacao') uk-form-danger @enderror">
                                <option selected disabled>Seleccione a designação</option>
                                <option value="Local">Local</option>
                                <option value="Nacional">Nacional</option>
                                <option value="Internacional">Internacional</option>
                            </select>
                            @error('designacao')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-secondary">
                        {{ __('Registar local') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
