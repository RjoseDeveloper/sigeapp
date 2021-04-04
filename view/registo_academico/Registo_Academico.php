<?php

session_start();
if (!isset($_SESSION['username'])){?>

    <script>
        window.location="../../index.php";
    </script>

<?php }else{

    require_once('../../dbconf/getConection.php');
    require_once('../../Query/AllQuerySQL.php');
    require_once('../../Query/EstudantesSQL.php');
    require_once '../../Query/RegistoAcademicoSQL.php';
    require_once('../../Query/EstudantesSQL.php');
    require_once('../../controller/EstudanteCtr.php');

    $estudante_sql =  new EstudantesSQL();

    $db = new mySQLConnection();
    $query = new QuerySql();
    $registo_academico = new RegistoAcademicoSQL();
    $idDoc = $query->getDoc_id($_SESSION['username']);

    $arrayCurso;
    $arrayDisciplina;
    $currentDisp = "";
    $semestre = date('m') < 7 ? '1º':' 2º';
    $ano = date('Y');
} ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type, refresh" content="text/html; charset=utf-8">
    <title>Registo Academico</title>
    <style>

        ul li {cursor: pointer}
        h5{background: none; }


        ul .lista_disciplinas{
            border-top: 1px solid #c6c6c6;
            padding: 8px;
        }

        .table_exame_freq tr td, th{
            text-align: left;
        }

    </style>

    <?php  include '../layouts/head.php' ?>

    <link href="../fragments/css/css_mystyle.css"  rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="../fragments/js/js_estudante.js"></script>
    <script type="text/javascript" src="../fragments/js/js_function.js"></script>
    <script type="text/javascript" src="../fragments/js/js_registo_academico.js"></script>

</head>
<body>

<!--  content of menu -->
<div class="container" style="background: #fff">

                <div class="col-md-5" style="float: left">
                    <label for="">Curso:</label>

                    <select onchange="buscar_disciplina(this.value)" class="form-control">

                        <option value="0" data-theme="b" ><span class="glyphicon glyphicon-list"></span> Seleccionar Curso</option>

                        <?php

                        $result = mysqli_query($db->openConection(), "Select * from curso");

                        while ($row = mysqli_fetch_assoc($result)){?>

                        <option value="<?php echo $row['idcurso']?>" ><?php echo $row['descricao']?>
                            <span class="glyphicon glyphicon-chevron-right pull-right"></span></option>
                        <?php } ?>

                    </select>

                    <div  class="lista_disciplinas">&nbsp;</div>
                    <label for="">Ano:</label>

                    <select class="form-control" onchange="">
                        <option>Ano Lectivo</option>
                        <?php

                        $result = mysqli_query($db->openConection(), "Select YEAR(data_registo) as ano from perfil_instituicao WHERE idperfil=1");
                        if ($row = mysqli_fetch_assoc($result)){

                            for($i = $row['ano']; $i< date('Y'); $i++){ ?>
                                <option value="<?php echo $i ?>"> <?php echo $i ?> </option>
                            <?php } } ?>
                        <option value="">...</option>

                    </select>

                </div>

    <div class="col-md-5" style="float: right">


        <label>Periodo:</label>
        <select class="form-control">
            <option>Laboral</option>
            <option>Pos-Laboral</option>
        </select>

<label>Semestre:</label>
        <select class="form-control">
            <option>Semestre 1</option>
            <option>Semestre 2</option>
        </select>

        <div class="pull-right"><br>

        <button class="btn btn-info" data-mini="true" data-inline="true">Buscar Pauta</button>
        </div>
    </div>



        </div>

<hr style="border: 1px solid #ccc">
    <div class="main_div getPtn2 col-md-12">
        <div class="pautas_freq"></div>
        <div class="outer_div"></div>
           </div> <!-- fim div float right --> <!--fim colapsibleset--->


    <div class="container">
        <!-- Modal -->
        <div class="modal fade" id="modal_exame" role="dialog" data-backdrop="false">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header alert">
                        <button type="button"  style=" border: none" data-mini="true" data-inline="true"
                                class="close" data-dismiss="modal">&times;</button>
                        <h3 class=" modal-title" style="">Pautas do Estudante <span class="nome_aluno"></span></h3>
                    </div>

                    <div class="modal-body">
                        <div class="res_exames_1"></div>
                    </div>

                    <div class="modal-footer">

                        <button class="btn btn-default close" data-dismiss="modal">Fechar</button>


                    </div>
                </div> <!-- fim Modal content-->
            </div> <!-- fim Modal dialog -->
        </div> <!-- fim Modal fade-->
    </div> <!-- fim Modal container-->


</body>
</html>

<script type="text/javascript">

        $('.ul_curso_rec li').click(function () {

                $('.ul_curso_rec li.current').removeClass('current').css({'background':'white', 'color':'black'});
                $(this).closest('li').addClass('current');
                $(this).closest('li ').css({'background':'#E6E8FA', 'color':'blue'});
        });
        $('.lista_estudantes').hide();

</script>