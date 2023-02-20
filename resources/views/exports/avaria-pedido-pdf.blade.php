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

        .assinatura {
            margin-left: 15%;
        }

    </style>
</head>
<body>
<div class="container" style="background-color: #fff;height: auto;font-family: 'Quicksand',sans-serif;">

    <div class="header">
        <div class="header-left">
            <img src="{{ URL::asset('storage/logos/logo-small.jpg') }}" width="160px" height="70px">
        </div>

        <div class="header-right" style="margin-left: -20%">
            <p class="text-header header-main">CENTRO MÉDICO MAXI VIDA, LDA</p>
            <p class="text-header">Sector de Manutenção</p>
            <p class="text-header" style="margin-left: 10%; text-indent : 1.5em;">Pedido de Resolução de Avaria</p>

        </div>
    </div>

    <div class="expand-box" style="margin-bottom: 0 !important; margin-top: 15px !important;">
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
        <div class="column-f">
            <h5 style="margin-bottom: 1%;">Localização</h5>
            <label style="font-size: 12px; ">{{ $avaria->localizacao }}</label>
        </div>
        <div class="column-f">
            <h5 style="margin-bottom: 1%;">Submetida por</h5>
            <label style="font-size: 12px; ">{{ $avaria->user->name }}</label>
        </div>

    </div>

    <hr style="margin-top: 0.3% !important;">

    <div class="row" style="margin-bottom: 0.5% !important;">
        <div class="column" style="margin-right: 1%">
            <h5>Descrição</h5>
            <p>{{ $avaria->descricao }}</p>
        </div>
        <div class="column" style="margin-right: 20%">
            <h5>Compartimento</h5>
            <p class="text-normal">{{$avaria->compartimento?? 'Não indicado'}}</p>

        </div>
    </div>

    <div class="row" style="margin-top: 0 !important;">
        <div class="column" style="margin-right: 1%">
            <h5>Nível de prioridade</h5>
            <p>{{ ucfirst($avaria->prioridade)}}</p>
        </div>
        <div class="column" style="margin-right: 20%">
            <h5>Natureza</h5>
            <p class="text-normal">{{$avaria->natureza}}</p>
        </div>
    </div>


    <div class="row" style="margin-bottom: 0.5% !important; margin-top: 0.5% !important;">
        <div class="column" style="margin-right: 1%">
            <h5>Referência</h5>
            <p>{{ $avaria->referencia}}</p>
        </div>
        <div class="column" style="margin-right: 20%">
            <h5>Data e hora de submissão</h5>
            <p>{{ date('d-m-Y', strtotime($avaria->created_at)) }} às {{ date('H:i', strtotime($avaria->created_at)) }}
                Minutos </p>
        </div>
    </div>
</div>
</body>
</html>
