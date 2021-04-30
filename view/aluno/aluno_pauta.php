<?php

session_start();
if (!isset($_SESSION['username'])){?>

    <script xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
        window.location="../../index.php";
    </script>

<?php }else{

    require_once("../../dbconf/getConection.php");
    require_once('../../Query/AllQuerySQL.php');
    require_once('../../Query/EstudantesSQL.php');
  
    $estudante_sql = new EstudantesSQL();
    $db = new mySQLConnection();
    $query = new QuerySql();

    $idAluno= $estudante_sql->getIdEstudante($_SESSION['username'],1);
    $idcurso = $estudante_sql->obterIdCursoEstudante($idAluno);
    $semestre = date('m') < 7 ? '1º':' 2º';
    $ano = date('Y');
    $curso = '';

} ?>

<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type, refresh" content="text/html; charset=utf-8">

    <title>Estudante Pautas</title>

    <style>

        body {
            font-family: serif;
            font-size: 13px;
            li{list-style: none;}
        }
        .controllero_s{
            background: #108040;  border-top-left-radius: 4px; border-top-right-radius: 4px; border: #ccc;
        }

        .ui-li-static.ui-collapsible > .ui-collapsible-heading {
            margin: 0;
        }
        .ui-li-static.ui-collapsible {
            padding: 0;
        }
        .ui-li-static.ui-collapsible > .ui-collapsible-heading > .ui-btn {
            border-top-width: 0;
        }
        .ui-li-static.ui-collapsible > .ui-collapsible-heading.ui-collapsible-heading-collapsed > .ui-btn,
        .ui-li-static.ui-collapsible > .ui-collapsible-content {
            border-bottom-width: 0;
        }

        #res_tipo_av li a{text-decoration: none;}
        #res_tipo_av li{padding: 6px;}
        #save_pauta_normal{margin-top: -1.5em;}

        .table_exame_freq th, .tbl_freq td{
            text-align: center;
            font-family: "Courier New", Courier, monospace;
            border-color: white;
        }

        .table_frequencia{
            font-size: 13px;
        border: none; color:white;
            text-align: center;

            background: -moz-linear-gradient(#24246A, white);
            background:-webkit-linear-gradient(#24246A, white);
            background:-ms-linear-gradient(#24246A, white);
            background:-o-linear-gradient(#24246A, white);
        }

        .btn_a {
            box-shadow:inset 0px 34px 0px -15px #b54b3a;
            background:linear-gradient(to bottom, #a73f2d 5%, #b34332 100%);
            background-color:#a73f2d;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-family:Arial;
            font-size:15px;
            font-weight:bold;
            padding:9px 23px;
            text-decoration:none;
            text-shadow:0px -1px 0px #7a2a1d;
        }
        .btn_a:hover {
            background:linear-gradient(to bottom, #b34332 5%, #a73f2d 100%);
            background-color:#b34332;
            text-decoration: none;
        }
        .btn_a:active {
            position:relative;
            top:1px;

        }

    </style>


    <script src="../../bibliotecas/jQuery/js/jquery-1.8.3.min.js"></script>
    <script src="../../bibliotecas/jQuery/js/jquery-1.9.1.min.js"></script>
    <link href="../../bibliotecas/jQuery/css/jquery.mobile-1.4.3.min.css" rel="stylesheet" type="text/css"/>
    <script src="../../bibliotecas/jQuery/js/jquery.mobile-1.4.3.min.js"></script>
    <script src="../../bibliotecas/bootstrap/js/bootstrap.min.js"></script>

    <link href="../../bibliotecas/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../fragments/css/button_style.css" rel="stylesheet" type="text/css"/>
    <script src="../../bibliotecas/bootstrap/js/bootstrap.min.js" type="text/javascript"/>
    <script type="text/javascript" src="../fragments/js/js_function.js"></script>


    </head>



<body>

<div data-role="page" class="ui-container" style="background: #fff">

    <div data-role="content" class="container">
        <div style="">

            <fieldset data-role="controlgroup" data-type="horizontal">
            <select name="select-ano" id="select-ano" data-theme="c"
                    data-overlay-theme="c" data-native-menu="true" data-mini="true" >
                <option>-- Selecionar Ano --</option>
                <?php
                for($i = $estudante_sql->obter_ano_ingresso($_SESSION['username']); $i< date('Y')+1; $i++){ ?>
                        <option value=""> <?php echo $i ?> </option>
                    <?php } ?>
                <option value="">...</option>

            </select>
			<hr>

<!--            <select name="a_semestre" id="a_semestre" data-theme="a"-->
<!--                    data-overlay-theme="c" data-native-menu="false" data-mini="true" >-->
<!--                <option>-- select semestre --</option>-->
<!---->
<!--                        <option value="1>"> SEMESTE I</option>-->
<!---->
<!---->
<!--                    <option value="2"> SEMESTRE II </option>-->
<!--            </select>&nbsp;&nbsp;&nbsp;-->
<!---->
<!---->

            </fieldset>

        </div>


        <div data-role="collapsibleset" data-iconpos="left" data-content-theme="a" data-mini="true"
                 style="border: none;" class="main_div getPtn2">

                <input type="hidden" id="save_nome_disp"/>
                <input type="hidden" id="save_nome_av"/>

                <?php
                $vetor =  $estudante_sql->estudanteDisciplina($idAluno, "", 0, $semestre, $ano);

                foreach($vetor as $row){
                    if ($row!=null){

                        $disp = $row['idDisciplina'];
                        $curso=$row['curso'];

                        if ($estudante_sql->obterQtdAvaliacao($disp,$row['idcurso'], 0) >= 0){ ?>
                            <div  data-role="collapsible" data-theme="c" style=" color:#008000" id="ctr_pauta">
                                <h3 > <li value="<?php echo $row['idDisciplina']?>"
                                          class="getDisp" onclick="get_item_disp(this.value)" style="list-style: none">

                                        <a href="#two"><?php echo utf8_encode($row['descricao'])?></a></li></h3>

                                <!-- Mostrar tabelas de Notas-->

                                <div class="myresult">
                                    <div class="<?php echo 'pp'. $disp ?>" ><h4 align="left" style="color: blue;">Pautas Parciais</h4>
                                    <h3 class="titulo2" style="color:green" align="justify"></h3>

                                    <table data-role="table" id="table-custom-2"
                                           class="ui-body-d ui-shadow table-stripe ui-responsive"
                                           style="margin-top: 1em; margin-bottom: 3em">
                                        <thead>

                                        <tr class="ui-bar-b" style="background: #4682B4; font-size: 13px;
										border: none; color:white" align="center">

                                            <th >Tipo de Avaliação </th>
                                            <th style="text-align: center">Classificação</th>
                                            <th style="text-align: center">Data de Publicação</th>

                                        </tr>
                                        </thead>
                                        <tbody class="mycontente" style="font-size: 12px"></tbody>
                                    </table>
                                    </div>

                                    <div class="<?php echo $row['idDisciplina']?>"></div>

                                    <div class="tipo_avaliacao" style="margin-top: .5em;" align="right">
                                        <fieldset data-role="controlgroup" data-type="horizontal">

                                            <a class="btn_a" href="#" onclick="buscar_avaliacao_freq(<?php echo $row['idDisciplina']?>)">Mapa de Freq</a>
                                            <a class="btn_a" href="aluno_pauta.php" target="frm_content">Pautas Parciais</a>

                                        </fieldset>
                                    </div>
                                </div> <!-- end my result-->
                            </div>

                        <?php }else{?>

                            <div  data-role="collapsible" data-theme="c" style=" color:#008000">
                                <h3 class="ui-bar-a" value="<?php echo $row['idDisciplina']?>" style="color:blue" class="getDisp">
                                    <?php echo $row['descricao'] .'   [ Paramentros Incompletos] '?> </h3></div>
                        <?php }} } ?>

                <!--fim colapsible 1--->
            </div>  <!--fim colapsibleset--->

            <!----------------------------------Avaliacoes de Frequencia de disciplina ------------------------------>

            </div> <!-- container Geral -->
        </div>  <!--fim CONTENT--->


</body>

<script type="text/javascript" src="../fragments/js/js_estudante.js"></script>

<script>

//    function get_item_disp(item) {
//        /*
//         funcoes mostrar avaliacao de disciplina
//         * */
//        if (item != null) {
//
//            $.ajax({
//
//                url: "../../requestCtr/Processa_nota.php",
//                type: "POST",
//                data: {disp: item, acao: 1},
//                success: function (result) {
//
//                    $('.myresult').show('slow');
//                    $('.mycontente').html(result);
//                }
//            });
//        }
//    }
</script>




</html>



