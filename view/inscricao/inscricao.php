<?php
if (!isset($_SESSION['username'])) {
    include('../ajax/is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
    /* Connect To Database*/
}

require_once '../../dbconf/getConection.php';
require_once '../../Query/DocenteSQL.php';
$db = new mySQLConnection();
$con = $db->openConection();
$cdocente = new DocenteSQL();
	$active_facturas="";
	$active_productos="";
	$active_clientes="active";
	$active_usuarios="";	
	$title="Clientes | Sistema de Pautas";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("../layouts/head.php");?>

  </head>
  <body>

    <div class="container">

			<form class="form-horizontal" role="form" id="datos_cotizacion">
						<div class="form-group row">

                            <div class="col-md-3" style="color: #f95e0f; font-weight: bold">

                               LISTA DE MEMBROS OU DISCIPLINAS
                            </div>

                            <div class="col-md-5">
                                <select class="form-control" data-style="btn-primary"
                                        onchange="buscar_disciplina(this.value)" id="curso_id" name="curso_id" required="">

                                    <option value="#">--Select Curso --</option>
                                    <?php
                                    if ($_SESSION['tipo']!='docente'){
                                        $sql = "select * from curso";
                                    }else{
                                        $sql = $cdocente->listCurso($_SESSION['id']); }
                                    $resut = mysqli_query($con,$sql);
                                    $t=1;
                                    while ($row = mysqli_fetch_assoc($resut)){?>

                                        <option value="<?php echo $row['idcurso'] ?>">
                                            <?php echo utf8_encode($row['descricao']) ?></option>
                                    <?php }  ?>

                                </select>
                                <span class="dinamic_disp"></span><br>
                                <div class="pull-right">

                                <button type="button" class="btn btn-success" onclick="load(1)">
                                    <span class="glyphicon glyphicon-search" ></span>&nbsp;Pesquisar</button>

                                <?php if ($_SESSION['tipo']!='estudante'){?>

                                <button type="button" class="btn btn-primary" id="btn_add_aluno" onclick="get_paramenter();"
                                        data-toggle="modal" data-backdrop="false" data-target="#form-inscricao">
                                    <span class="glyphicon glyphicon-plus-sign "></span> Adicionar Estudante</button>

                                </div>

                            </div>


                            <div class="col-md-4">
                                <input type="hidden" name="q" id="q" onkeyup="load(1);">


                                <?php } ?>
                            </div>

						</div>
			</form>
        <hr>

				<div id="results"></div><!-- Carga los datos ajax -->
				<div class='outer_divs'></div><!-- Carga los datos ajax outer_divs -->
		 
	</div>

    <script type="text/javascript" src="../fragments/js/js_inscricao.js"></script>
    <?php include 'inscricao_modal.php' ?>
  </body>
</html>

<script>

    $("#btn_add_aluno").attr("disabled", true);
    function lista_avaliacao_doc() {

    }

    function load(page) {

        var curso = $('#curso_id').val();
        var aluno = $('#aluno').val();
        var disciplina = $('#disciplinas_docente').val();
        //alert(disciplina + " / " + curso);
        if (curso > 0 && disciplina > 0) {


            var q = $("#q").val();
            $("#loaders").fadeIn('slow');

            $.ajax({
                url: '../inscricao/buscar_inscricao.php',

                data: {
                    action: 'ajax',
                    page: page,
                    q: q,
                    curso: curso,
                    aluno: aluno,
                    disciplina: disciplina
                },
                beforeSend: function (objeto) {
                    $('#loaders').html('<img src="../fragments/img/ajax-loader.gif"> Carregando...');
                },
                success: function (data) {
                    $(".outer_divs").html(data).fadeIn('slow');
                    $('#loaders').html('');
                }
            })
        }

    }

</script>


