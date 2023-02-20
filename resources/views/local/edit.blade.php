@extends('layouts.admin')

@section('title-page')
Editar dados do Local
@endsection
@section('links')
<a href="{{ route('local.index') }}" class="uk-button uk-button-text">Locais</a> / Actualização
@endsection
@section('link')
Editar dados do Local
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')
    <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <form method="POST" action="{{ route('local.update', $local->id) }}"
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
                                value="{{ $local->name }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="uk-width-1-2@s">
                        <label for="endereco" class="uk-form-label">
                            {{ __('Endereço') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('endereco') uk-form-danger @enderror" id="endereco" name="endereco"
                                type="text" value="{{ $local->endereco }}" required autocomplete="endereco" autofocus>
                            @error('endereco')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label for="designacao" class="uk-form-label">
                            {{ __('Designação') }}
                        </label>
                        <div class="uk-form-control">
                            <select class="uk-select @error('designacao') uk-form-danger @enderror" id="designacao" name="designacao">
                                @foreach($designacoes as $designacao)
                                <option value="{{ $designacao }}" {{ $designacao== $local->designacao? 'selected':'' }}>
                                    {{ $designacao }}</option>
                                @endforeach
                            </select>

                            @error('designacao')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                        {{ __('Actualizar dados do local') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
