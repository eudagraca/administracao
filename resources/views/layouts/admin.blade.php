<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery.timepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">

        <link href="{{ asset('css/forms.css') }}" rel="stylesheet">

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="/vendor/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/vendor/adminlte/dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->

        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <script type="module" src="https://unpkg.com/@ionic/core@latest/dist/ionic/ionic.esm.js"> </script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.css')}}">


    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a class="nav-link">@yield('link')</a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Messages Dropdown Menu -->

                    <!-- Notifications Dropdown Menu -->

                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell" style="margin-right: 80px"></i>

                            <span style="margin-top: -10px" class="uk-badge navbar-badge uk-text-bold">Notificações</span>

                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">Notificações</span>
                            <div class="dropdown-divider"></div>

                            @if(count($substituto) > 0)
                            <a href="{{ route('feria.subistacao') }}" class="dropdown-item">
                                <i class="fas fa-ban"></i>
                                <b>{{ count($substituto) }}</b> Solicitações de substituicao
                            </a>
                            @endif

                            @if(count($advertenciasOpened) > 0)
                            <a href="{{ route('advertencia.index') }}" class="dropdown-item">
                                <i class="fas fa-ban"></i>
                                <b>{{ count($advertenciasOpened) }}</b> Advertencia (s) para sí
                            </a>
                            @endif

                            @auth
                            @if(Auth::user()->sector != NULL)
                            @if(count($prolParecerChefe) > 0)
                            <a href="{{ route('prolongamento.index') }}" class="dropdown-item">
                                <i class="fas fa-angle-right"></i>
                                <b>{{ count($prolParecerChefe) }}</b> P. - Prol. Turno - Chefe Sector
                            </a>
                            @endif
                            @if(count($escalaParecerChefe) > 0)
                            <a href="{{ route('escala.index') }}" class="dropdown-item">
                                <i class="fas fa-angle-right"></i>
                                <b>{{ count($escalaParecerChefe) }}</b> P. - Alteração. Escala - Chefe Sector
                            </a>
                            @endif
                            @if(count($justificacaoParecerChefe) > 0)
                            <a href="{{ route('justificacao.index') }}" class="dropdown-item">
                                <i class="fas fa-angle-right"></i>
                                <b>{{ count($justificacaoParecerChefe) }}</b> Justificações de falta - Chefe Sector
                            </a>
                            @endif
                            @endif
                            @endauth

                            @if(Auth::check() && Auth::user()->hasRole('gestor-recursos-humanos'))

                            @if(count($pedidosRescisaoC) > 0)
                            <a href="{{ route('pedidoRescisao.index') }}" class="dropdown-item">
                                <i class="fas fa-bars"></i>
                                <b>{{ count($pedidosRescisaoC) }}</b> Pedidos de rescisão por ver
                            </a>
                            @endif
                            @if(count($pRemuneracaoC) > 0)
                            <a href="{{ route('remuneracao.index') }}" class="dropdown-item">
                                <i class="fas fa-bars"></i>
                                <b>{{ count($pRemuneracaoC) }}</b> P. de aumento de remuneração
                            </a>
                            @endif

                            @if(count($prolParecerRH) > 0)
                            <a href="{{ route('prolongamento.index') }}" class="dropdown-item">
                                <i class="fas fa-bars"></i>
                                <b>{{ count($prolParecerRH) }}</b> P. - Prol. Turno - RH
                            </a>
                            @endif

                            @if(count($escalaParecerRH) > 0)
                            <a href="{{ route('prolongamento.index') }}" class="dropdown-item">
                                <i class="fas fa-bars"></i>
                                <b>{{ count($escalaParecerRH) }}</b> P. - Alteração escala - RH
                            </a>
                            @endif

                            @if(count($justificacaoParecerRH) > 0)
                            <a href="{{ route('justificacao.index') }}" class="dropdown-item">
                                <i class="fas fa-ban"></i>
                                <b>{{ count($justificacaoPareceRH) }}</b> Justificações de falta - RH
                            </a>
                            @endif
                            @endif

                            @if(Auth::check() && Auth::user()->hasRole('gestor-manutencao'))
                            <a href="{{ route('avaria.index') }}" class="dropdown-item">
                                <i class="fas fa-screwdriver"></i>
                                {{ count($naoLidas) }} Avarias Por ler
                            </a>
                            <div class="dropdown-divider"></div>

                            <a href="{{ route('avaria.index') }}" class="dropdown-item">
                                <i class="fas fa-screwdriver"></i>
                                {{ count($anotacoesC) }} Avarias registadas fora de hora
                            </a>
                            @endif
                            <div class="dropdown-divider"></div>
                            @if(Auth::check() && Auth::user()->hasRole('gestor-administracao'))
                            <div class="dropdown-divider"></div>

                            <a href="{{ route('requisicaoTransporte.index') }}" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i>{{ count($solicitacoes)  }} Solicitações
                                <span class="float-right text-muted text-sm">Transporte</span>
                            </a>
                            @endif

                    </li>
                    <li class="nav-item">
                        <a type="submit" class="nav-link" href="{{ route('logout') }}"><i
                                class="fas fa-power-off"></i></a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ Auth::user()->hasRole('super-admin') ? route('admin.dashboard'): route('normal.dashboard') }}"
                    class="brand-link">
                   <img  src="{{ asset('storage/logos/logo-small.jpg') }}"
                    alt="{{ config('app.name', 'Laravel') }}"
                    {{-- class="brand-image elevation-3" style="opacity: .8">--}}
                    <span class="brand-text font-weight-normal">SGA</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="info">
                            <a href="{{route('user.details', Auth::user())}}"
                                class="d-block uk-text-bold">{{ Auth::user()->name }}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">

                            @if(Auth::user()->hasRole('super-admin'))
                            <li class="nav-item has-treeview menu-open">
                                <a href="#" class="nav-link active">
                                    <i class="fi-xnsuxl-user-solid"></i>
                                    <p>
                                        Super usuário
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.dashboard') }}" class="nav-link">

                                            <i class="fa fa-database"></i>
                                            <p>
                                                Area administrativa
                                                <span class="right badge badge-danger"></span>
                                            </p>

                                        </a>
                                        <a href="{{ route('user.all') }}" class="nav-link">
                                            <i class="fa fa-user-edit"></i>
                                            <p>
                                                Usuários
                                                <span class="right badge badge-danger"></span>
                                            </p>

                                        </a>
                                        <a href="{{ route('sector.index') }}" class="nav-link">
                                            <i class="fa fa-folder"></i>
                                            <p>
                                                Sectores
                                                <span class="right badge badge-danger"></span>
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endif

                            {{-- Gestor admin  --}}
                            @if(Auth::user()->hasRole('gestor-administracao'))
                            <li class="nav-item has-treeview menu-open">
                                <a href="#" id="drop-list" class="nav-link active">
                                    <i class="fi-xnsuxl-user-solid"></i>
                                    <p>
                                        Administração
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('transportes.index') }}" class="nav-link">
                                            <i class="fas fa-bus-alt"></i>
                                            <p>
                                                Transportes
                                                <span class="right badge badge-danger"></span>
                                            </p>

                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('motorista.index') }}" class="nav-link">
                                            <i class="fas fa-universal-access"></i>
                                            <p>
                                                Motorista
                                                <span class="right badge badge-danger"></span>
                                            </p>

                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endif

                            @auth
                            <li class="nav-item">
                                <a href="{{ route('normal.dashboard') }}" class="nav-link">
                                    <i class="fas fa-chart-pie"></i>
                                    <p>
                                        Painel Geral
                                        <span class="right badge badge-danger">MVIDA</span>
                                    </p>

                                </a>
                            </li>
                            @endauth

                            {{-- Manutencao--}}
                            @if(Auth::check() && Auth::user()->hasRole('gestor-manutencao'))
                            <li class="nav-item has-treeview menu-open">
                                <a id="drop-list" href="#" class="nav-link active">
                                    <i class="fi-xnsuxl-user-solid"></i>
                                    <p>
                                        Manutenção
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('avaria.index') }}" class="nav-link">
                                            <i class="fas fa-screwdriver"></i>
                                            <p>
                                                Avarias
                                                <span class="right badge badge-danger"></span>
                                            </p>

                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('requisicaoTransporte.create')}}" class="nav-link">
                                            <i class="fas fa-hand-spock"></i>
                                            <p>
                                                Requisitar transporte
                                                <span class="right badge badge-danger"></span>
                                            </p>

                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('tecnico.create')}}" class="nav-link">
                                            <i class="fas fa-user-astronaut"></i>
                                            <p>
                                                Registar Técnico
                                                <span class="right badge badge-danger"></span>
                                            </p>

                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endif

                            @if(Auth::check() and Auth::user()->hasRole('gestor-recursos-humanos'))
                            <li class="nav-item has-treeview menu-open">
                                <a id="drop-list rh" href="#" class="nav-link active">
                                    <i class="fi-xnsuxl-user-solid"></i>
                                    <p>
                                        Recursos Humanos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('advertencia.index') }}" class="nav-link">
                                            <i class="fas fa-info-circle"></i>
                                            <p>
                                                Advertência
                                                <span class="right badge badge-danger"></span>
                                            </p>

                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('carta.index') }}" class="nav-link">
                                            <i class="fas fa-clipboard"></i>
                                            <p>
                                                Cartas
                                                <span class="right badge badge-danger"></span>
                                            </p>

                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('contrato.index')}}" class="nav-link">
                                            <i class="fas fa-file-word"></i>
                                            <p>
                                                Contratos
                                                <span class="right badge badge-danger"></span>
                                            </p>

                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endif


                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="uk-width-1-2">
                                <h4 class="m-0 text-dark uk-text-bold">@yield('title-page')</h4>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb uk-flex-right">
                                    <li class="breadcrumb-item"><a class="uk-button uk-button-text" href="/">Início</a>
                                    </li>
                                    <li class="breadcrumb-item active">@yield('links')</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container-fluid">
                        {{-- {{ Auth::user()->roles }} --}}
                        @yield('content-main')
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                <div class="p-3">
                    <h5>Title</h5>
                    <p>Sidebar content</p>
                </div>
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="float-right d-none d-sm-inline">
                    <p>Coded by<span>
                        </span><a class="uk-button-text uk-button" href="http://tiexperts.co.mz/">TI EXPERSTS</a></p>
                </div>
                <!-- Default to the left -->
                <p>Copyright &copy; {{ date('Y') }} SGA todos direitos reservados</p>
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{ asset('js/forms.js') }}" defer></script>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>

        <!-- Bootstrap 4 -->
        <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/application.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
        <script src="{{ asset('js/select2.min.js') }}" defer></script>
        <script src="{{ asset('js/jquery.inputmask.js') }}" defer></script>
        <!-- AdminLTE App -->
        <script src="/vendor/adminlte/dist/js/adminlte.min.js"></script>

        <script src="{{ asset('js/ajax-requests.js') }}" defer></script>

        <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
        <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>

    </body>

</html>
