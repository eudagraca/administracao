<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$adenda->id}}</title>

    <style>

        @page {
            margin: 1.5cm;
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
        <div class="colun" style="text-align: right; margin-right: -9% !important;">
            <p>Contrato de adenda</p>
        </div>
    </header>

    <div class="content">
        <h4>TERMO ADITIVO AO CONTRATO DE PRESTAÇÃO DE SERVIÇO CELEBRADO ENTRE CENTRO MÉDICO MAXI VIDA S. U. LDA
            </h4>

        <p>E</p>

        <h4>{{ $adenda->contrato->name }}</h4>
        <p style="text-align: center" >Adenda N° {{ $adenda->id }}</p>
        <p>Entre:</p>
        <p class="text-p" id="text-maxvida"><strong>CENTRO MÉDICO MAXI VIDA SOCIEDADE UNIPESSOAL, LIMITADA</strong> com
            sede na cidade
            de Tete,
            Avenida Martires, matriculada na Conservatória de Registo das Entidades Legais sob o nº 100540681,
            Licença no: 01/2015 ,neste acto representado por:
            Márcio Raúl Dias Quintano, solteiro maior, natural de Maputo, de nacionalidade Moçambicana,
            portador de BI Nº110100334047A, emitido em Cidade de Tete aos 05/02/2016, na qualidade de
            Administrador, com poderes bastantes para o efeito, doravante designada por Primeiro Outorgante e
            Contratante
        </p>

        <p>E</p>

        <table>
            <tr>
                <th>Nome</th>
                <td>{{ $adenda->contrato->name }}</td>
            </tr>

            <tr>
                <th>Estado civíl</th>
                <td>{{ $adenda->contrato->estado_civil }}</td>
            </tr>


            <tr>
                <th>Nacionalidade</th>
                <td>{{ ucfirst($adenda->contrato->nacionalidade) }}</td>
            </tr>

            <tr>
                <th>Tipo de Identificação</th>
                <td>{{ $adenda->contrato->tipo_documento }}</td>
            </tr>

            <tr>
                <th>Número</th>
                <td>{{ $adenda->contrato->bi }}</td>

            </tr>

            <tr>
                <th>Residência</th>
                <td>{{ $adenda->contrato->residencia }}</td>
            </tr>

            <tr>
                <th>Habilitações</th>
                <td>{{ $adenda->contrato->habilitacoes }}</td>
            </tr>

        </table>

        <p class="text-p">Adiante designado por Contratante e Contratado </p>
        <p class="text-p">Tendo entre si acordado esta {{ $numExt }} Adenda ao contrato de prestação de serviço, que se regerá
            pelas cláusulas seguintes: </p>

        <p class="clausula-tile">CLÁUSULA PRIMEIRA
            <br>
            ({{ $adenda->clausula }})
        </p>
        <p class="text-p">{{ $adenda->descricao }}</p>

        <div class="row">
            <div class="column">
                <p class="clausula-tile">A CONTRATANTE:</p>
                <p class="clausula-tile">CENTRO MÉDICO MAXI VIDA SOCIEDADE UNIPESSOAL, LIMITADA</p>
                <br>
                <hr>
            </div>
            <div class="column">
                <p class="clausula-tile">O CONTRATADO:</p>
                <p class="clausula-tile">{{ $adenda->contrato->name }}</p>
                <br>
                <br>
                <hr style="margin-top: 10px">
            </div>
        </div>

        <p class="clausula-tile">Data e Local da celebração do contrato</p>
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
