$(document).ready(function () {
    let counter = 1;
    $('#add-rh_parecer').click(function () {

        $('#dynamic_rh_jt').append(
            '<tr id="myRow' + counter + '">' +
            '<td><input name="data_rh[' + counter + ']"  placeholder="Data"'+ 'type="date" class="uk-input data name_list" /></td>'+
            '<td><input type="text" name="hora_inicio_rh[' + counter + ']" ' + 'placeholder="HH:mm" class="hora_justificacao uk-input name_list"/></td>'+
            '<td><input type="text" name="intervalo_rh[' + counter + ']" ' + 'placeholder="HH:mm - HH:mm"'+
                     'class="uk-input intervalo name_list" /></td>'+
            '<td><input type="text" name="hora_fim_rh[' + counter + ']" ' + 'placeholder="HH:mm" class="uk-input hora_justificacao" /></td>'+
            '<td><button type="button" name="remove" id="' + counter + '" class="btn btn-danger btn_remove_row"><strong>X</strong></button></td>' +
            '</tr>');

        //Macara
        const hora = [{ "mask": "##:##" }, { "mask": "##:##" }];
        $('.hora_justificacao').inputmask({
            mask: hora,
            greedy: false,
            definitions: { '#': { validator: "[0-9]", cardinality: 1 } }
        });

        $('input[name="data_rh[' + counter + ']"]').rules("add", {
            required: true
        });

        $('input[name="hora_inicio_rh[' + counter + ']"]').rules("add", {
            required: true
        });

        $('input[name="intervalo_rh[' + counter + ']"]').rules("add", {
            required: true
        });

        $('input[name="hora_fim_rh[' + counter + ']"]').rules("add", {
            required: true
        });

        $('#id_ct' + j).rules('add', {
            required: true
        });
        counter++;
    });
});


$(document).ready(function(){
    let counter = 1;
    $('#add-justificacao_form').click(function () {

        $('#dynamic_justificacao').append(
            '<tr id="myRow' + counter + '">' +
            '<td><input name="data_escala[' + counter + ']"  placeholder="Data" type="date"'+
                    'class="uk-input data name_list" /></td>'+
            '<td><input type="text" name="hora_inicio_escala[' + counter + ']"  placeholder="HH:mm"'+
                    'class="hora_justificacao uk-input name_list" /></td>'+
            '<td><input type="text" name="intervalo[' + counter + ']"  placeholder="HH:mm - HH:mm"'+
                    'class="uk-input intervalo name_list" /></td>'+
            '<td><input type="text" name="hora_fim_escala[' + counter + ']" '+ 'placeholder="HH:mm" class="uk-input hora_justificacao" /></td>'+
            '<td><input name="hora_inicio_falta[' + counter + ']"  placeholder="HH:mm" class="uk-input hora_justificacao" /></td>' + '<td><input name="hora_fim_falta[' + counter + ']"  placeholder="HH:mm" class="uk-input hora_justificacao" /></td>'+
            '<td><button type="button" name="remove" id="' + counter + '" class="btn btn-danger btn_remove_row"><strong>X</strong></button></td>'+
            '</tr>');

        //Macara
        const hora = [{ "mask": "##:##" }, { "mask": "##:##" }];
        $('.hora_justificacao').inputmask({
            mask: hora,
            greedy: false,
            definitions: { '#': { validator: "[0-9]", cardinality: 1 } }
        });

        const intervalo = [{ "mask": "##:## às ##:##" }, { "mask": "##:## às ##:##" }];
        $('.intervalo').inputmask({
            mask: intervalo,
            greedy: false,
            definitions: { '#': { validator: "[0-9]", cardinality: 1 } }
        });

        $('input[name="hora_fim_escala[' + counter + ']"]').rules("add", {
            required: true
        });

        $('input[name="intervalo[' + counter + ']"]').rules("add", {
            required: true
        });

        $('input[name="hora_inicio_escala[' + counter + ']"]').rules("add", {
            required: true
        });

        $('input[name="hora_fim_falta[' + counter + ']"]').rules("add", {
            required: true
        });

        $('input[name="data_escala[' + counter + ']"]').rules("add", {
            required: true
        });

        $('input[name="hora_inicio_falta[' + counter + ']"]').rules("add", {
            required: true
        });

        $('#id_ct' + j).rules('add', {
            required: true
        });
        counter++;
    });
});



