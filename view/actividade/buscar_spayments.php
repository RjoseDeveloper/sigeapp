<?php

	/*-------------------------
	Autor: rjose
	---------------------------*/
	/* Connect To Database*/

	require_once('../ajax/is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
    require_once '../../dbconf/getConection.php';
    $db = new mySQLConnection();
    $con = $db->openConection();

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
  

	if (isset($_GET['id'])){
		$user_id=intval($_GET['id']);

		$query=mysqli_query($con, "SELECT * FROM actividade where actividade.idactividade='".$user_id."'");

		$count=mysqli_num_rows($query);
       // echo $user_id;

		if ($count == 0){

			if ($delete1=mysqli_query($con,"DELETE FROM actividade WHERE idactividade='".$user_id."'")){
			?>

			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Dados Removidos com sucesso.
			</div>
			<?php

		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Não é possivel eliminar os dados.
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Não pode eliminar possui disciplinas.
			</div>
			<?php
		}
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('actividade.descricao');//Columnas de busqueda
		 $sTable = "actividade";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}

		$sWhere.=" order by actividade.idactividade desc";
		include '../ajax/pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './usuarios.php';
		//main query to fetch the data

        $queries='SELECT * FROM actividade INNER JOIN curso ON curso.idcurso = actividade.idcurso
INNER JOIN utilizador ON actividade.idutilizador = utilizador.id';

		$sql=$queries." $sWhere LIMIT $offset,$per_page";

		$query = mysqli_query($con, $sql);
//        echo $sql;

		//loop through fetched data
		if ($numrows>0){?>

			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>#</th>
					<th>Detalhes da Actividade</th>
					<th>Curso</th>
					<th>Data de Inicio</th>
					<th>Data de Fim</th>
                    <th>Registado Pelo/</th>
                    <th>Data de Registo</th>
                    <th>Taxa Aplicada</th>
					<th><span class="pull-right">Acções</span></th>
					
				</tr>
				<?php
                $i=0;
				while ($row=mysqli_fetch_array($query)){
				    $i++;

						$_id=$row['idactividade'];
						$details= $row['details'];
						$curso=utf8_encode($row['descricao']);
						$di=$row['data_inicio'];
                        $df=$row['data_fim'];
                        $user=$row['fullname'];
                    $taxa=$row['taxa'];
						$date_added= date('d/m/Y', strtotime($row['data_added']));
					?>
					
					<input type="hidden" value="<?php echo $row['descricao'];?>" id="nombres<?php echo $_id;?>">
					<input type="hidden" value="<?php echo $row['curso'];?>" id="apellidos<?php echo $_id;?>">
					<input type="hidden" value="<?php echo $di;?>" id="usuario<?php echo $_id;?>">
					<input type="hidden" value="<?php echo $df;?>" id="email<?php echo $_id;?>">
                    <input type="hidden" value="<?php echo $df;?>" id="taxa<?php echo $_id;?>">
				
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $details; ?></td>
						<td ><?php echo $curso; ?></td>
						<td ><?php echo $di; ?></td>
						<td><?php echo $df;?></td>
                        <td><?php echo $user;?></td>
                        <td><?php echo $date_added;?></td>
                        <td><?php echo $taxa;?></td>
						
					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar Professor' data-backdrop="false"
                       onclick="obtener_datos('<?php echo $_id;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a>
					<a href="#" class='btn btn-default' title='Mostrar Disciplinas'
                       onclick="listar_Disciplinas('<?php echo $_id;?>');"
                       data-toggle="modal" data-target="#myModalx" data-backdrop="false"><i class="glyphicon glyphicon-list"></i></a>

                            <a href="#" class='btn btn-default' title='Eliminar Professor' onclick="eliminar('<?php echo $_id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
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