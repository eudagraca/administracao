@extends('layouts.admin')

@section('title-page')
    Lista de avarias
@endsection
@section('links')
    Lista de avarias
@endsection
@section('link')
    Lista de avarias
@endsection
@section('content-main')

    @if($message = Session('print'))
        <input name="print" id="print" value="{{ $message }}" hidden>

        <script type="text/javascript">
            window.open('avaria/geraPDF/'+document.getElementById("print").value);
        </script>
    @endif

    @if($message = Session('printA4'))
        <input  name="printA4" id="printA4" value="{{ $message }}" hidden>
        <script type="text/javascript">
            window.open('avaria/'+document.getElementById("printA4").value+'/pdf/');
        </script>
    @endif
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">
            <a href="{{ route('avaria.create') }}"
               class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                    class="fas fa-plus-circle"></i> Registar avaria</a>
            @if(Auth::check() and (Auth::user()->hasRole('gestor-manutencao')|| Auth::user()->hasRole('super-admin')))
                <a href="{{ route('avaria.todas') }}"
                   class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                        class="fas fa-th-list"></i> Todas avarias</a>
            @endif
        </div>
        @if(Auth::check() && !Auth::user()->hasRole('gestor-manutencao') && !$avarias)

            <p class="uk-margin-medium-left">
                Simbolos
                <br>
                &ensp;<i class="fas fa-clipboard"></i> Resposta da avaria</p>

        @endif

        <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$avarias->isEmpty())

                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="row uk-margin-medium-left uk-margin-top">
                            <span class="uk-margin-left uk-text-danger text-bold"><i class="fas fa-minus text-danger"></i> Prioridade Alta</span>
                            <span class="uk-margin-left uk-text-warning text-bold"><i class="fas fa-minus text-warning"></i> Prioridade Média</span>

                    </div>

                    <div class="uk-overflow-auto">
                        <table id="avarias-tb"
                               class="uk-table uk-border-rounded table-hover table uk-table-responsive uk-table-divider">
                            <thead>
                            <tr>
                                <th id="table-header" class="uk-text-small uk-table-shrink">Código</th>
                                <th id="table-header" class="uk-text-small uk-table-shrink">Est. avaria</th>
                                <th id="table-header" class="uk-text-small uk-table-shrink">Data de solicitação</th>
                                <th id="table-header" class="uk-text-small uk-table-shrink">Sector</th>
                                <th id="table-header" class="uk-text-small uk-table-shrink">Est. solicitação</th>
                                <th id="table-header" class="uk-text-small uk-table-shrink">Prioridade</th>
                                <th id="table-header" class="uk-text-small uk-table-shrink">Resposta</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($avarias as $avaria)
                                <tr class="uk-background-muted {{ $avaria->prioridade == 'média'? 'table-warning': ($avaria->prioridade == 'alta'? ('table-danger'):'table-light') }} uk-background-blend-multiply">
                                    <td class="uk-text-bold uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('avaria.show', $avaria)}}">
                                            {{ $avaria->id }}
                                        </a>
                                    </td>
                                    <td class="uk-text-truncate uk-table-link uk-text-bold">
                                        <a class="uk-link-reset"
                                           href="{{route('avaria.show', $avaria)}}"> {{ ucfirst($avaria->estado) }} </a>
                                    </td>
                                    <td class="uk-text-nowrap uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('avaria.show', $avaria)}}">
                                            {{ date( 'd / m / Y' , strtotime($avaria->created_at)) }}
                                            às {{ date( 'H:i' , strtotime($avaria->created_at)) }}
                                        </a>
                                    </td>
                                    <td class="uk-text-nowrap uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('avaria.show', $avaria)}}">
                                            {{ $avaria->sector->name }}
                                        </a>
                                    </td>
                                    <td class="uk-text-nowrap uk-text-bold uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('avaria.show', $avaria)}}">
                                            {{ ucfirst($avaria->foi_lida) }}
                                        </a>
                                    </td>
                                    <td class="uk-text-nowrap  uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{route('avaria.show', $avaria)}}">
                                            {{ ucfirst($avaria->prioridade) }}
                                        </a>
                                    </td>
                                    <td class="uk-text-nowrap uk-text-small uk-text-bold uk-table-link">
                                        <a class="uk-link-reset"
                                           href="{{ $avaria->user->id == Auth::id()? route('avaria.resposta-detalhes', $avaria): route('avaria.show', $avaria) }}">
                                            {{ $avaria->resposta == NULL? 'Sem resposta': 'Com Resposta'  }}
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                @include('layouts.empty')
            @endif
        </div>
    </div>
@endsection