$(document).ready(function(){
    let counter = 1;
    $('#add-clausulas').click(function () {

        $('#clausulas').append(

            '<div class="uk-width-1-1@s uk-margin">'+
            '<label for="nr_clausula[' + [counter] +']" class="uk-form-label">'+
                    'Titulo </label>'+
            '<div class="uk-form-control">' +
            '<input class="uk-input" id="nr_clausula[' + [counter] +']"'+
            'name="nr_clausula[' + [counter] +']" placeholder="Ex:'+ 'Número da Cláusula">'+
    '</div>'+

            '<label for="descricao_clausula[' + [counter] +']" class="uk-form-label uk-margin">'+
                        'Descrição da cláusula'+
            '</label>'+
            '<div class="uk-form-control">'+
            '<input class="uk-input" id="descricao_clausula[' + counter +']"'+
            'name="descricao_clausula[' + counter +']"'+
            'placeholder="Ex: Responsabilidades do contratado">'+
            '</div>'+

            '<div class="uk-form-control uk-margin">'+
            '<textarea class="uk-textarea"' + 'id="clausula" required name="clausula[' + counter +']" rows="4"' + 'placeholder="Oque diz a cláusula"></textarea>'+
            '</div>'+
            '</div>'
        );

        $('input[name="descricao_clausula[' + counter + ']"]').rules("add", {
            required: true
        });

        $('input[name="clausula[' + counter + ']"]').rules("add", {
            required: true
        });

        $('input[name="nr_clausula[' + counter + ']"]').rules("add", {
            required: true
        });
        counter++;
    });
});


$(document).ready(function(){
    let counter = 1;
    $('#add-justificacao').click(function () {

        $('#dynamic_prolongamento').append(
            '<tr id="myRow' + counter + '">' +

            '<td><input name="data_prolongamento[' + counter + ']" type="date"' +
            ' placeholder="Data" class="uk-input name_list" /></td>' +

            '<td><input type="text" name="hora_inicio_prolongamento[' + counter + ']"' +' placeholder="HH:mm"' +
            'class="hora_prolongamento uk-input name_list" /></td>' +
            '<td><input name="hora_fim_prolongamento[' + counter + ']" ' +
            'placeholder="HH:mm" class="uk-input hora_prolongamento"' + '/></td>' +
            '<td><button type="button" name="remove" id="' + counter + '" class="btn btn-danger btn_remove_row"><strong>X</strong></button></td></tr>');

        //Macara
        const hora = [{ "mask": "##:##" }, { "mask": "##:##" }];
        $('.hora_prolongamento').inputmask({
            mask: hora,
            greedy: false,
            definitions: { '#': { validator: "[0-9]", cardinality: 1 } }
        });

        $('input[name="data_prolongamento[' + counter + ']"]').rules("add", {
            required: true
        });

        $('input[name="hora_inicio_prolongamento[' + counter + ']"]').rules("add", {
            required: true
        });

        $('input[name="hora_fim_prolongamento[' + counter + ']"]').rules("add", {
            required: true
        });



        $('input[name="data[' + counter + ']"]').rules("add", {
            required: true
        });
        counter++;
    });
});

//Nova escala

$(document).ready(function(){
    let counter = 1;
    $('#add-justificacao').click(function () {

        $('#dynamic_nova_escala').append(

            '<tr id="row_nova_escala' + counter + '">' +
            '<td><input name="data_nova_escala[' + counter + ']" type="date"'+
                    ' placeholder="Data"'+
                    'class="uk-input name_list" /></td>'+
            '<td><input type="text" name="hora_inicio_nova_escala[' + counter + ']"'+
                    ' placeholder="HH:mm"'+
                    'class="hora_nova_escala uk-input name_list" /></td>'+
            '<td><input type="text" name="intervalo_nova_escala[' + counter + ']"' +' placeholder="HH:mm - HH:mm"'+
                    'class="uk-input intervalo_nova name_list" /></td>'+
            '<td><input name="hora_fim_nova_escala[' + counter + ']"'+
                    ' placeholder="HH:mm"'+
                    'class="uk-input hora_nova_escala" /></td>'+
            '</tr>'
        );

        // $(document).on('click', '.btn-remove_prol', function () {
        //     var button_id = $(this).attr("id");
        //     $('#row_nova_escala' + button_id + '').remove();
        // });
        //Macara
        const hora = [{ "mask": "##:##" }, { "mask": "##:##" }];
        $('.hora_nova_escala').inputmask({
            mask: hora,
            greedy: false,
            definitions: { '#': { validator: "[0-9]", cardinality: 1 } }
        });

        //Macara
        const intervalo = [{ "mask": "##:## às ##:##" }, { "mask": "##:## às ##:##" }];
        $('.intervalo_nova').inputmask({
            mask: intervalo,
            greedy: false,
            definitions: { '#': { validator: "[0-9]", cardinality: 1 } }
        });

        $('input[name="intervalo_nova_escala[' + counter + ']"]').rules("add", {
            required: true
        });

        $('input[name="data_nova_escala[' + counter + ']"]').rules("add", {
            required: true
        });

        $('input[name="hora_inicio_nova_escala[' + counter + ']"]').rules("add", {
            required: true
        });

        $('input[name="hora_fim_nova_escala[' + counter + ']"]').rules("add", {
            required: true
        });
        counter++;
    });
});


