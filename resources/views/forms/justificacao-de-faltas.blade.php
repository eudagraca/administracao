<div class="conntainer">
    <div class="uk-section uk-section-small uk-flex uk-flex-center uk-width-1-1@s">
        <div class="uk-card uk-card-default uk-width-1-1@s">
            <form method="POST" action="{{ route('carta.store') }}" id="justificacao"
                  class="uk-form-stacked">
                {{ csrf_field() }}
                <div class="uk-h4 uk-margin-remove-top uk-text-bold uk-card-header ">
                    Carta de Justificação de faltas
                </div>
                <div class="uk-panel uk-padding uk-padding-remove-bottom">
                    <div class="uk-panel-badge uk-card-badge badge badge-success"> Recursos humanos</div>
                    <h3 class="uk-panel-title uk-h5 uk-text-bold uk-text-small">Dados do colaborador</h3>
                    <hr class="uk-divider-small">
                    <div class="uk-grid-small" uk-grid>
                        <div class="uk-width-1-4@s">
                            <label for="sector_id" class="uk-form-label">Sector</label>
                            <select class="uk-select"
                                    name="states">
                                <option>Seleccione o sector</option>
                            @foreach($sectores as $sector)
                                    <option value="{{$sector->id}}">{{ $sector->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="uk-width-1-2@s">
                            <label for="name" class="uk-form-label">Nome</label>
                            <input class="uk-input" type="text" placeholder="Nome completo">
                        </div>
                        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid uk-margin-medium-top">
                            <label class="uk-text-small">
                                <input class="uk-radio" value="cash" type="radio" name="funcionario">
                                Prestador</label> <label class="uk-text-small">
                                <input class="uk-radio" value="cash" type="radio" name="funcionario">
                                Efectivo</label>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="uk-panel uk-padding uk-padding-remove-top">
                    <h3 class="uk-panel-title uk-h5 uk-text-bold uk-text-small">Pedido de: </h3>
                    <hr class="uk-divider-small">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th colspan="2">
                                <div
                                    class="uk-margin uk-margin-top uk-grid-small uk-child-width-auto uk-grid uk-margin-remove-bottom uk-margin-small">
                                    <label class="uk-text-small">
                                        <input class="uk-radio" value="cash" type="radio" name="justificacao">
                                        Justificação de falta</label>
                                    <label class="uk-text-small">
                                        Justificação de atraso
                                        <input class="uk-radio" value="cash" type="radio" name="justificacao">
                                    </label>
                                </div>
                            </th>
                            <th colspan="2">
                                <div
                                    class="uk-margin uk-grid-small uk-margin-top uk-child-width-auto uk-grid uk-margin-remove-bottom uk-margin-small">
                                    <label class="uk-text-small">
                                        <input class="uk-radio" value="cash" type="radio" name="justificacao">
                                        Dispensa</label>
                                    <label class="uk-text-small">
                                        <input class="uk-input uk-text-meta uk-child-width-auto" type="text"
                                               placeholder="Assunto . . ." name="justificacao">
                                        <small class="uk-text-light uk-text-small">Indique o assunto</small>
                                    </label>
                                </div>
                            </th>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="uk-panel uk-padding uk-padding-remove-top table-responsive-m">


                    <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_just">
                            <thead>
                            <tr>
                                <th class="uk-text-small" colspan="4">Dados de escala</th>
                                <th class="uk-text-small" colspan="2">Dados de falta</th>

                            </tr>
                            <tr>
                                <th class="uk-text-small">Datas</th>
                                <th class="uk-text-small">Hora de inicio</th>
                                <th class="uk-text-small">Intervalo</th>
                                <th class="uk-text-small">Hora do fim</th>
                                <th class="uk-text-small">Hora de início</th>
                                <th class="uk-text-small">Hora do fim</th>
                            </tr>
                            </thead>
                                <tr>
                                    <td><input name="data[]"
                                               value="" placeholder="Data"
                                               type="date"
                                               class="uk-input data name_list"/></td>
                                    <td><input type="text" name="hora_inicio_escala[]"
                                               value=""
                                               placeholder="Hora"
                                               class="hora_justificacao uk-input name_list"/></td>
                                    <td><input type="text" name="intervalo[]"
                                               value=""
                                               placeholder="11:30 - 12:00"
                                               class="uk-input intervalo name_list"/></td>
                                    <td><input type="text" name="hora_fim_escala[]"
                                               value=""
                                               placeholder="Hora do fim"
                                               class="uk-input hora_justificacao"/></td>
                                    <td><input name="hora_inicio_falta[]"
                                               value=""
                                               placeholder="Hora do início"
                                               class="uk-input hora_justificacao"/></td>
                                    <td><input  name="hora_fim_falta[]"
                                               value=""
                                               placeholder="Hora do fim"
                                               class="uk-input hora_justificacao"/></td>
                                </tr>
                        </table>
                        <td>
                            <button type="button" name="add-justificacao" id="add-justificacao"
                                    class="btn btn-dark uk-box-shadow-hover-medium"><span><i
                                        class="fa fa-plus-circle" aria-hidden="true"></i></span>
                            </button>
                        </td>
                    </div>


                    <div class="uk-width-1-1@s uk-margin">
                        <label for="responsavel" class="uk-form-label">
                            {{ __('Motivos') }}
                        </label>
                        <div class="uk-form-control">
                            <textarea class="uk-textarea @error('motivo') uk-form-danger @enderror"
                                      id="motivo" name="motivo"
                                      placeholder="Responsável pela resolução da avaria" rows="2"
                                      autocomplete="off"
                                      autofocus></textarea>
                            @error('motivo')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <hr>

{{--                    <div uk-grid>--}}
{{--                        <div class="uk-width-1-2@s">--}}
{{--                            <label for="plano_prevencao" class="uk-form-label uk-margin-remove">--}}
{{--                                {{ __('O colaborador') }}--}}
{{--                            </label>--}}
{{--                            <div class="uk-form-control">--}}
{{--                                <input class="uk-input uk-text-center line @error('colaborador') uk-form-danger @enderror"--}}
{{--                                       id="colaborador" name="colaborador"--}}
{{--                                       autocomplete="off"--}}
{{--                                       autofocus/>--}}
{{--                                @error('colaborador')--}}
{{--                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                                <input class="uk-input uk-text-center data_colaborador line @error('colaborador') uk-form-danger @enderror"--}}
{{--                                       id="colaborador" name="colaborador"--}}
{{--                                       autocomplete="off"--}}
{{--                                       autofocus/>--}}
{{--                                @error('colaborador')--}}
{{--                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>--}}
{{--                                @enderror--}}

{{--                                <p class="uk-margin-top uk-margin-remove-bottom uk-text-center">Tomei conhecimento</p>--}}

{{--                                <input class="uk-input uk-text-center line @error('colaborador') uk-form-danger @enderror"--}}
{{--                                       id="colaborador" name="colaborador"--}}
{{--                                       autocomplete="off"--}}
{{--                                       autofocus/>--}}
{{--                                @error('colaborador')--}}
{{--                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>--}}
{{--                                @enderror--}}

{{--                                <input class="uk-input uk-text-center line data_colaborador_conhecimento @error('colaborador') uk-form-danger @enderror"--}}
{{--                                       id="colaborador" name="colaborador" autocomplete="off"--}}
{{--                                       autofocus/>--}}
{{--                                @error('colaborador')--}}
{{--                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="uk-width-1-2@s">--}}
{{--                            <label for="plano_prevencao" class="uk-form-label">--}}
{{--                                {{ __('O colaborador substituto') }}--}}
{{--                            </label>--}}
{{--                            <div class="uk-form-control">--}}
{{--                                <input class="uk-input uk-text-center line @error('substituto') uk-form-danger @enderror "--}}
{{--                                       id="substituto" name="substituto"--}}
{{--                                       autocomplete="off"--}}
{{--                                       autofocus/>--}}
{{--                                @error('substituto')--}}
{{--                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                                <input class="uk-input line data_sustituto uk-text-center @error('substituto_data') uk-form-danger @enderror"--}}
{{--                                       id="substituto_data" name="substituto_data"--}}
{{--                                       autocomplete="off"--}}
{{--                                       autofocus/>--}}
{{--                                @error('substituto_data')--}}
{{--                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>--}}
{{--                                @enderror--}}

{{--                                <p class="uk-margin-top uk-margin-remove-bottom uk-text-center">Tomei conhecimento</p>--}}

{{--                                <input class="uk-input uk-text-center line @error('colaborador') uk-form-danger @enderror"--}}
{{--                                       id="colaborador" name="colaborador"--}}
{{--                                       autocomplete="off"--}}
{{--                                       autofocus/>--}}
{{--                                @error('colaborador')--}}
{{--                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>--}}
{{--                                @enderror--}}

{{--                                <input class="uk-input uk-text-center substituto_data_colaborador line @error('colaborador') uk-form-danger @enderror"--}}
{{--                                       id="colaborador" name="colaborador"  autocomplete="off"--}}
{{--                                       autofocus/>--}}
{{--                                @error('colaborador')--}}
{{--                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div uk-grid>--}}

{{--                        <div class="uk-width-1-3@s">--}}
{{--                            <label for="plano_prevencao" class="uk-form-label">--}}
{{--                                {{ __('Pertecente ao chefe do sector') }}--}}
{{--                            </label>--}}
{{--                            <div class="uk-form-control">--}}
{{--                                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid uk-margin-medium-top">--}}
{{--                                    <label class="uk-text-small">--}}
{{--                                        <input class="uk-radio" value="cash" type="radio" name="funcionario">--}}
{{--                                        Autorizo</label>--}}
{{--                                </div>--}}
{{--                                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">--}}
{{--                                    <label class="uk-text-small">--}}
{{--                                        <input class="uk-radio" value="cash" type="radio" name="funcionario">--}}
{{--                                        Não autorizo</label>--}}
{{--                                </div>--}}
{{--                                <input class="uk-input uk-text-center line @error('colaborador') uk-form-danger @enderror"--}}
{{--                                       id="colaborador" name="colaborador"--}}
{{--                                       autocomplete="off"--}}
{{--                                       autofocus/>--}}
{{--                                @error('colaborador')--}}
{{--                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                                <input class="uk-input uk-text-center reservado_data line @error('colaborador') uk-form-danger @enderror"--}}
{{--                                       id="colaborador data_para_resolucao" name="colaborador"--}}
{{--                                       autocomplete="off"--}}
{{--                                       autofocus/>--}}
{{--                                @error('colaborador')--}}
{{--                                <span class="uk-text-danger uk-text-small">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="uk-width-1-3@s">--}}
{{--                            <label for="plano_prevencao" class="uk-form-label">--}}
{{--                                Reservado RH--}}
{{--                            </label>--}}
{{--                            <div class="uk-form-control">--}}
{{--                                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid uk-margin-medium-top">--}}
{{--                                    <label class="uk-text-small">--}}
{{--                                        <input class="uk-radio" value="cash" type="radio" name="direccao">--}}
{{--                                        Reúne requisitos</label>--}}
{{--                                </div>--}}
{{--                                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">--}}
{{--                                    <label class="uk-text-small">--}}
{{--                                        <input class="uk-radio" value="cash" type="radio" name="direccao">--}}
{{--                                        Não reúne requisitos</label>--}}
{{--                                </div>--}}
{{--                                <input class="uk-input uk-text-center line" id="colaborador" name="colaborador" autocomplete="off" autofocus="">--}}
{{--                                <input class="uk-input uk-text-center line data_direccao" id="colaborador" name="colaborador" autocomplete="off" autofocus="">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="uk-width-1-3@s">--}}
{{--                            <label for="plano_prevencao" class="uk-form-label">--}}
{{--                                Reservado ao Direcção--}}
{{--                            </label>--}}
{{--                            <div class="uk-form-control">--}}
{{--                                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid uk-margin-medium-top">--}}
{{--                                    <label class="uk-text-small">--}}
{{--                                        <input class="uk-radio" value="cash" type="radio" name="direccao">--}}
{{--                                        Autorizo</label>--}}
{{--                                </div>--}}
{{--                                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">--}}
{{--                                    <label class="uk-text-small">--}}
{{--                                        <input class="uk-radio" value="cash" type="radio" name="direccao">--}}
{{--                                        Não autorizo</label>--}}
{{--                                </div>--}}
{{--                                <input class="uk-input uk-text-center line" id="colaborador" name="colaborador" autocomplete="off" autofocus="">--}}
{{--                                <input class="uk-input uk-text-center line data_direccao" id="colaborador" name="colaborador" autocomplete="off" autofocus="">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
                    <hr>
                    <div class="uk-width-1-1@s uk-margin">
                        <label for="responsavel" class="uk-form-label">
                            {{ __('Observações') }}
                        </label>
                        <div class="uk-form-control">
                            <textarea class="uk-textarea @error('observacoes') uk-form-danger @enderror"
                                      id="observacoes" name="observacoes"
                                      placeholder="Observações" rows="3"
                                      autocomplete="off"
                                      autofocus></textarea>
                            @error('motivo')
                            <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="uk-form-control uk-card-footer">
                    <button type="submit" class="uk-button uk-align-right uk-border-rounded uk-button-secondary">
                        {{ __('Enviar justificação') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
