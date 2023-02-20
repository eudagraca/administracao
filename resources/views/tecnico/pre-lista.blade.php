<div id="modal-sections"  class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title">Técnicos</h2>
        <p>Encontre o técnico de acordo com a natureza da avaria.</p>

        @if(!$tecnicos->isEmpty())
            <div class="uk-card uk-width-1-1@s">
                <div class="uk-overflow-auto">
                    <table id="avarias-tb"
                           class="uk-table uk-table-hover uk-table-responsive uk-table-middle uk-table-divider">
                        <thead>
                        <tr>
                            <th id="table-header" class="uk-width-small">Nome</th>
                            <th id="table-header" class="uk-width-small">Área de trabalho</th>
                            <th id="table-header" class="uk-width-small">Morada</th>
                            <th id="table-header" class="uk-table-shrink">Contacto</th>
                            <th id="table-header" class="uk-width-small">Sexo</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($tecnicos as $tecnico)
                            <tr class="uk-background-muted uk-table-link">
                                <td class="uk-text-bold uk-table-link uk-text-normal">
                                        {{ $tecnico->name }}
                                </td>

                                <td class="uk-text-normal uk-table-link">
                                    <a class="uk-link-reset"
                                       >  {{ $tecnico->area }}
                                    </a>
                                </td>
                                <td class="uk-table-link uk-text-normal">
                                    <a class="uk-link-reset" >
                                        {{ $tecnico->morada }}
                                    </a>
                                </td>
                                <td class="uk-text-truncate uk-table-link uk-text-normal">
                                    <a class="uk-link-reset" >
                                        {{ $tecnico->phone }}
                                    </a>
                                </td>
                                <td class="uk-text-truncate uk-table-link uk-text-normal">
                                    <a class="uk-link-reset" >
                                        {{ $tecnico->gender }}
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
