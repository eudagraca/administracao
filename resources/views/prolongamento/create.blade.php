@extends('forms.create-escala-prolongamento')

@section('title-p')
Prolongamento
@endsection

@section('lnk')
    Prolongamento
@endsection
@section('lnks')
<a href="{{ route('prolongamento.index') }}" class="uk-button uk-button-text">Prolongamentos</a> / Emitir
@endsection
@section('action')
    {{ route('prolongamento.store') }}
@endsection
@section('card-title')
Carta de prolongamento
@endsection
@section('tipo_escala')
    <label class="uk-text-small">
        Prolongamento de turno
        <input class="uk-radio" checked value="Prolongamento de turno" type="radio" name="tipo_escala">
    </label>

@endsection
@section('prolongamento')
<div class="table-responsive uk-margin-top">
    <table class="table" id="dynamic_prolongamento">
        <thead>
            <tr>
                <th class="uk-text-small" colspan="4">Dados do prolongamento</th>

            </tr>
            <tr>
                <th class="uk-text-small">Data</th>
                <th class="uk-text-small">Hora de início</th>
                <th class="uk-text-small">Hora de fim</th>
            </tr>
        </thead>
        <tr>
            <td><input name="data_prolongamento[0]" type="date" value="" placeholder="Data"
                    class="uk-input name_list" /></td>
            <td><input type="text" name="hora_inicio_prolongamento[0]" value="" placeholder="HH:mm"
                    class="hora_justificacao uk-input name_list" /></td>
            <td><input name="hora_fim_prolongamento[0]" value="" placeholder="HH:mm"
                    class="uk-input hora_justificacao" /></td>

        </tr>
    </table>
    <td>
        <button type="button" name="add-justificacao" id="add-justificacao"
            class="btn btn-dark uk-box-shadow-hover-medium"><span><i class="fa fa-plus-circle"
                    aria-hidden="true"></i></span>
        </button>
    </td>
</div>
@endsection
