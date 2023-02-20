@extends('layouts.admin')

@section('title-page')
    Lista de requisições
@endsection
@section('links')
    Requisições
@endsection
@section('link')
    Lista de requisições
@endsection
@section('content-main')
    <div class="conntainer">
        @include('layouts.flash')
        <div class="uk-align-right uk-margin-large-right uk-margin-remove-bottom">
            <a href="{{ route('preRequest.create') }}"
               class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i class="fas fa-hand-paper"></i> Requisitar transporte</a>
            @if((Auth::check() and (Auth::user()->hasRole('gestor-administracao') || Auth::user()->hasRole('super-admin'))))
                <a href="{{route('requisicaoTransporte.all')}}"
                   class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                        class="fas fa-route"></i>  Todas requisições</a>

                <a href="{{route('transportes.create')}}"
                   class="uk-margin-large-left uk-button uk-text-normal uk-button-text uk-text-bold"><i
                        class="fas fa-bus"></i>  Registar trasporte</a>
            @endif
        </div>

        @if($message = Session('open'))
            <input name="open"  value="{{$message}}" id="open" hidden>
            <script type="text/javascript">
                window.open('/admin/pre_requisicao/PDF/'+document.getElementById("open").value);
            </script>
        @endif
        <div class="uk-section uk-padding-small uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
            @if(!$requisicoes->isEmpty())
                <div class="uk-card uk-card-default uk-width-1-1@s">
                    <div class="uk-overflow-auto">
                        <table id="avarias-tb" class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                            <thead>
                            <tr>
                                <th id="table-header" class="uk-table-shrink uk-text-nowrap">n°</th>
                                <th id="table-header" class="uk-table-shrink uk-text-nowrap">Data solicitação</th>
                                <th id="table-header">Requisitante</th>
                                <th id="table-header" class="uk-width-small">Origem</th>
                                <th id="table-header" class="uk-width-small">Destino</th>
                                <th id="table-header" class="uk-width-small">est. da solicitação</th>
                                <th id="table-header" class="uk-table-shrink uk-text-nowrap uk-text-center">est. requição</th>
                                <th id="table-header" class="uk-table-shrink">Prioridade</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($requisicoes as $requisicao)
                                <tr class="uk-background-muted">
                                    <td class="uk-text-bold uk-text-small uk-text-nowrap">{{ $requisicao->id }}</td>
                                    <td class="uk-text-bold uk-text-small uk-text-nowrap">{{ date('d/m/Y', strtotime($requisicao->created_at)) }}</td>
                                    <td class="uk-text-truncate uk-table-link uk-text-normal">
                                        <a class="uk-link-reset"
                                           href="{{route('pre.read', $requisicao)}}">
                                            {{ ucfirst($requisicao->user->name) }}
                                        </a>
                                    </td>
                                    <td class="uk-text-truncate uk-text-normal  uk-table-link">
                                        <a class="uk-link-reset" href="{{route('pre.read', $requisicao)}}">
                                            {{ $requisicao->origem }}
                                        </a>
                                    </td>
                                    <td class="uk-text-truncate uk-text-normal  uk-table-link">
                                        <a class="uk-link-reset" href="{{route('pre.read', $requisicao)}}">
                                            {{ $requisicao->local->name }}
                                        </a>
                                    </td>
                                    <td class="uk-text-truncate uk-text-normal uk-text-bold  uk-table-link">
                                        <a class="uk-link-reset" href="{{route('pre.read', $requisicao)}}">
                                            {{ ucfirst($requisicao->estado) }}
                                        </a>
                                    </td>
                                    <td class="uk-text-truncate uk-text-normal uk-text-bold  uk-table-link">
                                        <a class="uk-link-reset" href="{{route('pre.read', $requisicao)}}">
                                            {{ ucfirst($requisicao->foi_aceite) }}
                                        </a>
                                    </td>
                                    <td class="uk-table-link uk-text-normal uk-text-nowrap">
                                        <a class="uk-link-reset" href="{{route('pre.read', $requisicao)}}">{{ $requisicao->prioridade }}</a>
                                    </td>

                                </tr>@endforeach </tbody>
                        </table>
                    </div>
                </div>
            @else
                @include('layouts.empty')
            @endif
        </div>
    </div>
@endsection
