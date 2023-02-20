<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <style>
        @page {
            margin: 0 0.5cm 0.5cm 0.5cm;
        }

        /*html,*/
        body {
            margin: 0;
            padding: 2%;
            /*height: 100%;*/
            font-family: "Helvetica", sans-serif;
        }

        div p {
            font-weight: 400;
            font-size: 10pt;
            color: #212121;
        }

        .header-left {
            float: left;
        }

        .header-right {
            margin-left: -20%;
        }

        .text-header {
            text-align: center;
            font-size: 10pt;
            text-transform: uppercase;
        }

        .header {
            height: auto;
            padding: 10px 15px;
            border: 0.6px solid #000000;
        }

        .header-main {
            font-weight: 700;
            font-family: "Helvetica", sans-serif;
        }


        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            margin-top: 1%;
            width: 100%;
        }

        td, th {
            border: 1px solid #3e3e3e;
            text-align: left;
            padding: 8px;
            font-size: 10pt;
        }

        tr:nth-child(1) {
            background-color: #dddddd;
        }

    </style>
    <title>Pre-Requisicao-{{date('d/m/Y H:i', strtotime(\Carbon\Carbon::now()))}}</title>
</head>
<body>
<div class="container" style="background-color: #fff;font-family: 'Quicksand',sans-serif;">

    <div class="header">
        <div class="header-left">
            <img src="{{ URL::asset('storage/logos/logo-small.jpg') }}" width="160px" height="70px">
        </div>

        <div class="header-right">
            <p class="text-header header-main">Centro Médico MAX VIDA, LDA</p>
            <p class="text-header">Sector de Manutenção</p>
            <p class="text-header" style="margin-left: 18%; text-indent : 1.5em;">Pré requisição de transporte de : {{ $hoje }} às {{ date('H:i:s', strtotime(\Carbon\Carbon::now()))}}</p>
        </div>
    </div>

    <table class="blueTable">
        <tr>
            <th>Código da pré requisição</th>
            <td>{{ $preReq->id }}</td>
        </tr>
        <tr>
            <th>Sector</th>
            <td>{{ $preReq->sector->name }}</td>
        </tr>
        <tr>
            <th>Prioridade da requisição</th>
            <td>{{ $preReq->prioridade }}</td>
        </tr>

        <tr>
            <th>Data da requisição</th>
            <td>{{ date('d-m-Y', strtotime($preReq->created_at)) }}</td>
        </tr>

        <tr>
            <th>Requisitante</th>
            <td>{{ $preReq->user->name }}</td>
        </tr>

        <tr>
            <th>Tipo de viajem</th>
            <td>{{ $preReq->tipo_viajem }}</td>
        </tr>

        <tr>
            <th>Origem</th>
            <td>{{ $preReq->origem }}</td>
        </tr>

        <tr>
            <th>Destino</th>
            <td>{{ $preReq->destino }}</td>
        </tr>

        <tr>
            <th>Tempo de viajem</th>
            <td>{{ $preReq->tempo_viajem }}</td>
        </tr>

        <tr>
            <th>Carga</th>
            <td>{{ $preReq->mercadoria }}</td>
        </tr>
        <tr>
            <th>Dia e Hora de Partida</th>
            <td>{{ date('d-m-Y', strtotime($preReq->dia_saida))}} às {{ date('H:i', strtotime($preReq->hora_saida)) }}
            </td>
        </tr>
    </table>
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
