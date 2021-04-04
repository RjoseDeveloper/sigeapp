/**
 * Created by Raimundo Jose on 1/11/2019.
 */


$(document).ready(function(){

    $('.list_view_encarregado').on('click','li', function(){
        $('#auto_encarregado').val($(this).text());
        $('.list_view_encarregado').hide();
    });
    $('.timer_ctr').hide();

});

function listar_Disciplinas(id){
    $.ajax({
        url:"../../requestCtr/Processa_docente.php",
        type:'POST',
        data:{id:id, acao:10},
        success:function(data){
            $('.list_disciplinas').html(data)
        }
    });
}

function pesquisar(item, ctr){
    // var inp = $("#auto_aluno");

    $.ajax({

        url: '../../controller/FormandoCtr.php',
        data: {acao: 10, q:item, ctr:ctr},
        success: function (data) {

            $('.list_view_encarregado').show();
            $('.list_view_encarregado').html(data);
        }

    });

}

function obter_estudante_nota(item, ctr){

    $('#campo_utilizador').val(item);
    $('#user_id').val(item);
}

function modify_user_pass(user, url){

    $("#user_id_mod").val(user);

    $( "#editar_password" ).submit(function( event ) {
        $('#actualizar_datos3').attr("disabled", true);

        var parametros = $(this).serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: parametros,
            beforeSend: function(objeto){
                $("#resultados_ajax3").html("Mensagem: Carregando...");
            },
            success: function(datos){
                $("#resultados_ajax3").html(datos);
                $('#actualizar_datos3').attr("disabled", false);

            }
        });
        event.preventDefault();
    })

}

