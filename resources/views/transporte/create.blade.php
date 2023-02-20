@extends('layouts.admin')

@section('title-page')
Registar Transporte
@endsection
@section('links')
<a href="{{ route('transportes.index') }}" class="uk-button uk-button-text">Transportes</a> / Registo
@endsection
@section('link')
Registro de transporte
@endsection
@section('content-main')
<div class="conntainer">
    @include('layouts.flash')
    <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <form method="POST" action="{{ route('transportes.store') }}" class="uk-form-stacked">
                {{ csrf_field() }}
                <div class="uk-card-body uk-margin  uk-grid">
                    <div class="uk-width-1-2@s uk-margin">
                        <label for="veiculo" class="uk-form-label">
                            {{ __('Veículo') }}
                        </label>
                        <select name="veiculo" class="uk-select @error('veiculo') uk-form-danger @enderror">
                            <option disabled selected>Seleccione tipo de veículo</option>
                            @foreach ($viaturas as $viatura)
                            <option value="{{ $viatura->name }}" {{ old('veiculo') ==$viatura->name ? 'selected':'' }}>
                                {{$viatura->name}}</option>
                            @endforeach
                        </select>
                        @error('veiculo')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="uk-width-1-2@s">
                        <label for="marca" class="uk-form-label">
                            {{ __('Marca') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('marca') uk-form-danger @enderror" id="marca" name="marca"
                                type="text" value="{{ old('marca') }}" required autocomplete="marca" autofocus>
                            @error('marca')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label for="modelo" class="uk-form-label">
                            {{ __('Modelo') }}
                        </label>
                        <div class="uk-form-control">
                            <input class="uk-input @error('modelo') uk-form-danger @enderror" id="modelo" name="modelo"
                                type="text" value="{{ old('modelo') }}" required autocomplete="modelo" autofocus>
                            @error('modelo')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label for="matricula" class="uk-form-label">
                            {{ __('Matrícula') }}
                        </label>
                        <div class="uk-form-control">
                            <input id="matricula" type="text"
                                class="uk-input @error('matricula') uk-form-danger @enderror" name="matricula" required
                                value="{{ old('matricula') }}"
                                autocomplete="matricula">
                            @error('matricula')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-secondary">
                        {{ __('Registar transporte') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
