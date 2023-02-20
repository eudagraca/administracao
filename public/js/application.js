$(document).ready(function () {
    var master = $('.sidebar-mini');
    master.addClass('sidebar-collapse');

    let timer = null;
    let i = 1;

    $('#add').click(function () {
    $('#dynamic_field').append('<tr id="row' + i + '">' +
        '<td><input type="text" name="nome[' + i + ']" placeholder="O material" class="uk-input name_list"  data-rule-required="true" /></td> ' +
        '<td><input type="text" id="fornecedor'+i+'" name="fornecedor[' + i + ']" placeholder="O fornecedor"  onfocus="getFornecedor(this)" class="uk-input name_list"  data-rule-required="true"  /></td>' +
        '<td><input type="number"  min="1" name="quantidade[' + i + ']" placeholder="Quantidade" class="uk-input name_list quantidade"  data-rule-required="true"  /></td>' +
        '<td><input type="number"  min="1" name="preco[' + i + ']" placeholder="Preço unitário" class="uk-input preco"  data-rule-required="true" /></td>' +
        '<td><input type="text" name="nr_requisicao[' + i + ']" placeholder="Req. N°" class="uk-input nr_requisicao"  data-rule-required="true" /></td>' +
        '<td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove"> <span><i class="fas fa-times-circle"></i></span> </button></td></tr>'
    );
    $('input[name="nome[' + i + ']"]').rules("add", {
        required: true
    });


    i++;
    });

    $("#data").validate({
        rules: {
            "nome[0]": {
                required: true
            },
            "fornecedor[0]": {
                required: true
            },
            "quantidade[0]": {
                required: true
            },
            "preco[0]": {
                required: true,
                number: true
            },
            // "responsavel": {
            //     required: true
            // },
            // "garantia": {
            //     required: true
            // },
            // "mao_obra_final": {
            //     required: true,
            //     number: true
            // },
            // "mao_obra_inicial": {
            //     required: true,
            //     number: true
            // },
            // "pagamento": {
            //     required: true,
            // }
        },
        messages: {
            mao_obra_inicial: {
                required: 'Mão de obra deve ser indicada.',
                number: 'Introduza um número válido.'
            },
            mao_obra_final: {
                required: 'Mão de obra final deve ser indicada.',
                number: 'Introduza um número válido',
            },
            pagamento: {
                required: 'Marque a forma de pagamento usada.',
            },

        }
    });

    $("#tipo-carta").validate({
        rules: {
            "tipo": {
                required: true,
                minlength: 3
            },
        },
        messages: {
            tipo: {
                required: 'O tipo de carta não pode estar nulo',
                minlength: 'Introduza um tipo válido'
            },
        }
    });

    jQuery.extend(jQuery.validator.messages, {
        required: "O campo é obrigatório"
    });

    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });

    let price = Array();
    let priceTotal = 0;
    let priceTotalFInal = 0;

    $(document).on('click', '#calc', function () {
        price = 0;
        priceTotal = 0;
        price = $('.preco');
        let quantidade = $('.quantidade');
        for (let index = 0; index < price.length; index++) {
            const element = price[index];
            const quantidadeElement = quantidade[index];
            priceTotal += parseFloat(element.value) * parseFloat(quantidadeElement.value);
        }

        $('#custo_do_material').val(priceTotal);
        clearTimeout(timer);
        timer = setTimeout(calcTotalPrice, 1000)
    });


    $("#mao_obra_final").keyup(function () {
        clearTimeout(timer);
        timer = setTimeout(calcTotalPrice, 1000)
    });

    $("#custo_do_material").keyup(function () {
        clearTimeout(timer);
        timer = setTimeout(calcTotalPrice, 1000)
    });

    /**
     * Calcula preco final
     * Sempre que o usuario mexer em um input faz um get all inputs and update
     */

    function calcTotalPrice() {
        var maoDeObraFinal = $('#mao_obra_final').val();
        var custoDoMaterial = $('#custo_do_material').val();

        if (isNaN(parseFloat(maoDeObraFinal))) {
            maoDeObraFinal = 0.0;
        }


        if (isNaN(parseFloat(custoDoMaterial))) {
            custoDoMaterial = 0.0;
        }

        let valTotal = parseFloat(maoDeObraFinal) + parseFloat(custoDoMaterial);
        custoDoMaterial = 0;
        maoDeObraFinal = 0;
        $('#valor_total').val(valTotal);

    }

    //Util
    $("#estado").on('change', function () {
        $(this).val(this.checked ? "concluido" : "andamento");
    });

    //Time picker
    $('#hora_para_resolucao').timepicker({
        timeFormat: 'HH:mm',
        use24hours: true
    });

    $("#data_search").datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd',
        maxDate: new Date()
    });


    $("#data_search_two").datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd',
        maxDate: new Date()
    });


    $('#data_para_resolucao').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd'
    });

    $('.data_contrato').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd'
    });

    $('.data_vigencia').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd'
    });

    $('#data_assinatura').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd'
    });

    $(".js-example-placeholder-single").select2({
        placeholder: "Seleccione a nacionalidade",
        allowClear: true
    });

    $(".js-example-placeholder").select2({
        placeholder: "Seleccione a área de formação",
        allowClear: true
    });

    $('#reset').click(function () {
        $('#estado_search').prop('selectedIndex', 0);
        $('input[name="data_inicial"]').val('');
        $('input[name="data_final"]').val('');
        $('input[name="sector_id"]').val('');
        $('#sector_search').val('');
        $('#user_search').val('');
        $('input[name="user"]').val('');
        $('select[name="estado"]').val('');
        $('select[name="sucursal"]').val('');
        $('#tecnico_search').val('');
        $('input[name="tecnico"]').val('');
    })

    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function () {
        $('.sector_dropdown').select2({
            placeholder: "Seleccione o sector",
            allowClear: true
        });
    });

    $(document).ready(function () {
        $('.sector_requisicao').select2({
            placeholder: "Seleccione o sector",
            allowClear: true
        });
    });

    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function () {
        $('.user_dropdown').select2({
            placeholder: "Pode seleccionar um usuário",
            allowClear: true
        });
    });

    //Data table avarias
    $(document).ready(function () {
        $('#avarias-tb').DataTable({
            responsive: true,
            "language": {
                searchPlaceholder: "Pesquisar ...",
                url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese.json'
            }
        });
    });


    $(document).ready(function () {
        $('#contratos-tb').DataTable({
            responsive: true,
            "language": {
                searchPlaceholder: "Pesquisar ...",
                url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese.json'
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdf',
                text: "RELATÓRIO DE CONTRATOS",
                title: 'Relatorio de contratos',
                pageSize: 'LEGAL',
                download: 'open',
                filename: 'Relatorio de contratos',
                customize: function (doc) {
                    doc.pageMargins = [10, 10, -30, -20];
                    doc.styles.title = {
                        fontSize: '10',
                        alignment: 'center'
                    };

                    doc.styles.tableHeader.alignment = 'left';

                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    // doc.content.splice(0,1);
                    //Create a date string that we use in the footer. Format is dd-mm-yyyy
                    var now = new Date();
                    var jsDate = now.getDate() + ' de ' + (now.getMonth() + 1) + ' de ' + now.getFullYear();
                    var logo = 'data:image/png;base64,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';

                    doc.pageMargins = [20, 60, 20, 0];
                    // Set the font size fot the entire document
                    doc.defaultStyle.fontSize = 8;
                    // Set the fontsize for the table header
                    doc.styles.tableHeader.fontSize = 9;

                    doc['header'] = (function () {
                        return {
                            columns: [
                                {
                                    image: logo,
                                    width: 80
                                },
                                {
                                    alignment: 'left',
                                    fontWeight: 500,
                                    text: 'CENTRO MÉDICO MAX VIDA, LDA',
                                    fontSize: 12,
                                    bold: true,
                                    margin: [10, 0]
                                },
                                {
                                    alignment: 'right',
                                    fontSize: 8,
                                    text: 'SECTOR DE RECURSOS HUMANOS\nRELATÓRIO DE CONTRATOS'
                                }
                            ],

                            margin: 20
                        }
                    });

                    doc['footer'] = (function (page, pages) {
                        return {
                            columns: [
                                {
                                    alignment: 'left',
                                    text: ['Impresso a: ', { text: jsDate.toString() }]
                                },
                                {
                                    alignment: 'right',
                                    text: ['Página ', { text: page.toString() }, ' de ', { text: pages.toString() }]
                                }
                            ],
                            margin: 20
                        }
                    });
                },
            }, {
                extend: 'excel',
                title: 'Relatório de contratos',

            }],
        });
    });


    $(document).ready(function () {
        $('#rescisoes-tb').DataTable({
            responsive: true,
            "language": {
                searchPlaceholder: "Pesquisar ...",
                url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese.json'
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdf',
                text: "RELATÓRIO DE PEDIDOS DE RESCISÃO DE CONTRATO",
                title: 'Relatorio de pedidos de rescisão de contratos',
                pageSize: 'LEGAL',
                download: 'open',
                filename: 'Relatorio de pedidos de rescisão de contratos',
                customize: function (doc) {
                    doc.pageMargins = [10, 10, -30, -20];
                    doc.styles.title = {
                        fontSize: '10',
                        alignment: 'center'
                    };

                    doc.styles.tableHeader.alignment = 'left';

                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    // doc.content.splice(0,1);
                    //Create a date string that we use in the footer. Format is dd-mm-yyyy
                    var now = new Date();
                    var jsDate = now.getDate() + ' de ' + (now.getMonth() + 1) + ' de ' + now.getFullYear();
                    var logo = 'data:image/png;base64,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';

                    doc.pageMargins = [20, 60, 20, 0];
                    // Set the font size fot the entire document
                    doc.defaultStyle.fontSize = 8;
                    // Set the fontsize for the table header
                    doc.styles.tableHeader.fontSize = 9;

                    doc['header'] = (function () {
                        return {
                            columns: [
                                {
                                    image: logo,
                                    width: 80
                                },
                                {
                                    alignment: 'left',
                                    fontWeight: 500,
                                    text: 'CENTRO MÉDICO MAX VIDA, LDA',
                                    fontSize: 12,
                                    bold: true,
                                    margin: [10, 0]
                                },
                                {
                                    alignment: 'right',
                                    fontSize: 8,
                                    text: 'SECTOR DE RECURSOS HUMANOS\nRELATÓRIO DE PEDIDOS DE RESCISÃO DE CONTRATO'
                                }
                            ],

                            margin: 20
                        }
                    });

                    doc['footer'] = (function (page, pages) {
                        return {
                            columns: [
                                {
                                    alignment: 'left',
                                    text: ['Impresso a: ', { text: jsDate.toString() }]
                                },
                                {
                                    alignment: 'right',
                                    text: ['Página ', { text: page.toString() }, ' de ', { text: pages.toString() }]
                                }
                            ],
                            margin: 20
                        }
                    });
                },
            }, {
                extend: 'excel',
                title: 'Relatório de pedidos de rescisão de contratos',

            }],
        });
    });

    $(document).ready(function () {
        $('#tableDatatable').DataTable({
            responsive: true,
            "language": {
                searchPlaceholder: "Pesquisar ...",
                url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese.json'
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdf',
                text: "RELATÓRIO DE REQUISIÇÕES",
                title: 'Relatorio de requisições',
                pageSize: 'LEGAL',
                download: 'open',
                filename: 'Relatorio de requisições',
                customize: function (doc) {
                    doc.pageMargins = [10, 10, -30, -20];
                    doc.styles.title = {
                        fontSize: '10',
                        alignment: 'center'
                    };

                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    // doc.content.splice(0,1);
                    //Create a date string that we use in the footer. Format is dd-mm-yyyy
                    var now = new Date();
                    var jsDate = now.getDate() + ' de ' + (now.getMonth() + 1) + ' de ' + now.getFullYear();
                    var logo = 'data:image/png;base64,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';

                    doc.pageMargins = [20, 60, 20, 0];
                    // Set the font size fot the entire document
                    doc.defaultStyle.fontSize = 8;
                    // Set the fontsize for the table header
                    doc.styles.tableHeader.fontSize = 9;

                    doc['header'] = (function () {
                        return {
                            columns: [
                                {
                                    image: logo,
                                    width: 80
                                },
                                {
                                    alignment: 'left',
                                    fontWeight: 500,
                                    text: 'CENTRO MÉDICO MAX VIDA, LDA',
                                    fontSize: 12,
                                    bold: true,
                                    margin: [10, 0]
                                },
                                {
                                    alignment: 'right',
                                    fontSize: 8,
                                    text: 'SECTOR DE ADMINISTRAÇÃO\nRELATÓRIO DE REQUISIÇÕES'
                                }
                            ],

                            margin: 20
                        }
                    });

                    doc['footer'] = (function (page, pages) {
                        return {
                            columns: [
                                {
                                    alignment: 'left',
                                    text: ['Impresso a: ', { text: jsDate.toString() }]
                                },
                                {
                                    alignment: 'right',
                                    text: ['Página ', { text: page.toString() }, ' de ', { text: pages.toString() }]
                                }
                            ],
                            margin: 20
                        }
                    });
                },
            }, {
                extend: 'excel',
                title: 'Relatório de requisições',

            }],
        });
    });

    $(document).ready(function () {
        $('#tableDatatableProlongamentos').DataTable({
            responsive: true,
            "language": {
                searchPlaceholder: "Pesquisar ...",
                url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese.json'
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdf',
                text: "RELATÓRIO DE PEDIDO DE PROLONGAMENTOS",
                title: 'Relatorio de pedido de prolongamento',
                pageSize: 'LEGAL',
                download: 'open',
                filename: 'RPP',
                customize: function (doc) {
                    doc.pageMargins = [10, 10, -30, -20];
                    doc.styles.title = {
                        fontSize: '10',
                        alignment: 'center'
                    };

                    doc.styles.tableHeader.alignment = 'left';
                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    // doc.content.splice(0,1);
                    //Create a date string that we use in the footer. Format is dd-mm-yyyy
                    var now = new Date();
                    var jsDate = now.getDate() + ' de ' + (now.getMonth() + 1) + ' de ' + now.getFullYear();
                    var logo = 'data:image/png;base64,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';

                    doc.pageMargins = [20, 60, 20, 0];
                    // Set the font size fot the entire document
                    doc.defaultStyle.fontSize = 8;
                    // Set the fontsize for the table header
                    doc.styles.tableHeader.fontSize = 9;

                    doc['header'] = (function () {
                        return {
                            columns: [
                                {
                                    image: logo,
                                    width: 80
                                },
                                {
                                    alignment: 'left',
                                    fontWeight: 500,
                                    text: 'CENTRO MÉDICO MAX VIDA, LDA',
                                    fontSize: 12,
                                    bold: true,
                                    margin: [10, 0]
                                },
                                {
                                    alignment: 'right',
                                    fontSize: 8,
                                    text: 'SECTOR DE RECURSOS HUMANOS\nRELATÓRIO DE PEDIDO DE PROLONGAMENTOS'
                                }
                            ],

                            margin: 20
                        }
                    });

                    doc['footer'] = (function (page, pages) {
                        return {
                            columns: [
                                {
                                    alignment: 'left',
                                    text: ['Impresso a: ', { text: jsDate.toString() }]
                                },
                                {
                                    alignment: 'right',
                                    text: ['Página ', { text: page.toString() }, ' de ', { text: pages.toString() }]
                                }
                            ],
                            margin: 20
                        }
                    });
                },
            }, {
                extend: 'excel',
                title: 'Relatório de pedido de prolongamentos',

            }],
        });
    });

    $(document).ready(function () {
        $('#tableDatatableJustificacoes').DataTable({
            responsive: true,
            "language": {
                searchPlaceholder: "Pesquisar ...",
                url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese.json'
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdf',
                text: "RELATÓRIO DE PEDIDO DE JUSTIFICAÇÃO DE FALTA",
                title: 'Relatorio de pedido de justificação de falta',
                pageSize: 'LEGAL',
                download: 'open',
                filename: 'RPP',
                customize: function (doc) {
                    doc.pageMargins = [10, 10, -30, -20];
                    doc.styles.title = {
                        fontSize: '10',
                        alignment: 'center'
                    };

                    doc.styles.tableHeader.alignment = 'left';
                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    // doc.content.splice(0,1);
                    //Create a date string that we use in the footer. Format is dd-mm-yyyy
                    var now = new Date();
                    var jsDate = now.getDate() + ' de ' + (now.getMonth() + 1) + ' de ' + now.getFullYear();
                    var logo = 'data:image/png;base64,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';

                    doc.pageMargins = [20, 60, 20, 0];
                    // Set the font size fot the entire document
                    doc.defaultStyle.fontSize = 8;
                    // Set the fontsize for the table header
                    doc.styles.tableHeader.fontSize = 9;

                    doc['header'] = (function () {
                        return {
                            columns: [
                                {
                                    image: logo,
                                    width: 80
                                },
                                {
                                    alignment: 'left',
                                    fontWeight: 500,
                                    text: 'CENTRO MÉDICO MAX VIDA, LDA',
                                    fontSize: 12,
                                    bold: true,
                                    margin: [10, 0]
                                },
                                {
                                    alignment: 'right',
                                    fontSize: 8,
                                    text: 'SECTOR DE RECURSOS HUMANOS\nRELATÓRIO DE PEDIDO DE JUSTIFICAÇÃO DE FALTA'
                                }
                            ],

                            margin: 20
                        }
                    });

                    doc['footer'] = (function (page, pages) {
                        return {
                            columns: [
                                {
                                    alignment: 'left',
                                    text: ['Impresso a: ', { text: jsDate.toString() }]
                                },
                                {
                                    alignment: 'right',
                                    text: ['Página ', { text: page.toString() }, ' de ', { text: pages.toString() }]
                                }
                            ],
                            margin: 20
                        }
                    });
                },
            }, {
                extend: 'excel',
                title: 'Relatório de pedido de justificação de falta',

            }],
        });
    });

    $(document).ready(function () {
        $('#tableDatatableRemuneracoes').DataTable({
            responsive: true,
            "language": {
                searchPlaceholder: "Pesquisar ...",
                url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese.json'
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdf',
                text: "RELATÓRIO DE PEDIDO DE AUMENTO DE REMUNERAÇÃO",
                title: 'Relatorio de pedido de aumento de remuneração',
                pageSize: 'LEGAL',
                download: 'open',
                filename: 'RPP',
                customize: function (doc) {
                    doc.pageMargins = [10, 10, -30, -20];
                    doc.styles.title = {
                        fontSize: '10',
                        alignment: 'center'
                    };

                    doc.styles.tableHeader.alignment = 'left';
                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    // doc.content.splice(0,1);
                    //Create a date string that we use in the footer. Format is dd-mm-yyyy
                    var now = new Date();
                    var jsDate = now.getDate() + ' de ' + (now.getMonth() + 1) + ' de ' + now.getFullYear();
                    var logo = 'data:image/png;base64,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';

                    doc.pageMargins = [20, 60, 20, 0];
                    // Set the font size fot the entire document
                    doc.defaultStyle.fontSize = 8;
                    // Set the fontsize for the table header
                    doc.styles.tableHeader.fontSize = 9;

                    doc['header'] = (function () {
                        return {
                            columns: [
                                {
                                    image: logo,
                                    width: 80
                                },
                                {
                                    alignment: 'left',
                                    fontWeight: 500,
                                    text: 'CENTRO MÉDICO MAX VIDA, LDA',
                                    fontSize: 12,
                                    bold: true,
                                    margin: [10, 0]
                                },
                                {
                                    alignment: 'right',
                                    fontSize: 8,
                                    text: 'SECTOR DE RECURSOS HUMANOS\nRELATÓRIO DE PEDIDO DE AUMENTO DE REMUNERAÇÃO'
                                }
                            ],

                            margin: 20
                        }
                    });

                    doc['footer'] = (function (page, pages) {
                        return {
                            columns: [
                                {
                                    alignment: 'left',
                                    text: ['Impresso a: ', { text: jsDate.toString() }]
                                },
                                {
                                    alignment: 'right',
                                    text: ['Página ', { text: page.toString() }, ' de ', { text: pages.toString() }]
                                }
                            ],
                            margin: 20
                        }
                    });
                },
            }, {
                extend: 'excel',
                title: 'Relatório de pedido de aumento de remuneração',

            }],
        });
    });

    $(document).ready(function () {
        $('#tableDatatableEscalas').DataTable({
            responsive: true,
            "language": {
                searchPlaceholder: "Pesquisar ...",
                url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese.json'
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdf',
                text: "RELATÓRIO DE ALTERAÇÃO DE ESCALA",
                title: 'Relatorio de alteração de escala',
                pageSize: 'LEGAL',
                download: 'open',
                filename: 'Relatorio de alteração de escala',
                customize: function (doc) {
                    doc.pageMargins = [10, 10, -30, -20];
                    doc.styles.title = {
                        fontSize: '10',
                        alignment: 'center'
                    };

                    doc.styles.tableHeader.alignment = 'left';
                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    // doc.content.splice(0,1);
                    //Create a date string that we use in the footer. Format is dd-mm-yyyy
                    var now = new Date();
                    var jsDate = now.getDate() + ' de ' + (now.getMonth() + 1) + ' de ' + now.getFullYear();
                    var logo = 'data:image/png;base64,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';

                    doc.pageMargins = [20, 60, 20, 0];
                    // Set the font size fot the entire document
                    doc.defaultStyle.fontSize = 8;
                    // Set the fontsize for the table header
                    doc.styles.tableHeader.fontSize = 9;

                    doc['header'] = (function () {
                        return {
                            columns: [
                                {
                                    image: logo,
                                    width: 80
                                },
                                {
                                    alignment: 'left',
                                    fontWeight: 500,
                                    text: 'CENTRO MÉDICO MAX VIDA, LDA',
                                    fontSize: 12,
                                    bold: true,
                                    margin: [10, 0]
                                },
                                {
                                    alignment: 'right',
                                    fontSize: 8,
                                    text: 'SECTOR DE RECURSOS HUMANOS\nRELATÓRIO DE ALTERAÇÃO DE ESCALA'
                                }
                            ],

                            margin: 20
                        }
                    });

                    doc['footer'] = (function (page, pages) {
                        return {
                            columns: [
                                {
                                    alignment: 'left',
                                    text: ['Impresso a: ', { text: jsDate.toString() }]
                                },
                                {
                                    alignment: 'right',
                                    text: ['Página ', { text: page.toString() }, ' de ', { text: pages.toString() }]
                                }
                            ],
                            margin: 20
                        }
                    });
                },
            }, {
                extend: 'excel',
                title: 'Relatório alteração de escala',

            }],
        });
    });

    $(document).ready(function () {
        $('#tableDatatableAvarias').DataTable({
            responsive: true,
            "language": {
                searchPlaceholder: "Pesquisar ...",
                url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese.json'
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdf',
                text: "RELATÓRIO DE AVARIAS",
                title: 'Relatorio de avarias',
                pageSize: 'LEGAL',
                download: 'open',
                filename: 'Relatorio de avarias',
                customize: function (doc) {
                    doc.styles.title = {
                        fontSize: '10',
                        alignment: 'center'
                    }

                    doc.content.splice(0, 1);
                    //Create a date string that we use in the footer. Format is dd-mm-yyyy
                    var now = new Date();
                    var jsDate = now.getDate() + ' de ' + (now.getMonth() + 1) + ' de ' + now.getFullYear();
                    var logo = 'data:image/png;base64,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';

                    doc.pageMargins = [20, 60, 20, 0];
                    // Set the font size fot the entire document
                    doc.defaultStyle.fontSize = 10;
                    // Set the fontsize for the table header
                    doc.styles.tableHeader.fontSize = 10;

                    doc['header'] = (function () {
                        return {
                            columns: [
                                {
                                    image: logo,
                                    width: 80
                                },
                                {
                                    alignment: 'left',
                                    fontWeight: 500,
                                    text: 'CENTRO MÉDICO MAX VIDA, LDA',
                                    fontSize: 12,
                                    bold: true,
                                    margin: [10, 0]
                                },
                                {
                                    alignment: 'right',
                                    fontSize: 8,
                                    text: 'SECTOR DE MANUTENÇÃO\nRELATÓRIO DE AVARIAS'
                                }
                            ],

                            margin: 20
                        }
                    });

                    doc['footer'] = (function (page, pages) {
                        return {
                            columns: [
                                {
                                    alignment: 'left',
                                    text: ['Impresso a: ', { text: jsDate.toString() }]
                                },
                                {
                                    alignment: 'right',
                                    text: ['Página ', { text: page.toString() }, ' de ', { text: pages.toString() }]
                                }
                            ],
                            margin: 20
                        }
                    });
                },
            }, {
                extend: 'excel',
                title: 'Relatório de avarias',

            }],
        });
    });

    $(document).ready(function () {
        $('#avarias-tb-ralatorio').DataTable({

            // "dom": 'Bfrtip',
            "paging": true,
            "autoWidth": true,
            responsive: true,
            "language": {
                searchPlaceholder: "Pesquisar ...",
                url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese.json'
            }
        });
    });

    $('.dataTables_filter input').attr("placeholder", "enter seach terms here");

    if ($("#sector_search").val() == '') {
        $('#sector_id').val('');
        console.log("sector -" + $('#sector_id').val());
    }

    $("#sector_search").keyup(function () {
        if ($("#sector_search").val() == '') {
            $('#sector_id').val('');
            console.log("sector -" + $('#sector_id').val());
        }
    });

    $("#user_search").keyup(function () {
        if ($("#user_search").val() == '') {
            $('#user_id').val('');
            console.log("user -" + $('#user_id').val())
        }
    });

    $('#spinner').hide();

    $(document).ready(function () {
        if ($("#controllerModal").val() == true) {
            // $('#modal-sections').modal('show');
            UIkit.modal($('#modal-sections')).show();;
        }
    });


    $('input:radio[name="estado"]').change(
    function(){
        if ($(this).is(':checked') && $(this).val() == 'negada') {
             console.log('Show');
            $('#justificacao_input').prop("hidden", false)
         }else{
            console.log('Hidden');
            $('#justificacao_input').prop("hidden", true)
        }
    });

    $('#mercadoria').change(function () {
        var contador = 0;
        var valor = $('#mercadoria').val();
        if (valor === 'Mercadoria') {
            $('#container_main_pessoas').prop("hidden", true)
            $('#container_pessoas').prop("hidden", true)
            $('#add_button').prop("hidden", true)
            $('#volume_input').prop("hidden", false)
            $('#volume_unidade').prop("hidden", false)

        } else if (valor === "Pessoas") {
            $('#container_pessoas').prop("hidden", false)
            $('#container_main_pessoas').prop("hidden", false)
            $('#add_button').prop("hidden", false)
            $('#volume_input').prop("hidden", true)
            $('#volume_unidade').prop("hidden", true)
            $('#add_pessoa').click(function () {
                contador++;
                $('#pessoas_container').append(
                    '<div id="row' + contador + '" class="uk-width-1-1@s uk-margin-small-top uk-grid"> <div class="uk-width-1-2@s">' +
                    '<input id="pessoas' + contador + '" name="pessoas[' + contador + ']" class="uk-input"></div>' +
                    '<div class="uk-width-1-3@s"><button class="uk-button uk-button-danger ' +
                    'uk-border-rounded btn_remove" name="remove" id="' + contador
                    + '"  type="button"><i class="fas fa-times"></i></button></div></div>'
                );
                $('input[name="pessoas[' + contador + ']"]').rules("add", {
                    required: true
                });

            });

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
        } else {
            $('#container_main_pessoas').hide();
            $('#add_button').hide();
            $('#volume_unidade').hide();
            $('#volume_input').hide();
        }
    });

    $("#formTransporte").validate({
        rules: {
            "tipo_viajem": {
                required: true
            },
            "origem": {
                required: true
            },
            "local_id": {
                required: true
            },
            "mercadoria": {
                required: true
            },
            "unidade": {
                required: function (element) {
                    return $('#mercadoria').val() === 'Mercadoria';
                }
            },
            "volume": {
                required: function (element) {
                    return $('#mercadoria').val() === 'Mercadoria';
                }
            },
            "pessoas[0]": {
                required: function (element) {
                    return $('#mercadoria').val() === 'Pessoas';
                }
            },
            "dia_saida": {
                required: true,
                date: true
            },
            "hora_saida": {
                required: true,
                time: true,
            },
            "prioridade": {
                required: true,
            },
            "tempo_viajem": {
                required: true,
            }
        },
        messages: {
            dia_saida: {
                date: 'Introduza uma data válida.'
            },
        }
    });

    $("#form_motorista").validate({
        rules: {
            "name": {
                required: true,
                minlength: 3,
            },
            "surname": {
                required: true
            },
            "phone": {
                required: true
            },
            "address": {
                required: true
            },
            "gender": {
                required: true,
            },
            "descricao": {
                required: true,
            },
        },
        messages: {
            name: {
                minlength: 'Nome inválido'
            },
        }
    });

    $("#estado-task").validate({
        rules: {
            "estado": {
                required: true,
            },
        },
    });

    $('#hora_saida').timepicker({
        timeFormat: 'HH:mm',
        use24hours: true
    });

    $('#dia_saida').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd'
    });
});
