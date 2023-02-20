<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>{{$avaria->id}}</title>

    <style>

        body {
            font-family: 'NunitoSans-Regular', sans-serif;
            font-size: 12px !important;
        }

        {{--@font-face {--}}
        {{--    font-family: 'Nunito', sans-serif;--}}
        {{--    src: url({{ storage_path('/fonts/NunitoSans-Regular.ttf') }}) format('truetype');--}}
        {{--    font-weight: normal;--}}
        {{--}--}}
        {{--@font-face {--}}
        {{--    font-family: 'Nunito', sans-serif;--}}
        {{--    src: url({{ storage_path('/fonts/NunitoSans-Bold.ttf') }}) format('truetype');--}}
        {{--    font-weight: bold;--}}
        {{--}--}}
        {{--@font-face {--}}
        {{--    font-family: nunito-font-family;--}}
        {{--    src: url("{{ asset('storage/fonts/NunitoSans-Bold.ttf') }}");--}}
        {{--    font-weight: 300;--}}
        {{--}--}}

        .box h4 {
            font-size: 10px !important;
            font-weight: 300;
            margin-bottom: 0;
        }

        .container {
        }

        p {
            font-weight: normal;
            font-size: 12px;
            color: #212121;
            margin-top: 1% !important;
            margin-bottom: 0;

        }

        div p {
            font-weight: normal;
            font-size: 13px;
            color: #212121;
            margin-bottom: 0;
        }

        .header-left {
            float: left;
        }

        .header-right {
            margin-left: -5%;
        }

        .text-header {
            text-align: center;
        }

        .header {
            height: auto;
            padding: 10px 15px;
            border: 0.6px solid #000000;
        }

        .header-main {
            font-weight: bold;
        }

        .clearfix:after {
            display: block;
            clear: both;
            visibility: hidden;
            line-height: 0;
            height: 0;
        }

        .clearfix {
            display: inline-block;
        }

        html[xmlns] .clearfix {
            display: block;
        }

        * html .clearfix {
            height: 1%;
        }

        .clearfix {
            display: block
        }

        table {
            font-size: 12px !important;
        }

        table, td, th {
            border: 0.3px solid #ddd;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 3px;
        }

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 47%;
            padding: 5px;
            border: 0.1px solid #a3a3a3;
            height: auto; /* Should be removed. Only for demonstration */
        }

        /* Create two equal columns that floats next to each other */
        .column-f {
            float: left;
            width: 47%;
            padding: 2px;
            height: auto; /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Clear floats after the columns */
        .row-column:after {
            content: "";
            display: table;
            clear: both;
        }

        .text-normal {
            font-size: 13px;
        }

        h5 {
            font-size: 12px;
            margin-bottom: 0;
            margin-top: 0;
        }

        .coluna {
            float: left;
            width: 35%;
            padding: 10px;
            height: auto;
        }

        .assinatura{
            margin-left: 15%;
        }

    </style>
</head>
<body>
<div class="container" style="background-color: #fff;height: auto;font-family: 'Quicksand',sans-serif;">

    <div class="header">
        <div class="header-left">
            <img src="{{  URL::asset('storage/logos/logo-small.jpg') }}" width="160px" height="70px">
        </div>

        <div class="header-right" style="margin-left: -20%">
            <p class="text-header header-main">CENTRO MÉDICO MAXI VIDA, LDA</p>
            <p class="text-header">Sector de Manutenção</p>
            <p class="text-header" style="margin-left: 10%; text-indent : 1.5em;">Formulário de Resolução de Avaria</p>

        </div>
    </div>

    <div class="expand-box" style="margin-bottom: 0 !important; margin-top: 0 !important;">
        <div id="expand-box-header" class="clearfix">
            <div style="float: left;">
                <h3 style="font-size: 12px;margin-bottom: -10px;">Referência</h3>
                <p style="color: #666;font-size: 12px; margin-top: 2% !important;">{{ $avaria->id }}</p>
            </div>

            <div style="float: right;">
                <h3 style="font-size: 12px;margin-bottom: -10px;">Sector</h3>
                <p style="color: #666;font-size: 12px; margin-top: 2% !important;">{{ $avaria->sector->name }}</p>
            </div>
        </div>
    </div>

    <div class="row-column" style="margin-bottom: 0 !important; margin-top: 0.5% !important;">
        <div class="column-f" style="margin-right: 1%">
            <h5>Fornecedor de serviço</h5>
            <p>{{ $avaria->fornecedor_servico ?? 'Não informado'}}</p>
        </div>

        <div class="column-f" style="margin-right: 50%">
            <h5 style="margin-bottom: 1%">Localização</h5>
            <label style="font-size: 12px; ">{{ $avaria->localizacao }}</label>
        </div>

        <div class="column-f" style="margin-right: -28%; float: right;">
            <h5>Requisitado por</h5>
            <p>{{ $avaria->user->name}}</p>
        </div>

    </div>

    <hr style="margin-top: 0.3% !important;">

    <div class="row" style="margin-bottom: 0.5% !important;">
        <div class="column" style="margin-right: 1%">
            <h5>Descrição</h5>
            <p>{{ $avaria->descricao }}</p>
        </div>
        <div class="column" style="margin-right: 20%">
            <h5>Observação</h5>
            <p>{{ $avaria->observacao??'Não informada' }}</p>
        </div>
    </div>

    <div class="row" style="margin-top: 0 !important;">
        <div class="column" style="margin-right: 1%">
            <h5>Plano de reparação</h5>
            <p class="text-normal">{{$avaria->plano_reparacao}}</p>
        </div>
        <div class="column" style="margin-right: 20%">
            <h5>Plano de prevenção</h5>
            <p class="text-normal">{{$avaria->plano_prevencao}}</p>
        </div>
    </div>


    <div class="row" style="margin-bottom: 0.5% !important; margin-top: 0.5% !important;">
        <div class="column" style="margin-right: 1%">
            <h5>Diagnóstico</h5>
            <p>{{ $avaria->diagnostico}}</p>
        </div>
        <div class="column" style="margin-right: 20%">
            <h5>Duração</h5>
            <p>{{ $avaria->horas_duracao }}h : {{ $avaria->minutos_duracao }} Minutos </p>
        </div>
    </div>
    <h5 style="margin-top: 0.5% !important; margin-bottom: 1% !important;">Materiais:</h5>

    @if(count($avaria->materiais)>0)

    <table>
        <tr>
            <th>Material</th>
            <th>Fornecedor</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            <th>Req. No.</th>
        </tr>

        @foreach($avaria->materiais as $material)
            <tr>
                <td class="text-normal">{{  $material->nome }}</td>
                <td class="text-normal">{{  $material->fornecedor->nome }}</td>
                <td class="text-normal">{{  $material->quatidade }}</td>
                <td class="text-normal">{{  $material->preco }}</td>
                <td class="text-normal">{{  $material->nr_requisicao }}</td>
            </tr>

        @endforeach
    </table>
    <table style="margin-top: 1% !important;">
        <tr>
            <th>Custo do material</th>
            <th>Mão de obra inicial</th>
            <th>Mão de obra final</th>
            <th>Valor total</th>
        </tr>

        <tr>
            <td class="text-normal">{{  $avaria->custo_do_material }} Mt</td>
            <td class="text-normal">{{  $avaria->mao_obra_inicial }} Mt</td>
            <td class="text-normal">{{  $avaria->mao_obra_final }} Mt</td>
            <td class="text-normal">{{  $avaria->valor_total }} Mt</td>
        </tr>
    </table>

    @else
        <p>Nenhum material necessário</p>
    @endif

    <table style="margin-top: 1% !important;">
    <tr>
    <th>Garantia</th>
    </tr>
    <tr>
    <td class="text-normal">{{ $avaria->garantia }}</td>
    </tr>
    </table>

    <table style="margin-top: 1% !important; margin-bottom: 0 !important;">
        <tr>
            <th>Estado da avaria</th>
            <th>Responsável pela reparação</th>
            <th>Forma de pagamento</th>
            <th>Comprovativo</th>
        </tr>

        <tr>
            <td class="text-normal">{{  ucfirst($avaria->estado) }}</td>
            <td class="text-normal">{{  ucfirst($avaria->responsavel) }}</td>
            <td class="text-normal">{{  ucfirst($avaria->resposta->tecnico->pagamento) }}</td>
            <td class="text-normal">{{  $avaria->comprovativo }}</td>
        </tr>

    </table>

    <div class="row" style="margin-top: 0 !important;">

        <div class="coluna">
            <p class="assinatura">Emitido por:</p>
            <hr style="width: 70%; margin:0; margin-top: 20px !important;">
            <p style="margin-top: 5% !important;" class="assinatura">{{date('d')}}/{{date('m')}}/{{ date('Y') }}</p>
        </div>
        <div class="coluna">
            <p class="assinatura">O técnico:</p>
            <hr style="width: 70%; margin:0; margin-top: 20px !important;">
            <p style="margin-top: 5% !important;" class="assinatura">____/____/{{ date('Y') }}</p>
        </div>

        <div class="coluna">
            <p style="margin-left: 15%">Ass. sector:</p>
            <hr style="width: 70%; margin:0; margin-top: 20px !important;">
            <p style="margin-top: 5% !important;" class="assinatura">____/____/{{ date('Y') }}</p>
        </div>
    </div>


    <div class="row">


        <div class="coluna">
            <p class="assinatura">Supervisionado por:</p>
            <hr style="width: 70%; margin:0; margin-top: 20px !important;">
            <p style="margin-top: 5% !important;" class="assinatura">____/____/{{ date('Y') }}</p>
        </div>
        <div class="coluna">
            <p class="assinatura">A contabilidade:</p>
            <hr style="width: 70%; margin:0; margin-top: 20px !important;">
            <p style="margin-top: 5% !important;" class="assinatura">____/____/{{ date('Y') }}</p>
        </div>

        <div class="coluna">
            <p style="margin-left: 5%">Pré - Autorização:</p>
            <hr style="width: 70%; margin:0; margin-top: 20px !important;">
            <p  style="margin-top: 5% !important;" class="assinatura">____/____/{{ date('Y') }}</p>
        </div>
    </div>

</div>
<script type="text/php">
    if (isset($pdf))
    {
        $x = 500;
        $y = 820;
        $text = "Página {PAGE_NUM} de {PAGE_COUNT}";
        $font = $fontMetrics->get_font("helvetica", "normal");
        $size = 11;
        $color = array(0,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
}
</script>
</body>
</html>
