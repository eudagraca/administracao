<?php

namespace App\Providers;

use App\Advertencia;
use App\AlertaFeria;
use App\AnotacoesAvaria;
use App\AumentoRemuneracao;
use App\Avaria;
use App\Contrato;
use App\Escala;
use App\Feria;
use App\Fornecedor;
use App\JustificaoFalta;
use App\Local;
use App\Motorista;
use App\PedidoRescisao;
use App\PreRequisicao;
use App\Prolongamento;
use App\RequisicaoTransporte;
use App\Sector;
use App\Tarefas;
use App\Tecnico;
use App\TipoCarta;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Carbon::setLocale('pt_BR');

        view()->composer('*', function ($view) {

            //Task motorista
            if (Auth::check() and Auth::user()->hasRole('motorista')) {
                $tarefas = Tarefas::whereHas('requisicaoTransporte', function (Builder $query) {
                    $query->whereHas('preRequisicao', function (Builder $builder) {
                    })->where('motorista_id', Auth::user()->motorista->id);
                })->get();
            } else {
                $tarefas = Tarefas::all();
            }
            //Task substituição
            $substituto = AlertaFeria::whereHas('feria', function (Builder $query) {
                $query->where('substituto_id', Auth::id())
                ->where('estado', '=', 'aceite')->where('confirmed','=', 'Pendente')->whereDate('data_termino', '>=', Carbon::now());
            })->get();

            $naoLidas = Avaria::where('foi_lida', 'não lida')->get();
            $totalAvarias = Avaria::all();
            $justificacoesF = JustificaoFalta::all();
            $solicitacoesDeTransporte = RequisicaoTransporte::all();
            $tiposC = TipoCarta::all();
            $pedidosRescisaoC = PedidoRescisao::where('estado', 'nao lida')->get();
            $pedidosRescisao = PedidoRescisao::all();
            $advertenciasC = Advertencia::all();
            $advertenciasOpened = Advertencia::where('user_id', '=', Auth::id())->where('is_open', '=', 0)->get();
            $advertenciasUser = Advertencia::where('user_id', '=', Auth::id())->get();
            $tecnicosC = Tecnico::where('is_active', 1)->get();
            $locaisC = Local::where('is_active', 1)->get();
            $fornecedoresC = Fornecedor::where('is_active', 1)->get();
            $feriasAlert = Feria::all();
            $alteracoesEscala = Escala::all();
            $prolongamentoT = Escala::all();
            $pRemuneracao = AumentoRemuneracao::all();
            $pRemuneracaoC = AumentoRemuneracao::where('estado', 'Enviada')->get();
            $feriasC = Feria::where('estado', 'nao lida')->get();
            if (Auth::check() and (Auth::user()->sector)) {
                $prolParecerChefe = Prolongamento::where('parecer_chefe', '=', null)->where('sector_id', Auth::user()->sector->id)->get();
                $escalaParecerChefe = Escala::where('parecer_chefe', '=', null)->where('sector_id', Auth::user()->sector->id)->get();
                $justificacaoParecerChefe = JustificaoFalta::where('parecer_chefe', '=', null)->where('sector_id', Auth::user()->sector->id)->get();
            }else{
                $prolParecerChefe = Prolongamento::where('parecer_chefe', '=', null)->where('sector_id', 0)->get();
                $escalaParecerChefe = Escala::where('parecer_chefe', '=', null)->where('sector_id', 0)->get();
                $justificacaoParecerChefe = JustificaoFalta::where('parecer_chefe', '=', null)->where('sector_id', 0)->get();
            }

            $feriasN = Feria::where('user_id', '=', Auth::id())->orWhere('substituto_id', '=', Auth::id())->get();

            $prolParecerRH = Prolongamento::where('parecer_rh','=', NULL)->get();
            $escalaParecerRH = Escala::where('parecer_rh','=', NULL)->get();
            $justificacaoParecerRH = JustificaoFalta::where('parecer_rh','=', NULL)->get();
            $solicitacoes = PreRequisicao::where('estado', 'nao lida')->get();
            $motoristasC = Motorista::where('is_active', 1)->get();
            $view->with(['solicitacoesDeTransporte' => $solicitacoesDeTransporte,
                'tiposC' => $tiposC, 'users' => User::all(), 'tecnicosC' => $tecnicosC,
                'motoristasC' => $motoristasC,
                'prolParecerChefe' => $prolParecerChefe,
                'escalaParecerChefe' => $escalaParecerChefe,
                'justificacaoParecerChefe' => $justificacaoParecerChefe,
                'justificacaoParecerRH' => $justificacaoParecerRH,
                'prolParecerRH' => $prolParecerRH,
                'escalaParecerRH' => $escalaParecerRH,
                'sectoresC' => Sector::all(),
                'fornecedoresC' => $fornecedoresC,
                'locaisC' => $locaisC,
                'pedidosRescisaoC' => $pedidosRescisaoC,
                'pedidosRescisao' => $pedidosRescisao,
                'advertenciasC' => $advertenciasC,
                'advertenciasUser' => $advertenciasUser,
                'advertenciasOpened' => $advertenciasOpened,
                'feriasAlert' => $feriasAlert,
                'feriasC' => $feriasC,
                'substituto' => $substituto,
                'pRemuneracao' => $pRemuneracao,
                'pRemuneracaoC' => $pRemuneracaoC,
                'contratosC' => Contrato::all(),
                'tarefas' => $tarefas,
                'feriasN' => $feriasN,
                'prolongamentoT' => $prolongamentoT,
                'alteracoesEscala' => $alteracoesEscala,
                'justificacoesF' => $justificacoesF,
                'anotacoesC' => AnotacoesAvaria::where('foi_lida', 'não lida')->get(),
                'naoLidas' => $naoLidas, 'solicitacoes' => $solicitacoes, 'totalAvarias' => $totalAvarias]);
        });

    }
}
