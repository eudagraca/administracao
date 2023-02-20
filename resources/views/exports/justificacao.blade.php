<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>{{$justificacao->user->name}} {{$justificacao->id}}</title>

        <style>
            @page {
                margin: 0.5cm;
                line-height: 18pt;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0;
                right: 0;
                height: 50px;
                font-size: 10pt !important;
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
                border-spacing: 0;
                width: 100%;
                font-size: 10pt !important;
                border: 1px solid #ddd;
            }

            th,
            td {
                text-align: left;
                padding: 10px;
                font-size: 10pt !important;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
                font-size: 10pt !important;
            }



            .clausula-tile {
                text-align: center;
                line-height: 20pt;
                font-size: 10pt !important;
            }

            .text-p {
                text-align: justify;
                font-size: 10pt !important;
            }

            /* Create two equal columns that floats next to each other */
            .column {
                float: left;
                width: 24%;
                padding: 5px;
                height: auto;
                font-size: 10pt !important;
                /* Should be removed. Only for demonstration */
            }

            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
                font-size: 12pt !important;
            }

            .coluna {
                float: left;
                width: 50%;
                padding: 0px;
                height: auto;
                font-size: 12pt !important;
                /* Should be removed. Only for demonstration */
            }


            hr {
                background: black;
            }

            .content {
                margin-top: 5%;
                font-size: 10pt !important;
                height: 1200px;
                /* Changed this height */
                margin-bottom: 5% !important;
            }

            .form-inline {
                display: flex;
                width: 100%;
                flex-flow: row wrap;
                align-items: center;
                font-size: 10pt !important;
            }

            .form-inline label {
                margin: 5px 10px 5px 0;
                font-size: 10pt !important;
            }

            .form-inline input {
                vertical-align: middle;
                margin: 5px 10px 5px 0;
                padding: 10px;
                font-size: 10pt !important;
                color: #000000;
                background-color: #fff;
                border: 1px solid #ddd;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            #footer {
                position: absolute;
                bottom: 0;
                width: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                height: 100%;
            }
        </style>
    </head>

    <body>

        <div class="container" style="background-color: #fff;font-family: 'Quicksand',sans-serif;">

            <header class="row">
                <div class="coluna" style="margin-top: 5% !important">
                    <img src="{{  public_path("storage/logos/logo-small.jpg") }}" width="120px" height="40px">
                </div>
                <div class="colun" style="text-align: right; margin-right: 0% !important; margin-top: 5%">
                    <p><b>N° DOC</b> <u>{{ $justificacao->id }}</u><br>{{ $hoje }}
                        <br>
                        Data ____/_____/{{ date('Y') }}
                    </p>
                </div>
            </header>

            <div class="content">
                <h4>Justificação de falta</h4>
                <hr>
                <p>
                    <form class="form-inline">
                        <fieldset style="width: 100%;">
                            <legend>Dados do colaborador</legend>
                            <p>
                                <b>
                                    SECTOR: </b>{{ $justificacao->sector->name }}

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>NOME: </b>{{ $justificacao->user->name }}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>COLABORADOR:
                                </b>{{ $justificacao->tipo_colaborador }}
                            </p>
                        </fieldset>
                    </form>
                </p>

                <p>
                    <form class="form-inline">
                        <fieldset style="width: 100%;">
                            <legend>Dados do pedido</legend>

                            <p>
                                <b>
                                    PEDIDO DE: </b>{{ $justificacao->tipo_justificacao }}

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>QUEM PEDE:
                                </b>{{ $justificacao->tipo_colaborador }}
                            </p>

                        </fieldset>
                    </form>
                </p>
                <h4>Dados da escala</h4>
                <table>
                    <tr>
                        <td>Datas</td>
                        <td>Hora de entrada</td>
                        <td>Intervalo</td>
                        <td>Hora de saída</td>
                    </tr>
                    @foreach($justificacao->dados as $dado)
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($dado->data_escala)) }}</td>
                        <td>{{ $dado->hora_inicio_escala }}</td>
                        <td>{{ $dado->intervalo }}</td>
                        <td>{{ $dado->hora_fim_escala }}</td>
                    </tr>
                    @endforeach
                </table>

                <h4>Dados da falta</h4>
                <table>
                    <tr>
                        <td>Hora de início</td>
                        <td>Hora do fim</td>
                    </tr>
                    @foreach($justificacao->dados as $dado)
                    <tr>


                        <td>{{ $dado->hora_inicio_falta }}</td>
                        <td>{{ $dado->hora_fim_falta }}</td>

                    </tr>
                    @endforeach

                </table>

                <h4>Prolongamento do turno</h4>
                <table>
                    <tr>
                        <td>Datas</td>
                        <td>Hora de inicio</td>
                        <td>Intervalo</td>
                        <td>Hora final</td>
                    </tr>
                    @foreach($justificacao->dados as $dado)
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($dado->data_rh)) }}</td>
                        <td>{{ $dado->hora_inicio_rh }}</td>
                        <td>{{ $dado->intervalo_rh }}</td>
                        <td>{{ $dado->hora_fim_rh }}</td>

                    </tr>
                    @endforeach

                </table>
                <h4>Motivo</h4>
                <fieldset style="padding-top: 0% !important; padding-bottom: 0% !important">

                    <p>{{ $justificacao->motivo }}</p>

                </fieldset>

                <table style="margin-top: 1%">
                    <tr>
                        <td>Forma de compensação</td>
                        <td>Observações</td>
                    </tr>
                    <tr>
                        <td>{{ $justificacao->forma_compensacao }}</td>
                        <td>{{ $justificacao->observacoes }}</td>
                    </tr>
                    </fieldset>
            </div>

            <div class="row" id="#foter">
                <div class="column">
                    <h4>O colaborador</h4>
                    <p style="margin-top: -2% !important"><label>
                            Concordo
                            <input type="checkbox">
                        </label>
                        <br>
                        <label>
                            Não Concordo
                            <input type="checkbox">
                        </label>
                    </p>
                    <br>
                    <hr style="margin-top: -0.1%">
                    <p class="clausula-tile">{{ $hoje }}</p>
                    <h5 class="clausula-tile">Tomei conhecimeto</h5>
                    <hr>
                    <p class="clausula-tile">___/____________/{{ date('Y') }}</p>
                </div>


                <div class="column">
                    <h4>Parecer do chefe do sector</h4>
                    <p style="margin-left: 2%">{{$justificacao->parecer_chefe}}</p>
                    <br>
                    <br>
                    <hr style="margin-top: -1.7% !important">
                    <p class="clausula-tile">___/____________/{{ date('Y') }}</p>
                </div>

                <div class="column">
                    <h4>Reservado ao RH</h4>
                    <p style="margin-left: 5% !important; margin-top: 0% !important">{{$justificacao->parecer_rh??'.'}}</p>
                    <br>
                    <hr>
                    <p class="clausula-tile">___/____________/{{ date('Y') }}</p>
                </div>

                <div class="column">
                    <h4>Reservada à Direcção</h4>
                    <p style="margin-top: -2% !important"><label>
                            Autorizo
                            <input type="checkbox">
                        </label>
                        <br>
                        <label>
                            Não Autorizo
                            <input type="checkbox">
                        </label>
                        <br>
                        <br>
                        <hr>
                        <p class="clausula-tile">___/____________/{{ date('Y') }}</p>
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
