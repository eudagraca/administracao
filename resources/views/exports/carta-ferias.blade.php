<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Féria - {{$feria->user->name}}</title>

        <style>
            @page {
                margin: 1.2cm;
                line-height: 18pt;
                font-size:11pt
            }

            header {
                position: fixed;
                top: -80px;
                left: 0;
                right: 0;
                background-color: lightblue;
                height: 40px;
                font-size:11pt
            }

            * {
                box-sizing: border-box;
            }

            #text-maxvida {
                text-align: justify;
            }



            .text-p {
                text-align: justify;
                font-size: 11pt;
            }

            /* Create two equal columns that floats next to each other */
            .column {
                float: left;
                width: 50%;
                padding: 10px;
                height: auto;
                /* Should be removed. Only for demonstration */
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
                height: auto;
                /* Should be removed. Only for demonstration */
            }

            .colum {
                float: left;
                width: 32%;
                padding-left: 10px;
                height: auto;
                /* Should be removed. Only for demonstration */
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
        </style>
    </head>

    <body>

        <div class="container" style="background-color: #fff;font-family: 'Quicksand',sans-serif;">

            <header class="row">
                <div class="coluna" style="margin-left: -8%">
                    <img src="{{  public_path("storage/logos/logo-small.jpg") }}" width="100px" height="40px">
                </div>
                <div class="colun" style="text-align: right; margin-right: -10% !important;">
                    <p><b>Visto da Direcção</b><br>
                        <br>
                        ____/_____/{{ date('Y') }}</p>


                </div>
            </header>

            <div class="content">
                <h4>CENTRO MÉDICO MAXI VIDA SOCIEDADE UNIPESSOAL, LIMITADA
                </h4>


                <p><b>Assunto​</b> : LICENÇA DISCIPLINAR</p>

                <p class="text-p" id="text-maxvida">
                    Eu <b>{{ $feria->user->name }}</b>, colaborador do Centro Médico Maxi Vida, afecto ao sector de/a
                    <b>{{ $feria->user->getSector()?$feria->user->getSector()->name:'________________________' }}</b>, como {{ $feria->funcao }}, venho por este meio solicitar
                    a V.Excia o gozo de licença disciplinar referente a <b>{{ $feria->anos_trabalho }} </b >{{ $feria->periodo }} de trabalho, que tem como data de início {{ date('d/m/Y', strtotime($feria->data_inicio)) }} e com o término {{ date('d/m/Y', strtotime($feria->data_termino)) }}, deixo como substituto o/a colega
                    <b>{{ $feria->substituto->name }}</b>. Em anexo o plano de trabalho e escala actualizada.
                </p>

                <p >Pelo que, pede deferimento.</p>

                <div class="row">
                    <div class="colum">
                        <p class="clausula-tile" style="margin-left: 30px !important">Assinatura do colaborador:</p>
                        <br>
                        <hr style="margin-top: 5px" >
                        <p class="clausula-tile" style="margin-left: 30px !important">{{ $hoje }}</p>
                    </div>
                    <div class="colum">
                        <p class="clausula-tile" style="margin-left: 30px !important">Assinatura do substituto:</p>
                        <br>
                        <hr style="margin-top: 5px">
                        <p class="clausula-tile" style="margin-left: 30px !important">{{ $hoje }}</p>
                    </div>
                    <div class="colum">
                        <p class="clausula-tile" style="margin-left: 30px !important">Parecer do RH:</p>
                        <p style="text-align: center">{{ ucfirst($feria->estado) }}</p>
                        {{-- <hr style="margin-top: 5px" > --}}
                        <p class="clausula-tile" style="margin-left: 30px !important">{{ $hoje }}</p>
                    </div>


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
