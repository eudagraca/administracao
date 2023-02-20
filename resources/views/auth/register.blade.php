@extends('layouts.admin')

@section('title-page')
Registar usuário
@endsection
@section('links')
<a href="{{ route('user.all') }}" class="uk-button uk-button-text">Usuários </a> / Registo
@endsection
@section('link')
Registro
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')
    <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <form method="POST" action="{{ route('user.gravar') }}" class="uk-form-stacked">
                @csrf
                <div class="uk-card-body uk-margin  uk-grid">
                    <div class="uk-margin uk-width-1-2@s">
                        <label for="name" class="uk-form-label">
                            {{ __('Nome do usuário') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('name') uk-form-danger @enderror" id="name" name="name"
                                type="text" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="uk-text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-2@s">
                        <label for="email" class="uk-form-label">
                            {{ __('E-mail') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('email') uk-form-danger @enderror" id="email" name="email"
                                type="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                            @error('email')
                            <span class="uk-text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label for="username" class="uk-form-label">
                            {{ __('Nome de acesso') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('username') uk-form-danger @enderror" id="username" name="username"
                                type="text" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            @error('username')
                            <span class="uk-text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label for="role" class="uk-form-label">
                            {{ __('Nível de acesso') }}
                        </label>
                        <select name="role" class="uk-select @error('role') uk-form-danger @enderror">
                            <option disabled selected>Seleccione o nível de acesso</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->slug}}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                        <span class="uk-text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="uk-width-1-2@s uk-margin">
                        <label for="sector_id" class="uk-form-label">
                            {{ __('Sector de trabalho') }}<small> Opcional</small>
                        </label>
                        <input class="uk-input @error('sector_id') uk-form-danger @enderror" id="sector_search"  placeholder="Pesquise pelo sector"/>
                        <input  hidden name="sector_id" id="sector_id"/>

                        @error('sector_id')
                        <span class="uk-text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-secondary">
                        {{ __('Registar usuário') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
