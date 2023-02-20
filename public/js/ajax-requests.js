$(document).ready(function () {

    $('#search').on('keyup', function () {
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: 'cartas/search',
            data: {'search': $value},
            success: function (data) {
                $('#container-cartas').html(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    $('#tipo-carta').on('keyup keypress', function (e) {
        const keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    $(document).ready(function () {
        $('.js-example-responsive').select2({
            placeholder: "Seleccione o sector",
            allowClear: true,
            id: '-1',
            language: "pt_BR"
        });
    });

    $('#btn_report_requisicoes').on('click', function () {
        var data_inicial = $('input[name="data_inicial"]').val();
        var data_final = $('input[name="data_final"]').val();
        var sector = $('input[name="sector"]').val();
        var user = $('input[name="user"]').val();
        var estado = $('select[name="estado"]').val();
        if (estado === null) {
            estado = "";
        }

        if (data_inicial === '') {
            UIkit.modal($('#modal-date')).show();
        } else if (data_final === null) {
            UIkit.modal($('#modal-date')).show();
        } else {
            window.open('/requisicoes/report?data_inicial=' + data_inicial + '&data_final=' + data_final + '&sector=' + sector +
                '&user=' + user + '&estado=' + estado, '_ blank');
        }

    });


    $('#btn_report_prolongamentos').on('click', function () {
        var data_inicial = $('input[name="data_inicial"]').val();
        var data_final = $('input[name="data_final"]').val();
        var sector = $('input[name="sector"]').val();
        var user = $('input[name="user"]').val();

        if (sector === null || sector === undefined) {
            sector = "";
        }

        if (data_inicial === '') {
            UIkit.modal($('#modal-date')).show();
        } else if (data_final === '') {
            UIkit.modal($('#modal-date')).show();
        } else {
            window.open('/prolongamentos/report?data_inicial=' + data_inicial + '&data_final=' + data_final + '&sector=' + sector +
                '&user=' + user, '_ blank');
        }
    });


    $('#btn_report_justificacao').on('click', function () {
        var data_inicial = $('input[name="data_inicial"]').val();
        var data_final = $('input[name="data_final"]').val();
        var sector = $('input[name="sector"]').val();
        var user = $('input[name="user"]').val();

        if (sector === null || sector === undefined) {
            sector = "";
        }

        if (data_inicial === '') {
            UIkit.modal($('#modal-date')).show();
        } else if (data_final === '') {
            UIkit.modal($('#modal-date')).show();
        } else {
            window.open('/justificacoes/report?data_inicial=' + data_inicial + '&data_final=' + data_final + '&sector=' + sector +
                '&user=' + user, '_ blank');
        }
    });

    $('#btn_report_remuneracoes').on('click', function () {
        var data_inicial = $('input[name="data_inicial"]').val();
        var data_final = $('input[name="data_final"]').val();
        var sector = $('input[name="sector_id"]').val();
        var user = $('input[name="user"]').val();

        if (sector === null || sector === undefined) {
            sector = "";
        }

        if (data_inicial === '') {
            UIkit.modal($('#modal-date')).show();
        } else if (data_final === '') {
            UIkit.modal($('#modal-date')).show();
        } else {
            window.open('/remuneracoes/report?data_inicial=' + data_inicial + '&data_final=' + data_final + '&sector=' + sector +
                '&user=' + user, '_ blank');
        }
    });

    $('#btn_report_escalas').on('click', function () {
        var data_inicial = $('input[name="data_inicial"]').val();
        var data_final = $('input[name="data_final"]').val();
        var sector = $('input[name="sector"]').val();
        var user = $('input[name="user"]').val();

        if (sector === null || sector === undefined) {
            sector = "";
        }

        if (data_inicial === '') {
            UIkit.modal($('#modal-date')).show();
        } else if (data_final === '') {
            UIkit.modal($('#modal-date')).show();
        } else {
            window.open('/escalas/report?data_inicial=' + data_inicial + '&data_final=' + data_final + '&sector=' + sector +
                '&user=' + user, '_ blank');
        }
    });

    // if ( typeof $('#print').val() !== 'undefined' && $('#print').val() !== ''){
    //     window.open('/geraPDF/'+$('#print').val());
    // }
    //
    // if ( typeof $('#printA4').val() !== 'undefined' && $('#printA4').val() !== ''){
    //     window.open('avaria/'+$('#printA4').val()+'/pdf/');
    // }

    $('#btn_report_avarias').on('click', function () {
        var data_inicial = $('input[name="data_inicial"]').val();
        var data_final = $('input[name="data_final"]').val();
        var sector = $('input[name="sector_id"]').val();
        var user = $('input[name="user"]').val();
        var estado = $('select[name="estado"]').val();
        var sucursal = $('select[name="sucursal"]').val();
        var tecnico = $('#tecnico_search').val();
        if (estado === null) {
            estado = "";
            console.log(estado);
        }


        if (data_inicial === '') {
            UIkit.modal($('#modal-date')).show();
        } else if (data_final === '') {
            UIkit.modal($('#modal-date')).show();
        } else {
            window.open('/avarias/report?data_inicial=' + data_inicial +
                '&data_final=' + data_final + '&sector=' + sector +
                '&user=' + user + '&estado=' + estado + '&sucursal=' + sucursal +
                '&tecnico=' + tecnico, '_ blank');
        }
    });

    $('#btn_report_rescisoes').on('click', function () {
        var data_inicial = $('input[name="data_inicial"]').val();
        var data_final = $('input[name="data_final"]').val();
        var user = $('input[name="user"]').val();
        if (user === null) {
            user = "";
        }


        if (data_inicial === '') {
            UIkit.modal($('#modal-date')).show();
        } else if (data_final === '') {
            UIkit.modal($('#modal-date')).show();
        } else {
            window.open('/pedidosRescisao/report?data_inicial=' + data_inicial +
                '&data_final=' + data_final +
                '&user=' + user, '_ blank');
        }
    });


    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function () {

        $("#sector_search").autocomplete({
            source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "/getSector",
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        sector: request.term
                    },
                    success: function (data) {
                        console.log(request.term);

                        response(data);
                    },
                    error: function (data) {
                        // console.log( request.term);
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                $('#sector_search').val(ui.item.label); // display the selected text
                $('#sector_id').val(ui.item.value); // save selected id to input
                return false;
            }
        });

        $("#user_search").autocomplete({
            source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "/getUser",
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        user: request.term
                    },
                    success: function (data) {
                        response(data);
                    },
                    error: function (data) {
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                $('#user_search').val(ui.item.label); // display the selected text
                $('#user_id').val(ui.item.value); // save selected id to input
                return false;
            }
        });


        $("#tecnico_search").autocomplete({
            source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "/getTecnico",
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        tecnico: request.term
                    },
                    success: function (data) {
                        response(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                $('#tecnico_search').val(ui.item.label); // display the selected text
                $('#tecnico_id').val(ui.item.value); // save selected id to input
                return false;
            }
        });


        $("#motorista_search").autocomplete({
            source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "/getMotorista",
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        motorista: request.term
                    },
                    success: function (data) {
                        response(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                $('#motorista_search').val(ui.item.label); // display the selected text
                $('#motorista_id').val(ui.item.value); // save selected id to input
                return false;
            }
        });


        $("#transporte_search").autocomplete({
            source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "/getTransporte",
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        transporte: request.term
                    },
                    success: function (data) {
                        response(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                $('#transporte_search').val(ui.item.label); // display the selected text
                $('#transporte_id').val(ui.item.value); // save selected id to input
                return false;
            }
        });

    });


    $('#search_ctos').on('keyup', function () {
        $('#spinner').show();
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: 'tos/search',
            data: {'search': $value},
            success: function (data) {
                $('#spinner').hide();
                $('#constratos_list').html(data);
            },
            error: function (data) {
                $('#spinner').hide();
                console.log(data);
            }
        });
    });

        $('.dynamic').change(function () {

            if ($(this).val() != '') {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "/fecth/dependent",
                    method: "POST",
                    data: {select: select, value: value, _token: _token},
                    success: function (result) {
                        $('#' + dependent).html(result);
                    },
                    error: function (result) {
                        console.log(result);
                    }

                })
            }
        });

        $('#tipo_viajem').change(function () {
            $('#local_id').val('');
        });

});
