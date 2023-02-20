<?php


namespace App;

use PhpParser\Node\Expr\Cast\String_;

class MyUtils
{
    public $semana = array(
        'Sun' => 'Domingo',
        'Mon' => 'Segunda-Feira',
        'Tue' => 'Terca-Feira',
        'Wed' => 'Quarta-Feira',
        'Thu' => 'Quinta-Feira',
        'Fri' => 'Sexta-Feira',
        'Sat' => 'Sábado'
    );

    public $mes_extenso = array(
        'Jan' => 'Janeiro',
        'Feb' => 'Fevereiro',
        'Mar' => 'Marco',
        'Apr' => 'Abril',
        'May' => 'Maio',
        'Jun' => 'Junho',
        'Jul' => 'Julho',
        'Aug' => 'Agosto',
        'Nov' => 'Novembro',
        'Sep' => 'Setembro',
        'Oct' => 'Outubro',
        'Dec' => 'Dezembro'
    );

    public static $mes_em_extenso = array(
        'Jan' => 'Janeiro',
        'Feb' => 'Fevereiro',
        'Mar' => 'Marco',
        'Apr' => 'Abril',
        'May' => 'Maio',
        'Jun' => 'Junho',
        'Jul' => 'Julho',
        'Aug' => 'Agosto',
        'Nov' => 'Novembro',
        'Sep' => 'Setembro',
        'Oct' => 'Outubro',
        'Dec' => 'Dezembro'
    );

public static $algarismo_extenso = array(
    '1' => 'Primeira',
    '2' => 'Segunda',
    '3' => 'Terceira',
    '4' => 'Quarta',
    '5' => 'QUinta',
    '6' => 'Sexta',
    '7' => 'Sétima',
    '8' => 'Oitava',
    '9' => 'Nona',
    '10' => 'Décima',
    '11' => 'Décima primeira',
    '12' => 'Décima segunda',
    '13' => 'Décima terceira',
    '14' => 'Décima quarta',
    '15' => 'Décima quinta',
    '16' => 'Décima sexta',
    '17' => 'Décima sétima',
    '18' => 'Décima oitava',
    '19' => 'Décima nona',
    '20' => 'Vigésinma',

);


    public function dateTodayPT()
    {
        $data = date('D');
        $mes = date('M');
        $dia = date('d');
        $ano = date('Y');

        return $dia . " de " . $this->mes_extenso["$mes"] . " de {$ano}";
    }

    public function dataPT($ano, $mes, $dia)
    {
        return $dia . " de " . $this->mes_extenso["$mes"] . " de {$ano}";
    }

    public static function dataToPT($ano, $mes, $dia): String
    {
        return $dia . " de " . self::$mes_em_extenso["$mes"] . " de {$ano}";
    }

    public static function getNumberExt($number): String
    {
        return strtolower(self::$algarismo_extenso["$number"]);
    }
}
