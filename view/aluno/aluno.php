<?php
	/*-------------------------
	Autor:rjose
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: index.php");
		exit;
        }

	/* Connect To Database*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("../layouts/head.php");?>
  </head>
  <body>



	
    <div class="container col-xl-9">
	<div class="panel panel-infox">
		<div class="panel-headingx">
            <hr>

		    <div class="pull-right">
                <a data-toggle="modal" class="btn btn-primary" data-backdrop="false" data-target="#form_aluno">
                    <span class="glyphicon glyphicon-plus" ></span>  Adiccionar</a>
			</div>

		</div>
		<div class="panel-bodyx">

			<?php
				include("modal_aluno.php");
				include("modal_encarregado.php");
                include("list_encarregado.php");
                include("save_editar_aluno.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Codigo:</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nome do Estudante" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
				
			</form>
				<div id="loader"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("../layouts/footer.php");
	?>
	<script type="text/javascript" src="../fragments/js/aluno.js"></script>

  <script type="text/javascript">
      $(document).ready(function(){

          $("#registar_encarregado").submit(function( event ) {
              $('#btn_save_encarregado').attr("disabled", true);
              var parametros = $(this).serialize();

              var nc = $("#fullname").val();
              var cel = $('#celular').val();
              var gr = $('#parentesco').val();
              var ne = $('select#nivel_ac').val();
              var age = $('#idade').val();
              var work = $('#local_work').val();
              var al = $("#campo_frm").val();
              var doc = $('#doc').val();

              $.ajax({

                  type: "POST",
                  url: "encarregado/novo_encarregado.php",
                  data: {fullname:nc,celular:cel,parentesco:gr,
                      nivel:ne, idade:age,work:work, idaluno:al,doc:doc},

                  beforeSend: function(objeto){
                      $("#resultados_ajax_encarregado").html("Mensagem: Enviando...");
                  },
                  success: function(datos){

                      $("#resultados_ajax_encarregado").html(datos);
                      $('#btn_save_encarregado').attr("disabled", false);
                  }
              });
              event.preventDefault();
          });

          $('#editar_aluno').submit(function (event) {

              var parametros = $(this).serialize();

              $.ajax({
                  type: "POST",
                  url: "modal_editar_aluno.php",
                  data: parametros,

                  beforeSend: function(objeto){
                      $("#resultados_ajax2").html("Mensagem: Enviando...");
                  },
                  success: function(datos){

                      $("#resultados_ajax2").html(datos);
                     // $('#btn_save_encarregado').attr("disabled", false);
                      load(1);
                  }
              });
              event.preventDefault();

          });

      })
  </script>

  </body>
</html>
