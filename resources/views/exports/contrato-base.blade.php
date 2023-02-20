<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$contrato->name}}</title>

    <style>

        @page {
            margin: 1cm;
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
            font-size: 11pt;
        }

        tr:nth-child(1) {
            background-color: #dddddd;
        }

        .clausula-tile {
            text-align: center;
            line-height: 20pt;
            font-size: 11pt;
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
            font-size: 11pt;
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
            <p>{{ $contrato->tipo }}</p>
        </div>
    </header>

    <div class="content">
        <h4>{{ $contrato->tipo }}</h4>
        <p>{{ $contrato->id }}</p>
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
                <td>{{ $contrato->name }}</td>
            </tr>

            <tr>
                <th>Estado civíl</th>
                <td>{{ $contrato->estado_civil }}</td>
            </tr>


            <tr>
                <th>Nacionalidade</th>
                <td>{{ $contrato->nacionalidade }}</td>
            </tr>

            <tr>
                <th>Tipo de Identificação</th>
                <td>{{ $contrato->tipo_documento }}</td>
            </tr>

            <tr>
                <th>Número</th>
                <td>{{ $contrato->bi }}</td>

            </tr>

            <tr>
                <th>Residência</th>
                <td>{{ $contrato->residencia }}</td>
            </tr>

            <tr>
                <th>Habilitações</th>
                <td>{{ $contrato->habilitacoes }}</td>
            </tr>

        </table>

        <p class="text-p">Adiante designado por Contratante e Contratado </p>
        <p class="text-p"> O Presente instrumento particular de {{ $contrato->tipo }} e de Assunção de
            Responsabilidade
            Técnica, as partes acima qualificadas têm entre si junto e avençado o </p>

            <p class="clausula-tile">CLÁUSULA PRIMEIRA
                <br>
                (Do Objecto)
            </p>

            <p class="text-p">1. A <b>CONTRATANTE</b>, empresa cuja actividade é da àrea de prestação de serviços de
                saúde, firma o presente contrato com o <b>CONTRATADO</b>, o(a) qual obriga-se a prestar a <b>CONTRATANTE</b>
                serviços profissionais atinentes a sua formação e habilitação técnico-profissional.
            </p>

            <p class="text-p">2. O <b>CONTRATADO</b>, prestarà a <b>CONTRATANTE</b> as seguintes
                actividades: Trabalhos dentro da instituição enfim, tudo o que for pertinente a sua capacitação técnica
                para manter a regularidade da actividade explorada pela <b>CONTRATANTE</b> .</p>

            <p class="clausula-tile">CLÁUSULA PRIMEIRA
                <br>
                (Da Remuneração)
            </p>

            <p class="text-p">O <b>CONTRATADO</b> é responsável por eventuais retenções de impostos e
                contribuições
                previstos
                na legislação tributária visto que se encontra no regime de ISPC ( imposto Simplificado para
                pequenos contribuintes) e irá canalizar os devidos impostos a autoridade tributaria.
                O <b>CONTRATANTE</b> pagará todo o dia 25 do mês subsequente á aquele serviço efectivamente
                prestado, de segunda a sabado o coorespondente a 9.6 horas diarias e 48h semanais), um
                valor, de 130.000,00 mt (Cento e trinta mil meticais) ;e um Valor de Subsidio de Urgências de
                40.000,00mt (quarenta mil meticais) , Totalizando um valor bruto de <b>170.000,00mt</b> (Cento e
                setenta mil meticais). O <b>CONTRATADO</b> poderá ser requerido a prestar actividades em outras
                subsidiária da empresa, respectivamente na cidade de Tete e Moatize.
                O <b>CONTRATADO</b> deve garantir Mensalmente a organização de todos os documentos e
                arquivos contabilisticos da instituição enfim, tudo o que for pertinente a sua capacitação
                profissional para manter a regularidade da actividade explorada pela <b>CONTRATANTE</b> .</p>

            <p class="clausula-tile">CLÁUSULA TERCEIRA<br>(Da Vigência)
            </p>
            <p class="text-p">O presente contrato é firmado por um prazo de <b>12 meses </b>, passando a vigorar a partir da
                data
                de sua assinatura, podendo ser rescindido por qualquer das partes, caso não ocorra concensso
                entre ambos ,caso a rescisão ocorra antes de <b>12 meses</b> o <b>CONTRATADO</b> deverá ressarcir
                a <b>CONTRATANTE</b> o valor dos custos efectuados a quando da contratação. <b>Anexo 1</b>.</p>

            <p class="clausula-tile">
                CLÁUSULA QUARTA
                <br>(Da Rescisão )
            </p>

            <p class="text-p">O presente contrato poderà ser rescindido por qualquer uma das partes, mediante os
                seguintes pontos abaixo:</p>
            <p class="text-p">Paragrafo 1º- O contrato também poderà ser rescindido em caso de violação de quaiquer das
                clàusulas deste contrato, pela parte prejudicada, mediante denùncia ou imediata, sem juizo de
                eventual indenização cabivel.</p>
            <p class="text-p">Paràgrafo 2º- Qualquer tolerância das partes quanto ao descumprimento das clàusulas do
                presente contrato constituirà mera liberalidade, não configurando renùncia ou novação do
                contrato ou de suas cluàsulas que poderão ser exigidos a qualquer tempo</p>

            <p class="clausula-tile">
                CLAÚSULA QUINTA
                <br>
                (Do Regime Juridico)
            </p>
            <p class="text-p">As partes declaram não haver entre si vìnculo empregatìcio, tendo
                o <b>CONTRATANTE</b> plena
                autonomia na prestação dos serviços, desde que prestados conforme as condições ora pactuadas e demais
                exigências legais. O <b>CONTRATADO</b> responde exclusivamente por eventual imprudência,
                negligência,
                impericia e dolo na execução de serviços que venham a causar qualquer dano a <b>CONTRATANTE</b> ou a
                terceiros, devendo responder regressivamente caso a <b>CONTRATANTE</b> seja responsabilizada
                judicialmente
                por tais factos, desde que haja a denunciação de lide, salvo no caso de conduta da pròpria
                <b>CONTRATANTE</b> contrària à orientação dada pelo <b>CONTRATADO</b>.</p>

            <p class="text-p">Paràgrafo ùnico - Tendo em vista a importância da responsabilidade técnica assumida o
                <b>CONTRATADO</b> deverà fazer por escrito suas orientações a <b>CONTRATANTE</b> e seus
                prepostos.</p>

            <p class="clausula-tile">
                CLÁUSULA SEXTA
                <br>
                (Deveres Gerais do contratado)
            </p>

            <p class="text-p">2. O <b>CONTRATADO</b> obriga-se a cumprir correctamente as normas de prestação de
                serviço e
                de
                bom comportamento, a manter em boas condições os bens relacionados com a sua actividade,
                a guardar sigilo profissional e os segredos de produção e de serviço de que tome
                conhecimento, e a não utilizar para fins pessoais ou alheios ao serviço, os locais, equipamento,
                veículos e outros bens ou serviços do local de prestação de serviço
            </p>

            <p class="text-p">O <b>CONTRATADO</b> obriga-se a apresentar os seguintes documentos, com um prazo de até
                uma
                semana após a assinatura do contrato:
            </p>

            <ol type="a">
                <li>Fotocópia do Bilhete de Identidade</li>
                <li>Fotocópia do NUIT</li>
                <li>2 Fotos tipo passe coloridas.</li>
                <li>Boletim de Saude (passado pelo CHAEM)</li>
                <li>Declaração do Bairro.</li>
                <li>Fotocópia do Certificado de Habilitações.</li>
                <li>Curriculum Vitae</li>
                <li>Fotocópia de comprovativo bancario</li>
            </ol>

            <ul>
                <li>Fotocópia da Carteira profissional, emitida pela Direcção Provincial de Saúde de Tete</li>
                <li>Carta de autorização para práctica de medicina privada, (ou protocolo da mesma)</li>
                <li>Copia do Cartao do INSS (se tiver)</li>
                <li>Documentos para profissionais de Saúde</li>
            </ul>

            <p class="clausula-tile">CLÁUSULA SETIMA
                <br>
                (Deveres Gerais do contratante)
            </p>
            <p class="text-p">O <b>CONTRATANTE</b> obriga-se a tratar o <b>CONTRATADO</b> com correção e respeito, a
                atribuir-lhe as
                tarefas e benefícios acordados, assim como se obriga a criar, dentro das suas possibilidades,
                condições que lhe possibilitem atingir o mais alto nível de eficiência.
            </p>

            <p class="clausula-tile">CLÁUSULA OITAVA
                <br>
                (Do Foro de Eleição)
            </p>
            <p class="text-p">As partes elegem o foro do tribunal da Cidade de Tete para qualquer demanda judicial relativa
                ao presente documento, com exclusão de qualquer outro.
                E por estarem justas e contratadas, na melhor forma de direito, as partes assinam o presente
                instrumento em 02 ( duas) vias originais e de igual teor e forma, dando tudo por bom, firme e valioso.</p>
        <div class="row">
            <div class="column">
                <p class="clausula-tile">A CONTRATANTE:</p>
                <p class="clausula-tile">CENTRO MÉDICO MAXI VIDA SOCIEDADE UNIPESSOAL, LIMITADA</p>
                <br>
                <hr>
            </div>
            <div class="column">
                <p class="clausula-tile">O CONTRATADO:</p>
                <p class="clausula-tile">{{ $contrato->name }}</p>
                <br>
                <br>
                <hr style="margin-top: 1.5%">
            </div>
        </div>

        <p class="clausula-tile">Data e Local da celebração do contrato</p>
        <p class="clausula-tile">__________ {{ $data }}</p>
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
