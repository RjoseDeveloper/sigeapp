<?php
require_once '../../dbconf/getConection.php';
$db = new mySQLConnection();
$con = $db->openConection();
?>
	<!-- Modal -->
	<div class="modal fade" id="mdl_editar_aluno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header alert-warning">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar Dados</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_aluno" name="editar_aluno">
			<div id="resultados_ajax2"></div>
			<div class="form-group">
				<label for="firstname2" class="col-sm-3 control-label">Nome Completo:</label>
				<div class="col-sm-8">
				  <input type="text"  disabled class="form-control" id="fullname" name="fullname" placeholder="Nome completo" required>
				  <input type="hidden" id="idaluno" name="idaluno">
				</div>
			  </div>

			  <div class="form-group">
				<label for="username" class="col-sm-3 control-label">Nr. Mecanografico:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nrmec" name="nrmec" placeholder="nr. mec" required>
				</div>
			  </div>

			  <div class="form-group">
				<label for="nome" class="col-sm-3 control-label">Nome:</label>
				<div class="col-sm-8">

                    <input type="text"  class="form-control" id="nomes" name="nomes" placeholder="nome .." required>
                </div>
			  </div>

                <div class="form-group">
                    <label for="apelido" class="col-sm-3 control-label">Apelido:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="apelidos" name="apelidos" placeholder="apelido .." required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="data_nasc" class="col-sm-3 control-label">B.I / Recibo.:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="bi_recibo" name="bi_recibo" placeholder="BI. /Recibo">
                    </div>
                </div>
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar</button>
		  </div>

		  </form>

		</div>
	  </div>
	</div>
