<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <style>
        @page {
            margin: 0 0.1cm 0.1cm 0.1cm;
        }

        /*html,*/
        body {
            margin: 0;
            padding: 2%;
            height: 100%;
            font-family: "Helvetica", sans-serif;
        }

        div p {
            font-weight: 400;
            font-size: 13px;
            color: #212121;
        }

        .header-left {
            float: left;
        }

        .header-right {
            margin-left: -10%;
        }

        .text-header {
            text-align: center;
            font-size: 11pt !important;

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

        table.blueTable {
            margin-top: 1%;
            border: 1px solid #000000;
            background-color: #EEEEEE;
            width: 100%;
            text-align: left;
            border-collapse: collapse;
        }

        table.blueTable td, table.blueTable th {
            border: 0.6px solid #000000;
            padding: 3px 2px;
        }

        table.blueTable tbody td {
            font-size: 12px;
        }

        table.blueTable tr:nth-child(even) {
            background: #D0E4F5;
        }

        table.blueTable thead {
            background: #92C683;
            /*background: -moz-linear-gradient(top, #add4a2 0%, #9dcb8f 66%, #92C683 100%);*/
            /*background: -webkit-linear-gradient(top, #add4a2 0%, #9dcb8f 66%, #92C683 100%);*/
            /*background: linear-gradient(to bottom, #add4a2 0%, #9dcb8f 66%, #92C683 100%);*/
            border-bottom: 1px solid #000000;
        }

        table.blueTable thead th {
            font-size: 13px;
            font-weight: bold;
            color: #FFFFFF;
            border-left: 1px solid #000000;
        }

        table.blueTable thead th:first-child {
            border-left: none;
        }

        table.blueTable tfoot {
            font-size: 9px;
            font-weight: bold;
            border-top: 1px solid #000000;
        }

        table.blueTable tfoot td {
            font-size: 9px;
        }

        img.center {
            display: block;
            margin: 0 auto;
        }

    </style>

    <title>Relatório de requisições</title>
</head>
<body>
<div class="container" style="background-color: #fff;height: auto;font-family: 'Quicksand',sans-serif;">

    <div class="header">
        <div class="header-left">
            <img src="{{  public_path("storage/logos/logo-small.jpg") }}" width="160px" height="70px">
        </div>

        <div class="header-right">
            <p class="text-header header-main">Centro Médico MAX VIDA, LDA</p>
            <p class="text-header">Sector de Administração</p>
            <p class="text-header" style="margin-left: 20%;">{!! $message !!}</p>

        </div>
    </div>

    @if(count($requisicoes)>0)
        <table class="blueTable">
            <thead>
            <tr>
                <th>N° ReQ.</th>
                <th>Data ReQ.</th>
                <th>Sector</th>
                <th>Requisitante</th>
                <th>Origem</th>
                <th>Destino</th>
                <th>Motorista</th>
                <th>Transporte</th>
            </tr>
            </thead>
            <tbody>
            @forelse($requisicoes as $requisicao)
                <tr>
                    <td>{{ $requisicao->requisicao->id }}</td>
                    <td>{{ date('d-m-Y', strtotime($requisicao->created_at)) }}</td>
                    <td>{{ $requisicao->sector->name }}</td>
                    <td>{{ $requisicao->user->name }}</td>
                    <td>{{ $requisicao->origem }}</td>
                    <td>{{ $requisicao->destino }}</td>
                    <td>{{ $requisicao->requisicao->motorista->name }}</td>
                    <td>{{ $requisicao->requisicao->transporte->marca }}</td>
                </tr>
            @empty
                <p style="align-items: center; text-align: center">Sem registos correspondentes</p>
            @endforelse
            </tbody>

        </table>
    @else
        <div>

            <p style="font-size: 13pt; margin-top: 5%; text-align: center">Sem registos para o relatório </p>
        </div>
    @endif

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
