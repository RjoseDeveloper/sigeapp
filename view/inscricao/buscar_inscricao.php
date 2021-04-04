<?php

/*-------------------------
Autor: rjose
---------------------------*/
include('../ajax/is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/


require_once '../../Query/Classes.php';
require_once '../../Query/AlunoSQL.php';
$classes = new Classes();
//Archivo de funciones PHP

require_once '../../dbconf/getConection.php';
$db = new mySQLConnection();
$con = $db->openConection();

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

if (isset($_GET['id'])){

    $idinscricao=intval($_GET['id']);
    $query=mysqli_query($con, 'select * from inscricao WHERE idinscricao='.$idinscricao);
    $count = mysqli_num_rows($query);

    if($count == 0 ){

        if ($delete1=mysqli_query($con,"DELETE FROM inscricao WHERE idinscricao='".$idcurso."'")){
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> Dados Eliminados com sucesso.
            </div>
        <?php
        }else {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> Erro tente novamente.
            </div>
        <?php
        }

    } else {
        ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> Não pode eliminar este curso existem registos associadas ao mesmo.
        </div>
    <?php
    }
}
if($action == 'ajax'){
    // escaping, additionally removing everything that could be (html/javascript-) code
    if(isset($_REQUEST['q'])){
        $q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    }else{
        $q='';
    }
    $aColumns = array('inscricao.data_registo');//Columnas de busqueda
    $sTable = "inscricao";
    $sWhere = "";
    if ($q != "" )
    {
        $sWhere = "WHERE (";
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
        }

        $sWhere = substr_replace( $sWhere, "", -3);
        $sWhere .= ')';
    }

    $sWhere.=" order by inscricao.idinscricao desc";

    include '../ajax/pagination.php'; //include pagination file
    //pagination variables

    if ($_SESSION['tipo']!= 'estudante'){

        $aluno = "";
        // $idDoc = $query->getDoc_id($_SESSION['username']);
        $curso_id = $_REQUEST['curso'];
        $disciplina = $_REQUEST['disciplina'];

    }else{

        $aluno = $_SESSION['id'];
        $curso_id = $classes->find_frm_curso($aluno);
        $disciplina ='';
    }



    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 5; //how much records you want to show
    $adjacents  = 4; //gap between pages after number of adjacents
    $offset = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $data = $classes->find_frm_periodos_or_mes($curso_id, $disciplina, $aluno, 0);
    $count_query   = mysqli_query($con, $data);
    //echo $data;
    $row= mysqli_fetch_array($count_query);

    //echo "SELECT count(*) AS numrows FROM $sTable  $sWhere";
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows/$per_page);
    $reload = 'inscricao.php';
    //main query to fetch the data

    $qs = $classes->find_frm_periodos_or_mes($curso_id, $disciplina, $aluno, 1);
    $sql= $qs." $sWhere LIMIT $offset, $per_page";

    $query = mysqli_query($con, $sql);
    //loop through fetched data

    //echo $sql;

    if ($numrows>0){
        $simbolo_moneda="MZN";
        ?>
        <div class="table-responsive">
            <table class="table">

                <tr class="info">

                    <th>Codigo</th>
                    <th>Nome Completo</th>
                    <th>Disciplina</th>
                    <th>Creditos</th>
                    <th>Curso</th>

                    <th>Data de Inscricao</th>
                    <th>Nivel</th>
                    <th class='text-right'>Acções</th>

                </tr>


                <?php

                while ($row = mysqli_fetch_array($query)) {

                    $codigo =$row['nr_mec'];
                    $descricao = $row['disciplina'];
                    $fullname = $row['nomeCompleto'];
                    $creditos = $row['creditos'];;
                    $curso = $row['descricao'];
                    $nivel = $row['nivel'].'º';
                    $id_aluno = $row['id'];
                    $date_added = date('d/m/Y', strtotime($row['data_registo']));
                    $status = 1;//$row['status'];
                    if ($status != 1 ){$text_estado="Aceite";$label_class='label-success';}
                    else{$text_estado="Rejeitada";$label_class='label-warning';}
                    ?>

                    <tr style="text-align: left">

                        <td><?php echo $codigo; ?></td>
                        <td><?php echo $fullname; ?></td>
                        <td><?php echo utf8_encode($descricao); ?></td>
                        <td><?php echo $creditos;?></td>
                        <td><?php echo $curso;?></td>

                        <td><?php echo $date_added;?></td>

                        <td><?php echo $nivel;?></td>
<!--                        <td class='text-center'><span class="label --><?php //echo $label_class;?><!--">--><?php //echo $text_estado;?><!--</span></td>-->
<!--                        -->
                        <td><span class="pull-right">
                                <a href="../aluno/buscar_alunos.php?action=ajax&q=x" target="frm_content" class='btn btn-default' title='Actualizar Dados'
                                   onclick="obtener_datos('<?php echo $id_aluno;?>');"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" class='btn btn-default' title='Exluir da Lista' "><i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </span>
                        </td>

                    </tr>
                <?php
                }
                ?>


                <tr>
                    <td colspan=9><span class="pull-right">
					<?php
                    echo paginate($reload, $page, $total_pages, $adjacents);
                    ?></span></td>
                </tr>
            </table>
        </div>
    <?php
    }
}
?>