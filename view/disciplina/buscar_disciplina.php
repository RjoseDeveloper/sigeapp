<?php

	/*-------------------------
	Autor: rjose
	---------------------------*/
	/* Connect To Database*/

	include('../ajax/is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado

require '../../dbconf/getConection.php';
$db = new mySQLConnection();
$con = $db->openConection();

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';


	if (isset($_GET['id'])){
		$_id=intval($_GET['id']);

		$query=mysqli_query($con, "SELECT disciplina.idDisciplina from disciplina
                                    INNER  JOIN disciplina_curso ON disciplina.idDisciplina = disciplina_curso.iddisciplina
                                    WHERE  disciplina.idDisciplina ='".$_id."'");

		$count=mysqli_num_rows($query);
       // echo $_id;

		if ($count == 0){

			if ($delete1=mysqli_query($con,"DELETE FROM disciplina WHERE disciplina.idDisciplina='".$_id."'")){
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
		 $aColumns = array('disciplina.codigo', 'disciplina.descricao');//Columnas de busqueda
		 $sTable = "disciplina";
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

		$sWhere.=" order by idDisciplina desc";
		include '../ajax/pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 4; //how much records you want to show
		$adjacents  = 3; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");

		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './usuarios.php';
		//main query to fetch the data

        $queries="SELECT disciplina.idDisciplina, disciplina.codigo, 
        disciplina.descricao, disciplina.creditos,disciplina.natureza,
        disciplina.data_registo, curso.descricao as curso 
        FROM disciplina inner join curso 
        on curso.idcurso=disciplina.idcurso";

		$sql=$queries." $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//echo $sql;

		//loop through fetched data
		if ($numrows>0){?>

			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>ID</th>
					<th>Disciplina</th>
					<th>Creditos</th>
					<th>Curso</th>
               
					<th>Plano Curricular</th>
					<th><span class="pull-right">Acções</span></th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){

						$_id=$row['idDisciplina'];
						$fullname= utf8_encode($row['descricao']);
						$creditos=$row['creditos'];
						$natureza=$row['natureza'];
                        $curso=$row['curso'];
						$date_added= date('d/m/Y', strtotime($row['data_registo']));
                        $codigo=$row['codigo'];
                        $nivel='';
					?>
					
					<input type="hidden" value="<?php echo $row['descricao'];?>" id="nombres<?php echo $_id;?>">
					<input type="hidden" value="<?php echo $row['creditos'];?>" id="apellidos<?php echo $_id;?>">
					<input type="hidden" value="<?php echo $natureza;?>" id="usuario<?php echo $_id;?>">
					<input type="hidden" value="<?php echo $codigo;?>" id="email<?php echo $_id;?>">
				
					<tr>
						<td><?php echo $codigo; ?></td>
						<td style="text-align: left"><?php echo $fullname; ?></td>
						<td ><?php echo $creditos; ?></td>
						<td ><?php echo $curso; ?></td>
                        
						<td><?php echo $natureza;?></td>

						
					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar Disciplina' data-backdrop="false"
                       onclick="obtener_datos('<?php echo $_id;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a>
				    <a href="#" class='btn btn-default' title='Eliminar Disciplina' onclick="eliminar('<?php echo $_id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
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