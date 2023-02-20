@extends('layouts.admin')
@section('link')
Painel Geral
@endsection
@section('content-main')
<div class="row">
    <div class="col-lg-3 col-6 uk-box-shadow-hover">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                @if(Auth::check() and (Auth::user()->hasRole('gestor-manutencao') || Auth::user()->hasRole('super-admin')))
                <h3>{{ count($totalAvarias) }}</h3>
                @else
                <h3>{{ count(Auth::user()->avarias) }}</h3>
                @endif
                <p class="uk-text-bold">Avarias</p>
            </div>
            <div class="icon">
                <i class="fas fa-screwdriver"></i>
            </div>
            <a href="{{ route('avaria.index') }}" class="small-box-footer">
                Mais detalhes <i class="fas fa-long-arrow-alt-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>_<sup style="font-size: 20px"></sup></h3>

                <p class="uk-text-bold">Cartas</p>
            </div>
            <div class="icon">
                <i class="fas fa-paste"></i>
            </div>
            <a href="{{  route('carta.index') }}"
                class="small-box-footer">Mais detalhes <i class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    @if(Auth::check() and (Auth::user()->hasRole('gestor-recursos-humanos') || Auth::user()->hasRole('super-admin')))
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-teal">
            <div class="inner">
                <h3>{{count($contratosC)}}</h3>

                <p class="uk-text-bold">Contratos</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-word"></i>
            </div>
            <a href="{{ route('contrato.index') }}" class="small-box-footer">Mais detalhes <i
                    class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>
<!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{count($pedidosRescisao)}}</h3>

                <p class="uk-text-bold">Pedidos de rescisão</p>
            </div>
            <div class="icon">
                <i class="fas fa-ban"></i>
            </div>
            <a href="{{ route('pedidoRescisao.index') }}" class="small-box-footer">Mais detalhes <i
                    class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{count($pRemuneracao)}}</h3>
                <p class="uk-text-bold">Pedidos de avaliação de desempenho</p>
            </div>
            <div class="icon">
                <i class="fas fa-cash-register"></i>
            </div>
            <a href="{{ route('remuneracao.index') }}" class="small-box-footer">Mais detalhes <i
                    class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-lime">
            <div class="inner">
                <h3>{{count($justificacoesF)}}</h3>

                <p class="uk-text-bold">Justificações de falta</p>
            </div>
            <div class="icon">
                <i class="fas fa-folder"></i>
            </div>
            <a href="{{ route('justificacao.index') }}" class="small-box-footer">Mais detalhes <i
                    class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-gradient-fuchsia">
            <div class="inner">
                <h3>{{count($prolongamentoT)}}</h3>

                <p class="uk-text-bold">Prolongamentos de turno</p>
            </div>
            <div class="icon">
                <i class="fas fa-stopwatch"></i>
            </div>
            <a href="{{ route('prolongamento.index') }}" class="small-box-footer">Mais detalhes <i
                    class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-indigo">
            <div class="inner">
                <h3>{{count($alteracoesEscala)}}</h3>

                <p class="uk-text-bold">Alterações de escala</p>
            </div>
            <div class="icon">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <a href="{{ route('escala.index') }}" class="small-box-footer">Mais detalhes <i
                    class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>
    @endif

    <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-yellow">
                <div class="inner">
                    @if(Auth::user()->hasRole('gestor-recursos-humanos'))
                    <h3>{{count($advertenciasC)}}</h3>
                    @else
                    <h3>{{count($advertenciasUser)}}</h3>
                    @endif
                    <p class="uk-text-bold">Advertência</p>
                </div>
                <div class="icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <a href="{{ route('advertencia.index') }}" class="small-box-footer">Mais detalhes <i
                        class="fas fa-long-arrow-alt-right"></i></a>
            </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-gradient-blue">
            <div class="inner">
                @if(Auth::user()->hasRole('gestor-recursos-humanos'))
                <h3>{{count($feriasAlert)}}</h3>
                @else
                <h3>{{count($feriasN)}}</h3>
                @endif

                <p class="uk-text-bold">Pedidos de férias</p>
            </div>
            <div class="icon">
                <i class="fas fa-smile-wink"></i>
            </div>
            <a href="{{ route('feria.index') }}" class="small-box-footer">Mais detalhes <i
                    class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    @if(Auth::check() and (Auth::user()->hasRole('gestor-manutencao') || Auth::user()->hasRole('super-admin')))
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-teal">
            <div class="inner">
                <h3>{{count($tecnicosC)}}</h3>

                <p class="uk-text-bold">Técnicos</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-astronaut"></i>
            </div>
            <a href="{{ route('tecnico.index') }}" class="small-box-footer">Mais detalhes <i
                    class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>
<div class="col-lg-3 col-6 text-white">
        <!-- small box -->
        <div class="small-box bg-fuchsia">
            <div class="inner">
                <h3>{{ count($fornecedoresC) }}</h3>
                <p class="uk-text-bold">Fornecedores</p>
            </div>
            <div class="icon">
                <i class="fas fa-truck-loading"></i>
            </div>
            <a href="{{ route('fornecedor.index') }}" class="small-box-footer">Mais detalhes <i
                    class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>
    @endif
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                @if(Auth::check() and Auth::user()->hasRole('gestor-administracao'))
                <h3>{{ count($solicitacoesDeTransporte) }}</h3>
                @else
                <h3>{{ count(Auth::user()->requisicoes) }}</h3>
                @endif

                <p class="uk-text-bold">Transportes</p>
            </div>
            <div class="icon">
                <i class="fas fa-bus-alt"></i>
            </div>
            <a href="{{ route('requisicaoTransporte.index') }}" class="small-box-footer">Mais detalhes <i
                    class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>

    @if(Auth::check() and (Auth::user()->hasRole('gestor-administracao') || Auth::user()->hasRole('super-admin')))

    <div class="col-lg-3 col-6 text-white">
        <!-- small box -->
        <div class="small-box bg-cyan">
            <div class="inner">
                <h3>{{ count($locaisC) }}</h3>
                <p class="uk-text-bold">Locais</p>
            </div>
            <div class="icon">
                <i class="fas fa-map-marked"></i>
            </div>
            <a href="{{ route('local.index') }}" class="small-box-footer">Mais detalhes <i
                    class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6 text-white">
        <!-- small box -->
        <div class="small-box bg-fuchsia">
            <div class="inner">
                <h3>{{ count($motoristasC) }}</h3>
                <p class="uk-text-bold">Motoristas</p>
            </div>
            <div class="icon">
                <i class="fas fa-universal-access"></i>
            </div>
            <a href="{{ route('motorista.index') }}" class="small-box-footer">Mais detalhes <i
                    class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6 text-white">
        <!-- small box -->
        <div class="small-box bg-lime">
            <div class="inner">
                <h3>{{ count($solicitacoes) }}</h3>
                <p class="uk-text-bold">Pedidos de transporte</p>
            </div>
            <div class="icon">
                <i class="fab fa-algolia"></i>
            </div>
            <a href="{{ route('preRequest.index') }}" class="small-box-footer">Mais detalhes <i
                    class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>
    @endif
</div>

@endsection
