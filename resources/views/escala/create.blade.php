@extends('forms.create-escala-prolongamento')
@section('title-p')
Escala
@endsection

@section('lnk')
Escala
@endsection
@section('lnks')
<a href="{{ route('escala.index') }}" class="uk-button uk-button-text">Escalas</a> / Emitir
@endsection
@section('action')
{{ route('escala.store') }}
@endsection
@section('card-title')
Carta de alteração de escala
@endsection

@section('tipo_escala')
    <label class="uk-text-small">
            <input class="uk-radio" checked value="Alteração de escala" type="radio" name="tipo_escala">
            Alteração de escala</label>
@endsection

@section('escala')

<div class="table-responsive">
    <table class="table" id="dynamic_just">
        <thead>
            <tr>
                <th class="uk-text-small" colspan="4">Dados de escala</th>

            </tr>
            <tr>
                <th class="uk-text-small">Datas</th>
                <th class="uk-text-small">Hora de entrada</th>
                <th class="uk-text-small">Intervalo</th>
                <th class="uk-text-small">Hora de saída</th>
            </tr>
        </thead>
        <tr>
            <td><input name="data_escala[0]" type="date" value="" placeholder="Data" class="uk-input name_list" /></td>
            <td><input type="text" name="hora_entrada[0]" value="" placeholder="HH:mm"
                    class="hora_justificacao uk-input name_list" /></td>
            <td><input type="text" name="intervalo[0]" value="" placeholder="HH:mm - HH:mm"
                    class="uk-input intervalo name_list" /></td>
            <td><input name="hora_final[0]" value="" placeholder="HH:mm" class="uk-input hora_justificacao" /></td>

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

@section('nova-escala')
<div class="table-responsive uk-margin-top">
    <table class="table" id="dynamic_nova_escala">
        <thead>
            <tr>
                <th class="uk-text-small" colspan="4">Dados da nova escala</th>

            </tr>
            <tr>
                <th class="uk-text-small">Datas</th>
                <th class="uk-text-small">Hora de entrada</th>
                <th class="uk-text-small">Intervalo</th>
                <th class="uk-text-small">Hora de saída</th>
            </tr>
        </thead>
        <tr>
            <td><input name="data_nova_escala[0]" type="date" value="" placeholder="Data" class="uk-input name_list" />
            </td>
            <td><input type="text" name="hora_inicio_nova_escala[0]" value="" placeholder="HH:mm"
                    class="hora_justificacao uk-input name_list" /></td>
            <td><input type="text" name="intervalo_nova_escala[0]" value="" placeholder="HH:mm - HH:mm"
                    class="uk-input intervalo name_list" /></td>
            <td><input name="hora_fim_nova_escala[0]" value="" placeholder="HH:mm" class="uk-input hora_justificacao" />
            </td>

        </tr>
    </table>
</div>
@endsection
