@extends('layouts.admin')

@section('title-page')
    Editar dados do Técnico
@endsection
@section('links')
    <a href="{{ route('tecnico.index') }}" class="uk-button uk-button-text">Técnicos</a> / Actualização
@endsection
@section('link')
    Editar dados do técnico
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-section uk-padding uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            <div class="uk-card uk-card-default uk-width-1-1@s">
                <form method="POST" action="{{ route('tecnico.update', $tecnico->id) }}"
                      class="uk-form-stacked">
                    @method('PUT')
                    {{ csrf_field() }}
                    <div class="uk-card-body uk-margin  uk-grid">
                        <div class="uk-width-1-2@s uk-margin">
                            <label for="name" class="uk-form-label">
                                {{ __('Nome completo') }}
                            </label>
                            <div class="uk-form-control">
                                <input class="uk-input @error('name') uk-form-danger @enderror" id="name" name="name"
                                       type="text"
                                       value="{{ $tecnico->name }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="uk-width-1-2@s">
                            <label for="gender" class="uk-form-label">
                                {{ __('Sexo') }}
                            </label>
                            <div class="uk-form-control">
                                <select name="gender" id="gender" class="uk-select @error('gender') uk-form-danger @enderror">

                                    <option disabled selected>Seleccione o sexo</option>
                                    @foreach ($genders as $gender)
                                        <option
                                            value="{{ $gender->gender }}" {{ $tecnico->gender == $gender->gender ? 'selected':'' }}>{{ $gender->gender }}</option>
                                    @endforeach
                                </select>
                                @error('gender')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="uk-width-1-2@s">
                            <label for="area" class="uk-form-label">
                                {{ __('Área') }}
                            </label>
                            <div class="uk-form-control">
                                <input class="uk-input @error('area') uk-form-danger @enderror" id="area" name="area"
                                       type="text" value="{{ $tecnico->area }}" required autocomplete="area" autofocus>
                                @error('area')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="uk-width-1-2@s">
                            <label for="phone" class="uk-form-label">
                                {{ __('Telefone') }}
                            </label>
                            <div class="uk-form-control">
                                <input class="uk-input @error('phone') uk-form-danger @enderror" id="phone" name="phone"
                                       type="tel" value="{{ $tecnico->phone }}" required autocomplete="phone" autofocus>
                                @error('phone')
                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="uk-width-1-2@s uk-margin">
                            <label for="morada" class="uk-form-label">
                                {{ __('Morada') }}
                            </label>
                            <input id="morada" type="text" class="uk-input @error('morada') uk-form-danger @enderror"
                                   name="morada"
                                   value="{{ $tecnico->morada }}"
                                   required autocomplete="morada">
                            @error('morada')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="uk-width-1-2@s uk-margin">
                            <label for="responsavel_resolucao" class="uk-form-label">
                                {{ __('Formas de pagamento') }}
                            </label>
                            <div class="uk-form-control">

                                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                    <label class="uk-text-small"><input class="uk-radio"
                                                                        {{ $tecnico->pagamento=="cash"? "checked" : '' }} value="cash"
                                                                        type="radio"
                                                                        name="pagamento">
                                        Cash</label>
                                    <label class="uk-text-small"><input class="uk-radio" type="radio"
                                                                        {{ $tecnico->pagamento=="cheque"? "checked" : '' }} value="cheque"
                                                                        name="pagamento"> Cheque</label>
                                    <label class="uk-text-small"><input class="uk-radio" type="radio"
                                                                        {{ $tecnico->pagamento=="conta corrente"? "checked" : '' }} value="conta corrente"
                                                                        name="pagamento"> Conta corrente</label>
                                    <label class="uk-text-small"><input class="uk-radio" type="radio"
                                                                        {{ $tecnico->pagamento=="transferência"? "checked" : '' }} value="transferência"
                                                                        name="pagamento"> Trans.
                                        bancária</label>
                                </div>
                            </div>
                            @error('pagamento')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="uk-form-control uk-card-footer">
                        <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-primary">
                            {{ __('Actualizar dados do técnico') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
