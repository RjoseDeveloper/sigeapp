		$(document).ready(function(){
			load(1);

            var curso = $('#curso').val();
            lista_turmas(curso);
		});

        function get_aluno_dados(id){

            $('#mdl_editar_aluno').modal();

            $("#idaluno").val(id);
            $("#fullname").val($("#fullname"+id).val());
            $("#nrmec").val($("#nrmec"+id).val());
            $("#nomes").val($("#nome"+id).val());
            $("#apelidos").val($("#apelido"+id).val());
            $("#bi_recibo").val($("#bi_recibo"+id).val());

        }

        function load(page){
            //alert(page);

            var q= $("#q").val();
            if (q !='undefined') {
                $("#loader").fadeIn('slow');
                $.ajax({
                    url: 'buscar_alunos.php?action=ajax&page=' + page + '&q=' + q,
                    beforeSend: function (objeto) {
                        $('#loader').html('<img src="../fragments/img/ajax-loader.gif"> Carregando...');
                    },
                    success: function (data) {

                        $(".outer_div").html(data).fadeIn('slow');
                        $('#loader').html('');

                    }
                })
            }

        }

        function get_item_val(item){
            $('#campo_frm').val(item);
        } /// atribuir um id aluno campo oculto no cadastro de dados estudante

        /***
         * Metodo listar turmas
         * @param id
         */
        function lista_turmas(id){

            $.ajax({
                url:"../../controller/FormandoCtr.php",
                data:{acao:9, idcurso:id, ctr:0},
                success:function(data){
                    $('#turma').hide();
                    $('.list_turma').html(data);
                }
            });

        }

        function listar_Encarregado(id){

            $(this).css('background','red');

            $.ajax({
                url:"../../controller/FormandoCtr.php",
                data:{id:id, acao:14},
                success:function(data){
                    $('.list_encarregado').html(data)
                }
            });

        }
        /***
         *
         * @param id do Aluno
         */
		function eliminar (id)
		{

			var q= $("#q").val();
		if (confirm("Realmente desejas eliminar este aluno")){
		$.ajax({
        type: "GET",
        url: "./ajax/buscar_alunos.php",
        data: "id="+id,"q":q,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensagem: Carregando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		load(1);
		}
			});
		}
		}


        /***
         * Metodo que permite buscar distrito ao fazer click na caixa de seleccao provincia
         */

        function buscar_distrito(item){

            var html = '';
            $.ajax({
                url:"../../controller/FormandoCtr.php?acao=1&prov="+item,
                success:function(sms){

                    $('.first_select').hide();
                    $('.lista_distritos').html(sms);
                }
            })
        }

        /***
         * Funcao autocomplete estudante
         */

        function do_autocomplete(item, ctr){

            $('.list_view_frm2').html("");
            $('.list_view_frm1').html("");

            if (item.length >= 3) {

                var row = "";

                $.ajax({
                    url: "../../controller/FormandoCtr.php?acao=5",
                    dataType: "json",
                    data: {keyword: item},
                    success: function (result) {

                        for (var i = 0; i < result.length; i++) {
                            if (ctr !=1){

                                row += '<li class="list-group-item list_item" value="' + result[i].idformando +
                                '" onClick="get_formando_ID(this.value);">'+ result[i].fullname + '</li>';
                                $('.list_view_frm2').show();
                                $('.list_view_frm2').html(row);

                            }else{

                                row += '<li class="list-group-item list_item" value="' + result[i].idformando +
                                '" onClick="get_formando_data(this.value);">'+ result[i].fullname + '</li>';
                                $('.list_view_frm1').show();
                                $('.list_view_frm1').html(row);
                            }

                            $('.nr_bi').html(result[i].bi_recibo).css({'color':'blue','font-weight': 'bold', 'font-size': '18px'});
                            $('#campo_frm').val(result[i].idformando);

                        }

                    }
                }); // fim primeiro ajax
            }
        }
        /****
         * Funcao aplicado ao evento onClick na listview
         */
        function get_formando_ID(item){

            $('.list_view_frm').hide();
            $('#campo_frm').val(item);

            var curso = $('#curso_ins').val();
            $.ajax({
                url: '../../controller/FormandoCtr.php',
                data: {acao: 10, formando: item, curso: curso},
                dataType:'json',
                success: function (data) {
                    $('.sms_report').html(data);
                }
            });

        }

        function get_formando_data(item){

            //alert ('get data');
            $.ajax({
                url: '../../controller/FormandoCtr.php',
                data: {acao: 13, idfrm: item},
                dataType:'json',
                success: function (data) {
                    for(var i =0; i< data.length; i++){
                        $('#nome').val(data[i].fullname);
                    }
                }
            });
        }
        /***
         * Funcao que permite obter lista de peridos passados o curso por parametro
         */

        function buscar_periodos(item, ctr) {
            var acao = '';

            $('#c_curso').val(item);
            load_table_matricula(item,0,0,8,3,0);

            if (ctr == 0) // acao 6 e 9 estao definidas na pagina cadastroFormandoCtr deve os periodos dos cursos respectivos.
                acao = 6;
            else
                acao = 9;

            $.ajax({

                url: '../../controller/FormandoCtr.php',
                data:{acao:acao,idcurso:item, ctr:1},

                success: function (sms) {

                    if (ctr == 0){
                        $('.first_select').hide();
                        $('.periodos_dymc').html(sms);
                    }else{
                        $('.select_pesquisa').hide();
                        $('.periodos_pesquisa').html(sms);
                    }
                }
            });



            $.ajax({
                url: '../controller/FormandoCtr.php',
                data:{acao:10,curso:item,formando: $('#campo_frm').val()},
                dataType:'json',
                success: function (sms) {

                    for(var i =0; i<sms.length; i++){
                        $('#prestacao').val(sms[i].prestacao);
                        $('#taxa_curso').val(sms[i].taxa);
                        $('#taxa_pagar').val(sms[i].diferenca).css({'color':'red'});
                    }
                }
            });

            $('#btn_upate_pagamento').click(function(){
                var valor = $('#taxa_pagar').val();
                var idf  = $('#campo_frm').val();
                $.ajax({

                    url: '../controller/FormandoCtr.php',
                    data:{acao:12,formando:idf, valor:valor },
                    success: function (sms) {
                        $('.msg_sucesso').html(sms);
                    }
                });

            });
        }

        /***
         * Permite guardar o identificador dinamico do campo periodos
         * @param item
         */
        function guardar_id_periodo(item){

            $('#campo_periodo').val(item); // campo oculto na sessao inscricao
        }

        function imprimir_ficha(){

            var idfrm = $('#user').val();
            var idcurso = $('#curso').val();
            var turma = $('#turma_x').val();

            //alert(idcurso);

            $('#btn_print').attr("href","../reports/ficha_inscricao.php?curso="+idcurso+"&formando="+idfrm).attr("target","conteudo");
        }

        function desable_exame_especial(aluno, inscricao){
            //alert(inscricao);
            $cont=2;
            $.ajax({
                type: "POST",
                url: "../../controller/FormandoCtr.php?acao=15&idaluno=" +aluno + '&idinsc='+inscricao + '&controlo='+ $cont,
                data: "idaluno"+aluno,"idinsc":inscricao, "controlo":$cont,
                beforeSend: function(objeto){
                    $(".msg_sucesso").html("Mensagem: Carregando...");
                },
                success: function(datos){
                    $(".msg_sucesso").html(datos);
                }
            });
            event.preventDefault();
        }


        function enable_exame_especial(aluno, inscricao){
            //alert(inscricao);
            $cont=1;
            $.ajax({
                type: "POST",
                url: '../../controller/FormandoCtr.php?acao=15&idaluno=' +aluno + '&idinsc='+inscricao + '&controlo=' + $cont,
                data: "idaluno"+aluno,"idinsc":inscricao, "controlo":$cont,
                beforeSend: function(objeto){
                    $(".msg_sucesso").html("Mensagem: Carregando...");
                },
                success: function(datos){
                    $(".msg_sucesso").html(datos);
                }
            });
            event.preventDefault();
        }



        /***
        * Funcao que permite obter lista de peridos passados o curso por parametro
        */

        function buscar_periodos(item, ctr) {
            var acao = '';

            $('#c_curso').val(item);
            load_table_matricula(item,0,0,8,3,0);

            if (ctr == 0) // acao 6 e 9 estao definidas na pagina cadastroFormandoCtr deve os periodos dos cursos respectivos.
                acao = 6;
            else
                acao = 9;

            $.ajax({

                url: '../../controller/FormandoCtr.php',
                data:{acao:acao,idcurso:item, ctr:1},

                success: function (sms) {

                    if (ctr == 0){
                        $('.first_select').hide();
                        $('.periodos_dymc').html(sms);
                    }else{
                        $('.select_pesquisa').hide();
                        $('.periodos_pesquisa').html(sms);
                    }
                }
            });

            $.ajax({
                url: '../controller/FormandoCtr.php',
                data:{acao:10,curso:item,formando: $('#campo_frm').val()},
                dataType:'json',
                success: function (sms) {

                    for(var i =0; i<sms.length; i++){
                        $('#prestacao').val(sms[i].prestacao);
                        $('#taxa_curso').val(sms[i].taxa);
                        $('#taxa_pagar').val(sms[i].diferenca).css({'color':'red'});
                    }
                }
            });

            $('#btn_upate_pagamento').click(function(){
                var valor = $('#taxa_pagar').val();
                var idf  = $('#campo_frm').val();
                $.ajax({

                    url: '../controller/FormandoCtr.php',
                    data:{acao:12,formando:idf, valor:valor },
                    success: function (sms) {
                        $('.msg_sucesso').html(sms);
                    }
                });

            });
        }






	
		
		

