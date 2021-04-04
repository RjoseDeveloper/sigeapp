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
    require_once '../../dbconf/getConection.php';
    $db = new mySQLConnection();
    $con = $db->openConection();

	$active_usuarios="active";	
	$title="Software| Pautas";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("../layouts/head.php");?>
  </head>
  <body>

		<div class="panel panel-infox">
		<div class="panel-headingx">
			<h4><span class=""></span>ÁREA DE DISCIPLINAS</h4>
		</div>			
			<div class="panel-bodyx">

			<?php
			include("../disciplina/Disciplina.php");
			?>

			<form class="form-horizontal" role="form" id="datos_cotizacion">

                <div class="form-group row">
                    <label for="q" class="col-md-2 control-label">Nome:</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="q" placeholder="Nome" onkeyup='load(1);'>
                        <span id="loader"></span>
                    </div>
                </div>
			</form>

				<div id="resultados_ajax"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
						
			</div>
		</div>

	<script type="text/javascript" src="../fragments/js/disciplina.js"></script>

  </body>
</html>

<script type="text/javascript">

	
    $( "#guardar_disciplina" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);

 var parametros = $(this).serialize();
//
// alert(parametros);

     $.ajax({
            type: "POST",
            url: "nova_disciplina.php",
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
});
    
</script>
