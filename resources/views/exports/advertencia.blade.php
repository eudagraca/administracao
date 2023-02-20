<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$advertencia->id}}</title>

    <style>

        @page {
            margin: 1.3cm;
            line-height: 18pt;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0;
            right: 0;
            background-color: lightblue;
            height: 50px;
        }

        * {
            box-sizing: border-box;
        }

        #text-maxvida {
            text-align: justify;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #3e3e3e;
            text-align: left;
            padding: 8px;
            font-size: 12pt;
        }

        tr:nth-child(1) {
            background-color: #dddddd;
        }

        .clausula-tile {
            text-align: center;
            line-height: 20pt;
        }

        .text-p {
            text-align: justify;
            font-size: 12pt;
        }

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 50%;
            padding: 10px;
            height: auto; /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .coluna {
            float: left;
            width: 50%;
            padding: 0px;
            height: auto; /* Should be removed. Only for demonstration */
        }

        .colum {
            float: left;
            width: 32%;
            padding-left: 10px;
            height: auto; /* Should be removed. Only for demonstration */
        }


        hr {
            background: black;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: auto;
            padding: 2px 50px;
            background-color: #ffffff;
            z-index: 1000;
        }

        .content {
            margin-top: 8%;
        }

    </style>
</head>
<body>

<div class="container" style="background-color: #fff;font-family: 'Quicksand',sans-serif;">

    <header class="row">
        <div class="coluna" style="margin-left: -8%">
            <img src="{{  public_path("storage/logos/logo-small.jpg") }}" width="120px" height="40px">
        </div>
        <div class="colun" style="text-align: right; margin-right: -10% !important;">
            <p>Visto da Direcção<br>
                <br>
            ____ /_____ / {{ date('Y') }}</p>

            <p style="float: right; margin-right: -1%; font-weight: bold">Referência: {{ $advertencia->id }}</p>
        </div>

    </header>

    <div class="content">
        <h4>CENTRO MÉDICO MAXI VIDA SOCIEDADE UNIPESSOAL, LIMITADA
            </h4>
        <p>{{ count($quantAdv) }}ª Advertência</p>

        <h4>Para : {{ $advertencia->para }}</h4>
        <p>Assunto: ADVERTÊNCIA DE SERVIÇO</p>

        <p class="text-p" id="text-maxvida">
            O Centro Medico Maxi Vida, vem por meio desta advertir a/o Sra/Sr <strong>{{ $advertencia->user->name }}</strong> pelo facto de <strong>{{ $advertencia->motivo }}</strong>,
            informar que caso haja reincidência de atos de natureza similar, a primeira medida será uma suspensão de serviço de até
            02 (dois) dias, a segunda medida será uma suspensão de serviço de até 07 (sete) dias, e terceira e ultíma medida será
            uma uma suspensão de serviço por tempo indeterminado.
        </p>

        <p class="text-p">Aplicamos a tal advertência com objectivo de que sua conduta seja revista.</p>


        <div class="row">
            <div class="colum">
                <p class="clausula-tile">Advertido Por:</p>
                <br>
                <hr>
                <p class="clausula-tile">{{ $advertencia->adversor->name }}</p>
            </div>
            <div class="colum">
                <p class="clausula-tile">A/O Colaborador:</p>
                <br>
                <hr style="margin-top: 10px">
                <p class="clausula-tile">{{ $advertencia->user->name }}</p>
            </div>
            <div class="colum">
                <p class="clausula-tile">O Representante do sector:</p>
                <br>
                <hr style="margin-top: 10px">
                <p class="clausula-tile">{{ $advertencia->adversor->name }}</p>
            </div>

        </div>


        <div class="row">
            <div class="column">
                <p class="clausula-tile">Recursos Humanos:</p>
                <br>
                <hr>
            </div>
            <div class="column">
                <p class="clausula-tile">Director(a) ADM /Coord. Clínico:</p>
                <br>
                <hr style="margin-top: 10px">
            </div>
        </div>

        <p class="clausula-tile">Tete, aos {{ $hoje }}</p>
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
