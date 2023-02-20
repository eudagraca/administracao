@extends('layouts.admin')

@section('title-page')
Alteração de nível de acesso
@endsection
@section('links')
<a href="{{ route('user.all') }}" class="uk-button uk-button-text">Usuário </a> / Nível de acesso
@endsection
@section('link')
Registro
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')
    <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <form method="POST" action="{{ route('user.actualizar', $user->id) }}" class="uk-form-stacked">
                @method('PUT')
                @csrf
                <div class="uk-card-body uk-margin  uk-grid">
                    <div class="uk-width-1-2@s">
                        <label for="role" class="uk-form-label">
                            {{ __('Nível de acesso') }}
                        </label>
                        <select name="role" class="uk-select @error('role') uk-form-danger @enderror">
                            @foreach ($roles as $role)
                            <option value="{{ $role->slug}}" {{ $role->slug == $user->roles[0]->slug? 'selected': '' }}>
                                {{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                        <span class="uk-text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="uk-width-1-2@s">
                        <label for="sector" class="uk-form-label">
                            {{ __('Sector') }}
                        </label>
                        <select name="sector" class="uk-select @error('sector') uk-form-danger @enderror">
                            @empty($user->getSector()->id)
                            <option selected disabled class="uk-text-muted">Seleccione o sector
                            </option>
                            @endempty
                            @foreach ($sectores as $sector)
                            @empty($user->getSector()->id)
                            <option value="{{ $sector->id}}">{{ $sector->name }}
                            </option>
                            @else
                            <option value="{{ $sector->id}}"
                                {{ $sector->id == $user->getSector()->id? 'selected': '' }}>{{ $sector->name }}
                            </option>
                            @endempty
                            @endforeach
                        </select>
                        @error('role')
                        <span class="uk-text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                        {{ __('Actualizar acesso do usuário') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
