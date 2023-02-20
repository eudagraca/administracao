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
            font-size: 13pt;
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

        #contents table {
            width: 49.5%;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

    </style>
    <title>Requisição {{$preRequisicao->requisicao->id}}</title>
</head>
<body>
<div class="container" style="background-color: #fff;font-family: 'Quicksand',sans-serif;">

    <div class="header">
        <div class="header-left">
            <img src="{{  public_path(" storage/logos/logo-small.jpg") }}" width="160px" height="70px">
        </div>

        <div class="header-right">
            <p class="text-header header-main">Centro Médico MAX VIDA, LDA</p>
            <p class="text-header">Sector de Manutenção</p>
            <p class="text-header" style="margin-left: 18%; text-indent : 1.5em;">Requisição de transporte</p>
        </div>
    </div>

    <p style="font-size: 12pt;">Referência da requisição: <span style=" font-weight: bold"> {{ $preRequisicao->requisicao->id}}</span></p>
    <p style="font-size: 12pt;">Estado da requisição:   <span style=" font-weight: bold">{{ ucfirst($preRequisicao->estado)}}</span></p>
    <div>

        <table cellspacing="0" style="margin-right: 1%;" cellpadding="0" >
            <tr>
                <td>Remetente</td>
                <td>Sector</td>
                <td>Responsável</td>
                <td>Data de saída</td>
                <td>Hora de saída</td>
            </tr>
            <tr>
                <td>{{ $preRequisicao->user->name }}</td>
                <td>{{ $preRequisicao->sector->name }}</td>
                <td>{{ $preRequisicao->requisicao->user->name }}</td>
                <td>{{ date('d-m-Y', strtotime($preRequisicao->requisicao->dia_exata)) }}</td>
                <td>{{ date('H:i', strtotime($preRequisicao->requisicao->hora_exata)) }}</td>

            </tr>
        </table>


        <table cellspacing="0" style="margin-right: 1%; margin-top: 2%" cellpadding="0">
            <tr>
                <td>Mercadoria</td>
                <td>Origem</td>
                <td>Destino</td>
                <td>Tempo previsto</td>
            </tr>
            <tr>
                <td>{{ $preRequisicao->mercadoria }}</td>
                <td>{{ $preRequisicao->origem }}</td>
                <td>{{ $preRequisicao->local->name }}</td>
                <td>{{ $preRequisicao->tempo_viajem }}</td>
            </tr>
        </table>

        <table cellspacing="0" style="margin-right: 1%; margin-top: 2%" cellpadding="0">
            <tr>
                <td>Hora e Data de início da actividade</td>
                <td>Hora e Data de término da actividade</td>
            </tr>
            <tr>
                <td>{{ date('d-m-Y', strtotime($preRequisicao->requisicao->tarefa->start_at ))}}  às  {{ date('H:i', strtotime($preRequisicao->requisicao->tarefa->start_at)) }}</td>
                <td>{{ date('d-m-Y', strtotime($preRequisicao->requisicao->tarefa->end_at ))}}  às  {{ date('H:i', strtotime($preRequisicao->requisicao->tarefa->end_at)) }}</td>
            </tr>
        </table>

        <table cellspacing="0" cellpadding="0" style="margin-top: 2%">
            <tr>
                <td>Motorista</td>
                <td>Transporte</td>
                <td>Tempo Gasto</td>
            </tr>
            <tr>
                <td>{{ $preRequisicao->requisicao->motorista->name }}</td>
                <td>{{ $preRequisicao->requisicao->transporte->marca }} - {{ $preRequisicao->requisicao->transporte->modelo }}</td>
                <td>{{ Carbon\Carbon::parse($preRequisicao->requisicao->tarefa->end_at)->diffForHumans(\Carbon\Carbon::parse($preRequisicao->requisicao->tarefa->start_at))}}</td>
            </tr>
        </table>

        <div class="clear"></div><!--/clear-floats-->

    </div>


    <table cellspacing="0" style="margin-top: 1%; margin-bottom: 2%" cellpadding="0">
        <tr>
            <td>Observação</td>
        </tr>
        <tr>
            <td>{{ $preRequisicao->requisicao->observacoes?? '_______________________' }}</td>
        </tr>
    </table>

    @if($preRequisicao->mercadoria == 'Pessoas')
        <label>Acompanhantes</label>
        <table cellspacing="0" style="margin-top: 1%;" cellpadding="0">
            <tr>
                @foreach($preRequisicao->pessoas as $pessoa)
                <td>{{ $pessoa->nome }}</td>
                @endforeach
            </tr>
        </table>

    @elseif($preRequisicao->mercadoria == 'Mercadoria')
        <label>Volume</label>
        <table cellspacing="0" style="margin-top: 1%;" cellpadding="0">
            <tr>
                    <td>{{ $preRequisicao->volume .' '.$preRequisicao->unidade }}</td>
            </tr>
        </table>
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
