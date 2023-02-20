@extends('layouts.admin')

@section('title-page')
    Lista de usuários
@endsection
@section('links')
    Lista de usuários
@endsection
@section('link')
    Lista usuários
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">
            <a href="{{ route('user.register') }}"
               class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-plus-circle"></i> Registar usuário</a>
        </div>
        <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">
                <div class="uk-overflow-auto">
                    <table id="avarias-tb" class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                        <thead>
                        <tr>
                            <th id="table-header" class="uk-table-shrink uk-text-nowrap">Nível de acesso</th>
                            <th id="table-header" class="uk-table-shrink">Nome</th>
                            <th id="table-header" class="uk-width-small">Útimo acesso</th>

                            <th id="table-header" class="uk-width-small">Dispositivo usado</th>
                            <th id="table-header" class="uk-table-shrink uk-text-nowrap uk-text-center">Acção</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($users as $user)
                            @if(!$user->motorista)
                            <tr class="uk-background-muted">
                                <td class="uk-text-bold uk-text-nowrap  uk-text-normal">

                                    @foreach ($user->roles as $role)
                                         {{ $role->name }}
                                    @endforeach

                                </td>
                                <td class="uk-text-nowrap  uk-text-normal">
                                    {{ $user->name }}
                                </td>
                                <td class="uk-text-truncate uk-text-normal">
                                    @if ($user->last_login_at)
                                        {{ date('d-m-y', strtotime($user->last_login_at)) }}
                                    às
                                        {{ date('H:i', strtotime($user->last_login_at)) }}
                                    @endif
                                </td>
                                <td class="uk-text-truncate uk-text-normal">
                                        {{ $user->last_login_ip }}
                                </td>
                                <td class="uk-text-nowrap">
                                    <p uk-margin class="uk-align-right">
                                        <a id="a-text-color" href="{{ route('user.edit', $user) }}"
                                           class="uk-button uk-button-default uk-box-shadow-hover-medium uk-border-rounded uk-text-bold btn-warning">Editar</a>
                                </td>
                            </tr>
                            @endif
                        @empty
                            @include('layouts.empty')
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
