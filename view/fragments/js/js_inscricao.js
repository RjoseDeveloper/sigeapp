/**
 * Created by SIGP on 8/12/2019.
 */

$(document).ready(function(){
    // load(1);

    $('.list_view_studant').on('click','li', function(){
                //$('#auto_encarregado').inner;
                var text = $(this).text();
               $('#auto_encarregado').val(""+text);
                $('.list_view_studant').hide();
            });

    $( "#save_inscricao" ).submit(function( event ) {
        $('#btn_inscricaov').attr("disabled", true);
        var parametros = $(this).serialize();
        //alert(parametros);
        $.ajax({
            type: "POST",
            url: "../../controller/FormandoCtr.php?acao=4",
            data: parametros,
            beforeSend: function(objeto){
                $(".results_inserted").html("Mensagem: Carregando...");
            },
            success: function(datos){
                $(".results_inserted").html(datos);
                $('#btn_inscricaov').attr("disabled", false);
                load(1);
            }
        });
        event.preventDefault();
    });
    });

function get_paramenter(){
    $('#disciplina').val($('#disciplinas_docente').val());
    $('#curso').val($('#curso_id').val());
    lista_turmas($('#curso_id').val());
}

function lista_turmas(item) {}

function load(page){

    //alert(page);

    var curso = $('#curso').val();
    var aluno = $('#aluno').val();
    var disciplina = $('#disciplinas_docente').val();
    //alert(disciplina+" / "+curso);

        var q = $("#q").val();
        $("#loaders").fadeIn('slow');

        $.ajax({
            url: '../inscricao/buscar_inscricao.php',

            data: {
                action: 'ajax',
                page: page,
                q: q,
                curso: curso,
                aluno: aluno,
                disciplina:disciplina
            },
            beforeSend: function (objeto) {
                $('#loaders').html('<img src="../fragments/img/ajax-loader.gif"> Carregando...');
            },
            success: function (data) {
                $(".outer_divs").html(data).fadeIn('slow');
                $('#loaders').html('');
            }
        })
}

/***
 * Permite buscar dados de formandor por periodo de inscricao
 */
function table_frm_periodos(item){

    var curso = $('#c_curso').val();
    load_table_matricula(curso,item,0,8,0,0);

}

function table_frm_estudante(item){

    var curso = $('#c_curso').val();
    load_table_matricula(curso,0,0,8,3,0);

}

function table_frm_disciplina(item){
    var curso = $('#c_curso').val();
    load_table_matricula(curso,0,item,8,1,0);
}

function load_table_matricula(curso,turma,discplina,acao, ctr, aluno){
    $.ajax({
        url: '../../controller/FormandoCtr.php',
        data: {acao: acao, curso: curso, turma: turma, disciplina:discplina,aluno:aluno, ctr:ctr},
        success: function (dados) {
            $('.tbl_alunos').html(dados);

        }
    });
}

        /***

        Funcao buscar aluno utilizador
        */

 function pesquisar(item, ctr){

            $.ajax({
                url: '../../controller/FormandoCtr.php',
                data: {acao: 10, ctr:ctr},
                success: function (data) {

                    $('.list_view_studant').show();
                    $('.list_view_studant').html(data);
                }
            });
        }
        /***
            find aluno  id
        */

          function obter_estudante_nota(item, ctr){
            $('#aluno').val(item);
        }
function buscar_disciplina(c){

    //$('.nome_curso').html($('select#curso_pauta > option:selected').html());

    $.ajax({
        url: "../../requestCtr/Processa_cadastro_pauta.php",
        type: "POST",
        data: {curso:c, acesso:5},
        success: function (results) {
            $('.dinamic_disp').html(results);
        }
    });
    $("#btn_add_aluno").attr("disabled", false);
}