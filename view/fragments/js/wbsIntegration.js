$(document).ready(function(){

    $( "#testeIp" ).submit(function( event ) {
       // $('#guardar_datos').attr("disabled", true);

        var parametros = $(this).serialize();
        //alert(parametros);

        $.ajax({

            url: "wbsConnection.php",
            type: "POST",
            data: parametros,
            beforeSend: function(objeto){
                $("#resultados_ajax").html("Mensagem: Carregando...");
            },
            success: function(datos){
                //alert(datos);
                $("#resultados_ajax").html(datos);
                //$('#url_base').val();
                //$('#guardar_datos').attr("disabled", false);
            }
        });
        event.preventDefault();
    });
})

function loadFaculty(page){

    var q= $("#q").val();

    $("#loaderi").fadeIn('slow');
    var url_base= $("#url_base").val();
    $.ajax({
        url:'wbsFaculty.php?action=ajax&page='+page+'&url_base='+url_base,
        beforeSend: function(objeto){
            $('#loaderf').html('<img src="../fragments/img/ajax-loader.gif"> ');
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loaderf').html('');
        }
    })
}

function loadCourses(page){
    var q= $("#q").val();
    var url_base= $("#url_base").val();

    $("#loaderc").fadeIn('slow');
    $.ajax({
        url:'wbsCourse.php?action=ajax&page='+page+'&url_base='+url_base,
        beforeSend: function(objeto){
            $('#loaderc').html('<img src="../fragments/img/ajax-loader.gif"> ');
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loaderc').html('');
        }
    })
}

function loadSubjects(page){

    var q= $("#q").val();
    var url_base= $("#url_base").val();

    $("#loaderd").fadeIn('slow');
    $.ajax({
        url:'wbsSubjects.php?action=ajax&page='+page+'&url_base='+url_base,
        beforeSend: function(objeto){
            $('#loaderd').html('<img src="../fragments/img/ajax-loader.gif"> ');
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loaderd').html('');
        }
    })
}


function loadStudents(page){

    var q= $("#q").val();

    $("#loadere").fadeIn('slow');
    var url_base= $("#url_base").val();
    $.ajax({
        url:'wbsStudents.php?action=ajax&page='+page+'&url_base='+url_base,
        beforeSend: function(objeto){
            $('#loadere').html('<img src="../fragments/img/ajax-loader.gif"> ');
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loadere').html('');
        }
    })
}

function loadSubscription(page){

    var q= $("#q").val();
    var url_base= $("#url_base").val();
    $("#loaderi").fadeIn('slow');
    $.ajax({
        url:'wbsSubscription.php?action=ajax&page='+page+'&url_base='+url_base,
        beforeSend: function(objeto){
            $('#loaderi').html('<img src="../fragments/img/ajax-loader.gif"> ');
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loaderi').html('');
        }
    })
}

function loadUser(page){

    var url_base= $("#url_base").val();
    //alert(url_base);
    $("#loaderu").fadeIn('slow');
    $.ajax({
        url:'wbsUser.php?action=ajax&page='+page+'&url_base='+url_base,
        beforeSend: function(objeto){
            $('#loaderu').html('<img src="../fragments/img/ajax-loader.gif"> ');
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loaderu').html('');
        }
    })
}

function loadWoker(page){

}