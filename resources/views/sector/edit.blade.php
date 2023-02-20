@extends('layouts.admin')

@section('title-page')
Editar dados do Sector
@endsection
@section('links')
<a href="{{ route('sector.index') }}" class="uk-button uk-button-text">Sector</a> / Actualização
@endsection
@section('link')
Editar dados do Sector
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')
    <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <form method="POST" action="{{ route('sector.update', $sector->id) }}"
            class="uk-form-stacked">
            @method('PUT')
            {{ csrf_field() }}
                <div class="uk-card-body uk-margin  uk-grid">
                    <div class="uk-width-1-2@s uk-margin">
                        <label for="name" class="uk-form-label">
                            {{ __('Nome do sector') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('name') uk-form-danger @enderror" id="name" name="name" type="text"
                                value="{{ $sector->name }}" required autocomplete="name" autofocus>
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
                            <select name="user_id" class="uk-select @error('user_id') uk-form-danger @enderror">
                                @foreach ($users as $user)

                                <option value="{{ $user->id }}" {{ $sector->user->id ==$user->id ? 'selected':'' }}>{{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                        {{ __('Actualizar dados do sector') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
