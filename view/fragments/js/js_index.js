/**
 * Created by rjose on 7/20/2016.
 */

var acess = 0, vez =0;

$(document).ready(function() {

    $('.go_offline').click(function () {
        window.location = "offlineApp/Docente_offline.html";
    });

    $('.menu_opcao li').hover(function () {

        if ($(this).val() > 0){
            $('.menu_opcao li.current').removeClass('current').css({'background':'white', 'color':'black'});
            $(this).closest('li').addClass('current');
            $(this).closest('li ').css({'background':'#E6E8FA', 'color':'blue'});
            ///console.log(''+$(this).val());*/
        }
    });


    $('#name').on('change', function () {

        if ($('#name').val() == " ") {
            $('#ac_name').text("* Obrigatorio").css('color', 'red').fadeOut(1000);
        }
    });

    $('#pass').on('change', function () {
        if ($('#pass').val() == "") {
            $('#ac_pass').text("* Obrigatorio").css('color', 'red').fadeOut(1000);
        }
    });

    $('#btnlogin').on('click', function () {
        if ($('#name').val() == " ") {
            $('#ac_name').text("* Obrigatorio").css('color', 'red').fadeOut(5000);
        }

        if ($('#pass').val() == "") {
            $('#ac_pass').text("* Obrigatorio").css('color', 'red').fadeOut(5000);
        }
        if ($('#name').val() == "" && $('#name').val() == "") {
            $('#myresultlogin').text("* Todos campos obrigatorios").css('color', 'red').fadeOut(1000);
        }
    });

    $('#confirmar_rec').click(function () {

        var nome = $('#rec_nome').val();
        var el = $('#rec_email').val();

        $.ajax({

            url: "/requestCtr/Processa_docente.php",
            type: "POST",

            data: {email: el, fullname: nome, acao: 1},
            success: function (result) {

                $('#popupLogin').popup('close');
                var texto = jQuery.parseJSON(result);
                jAlert(texto, 'Confirmação', function (r) {

                    if (r) {
                        $('.menu_opcao').hide();
                        $('.login_ctr').show();
                    }
                });
            }
        });

    });
});

/***
 * Funcoes devem estar fora do arquivo document ready
 */


/*
 * Teste par o segundo Login popup----------------------------*/
function login_online(){


    var un = $('#name').val();
    var pw = $('#pass').val();
    $(".result_login").show()

    if (un != ""){

        $.ajax({

            url: "requestCtr/Processa_autenticacao.php",
            type : "POST",
            data: {username:un,password:pw, acao: 2},
            beforesend:function(){
                $(".result_login").html('Validando os Dados')
                    .css({'font-size':'18px','color':'blue'});
            },
            success: function(result){
                $(".result_login").html(result)
                    .css({'font-size':'18px','color':'red'});
            }
        });

    }else{

        $('#name').css({'border':'2px solid blue '});
        $(".result_login").html("Deve prencher todos os campos vazios")
            .css({'font-size':'14px','color':'red','font-weight':'bold'});
    }
};