		$(document).ready(function(){
			load(1);
            $('.nr_mec').hide();
            $('.ano_doc').hide();

            $( "#editar_password" ).submit(function( event ) {
                $('#actualizar_datos3').attr("disabled", true);

                var parametros = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "editar_password.php",
                    data: parametros,
                    beforeSend: function(objeto){
                        $("#resultados_ajax3").html("Mensagem: Carregando...");
                    },
                    success: function(datos){
                        $("#resultados_ajax3").html(datos);
                        $('#actualizar_datos3').attr("disabled", false);
                        load(1);
                    }
                });
                event.preventDefault();
            })


		});

        function get_user_id(id){
            $("#user_id_mod").val(id);
        }

		function load(page) {
            var q = $("#q").val();
            $("#loader").fadeIn('slow');
            $.ajax({
                url: 'buscar_usuarios.php?action=ajax&page=' + page + '&q=' + q,
                beforeSend: function (objeto) {
                    $('#loader').html('<img src="../fragments/img/ajax-loader.gif"> Carregando ...');
                },
                success: function (data) {
                    $(".outer_div").html(data).fadeIn('slow');
                    $('#loader').html('');

                }
            })
        }
		
			function eliminar (id)
		{
			var q= $("#q").val();
		if (confirm("Deseja realmente eliminar este utilizador")){
		$.ajax({
        type: "GET",
        url: "./ajax/buscar_usuarios.php",
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
		
		
		
		

