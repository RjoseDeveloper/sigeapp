		$(document).ready(function(){
			load(1);

$( "#editar_usuario" ).submit(function( event ) {
  $('#actualizar_datos2').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "editar_professor.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados_ajax2").html("Mensagem: Carregando...");
              },
            success: function(datos){
            $("#resultados_ajax2").html(datos);
            $('#actualizar_datos2').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})


        }); /// FIM LOAD DOCUMENT

        
    function obtener_datos(id){
            var nombres = $("#nombres"+id).val();
            var apellidos = $("#apellidos"+id).val();
            var usuario = $("#usuario"+id).val();
            var email = $("#email"+id).val();
            
            $("#mod_id").val(id);
            $("#firstname2").val(nombres);
            $("#lastname2").val(apellidos);
            $("#user_name2").val(usuario);
            $("#user_email2").val(email);
            
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
		function load(page){

            var q= $("#q").val();
            $("#loader").fadeIn('slow');
            $.ajax({
                url:'buscar_disciplina.php?action=ajax&page='+page+'&q='+q,
                beforeSend: function(objeto){
                    $('#loader').html('<img src="../fragments/img/ajax-loader.gif"> Carregando...');
                },
                success:function(data){
                    $(".outer_div").html(data).fadeIn('slow');
                    $('#loader').html('');
                }
            })
        }

		function eliminar (id) {
            var q= $("#q").val();

		if (confirm("Realmente desejas eliminar esta disciplina")){
		$.ajax({
        type: "GET",
        url: "buscar_disciplina.php",
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
		
		
		
		

