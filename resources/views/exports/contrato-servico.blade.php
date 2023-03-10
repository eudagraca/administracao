<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$contrato->name.' ' .$contrato->id}}</title>

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
            font-size: 11pt;
        }

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 45%;
            padding: 0px;
            marker-start: 10px;
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
            <p>Contrato de Presta????o de Servi??o</p>
        </div>
    </header>

    <div class="content">
        <h4 style="text-align: center">Contrato Individual de Trabalho</h4>
        <p style="text-align: center">{{ $contrato->id }}</p>
        <p>Entre:</p>
        <p class="text-p" id="text-maxvida"><strong>CENTRO M??DICO MAXI VIDA SOCIEDADE UNIPESSOAL, LIMITADA</strong> com sede na cidade de Tete,
            Avenida Martires, matriculada na Conservat??ria de Registo das Entidades Legais sob o n?? 100540681,
            Licen??a no: 01/2015 ,neste acto representado por:
            M??rcio Ra??l Dias Quintano, solteiro maior, natural de Maputo, de nacionalidade Mo??ambicana,
            portador de BI N??110100334047A, emitido em Maputo aos 05/02/2016, na qualidade de
            Administrador, com poderes bastantes para o efeito, doravante designada por Primeiro Outorgante
            e Contraente.
        </p>

        <p>E</p>

        <table>
            <tr>
                <th>Nome</th>
                <td>{{ $contrato->name }}</td>
            </tr>

            <tr>
                <th >Estado civ??l</th>
                <td>{{ $contrato->estado_civil }}</td>
            </tr>


            <tr>
                <th>Nacionalidade</th>
                <td>{{ $contrato->nacionalidade }}</td>
            </tr>

            <tr>
                <th>Tipo de Identifica????o</th>
                <td>{{ $contrato->tipo_documento }}</td>
            </tr>

            <tr >
                <th>N??mero</th>
                <td>{{ $contrato->bi }}</td>

            </tr>

            <tr>
                <th>Resid??ncia</th>
                <td>{{ $contrato->residencia }}</td>
            </tr>

            <tr>
                <th>Habilita????es</th>
                <td>{{ $contrato->habilitacoes }}</td>
            </tr>

        </table>

        <p class="text-p">Adiante designado por Contratante e Contratado </p>
        <p class="text-p">?? celebrado o presente contrato de trabalho por <b>tempo indeterminado</b> , que se reger??
            pelas seguintes cl??usulas abaixo declaradas: </p>

        <p class="clausula-tile">CL??USULA PRIMEIRA
            <br>
            (Admiss??o, Dura????o e Local de Emprego)
        </p>

        <p class="text-p"><strong>1.</strong> O presente contrato entrar?? em vigor apartir de: <b>{{ $dataVigor }}</b></p>

        <p class="clausula-tile">CL??USULA SEGUNDA
            <br>
            (Categoria e Obriga????es)
        </p>

        <p class="text-p">1 O Segundo Outorgante exercer?? a sua actividade profissional na categoria de
            <b>Agente de servi??os</b></p>

        <p class="text-p"><b>2</b> As obriga????es do Segundo Outorgante ser??o explicadas com todos os dados necess??rios, e
            assinadas por ambas as partes</p>

        <p class="text-p"><b>3</b> Dependendo das necessidades da Empresa, o Primeiro Outorgante poder?? requerer ao
            Segundo Outorgante para apoiar em outra ??rea de actividade da Empresa. Devendo esta ser
            acordada por ambas as partes de uma forma razo??vel e sem nenhumas altera????es ou prejuizo
            no pacote e benef??cios.</p>
        <p class="text-p"><b>4</b>O Segundo Outorgante poder?? ser requerido a trabalhar em regime tempor??rio numa outra
            subsidi??ria da Empresa, onde o Primeiro Outorgante ir?? providenciar a acomoda????o
            apropriada e o pagamento das despesas da viagem.</p>

        <p class="clausula-tile">CL??USULA TERCEIRA<br>(Per??odo Probat??rio e Dura????o)
        </p>
        <p class="text-p"><b>1</b> Este Contrato est?? sujeito ao per??odo probat??rio de 90 dias, durante o qual, qualquer das
            partes poder?? rescindir o Contrato sem quaisquer formalidades, bastando apenas comunicar,
            com anteced??ncia m??mina de 7 dias, por escrito, os motivos da rescis??o. </p>

        <p class="text-p"><b>2</b> O per??odo probat??rio poder?? ser terminado atrav??s de uma notifica????o por escrito, realizada
            no m??nimo 24 (Vinte e quatro) horas antes da data limite para o probat??rio terminar.</p>

        <p class="clausula-tile">
            CL??USULA QUARTA
            <br>(Remunera????o e Regalias Complementares)
        </p>

        <p class="text-p"><b>1</b> O Segundo Outorgante ser?? intitulado a remunera????o bruta mensal de: <b> {{ $contrato->salario_bruto }} {{ $extenso }}</b></p>
        <p class="text-p"><b>2</b> O Segundo Outorgante e os seus dependentes do primeiro grau, incluindo esposo, ser??o
            intitulados a assist??ncia m??dica e medicamentosa gratu??ta nas instala????es do Primeiro
            Outorgante</p>

        <p class="clausula-tile">
            CLA??SULA QUINTA
            <br>
            (Hor??rio de Trabalho)
        </p>

        <p class="text-p"><b>1</b> O Segundo Outorgante estar?? sujeito a um per??odo m??ximo de 48 horas por semana</p>
        <p class="text-p"><b>2</b> A tabela hor??ria de trabalho utilizada ser?? a que estiver em vigor na empresa, conforme a
            aprova????o das autoridades competentes.</p>

        <p class="clausula-tile">
            CL??USULA SEXTA
            <br>
            (Obriga????es de Confidencialidade e Exclusividade)
        </p>

        <p class="text-p"><b>1</b> O Segundo Outorgante n??o dever?? revelar qualquer informa????o escrita ou verbal sem o
            consentimento pr??vio por escrito pelo primeiro Outorgante no que respeita as actividades,
            opera????es e outros detalhes do Primeiro Outorgante.</p>
        <p class="text-p"><b>2</b> Durante o presente contrato, o Segundo Outorgante n??o dever?? se envolver em qualquer
            outra actividade, neg??cio, emprego que possam interferir nas fun????es da Empresa, salvo com
            autoriza????o expressa do Primeiro Outorgante.</p>

        <p class="clausula-tile">
            CL??USULA S??TIMA
            <br>
            (F??rias Anuais)
        </p>

        <p class="text-p"><b>1</b> O Segundo Outorgante ter?? direito a f??rias, segundo a Lei do Trabalho da Republica de
            Mo??ambique.</p>
        <p class="text-p"><b>2</b> Durante o presente contrato, o Segundo Outorgante n??o dever?? se envolver em qualquer
            outra actividade, neg??cio, emprego que possam interferir nas fun????es da Empresa, salvo com
            autoriza????o expressa do Primeiro Outorgante.</p>


        <p class="clausula-tile">
            CL??SULA OITAVA
            <br>
            (Cessa????o do Contrato)
        </p>

        <p class="text-p"><b>1</b> Ap??s o per??odo probat??rio, conforme os termos da Lei de Trabalho em vigor em Mo??ambique,
            o presente contrato poder?? ser terminado por qualquer uma das partes, atrav??s de uma
            notifica????o por escrito realizada no minimo 30 dias (Trinta) antes ou at?? ao primeiro dia do
            calend??rio do m??s.</p>
        <p class="text-p"><b>2</b> O Segundo Outorgante aceita que as remunera????es em d??vida sejam efectuadas na altura da
            cessa????o deste contrato, isto ??, sobre os valores que o Segundo Outorgante tem em d??vida
            com o Primeiro Outorgante.</p>

        <p class="clausula-tile">
            CL??USULA NONA
            <br>
            (Deveres Gerais do Segundo Outorgante)
        </p>

        <p class="text-p"><b>1</b> O Segundo Outorgante obriga-se a prestar servi??os com maior zelo, compet??ncia e
            assiduidade, aproveitando plenamente as suas aptid??es e prepara????o, sob autoridade e
            dire????o do Primeiro Outorgante e de acordo com as ordens que lhe forem dadas pelos
            superiores hier??rquicos.</p>
        <p class="text-p"><b>2</b> O Segundo Outorgante obriga-se a cumprir correctamente as normas de trabalho e de bom
            comportamento, a manter em boas condi????es os bens relacionados com a sua actividade, a
            guardar sigilo profissional e os segredos de produ????o e de servi??o de que tome conhecimento,
            e a n??o utilizar para fins pessoais ou alheios ao servi??o, os locais, equipamento, ve??culos e
            outros bens ou servi??os do local de trabalho.</p>


        <p class="text-p">O Segundo Outorgante obriga-se a apresentar os seguintes documentos, com um prazo de at??
            uma semana ap??s a assinatura do contrato:
        </p>

        <ol type="a">
            <li>Fotoc??pia do Bilhete de Identidade</li>
            <li>Fotoc??pia do NUIT</li>
            <li>2 Fotos tipo passe coloridas.</li>
            <li>Boletim de Saude (passado pelo CHAEM)</li>
            <li>Declara????o do Bairro.</li>
            <li>Fotoc??pia do Certificado de Habilita????es.</li>
            <li>Curriculum Vitae</li>
            <li>Fotoc??pia de comprovativo bancario</li>
        </ol>
        <ul>
            <li>Fotoc??pia da Carteira profissional, emitida pela Direc????o Provincial de Sa??de de Tete</li>
            <li>Carta de autoriza????o para pr??ctica de medicina privada, (ou protocolo da mesma)</li>
            <li>Copia do Cartao do INSS (se tiver)</li>
        </ul>

        <p class="clausula-tile">CL??USULA D??CIMA
            <br>
            (Regulamentos Internos)
        </p>
        <p class="text-p"><b>1</b> O Segundo Outorgante na sua ades??o ao regulamento Geral Interno e Regulamento de
            Carreiras Profissionais, ao acordo da Empresa ???Centro Medico Maxi Vida Soc. Unip, Lda??? e
            expressamente aceita as suas condi????es.
        </p>

        <p class="clausula-tile">CL??USULA D??CIMA-PRIMEIRA
            <br>
            (Deveres Gerais do Primeiro Outorgante)
        </p>
        <p class="text-p"><b>1</b> O Primeiro Outorgante obriga-se a tratar o Segundo Outorgante com corre????o e respeito, a
            atribuir-lhe as tarefas e benef??cios acordados, assim como se obriga a criar, dentro das suas
            possibilidades, condi????es que lhe possibilitem atingir o mais alto n??vel de efici??ncia.
        </p>

        <p class="clausula-tile">CL??USULA D??CIMA-SEGUNDA
            <br>
            (Conflitos Laborais e Casos Omissos)
        </p>
        <p class="text-p"><b>1</b> Os conflitos de trabalho que surjam em quest??es emergentes do presente contrato, por
            motivo de constitui????o, modifica????o ou extin????o da rela????o juridicial de trabalho, ser??o
            submetidos aos Tribunais competentes do Pa??s</p>

        <p class="text-p"><b>2</b> A todos os casos n??o expressamente regulados neste contrato, aplicar-se-?? o estabelecido na
            legisla????o em vigor na Republica de Mo??ambique e nos Regulamentos da Empresa referidos
            nas cl??usulas deste contrato.</p>

        <div class="row">
            <div class="column">
                <p class="clausula-tile">O Primeiro Outorgante </p>
                <p class="clausula-tile">CENTRO M??DICO MAXI VIDA SOCIEDADE UNIPESSOAL, LIMITADA</p>
                <br>
                <hr>
            </div>
            <div class="column" style="margin-left: 1%">
                <p class="clausula-tile">O Segundo Outorgante</p>
                <p class="clausula-tile">{{ $contrato->name }}</p>
                <br>
                <br>
                <hr style="margin-top: 10px">
            </div>
        </div>

        <p class="clausula-tile">Data e Local da celebra????o do contrato</p>
        <p class="clausula-tile">{{ $data }}</p>
        <br>
        <p style="font-size: 11pt; font-weight: bold"><span>&#8226;</span> Documentos aplic??veis somente se o segundo outorgante for pessoal t??cnico de sa??de.</p>
    </div>

</div>

<script type="text/php">
    if (isset($pdf))
    {
        $x = 500;
        $y = 820;
        $text = "P??gina {PAGE_NUM} de {PAGE_COUNT}";
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
