<?php

session_start();
if (!isset($_SESSION['username'])){?>
    <script>
        window.location="../../index.php";
    </script>

<?php }

require_once("../../Query/AllQuerySQL.php");
require_once('../../dbconf/getConection.php');
require_once '../../Query/DocenteSQL.php';

$query = new QuerySql();
$idDoc = $query->getDoc_id($_SESSION['username']);
$db = new mySQLConnection();
$con = $db->openConection();
$sql_docente = new DocenteSQL();

$teste = FALSE;
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Nota</title>

    <?php include '../../view/layouts/head.php' ?>

    <script  src="../fragments/js/js_function.js" type="text/javascript"></script>
    <script src="../fragments/js/js_registo_academico.js" type="text/javascript" charset="utf-8"> </script>
    <script  src="../fragments/js/js_editar_pauta.js" type="text/javascript"></script>
    <script type="text/javascript" src="../fragments/js/el_relatorio.js"></script>
    <script type="text/javascript" src="../fragments/js/js_inscricao.js"></script>

    <style>

        .ul_li_item li {
            cursor: pointer;
            font-size: 13px;
        }

        .modal_header{
            background-color: #ccccff; border: none;
            padding-bottom: -1em;
        }

    </style>

</head>
<body>

<div class="container" style="margin-top: 1em">

<!--    <h4 class="nome_e alert alert-success">Actualização de Dados e Relatorios <span class="pull-right"> &times</></h4>-->
    <div class="jumbotronx">
        <!--------   Mmostra lista de disciplina de um docente ----------------->

        <form class="form-horizontal" role="form" id="datos_cotizacion">
            <div class="form-group row">
                <div class="col-md-3" style="color: #f95e0f; font-weight: bold">RELATORIOS POR DISCIPLINA</div>
                <div class="col-md-5">
                    <select class="form-control" data-style="btn-primary"
                            onchange="buscar_disciplina(this.value)" id="idcurso" name="idcurso" required="">
                        <option value="#">--Select Curso --</option>
                        <?php
                        if ($_SESSION['tipo']!='docente'){
                            $var = "select * from curso";
                        }else{
                            $var = $sql_docente->listCurso($_SESSION['id']);
                        }
                        $resut = mysqli_query($con,$var);
                        $t=1;
                        while ($row = mysqli_fetch_assoc($resut)){?>

                            <option value="<?php echo $row['idcurso'] ?>">
                                <?php echo utf8_encode($row['descricao']) ?></option>
                        <?php }  ?>

                    </select>

                    <span class="dinamic_disp"></span><br>
                    <div class="pull-right">

                        <button type="button" class="btn btn-success" value="mf" onclick="mostrar_relatorio(this.value)">
                            <span class="glyphicon glyphicon-reports" ></span>&nbsp;Mapa de Frequencia</button>

                        <button type="button" class="btn btn-primary" value="rs" onclick="mostrar_relatorio(this.value)">
                            <span class="glyphicon glyphicon-pinter" ></span>&nbsp;Relatorio Semestral </button>
                        <!--
                            rs -- relatorio semestral
                            mf --- mapa de frequencia
                        -->
                    </div>
                </div>
                <div class="col-md-4">
                    &nbsp;
                </div>

            </div>
        </form>

    </div>
    <div align="center" class="sucesso"></div>
    <input type="hidden" value="" id="idpauta"/>
    <div class="mostrar_avaliacao"></div>
    <br>
</div>

<div class="pautas_freq container"></div>

</div> <!---  container -->
<!--------Popoup modal-------->

<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="popup_editar_nota" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modal_header ">
                    <div class="modal-header modal_header">
                        <button type="button" style=" border: none" data-mini="true" data-inline="true"
                                class="close" data-dismiss="modal">&times;</button>
                        <h4 class="resumo" style="text-align: left; margin-top: -.3em">Adicção ou Remoção de Pautas</h4>
                    </div>
                </div>

                <div class="container"><br>

                    <h5 class="" style="text-align: left; color: green" class="text_include"></h5>
                    <div style="color: green" class="included" align="center"></div>

                    <input class="form-control" type="search" name="text_estudante" value="" id="text_estudante"
                           placeholder="Buscar estudante ... none"/><br>
                    <div class="list-group" id="resultados_e"></div>

                    <input class="form-control" type="text" name="text_nota" value="" id="text_nota" placeholder="Atribuir Nota..."/><br>
                    <textarea class="form-control" height="50" name="txtmotivo" id="txtmotivo" rows="10" cols="40"
                              placeholder="Escreva o motivo da inclusão ..." ></textarea>

                </div>

                <div class="modal-footer">

                    <div class="ctr_disp"></div>
                    <button id="btn_salvar" class="btn btn-success">Incluir <span class="glyphicon glyphicon-plus"></span></button>
                    <button id="btn_delete" class="btn btn-warning">Excluir <span class="glyphicon glyphicon-remove"></span></button>

                </div> <!-- fim Modal footer  -->
            </div> <!-- fim Modal content-->
        </div> <!-- fim Modal dialog -->
    </div> <!-- fim Modal fade-->
</div> <!-- fim Modal container-->

<!----------------------------------------------- Modal Relatorio Final -------->

<div class="container">
    <!-- Modal -->
    <div class="modal fade model-lg" id="relatorio_f" role="dialog">

        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modal_header">
                    <button type="button"  style=" border: none" data-mini="true" data-inline="true"
                            class="close" data-dismiss="modal">&times;</button>

                    <h4 style="color:green" class="resumo"></h4>
                </div>

                <div class="modal-body" ><br>

                    <input class="form-control" type="text" name="txtnomedisp" autofocus="true" value="" id="txtnomedisp" placeholder="Nome detalhado da Disciplina ..."/>
                    <br>
                    <textarea class="form-control" name="txtmetaplano" id="txtmetaplano"  placeholder="Cumprimento do Plano ..." ></textarea>
                    <br>
                    <textarea class="form-control" name="txtdetalhes" id="txtdetalhes"  placeholder="Sobre Avaliações ..." ></textarea>
                    <br>
                    <textarea class="form-control" name="txtconstrg"  id="txtconstrg"  placeholder="Constrangimentos na Disciplina ..." ></textarea>
                    <br>
                    <textarea  class="form-control" name="txtdesafios" id="txtdesafios"  placeholder="Perspectivas ou Desafios ..." ></textarea>

                </div>

                <div class="modal-footer">

                    <a href="#" class="btn btn-success" id = "btn_print_rsemestral">Imprimir Relatorio</a>
                </div> <!-- fim Modal footer  -->
            </div> <!-- fim Modal content-->
        </div> <!-- fim Modal dialog -->
    </div> <!-- fim Modal fade-->
</div> <!-- fim Modal container-->

</body>
</html>

<script>
    function lista_avaliacao_doc(){

    }

</script>
