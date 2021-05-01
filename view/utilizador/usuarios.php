<?php
	/*-------------------------
	Autor: rjose
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: index.php");
		exit;
    }

	/* Connect To Database*/

	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="active";	
	$title="Software| Pautas";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("../layouts/head.php");
	include("form_usuarios.php");

	?>
  </head>
  <body>

    <div class="container">
		<div class="panel panel-info">
		<div class="panel-heading">
		    <div class="btn-group pull-right">

				<button type='button' class="btn btn-default" data-toggle="modal" data-backdrop="false" data-target="#modal-usuario">
                    <span class="glyphicon glyphicon-plus" ></span> Adiccionar</button>
			</div>

			<h4><span class="glyphicon glyphicon-magnet"></span>tilizadores</h4>
		</div>

			<div class="panel-body">
			<?php

			include("cambiar_password.php");

			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Nome:</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nome" onkeyup='load(1);'>
							</div>

							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
						
			</div>
		</div>

	</div>
	<hr>
	<?php
	include("../layouts/footer.php");
	?>
	<script type="text/javascript" src="../fragments/js/usuarios.js"></script>

  </body>
</html>
<script>

$( "#guardar_usuario" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();

	 $.ajax({
			type: "POST",
			url: "nuevo_usuario.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensagem: Carregando...");
			  },
			success: function(datos){
                //alert(datos);
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_usuario" ).submit(function( event ) {
  $('#actualizar_datos2').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "editar_usuario.php",
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


	function get_user_id(id){
		$("#user_id_mod").val(id);
	}

	function get_user_data(id){

			$("#mod_id").val(id);

			$("#fullname").val($("#fullname"+id).val());
			$("#user_role").val($("#user_role"+id).val());
			$("#username").val($("#user_name"+id).val());
			$("#email").val($("#user_email"+id).val());
            $("#user_curso").val($("#user_curso"+id).val())

			//alert($("#user_email"+id).val());
		}


function enable_codigo_aluno(item){
    if(item == 1){
        $('.nr_mec').show('slow');
        $('.ano_doc').hide('slow');
    }else{
        $('.nr_mec').hide('slow');
        $('.ano_doc').show('slow');
    }
}

var domains = ["unilurio", "", ""];

function validateDomainEmail(me) {
    $('.vemail').html("@unilurio.ac.mz");


}
</script>