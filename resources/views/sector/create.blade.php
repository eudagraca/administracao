@extends('layouts.admin')

@section('title-page')
    Registar Sector
@endsection
@section('links')
    <a class="uk-button uk-button-text" href="{{ route('sector.index') }}">Sector</a> / Registro
@endsection
@section('link')
    Registro de Sector
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">
                <form method="POST" action="{{ route('sector.store') }}"
                      class="uk-form-stacked">
                    {{ csrf_field() }}
                    <div class="uk-card-body uk-margin  uk-grid">
                        <div class="uk-width-1-2@s uk-margin">
                            <label for="name" class="uk-form-label">
                                {{ __('Nome do sector') }}
                            </label>
                            <div class="uk-form-control">
                                <input class="uk-input @error('name') uk-form-danger @enderror" id="name" name="name"
                                       type="text"
                                       value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="uk-width-1-2@s">
                            <label for="user_id" class="uk-form-label">
                                {{ __('O Responsável') }}
                            </label>
                            <div class="uk-form-control">

                                <input id="user_search" class="uk-input @error('user_id') uk-form-danger @enderror" placeholder="Nome do usuário">
                                <input hidden name="user_id" id="user_id" class="uk-input" placeholder="O responável">
                                @error('user_id')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="uk-form-control uk-card-footer">
                        <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-secondary">
                            {{ __('Registar sector') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
