@extends('layouts.app')

@section('content')


    <div class="uk-container uk-margin-top  uk-flex-center">

        @if ($message = Session::get('warning'))
            <div class="uk-alert-warning uk-text-center uk-text-large" uk-alert>
                {{ $message }}
            </div>
        @endif
        <div class="uk-card-media-top uk-flex uk-flex-center">
            <img src="{{ URL::asset('storage/logos/logo-small.jpg') }}" width="200px" height="200px">
        </div>
        <div class="uk-flex uk-flex-center">
            <div class="uk-card uk-box-shadow-small  uk-card-default uk-width-1-2@s">
                <div class="uk-card-header" style="background: #AA2B21">
                    <h3 class="uk-card-title uk-text-bold uk-margin-remove uk-text-bold" style="color: white">
                        Autenticar</h3>
                    <small class="uk-text-small" style="color: white">Acesso restrito à <strong>Administração do
                            SGA</strong></small>

                </div>
                <form method="POST" action="{{ route('login') }}" class="uk-form-stacked">
                    @csrf
                    <div class="uk-card-body">
                        <div class="uk-margin">
                            <label for="username" class="uk-form-label">
                                {{ __('Nome de usuário') }}
                            </label>
                            <div class="uk-inline uk-width-1-1">
                                <input class="uk-input @error('username') uk-form-danger @enderror" name="username"
                                       id="username" type="text" value="{{ old('username') }}" required
                                       autocomplete="off"
                                       autofocus>
                                @error('username')
                                <small class="uk-text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label for="password" class="uk-form-label">
                                {{ __('Senha de acesso') }}
                            </label>
                            <div class="uk-inline uk-width-1-1">
                                <input id="password" type="password"
                                       class="uk-input @error('password') uk-form-danger @enderror" name="password"
                                       required
                                       autocomplete="current-password">
                                @error('password')
                                <small class="uk-text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-form-control">
                                <input class="uk-checkbox" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    {{ __('Manter me autenticado') }}
                                </label>
                            </div>
                            <small class="uk-text-muted uk-text-warning">(Evite selecionar esta opção se estiver em um
                                dispositivo
                                público para melhor segurança)</small>
                        </div>
                    </div>
                    <div class="uk-card-footer uk-clearfix">
                        <div class="uk-align-right">
                            <div class="uk-form-control">
                                <button type="submit" class="uk-button uk-border-rounded uk-button-secondary">
                                    {{ __('Acessar') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
