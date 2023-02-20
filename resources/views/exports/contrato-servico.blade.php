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
            <p>Contrato de Prestação de Serviço</p>
        </div>
    </header>

    <div class="content">
        <h4 style="text-align: center">Contrato Individual de Trabalho</h4>
        <p style="text-align: center">{{ $contrato->id }}</p>
        <p>Entre:</p>
        <p class="text-p" id="text-maxvida"><strong>CENTRO MÉDICO MAXI VIDA SOCIEDADE UNIPESSOAL, LIMITADA</strong> com sede na cidade de Tete,
            Avenida Martires, matriculada na Conservatória de Registo das Entidades Legais sob o nº 100540681,
            Licença no: 01/2015 ,neste acto representado por:
            Márcio Raúl Dias Quintano, solteiro maior, natural de Maputo, de nacionalidade Moçambicana,
            portador de BI Nº110100334047A, emitido em Maputo aos 05/02/2016, na qualidade de
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
                <th >Estado civíl</th>
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

            <tr >
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
        <p class="text-p">É celebrado o presente contrato de trabalho por <b>tempo indeterminado</b> , que se regerá
            pelas seguintes cláusulas abaixo declaradas: </p>

        <p class="clausula-tile">CLÁUSULA PRIMEIRA
            <br>
            (Admissão, Duração e Local de Emprego)
        </p>

        <p class="text-p"><strong>1.</strong> O presente contrato entrará em vigor apartir de: <b>{{ $dataVigor }}</b></p>

        <p class="clausula-tile">CLÁUSULA SEGUNDA
            <br>
            (Categoria e Obrigações)
        </p>

        <p class="text-p">1 O Segundo Outorgante exercerá a sua actividade profissional na categoria de
            <b>Agente de serviços</b></p>

        <p class="text-p"><b>2</b> As obrigações do Segundo Outorgante serão explicadas com todos os dados necessários, e
            assinadas por ambas as partes</p>

        <p class="text-p"><b>3</b> Dependendo das necessidades da Empresa, o Primeiro Outorgante poderá requerer ao
            Segundo Outorgante para apoiar em outra área de actividade da Empresa. Devendo esta ser
            acordada por ambas as partes de uma forma razoável e sem nenhumas alterações ou prejuizo
            no pacote e benefícios.</p>
        <p class="text-p"><b>4</b>O Segundo Outorgante poderá ser requerido a trabalhar em regime temporário numa outra
            subsidiária da Empresa, onde o Primeiro Outorgante irá providenciar a acomodação
            apropriada e o pagamento das despesas da viagem.</p>

        <p class="clausula-tile">CLÁUSULA TERCEIRA<br>(Período Probatório e Duração)
        </p>
        <p class="text-p"><b>1</b> Este Contrato está sujeito ao período probatório de 90 dias, durante o qual, qualquer das
            partes poderá rescindir o Contrato sem quaisquer formalidades, bastando apenas comunicar,
            com antecedência mímina de 7 dias, por escrito, os motivos da rescisão. </p>

        <p class="text-p"><b>2</b> O período probatório poderá ser terminado através de uma notificação por escrito, realizada
            no mínimo 24 (Vinte e quatro) horas antes da data limite para o probatório terminar.</p>

        <p class="clausula-tile">
            CLÁUSULA QUARTA
            <br>(Remuneração e Regalias Complementares)
        </p>

        <p class="text-p"><b>1</b> O Segundo Outorgante será intitulado a remuneração bruta mensal de: <b> {{ $contrato->salario_bruto }} {{ $extenso }}</b></p>
        <p class="text-p"><b>2</b> O Segundo Outorgante e os seus dependentes do primeiro grau, incluindo esposo, serão
            intitulados a assistência médica e medicamentosa gratuíta nas instalações do Primeiro
            Outorgante</p>

        <p class="clausula-tile">
            CLAÚSULA QUINTA
            <br>
            (Horário de Trabalho)
        </p>

        <p class="text-p"><b>1</b> O Segundo Outorgante estará sujeito a um período máximo de 48 horas por semana</p>
        <p class="text-p"><b>2</b> A tabela horária de trabalho utilizada será a que estiver em vigor na empresa, conforme a
            aprovação das autoridades competentes.</p>

        <p class="clausula-tile">
            CLÁUSULA SEXTA
            <br>
            (Obrigações de Confidencialidade e Exclusividade)
        </p>

        <p class="text-p"><b>1</b> O Segundo Outorgante não deverá revelar qualquer informação escrita ou verbal sem o
            consentimento prévio por escrito pelo primeiro Outorgante no que respeita as actividades,
            operações e outros detalhes do Primeiro Outorgante.</p>
        <p class="text-p"><b>2</b> Durante o presente contrato, o Segundo Outorgante não deverá se envolver em qualquer
            outra actividade, negócio, emprego que possam interferir nas funções da Empresa, salvo com
            autorização expressa do Primeiro Outorgante.</p>

        <p class="clausula-tile">
            CLÁUSULA SÉTIMA
            <br>
            (Férias Anuais)
        </p>

        <p class="text-p"><b>1</b> O Segundo Outorgante terá direito a férias, segundo a Lei do Trabalho da Republica de
            Moçambique.</p>
        <p class="text-p"><b>2</b> Durante o presente contrato, o Segundo Outorgante não deverá se envolver em qualquer
            outra actividade, negócio, emprego que possam interferir nas funções da Empresa, salvo com
            autorização expressa do Primeiro Outorgante.</p>


        <p class="clausula-tile">
            CLÁSULA OITAVA
            <br>
            (Cessação do Contrato)
        </p>

        <p class="text-p"><b>1</b> Após o período probatório, conforme os termos da Lei de Trabalho em vigor em Moçambique,
            o presente contrato poderá ser terminado por qualquer uma das partes, através de uma
            notificação por escrito realizada no minimo 30 dias (Trinta) antes ou até ao primeiro dia do
            calendário do mês.</p>
        <p class="text-p"><b>2</b> O Segundo Outorgante aceita que as remunerações em dívida sejam efectuadas na altura da
            cessação deste contrato, isto é, sobre os valores que o Segundo Outorgante tem em dívida
            com o Primeiro Outorgante.</p>

        <p class="clausula-tile">
            CLÁUSULA NONA
            <br>
            (Deveres Gerais do Segundo Outorgante)
        </p>

        <p class="text-p"><b>1</b> O Segundo Outorgante obriga-se a prestar serviços com maior zelo, competência e
            assiduidade, aproveitando plenamente as suas aptidões e preparação, sob autoridade e
            direção do Primeiro Outorgante e de acordo com as ordens que lhe forem dadas pelos
            superiores hierárquicos.</p>
        <p class="text-p"><b>2</b> O Segundo Outorgante obriga-se a cumprir correctamente as normas de trabalho e de bom
            comportamento, a manter em boas condições os bens relacionados com a sua actividade, a
            guardar sigilo profissional e os segredos de produção e de serviço de que tome conhecimento,
            e a não utilizar para fins pessoais ou alheios ao serviço, os locais, equipamento, veículos e
            outros bens ou serviços do local de trabalho.</p>


        <p class="text-p">O Segundo Outorgante obriga-se a apresentar os seguintes documentos, com um prazo de até
            uma semana após a assinatura do contrato:
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
        </ul>

        <p class="clausula-tile">CLÁUSULA DÉCIMA
            <br>
            (Regulamentos Internos)
        </p>
        <p class="text-p"><b>1</b> O Segundo Outorgante na sua adesão ao regulamento Geral Interno e Regulamento de
            Carreiras Profissionais, ao acordo da Empresa “Centro Medico Maxi Vida Soc. Unip, Lda” e
            expressamente aceita as suas condições.
        </p>

        <p class="clausula-tile">CLÁUSULA DÉCIMA-PRIMEIRA
            <br>
            (Deveres Gerais do Primeiro Outorgante)
        </p>
        <p class="text-p"><b>1</b> O Primeiro Outorgante obriga-se a tratar o Segundo Outorgante com correção e respeito, a
            atribuir-lhe as tarefas e benefícios acordados, assim como se obriga a criar, dentro das suas
            possibilidades, condições que lhe possibilitem atingir o mais alto nível de eficiência.
        </p>

        <p class="clausula-tile">CLÁUSULA DÉCIMA-SEGUNDA
            <br>
            (Conflitos Laborais e Casos Omissos)
        </p>
        <p class="text-p"><b>1</b> Os conflitos de trabalho que surjam em questões emergentes do presente contrato, por
            motivo de constituição, modificação ou extinção da relação juridicial de trabalho, serão
            submetidos aos Tribunais competentes do País</p>

        <p class="text-p"><b>2</b> A todos os casos não expressamente regulados neste contrato, aplicar-se-á o estabelecido na
            legislação em vigor na Republica de Moçambique e nos Regulamentos da Empresa referidos
            nas cláusulas deste contrato.</p>

        <div class="row">
            <div class="column">
                <p class="clausula-tile">O Primeiro Outorgante </p>
                <p class="clausula-tile">CENTRO MÉDICO MAXI VIDA SOCIEDADE UNIPESSOAL, LIMITADA</p>
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

        <p class="clausula-tile">Data e Local da celebração do contrato</p>
        <p class="clausula-tile">{{ $data }}</p>
        <br>
        <p style="font-size: 11pt; font-weight: bold"><span>&#8226;</span> Documentos aplicáveis somente se o segundo outorgante for pessoal técnico de saúde.</p>
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
