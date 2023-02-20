@extends('layouts.admin')

@section('title-page')
    Alteração de nível de acesso
@endsection
@section('links')
    Dados do usuário
@endsection
@section('link')
    Registro
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">
                <form method="POST" action="{{ route('password.update') }}" class="uk-form-stacked">
                    @method('PUT')
                    @csrf
                    <div class="uk-card-body uk-margin  uk-grid">

                        <div class="uk-width-1-3@s uk-margin-small-top">
                            <div class="uk-placeholder">
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('Nome de acesso') }}
                                </label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ $user->username}}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-3@s uk-margin-small-top">
                            <div class="uk-placeholder">
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('Nome do usuário') }}
                                </label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ $user->name}}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-3@s uk-margin-small-top">
                            <div class="uk-placeholder">
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('E-mail') }}
                                </label>
                                <p class="uk-text-normal uk-margin-remove-top">{{$user->email}}</p>
                            </div>
                        </div>

                        <div class="uk-width-1-3@s uk-margin-small-top">
                            <div class="uk-placeholder">
                                <label for="diagnostico" class="uk-form-label">
                                    {{ __('Sector de trabalho') }}
                                </label>
                                <p class="uk-text-normal uk-margin-remove-top">{{ Auth::user()->getSector()->name?? 'Nenhum sector associado' }}</p>
                            </div>
                        </div>

                        @if (Auth::check() and Auth::user()->hasRole('motorista'))
                            <div class="uk-width-1-3@s uk-margin-small-top">
                                <div class="uk-placeholder">
                                    <label for="diagnostico" class="uk-form-label">
                                        {{ __('Telefone') }}
                                    </label>
                                    <p class="uk-text-normal uk-margin-remove-top">{{ Auth::user()->motorista->phone }}</p>
                                </div>
                            </div>

                            <div class="uk-width-1-3@s uk-margin-small-top">
                                <div class="uk-placeholder">
                                    <label for="diagnostico" class="uk-form-label">
                                        {{ __('Morada') }}
                                    </label>
                                    <p class="uk-text-normal uk-margin-remove-top">{{ Auth::user()->motorista->address }}</p>
                                </div>
                            </div>
                            <div class="uk-width-1-3@s uk-margin-small-top">
                                <div class="uk-placeholder">
                                    <label for="diagnostico" class="uk-form-label">
                                        {{ __('Sexo') }}
                                    </label>
                                    <p class="uk-text-normal uk-margin-remove-top">{{ Auth::user()->motorista->gender }}</p>
                                </div>
                            </div>

                        @endif

                        <div class="uk-width-1-3@s uk-margin-small-top">

                            <label>
                                {{ __('Trocar senha de acesso') }}
                            </label>

                            <label for="password" class="uk-form-label uk-margin-small-top">
                                {{ __('Senha de acesso') }}
                            </label>
                            <div class="uk-form-control">
                                <input id="password" type="password"
                                       class="uk-input @error('password') uk-form-danger @enderror" name="password"
                                       required
                                       autocomplete="new-password">
                                @error('password')
                                <span class="uk-text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="uk-width-1-3@s uk-margin-medium-top">
                            <label for="password_confirmation" class="uk-form-label uk-margin-small-top">
                                {{ __('Confirme a senha') }}
                            </label>
                            <div class="uk-form-control ">
                                <input id="password_confirmation" type="password"
                                       class="uk-input @error('password') uk-form-danger @enderror"
                                       name="password_confirmation" required autocomplete="new-password">
                                @error('password_confirmation')
                                <span class="uk-text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="uk-form-control uk-card-footer">
                        <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                            {{ __('Trocar senha') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