$(document).ready(function () {
    // //Forms
    let count = 1;

    $('#add-justificacao').click(function () {

        $('#dynamic_just').append(
            '<tr id="row' + count + '">' +
            '<td><input class="uk-input" name="data[' + count + ']" type="date" placeholder="Datas"></td> ' +
            '<td><input type="text" name="hora_entrada[' + count + ']"  placeholder="HH:mm" class="hora_justificacao uk-input name_list"/></td> ' +
            '<td><input type="text" name="intervalo[' + count + ']"  placeholder="HH:mm - HH:mm" class="uk-input intervalo name_list "/></td>' +
            '<td><input type="text" name="hora_final[' + count + ']"  placeholder="HH:mm" class="uk-input hora_justificacao"/></td>' +
            '<td><button type="button" name="remove" id="' + count + '" class="btn btn-danger btn_remove"><strong>X</strong></button></td></tr>');

        //Macara
        const intervalo = [{ "mask": "##:## às ##:##" }, { "mask": "##:## às ##:##" }];
        $('.intervalo').inputmask({
            mask: intervalo,
            greedy: false,
            definitions: { '#': { validator: "[0-9]", cardinality: 1 } }
        });

        const horas = [{ "mask": "##:##" }, { "mask": "##:##" }];
        $('.hora_justificacao').inputmask({
            mask: horas,
            greedy: false,
            definitions: { '#': { validator: "[0-9]", cardinality: 1 } }
        });

        $('input[name="data[' + count + ']"]').rules("add", {
            required: true
        });

        $('input[name="hora_entrada[' + count + ']"]').rules("add", {
            required: true
        });

        $('input[name="intervalo[' + count + ']"]').rules("add", {
            required: true
        });

        $('input[name="hora_final[' + count + ']"]').rules("add", {
            required: true
        });
        count++;
    });

    for (let j = 0; j < count; j++) {
        $('#event' + [j]).datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy/mm/dd'
        });
    }

    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
        $('#row_nova_escala' + button_id + '').remove();
    });

    $(document).on('click', '.btn_remove_row', function () {
        var button_id = $(this).attr("id");
        $('#myRow' + button_id + '').remove();
    });


    $("#justificacao").validate({
        rules: {
            "data_escala[]": {
                required: true
            },
            "data_prolongamento[]": {
                required: true
            },
            "hora_inicio_escala[]": {
                required: true
            },
            "intervalo_escala[]": {
                required: true
            },
            "hora_fim_escala[]": {
                required: true
            },
            "hora_inicio_falta[]": {
                required: true,
                number: true
            },
            "hora_fim_falta[]": {
                required: true
            },
            "data_nova_escala[]": {
                required: true
            },
            "hora_fim_nova_escala[]": {
                required: true
            },
            "intervalo_nova_escala[]": {
                required: true
            },
            "hora_inicio_escala[]": {
                required: true
            },
            "hora_inicio_prolongamento[]": {
                required: true
            },
            "hora_fim_prolongamento[]": {
                required: true
            },
            "data_prolongamento[]": {
                required: true
            },
            "hora_fim_escala[]": {
                required: true
            },
            "hora_inicio_escala[]": {
                required: true
            },
            "tipo_escala": {
                required: true
            },
            "motivo": {
                required: true
            },
            "pedido_de": {
                required: true
            },
            "escala": {
                required: true
            },
            "tipo_colaborador": {
                required: true
            },
            "hora_inicio_escala[]": {
                required: true
            },
        },
        messages: {
            // mao_obra_inicial: {
            //     required: 'Mão de obra deve ser indicada.',
            //     number: 'Introduza um número válido.'
            // },
            // mao_obra_final: {
            //     required: 'Mão de obra final deve ser indicada.',
            //     number: 'Introduza um número válido',
            // },
            // pagamento: {
            //     required: 'Marque a forma de pagamento usada.',
            // },

        }
    });

    $("#contrato").validate({
        rules: {
            "clausula[0]": {
                required: true
            },
            "descricao_clausula[0]": {
                required: true
            },
            "nr_clausula[0]": {
                required: true
            },
        },
        messages: {
            // mao_obra_inicial: {
            //     required: 'Mão de obra deve ser indicada.',
            //     number: 'Introduza um número válido.'
            // },
            // mao_obra_final: {
            //     required: 'Mão de obra final deve ser indicada.',
            //     number: 'Introduza um número válido',
            // },
            // pagamento: {
            //     required: 'Marque a forma de pagamento usada.',
            // },

        }
    });


    $("#escala").validate({
        rules: {
            "data_escala[0]": {
                required: true
            },
            "hora_fim_nova_escala[0]": {
                required: true
            },
            "hora_inicio_escala[0]": {
                required: true
            },
            "hora_inicio_nova_escala[0]": {
                required: true
            },
            "intervalo[0]": {
                required: true
            },
            "hora_fim_escala[0]": {
                required: true
            },
            "data_prolongamento[0]": {
                required: true
            },
            "hora_inicio_prolongamento[0]": {
                required: true
            },
            "hora_fim_prolongamento[0]": {
                required: true,

            },
            "data_nova_escala[0]": {
                required: true
            },
            "hora_entrada[0]": {
                required: true
            },
            "hora_final[0]": {
                required: true
            },
            "intervalo_nova_escala[0]": {
                required: true
            },
            "hora_fim_nova_escala[0]": {
                required: true
            },
            "forma_compensacao": {
                required: true
            },
            "motivo": {
                required: true
            },
            "tipo_colaborador": {
                required: true
            },
            "tipo_escala": {
                required: true
            },
            "pedido_de": {
                required: true
            },

        },
        messages: {
            // mao_obra_inicial: {
            //     required: 'Mão de obra deve ser indicada.',
            //     number: 'Introduza um número válido.'
            // },
            // mao_obra_final: {
            //     required: 'Mão de obra final deve ser indicada.',
            //     number: 'Introduza um número válido',
            // },
            // pagamento: {
            //     required: 'Marque a forma de pagamento usada.',
            // },

        }
    });


    $("#rh_jt_form").validate({
        rules: {
            "data_rh[0]": {
                required: true
            },
            "hora_inicio_rh[0]": {
                required: true
            },
            "intervalo_rh[0]": {
                required: true
            },
            "hora_fim_rh[0]": {
                required: true
            },
            "estado": {
                required: true
            },
            "observacoes": {
                required: true
            },
            "parecer_chefe": {
                required: true
            },
        },
        messages: {
            // mao_obra_inicial: {
            //     required: 'Mão de obra deve ser indicada.',
            //     number: 'Introduza um número válido.'
            // },
            // mao_obra_final: {
            //     required: 'Mão de obra final deve ser indicada.',
            //     number: 'Introduza um número válido',
            // },
            // pagamento: {
            //     required: 'Marque a forma de pagamento usada.',
            // },

        }
    });

    $("#justificacao_falta").validate({
        rules: {
            "tipo_colaborador": {
                required: true
            },
            "tipo_justificacao": {
                required: true
            },
            "assunto": {
                required: function (element) {
                    return $("#tipo_justificacao").val() === "Dispensa";
                }
            },
            "data_escala[0]": {
                required: true
            },
            "intervalo[0]": {
                required: true
            },
            "intervalo_escala[0]": {
                required: true
            },
            "hora_fim_escala[0]": {
                required: true
            },
            "hora_inicio_falta[0]": {
                required: true,
            },
            "hora_fim_falta[0]": {
                required: true,
            },
            "hora_inicio_escala[0]": {
                required: true,
            },
            "motivo": {
                required: true
            },
            "forma_compensacao": {
                required: true
            },
            "observacoes": {
                required: true
            },
        },
        messages: {
            // mao_obra_inicial: {
            //     required: 'Mão de obra deve ser indicada.',
            //     number: 'Introduza um número válido.'
            // },
            // mao_obra_final: {
            //     required: 'Mão de obra final deve ser indicada.',
            //     number: 'Introduza um número válido',
            // },
            // pagamento: {
            //     required: 'Marque a forma de pagamento usada.',
            // },

        }
    });

    // $("#intervalo").inputmask({"mask": "0000 - 0000"});

    const intervalo = [{ "mask": "##:## às ##:##" }, { "mask": "##:## às ##:##" }];
    $('.intervalo').inputmask({
        mask: intervalo,
        greedy: false,
        definitions: { '#': { validator: "[0-9]", cardinality: 1 } }
    });

    const horas = [{ "mask": "##:##" }, { "mask": "##:##" }];
    $('.hora_justificacao').inputmask({
        mask: horas,
        greedy: false,
        definitions: { '#': { validator: "[0-9]", cardinality: 1 } }
    });

    //
    // var date = new Date(); // Now
    // date.setDate(date.getDate() + 15);
    //
    //
    // console.log(date);
    //
    // function calcDateDif(){
    //     const date1 = new Date();
    //     const date2 = new Date($('#antecedencia').val());
    //     const diffTime = Math.abs(date2 - date1);
    //     const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    //     if ( !isNaN(diffDays) && (diffDays > 15)){
    //     }else {
    //        alert('A tua data deve ter uma diferença de 15 dias')
    //     }
    //
    // }

    $("#rescisaoForm").validate({
        rules: {
            "motivo": {
                required: true,
                minlength: 3
            },
            "antecedencia": {
                required: true,
                minDate: true,
                validDate: true,
                isDate: true,
            }
        }
    });

    const antecedencia = [{ "mask": "####-##-##" }, { "mask": "####-##-##" }];
    $('#antecedencia').inputmask({
        mask: antecedencia,
        greedy: false,
        placeholder: "AAAA-MM-DD",
        definitions: { '#': { validator: "[0-9]", cardinality: 1 } },
    });


    $('#antecedencia').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd',

    });


    $('#data_inicio').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd',

    });

    $('#data_termino').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd',

    });

    $('#antecedencia').change(function () {
        console.log('ho');
        $("#rescisaoForm").validate({
            rules: {
                "antecedencia": {
                    required: true,
                    minDate: true,
                    validDate: true,
                    isDate: true,
                }
            }
        });
    });

    $.validator.addMethod("minDate", function (value, element) {

        var curDate = new Date();
        var inputDate = new Date(value);

        const diffTime = Math.abs(inputDate - curDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        if (diffDays > 15)
            return true;
        return false;
    }, "A diferença dos dias deve ser no mínimo de 15 dias");


    $.validator.addMethod("validDate", function (value, element) {

        var regEx = /^\d{4}-((0\d)|(1[012]))-(([012]\d)|3[01])$/;
        if (!value.match(regEx)) return false;  // Invalid format
        var d = new Date(value);
        var dNum = d.getTime();
        if (!dNum && dNum !== 0) return false; // NaN value, Invalid date
        return d.toISOString().slice(0, 10) === value;
    }, "Data inválida");


    $.validator.addMethod("isDate", function (value, element) {

        var dateReg = /^\d{2}[./-]\d{2}[./-]\d{4}$/
        return value.match(/^\d{4}-((0\d)|(1[012]))-(([012]\d)|3[01])$/);
    }, "Data inválida");


    $.validator.addMethod("reqIfNN", function (value, element) {

        return value == '';
    }, "Campo obrigatório");


    //Adenda
    let counter = 1;
    $('#addClausulaAdenda').click(function (e) {

        $('#adenda-add').append(
            '<div class="uk-width-1-1@s uk-margin-top" id="linha' + counter + '"> ' +
            '<div class="uk-form-control">' +
            '<textarea class="uk-textarea uk-width-1-1@s" required ' +
            'name="clausula[' + counter + ']" placeholder="Parágrafo "' +
            ' rows="3" required></textarea> </div>' +
            '<button type="button" name="remove" id="' + counter + '" class="uk-align-right uk-margin-small btn btn-danger btn-remove"><i class="fa fa-trash-alt"></i></button></div>')

        $('input[name="clausula[' + counter + ']"]').rules("add", {
            required: true
        });
        counter++;
    });

    $(document).on('click', '.btn-remove', function () {
        var button_id = $(this).attr("id");
        $('#linha' + button_id + '').remove();
    });


    $("#adendaForm").validate({
        rules: {
            "aumento": {
                required: true,
                number: true
            },
            "clausula[0]": {
                required: true,
                minlength: 3
            },
        },
        messages: {
            aumento: {
                number: 'Introduza um número válido.'
            }
        }
    });



    $("#advertenciaForm").validate({
        rules: {
            "para": {
                required: true,
            },
            "motivos": {
                required: true,
            },
            "user_id": {
                required: true,
            },
        },
        messages: {
            aumento: {
                number: 'Introduza um número válido.'
            }
        }
    });


});
