<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>


    <style>
        @page {
            margin: 0 0.2cm 0.2cm 0.1cm;
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
            font-size: 13px;
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

    </style>
    <title>Relatório MAXVIDA {{ date('d-m-Y', strtotime(\Carbon\Carbon::now())) }}</title>
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
            <p class="text-header" style="margin-left: 10%;">{!! $message !!}</p>

        </div>
    </div>

    @if(count($avarias)>0)
        <table class="blueTable">
            <thead>
            <tr>
                <th>Código</th>
                <th>Data Sol.</th>
                <th>Sector</th>
                <th>Requisitante</th>
                <th>E. avaria</th>
                <th>E da solic.</th>
                <th>M. Obra</th>
                <th>C material</th>
                <th>Total</th>
                <th>Comprovativo</th>
            </tr>
            </thead>
            <tbody>

            @forelse($avarias as $avaria)
                <tr>
                    <td>{{ $avaria->id }}</td>
                    <td>{{ $avaria->created_at }}</td>
                    <td>{{ $avaria->sector->name }}</td>
                    <td>{{ $avaria->user->name }}</td>
                    <td>{{ ucfirst($avaria->estado) }}</td>
                    <td>{{ ucfirst($avaria->foi_lida? "Recebida": "Não Lida") }}</td>
                    <td>{{ $avaria->mao_obra_final }}</td>
                    <td>{{ $avaria->custo_do_material }}</td>
                    <td>{{ $avaria->valor_total }}</td>
                    <td>{{ $avaria->comprovativo?? 'Não informado'}}</td>
                </tr>
            @empty
                <p style="align-items: center; text-align: center">Sem registos correspondentes</p>
            @endforelse
            </tbody>

        </table>
    @else
        <p style="font-size: 18px; margin-top: 5%; text-align: center">Sem registos para o relatório </p>
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
