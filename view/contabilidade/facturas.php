<?php
	/*-------------------------
	Autor: rjose
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Sistema | Sistema de Pautas";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("../layouts/head.php");?>

  </head>
  <body>

    <div class="container">
		<div class="panel panel-info">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<a  href="nueva_factura.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Novo Pagamento</a>
			</div>
			<h4><i class='glyphicon glyphicon-credit-card'></i> Gerir Pagamentos</h4>
		</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Estudante Pagamento</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nome do aluno" onkeyup='load(1);'>
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

	<script type="text/javascript" src="../fragments/js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="../fragments/js/facturas.js"></script>
	
  </body>
</html>