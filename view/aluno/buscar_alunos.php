<?php

/*-------------------------
Autor: rjose
---------------------------*/
include('../ajax/is_logged.php');

/* Connect To Database*/


require_once('../../Query/AlunoSQL.php');
require_once '../../dbconf/getConection.php';

if ($_SESSION['tipo'] == 'aluno'){
    require_once '../layouts/head.php';
}
$db = new mySQLConnection();
$con = $db->openConection();



$pessoa = new AlunoSQL();

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if (isset($_GET['id'])) {

    $id_aluno = intval($_GET['id']);
    $query = mysqli_query($con,$pessoa->get_all_pessoa(1,$id_aluno));
    $count = mysqli_num_rows($query);

    if ($count == 0) {
        if ($delete1 = mysqli_query($con, "DELETE * FROM utilizador WHERE id ='" . $id_aluno . "'")) {
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> Dados Removidos com sucesso.
            </div>
        <?php
        } else {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> Erro tente novamente.
            </div>
        <?php
        }

    } else {?>

        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> Não pode eliminar este aluno tem dados associados.
        </div>

    <?php
    }


}
if ($action == 'ajax') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));


    $aColumns = array('utilizador.fullname');//Columnas de busqueda
    $sTable = "utilizador,distrito";
    $sWhere = "";
    if ($_GET['q'] != "") {

        $sWhere = " AND (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%".$q."%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -4);
        $sWhere .= ')';
    }
    $sWhere .= " order by utilizador.data_added DESC";
    include '../ajax/pagination.php'; //include pagination file
    //pagination variables
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page = 5; //how much records you want to show
    $adjacents = 3; //gap between pages after number of adjacents
    $offset = ($page - 1) * $per_page;
    //Count the total number of row in your table*/

    if ($_SESSION['tipo'] == 'aluno'){

        $user_id = $_SESSION['id'];
        $queries = $pessoa->get_all_pessoa(1,$user_id);
        $count_query = mysqli_query($con, "SELECT count(*) AS numrows 
            FROM utilizador WHERE utilizador.id=".$user_id);
        
       
    }else{
        $queries = $pessoa->get_all_pessoa(0,0)." $sWhere LIMIT $offset,$per_page";
        $count_query = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable $sWhere");
    }

    $row = mysqli_fetch_assoc($count_query);
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows / $per_page);
    $reload = './aluno.php';
    //main query to fetch the da
    $query = mysqli_query($con, $queries);
    //echo $queries;

    //loop through fetched data
    if ($numrows > 0) { ?>

        <div class="table-responsive container">
            <table class="table">
                <tr class="info">
                    <th>#</th>
                    <th>Codigo</th>
                    <th>Nome Completo</th>
                    <th>Naturalidade</th>
                    <th>Morada</th>
                    <th>Sexo</th>
                    <th>Data de Ingresso</th>
                    <th class='text-right'>Acções</th>

                </tr>

                <?php while ($row = mysqli_fetch_array($query)) {

                    $id_aluno = $row['id'];
                    $nr_mec = $row['codigo'];
                    $fullname = $row['fullname'];
                    $sexo = $row['sexo'];
                    $endereco = $row['endereco1'];
                    $celular1 = $row['celular1'];
                    $distrito = $row['descricao'];
                    $bi_recibo = $row['documento'];

                    $endereco = $row['endereco1'];
                    $estadocivil = $row['estadocivil'];

                    $data = $row['datanasc'];
                    $date_added = date('d/m/Y', strtotime($row['data_added']));

                    ?>

                    <input type="hidden" value="<?php echo htmlentities($nr_mec); ?>"
                           id="nrmec<?php echo $id_aluno;?>">

                    <input type="hidden" value="<?php echo $fullname; ?>"
                           id="fullname<?php echo $id_aluno;?>">

                    <input type="hidden" value="<?php echo $nome;?>"
                           id="nome<?php echo $id_aluno;?>">

                    <input type="hidden" value="<?php echo $apelido;?>"
                           id="apelido<?php echo $id_aluno;?>">

                    <input type="hidden" value="<?php echo $bi_recibo;?>"
                           id="bi_recibo<?php echo $id_aluno;?>">
                    <tr>
                        <td><?php echo $id_aluno; ?></td>
                        <td><?php echo $nr_mec; ?></td>
                        <td style="text-align: left"><?php echo $fullname; ?></td>
                        <td><?php echo $distrito;?></td>
                        <td><?php echo $endereco;?></td>
                        <td><?php echo $sexo;?></td>
                        <td><?php echo $date_added;?></td>

                        <td><span class="pull-right">

                                 <a href="#" class='btn btn-default' title='Listar Encarregado' data-toggle="modal"
                                    data-target="#list_encarregado" data-backdrop="false"
                                    onclick="listar_Encarregado('<?php echo $id_aluno; ?>')">
                                     <i class="glyphicon glyphicon-list"></i>
                                 </a>

                                 <?php if ($_SESSION['tipo'] != 'aluno'){?>

					<a href="#" class='btn btn-default' title='Editar Aluno'
                       onclick="get_aluno_dados('<?php echo $id_aluno;?>');"><i class="glyphicon glyphicon-edit"></i></a>



                                <a href="#" class='btn btn-default' title='Apagar Estudante'
                                   onclick="eliminar('<?php echo $id_aluno; ?>')">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                                <a href="#" onclick="get_item_val('<?php echo $id_aluno;?>')" style="color:darkred"
                                   data-toggle="modal" data-target="#registar_encarregado" data-backdrop="false">
                                    <div>Add Encarregado</a>

                <?php }?>


                            </span>
                        </td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan=8><span class="pull-right">
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