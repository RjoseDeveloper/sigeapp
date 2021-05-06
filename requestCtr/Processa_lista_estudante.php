<?php

	session_start();
 

	require_once("../Query/AllQuerySQL.php");
	require_once("../controller/DisciplinaCtr.php");
	require_once("../Query/EstudantesSQL.php");
	require_once('../Query/PublicacaoPautaSQL.php');
    require_once('../controller/EstudanteCtr.php');
    require_once('../dbconf/getConection.php');

          $query = new QuerySql();
          $sql_estudante = new EstudantesSQL();
          $publicacao = new EstudanteController();
          $sql_publicacao = new PublicarPauta();
          $idDoc = $query->getDoc_id($_SESSION['username']);
           $db = new mySQLConnection();



		$acao= $_REQUEST['acao'];

		switch($acao){

	          case 1:
          		  $disciplina = $_REQUEST['disp'];
                  $curso = $_REQUEST['curso'];

                //$vetor = array();
          		$result = mysqli_query($db->openConection(),$sql_estudante->obterEstudantesDisciplina($disciplina, $curso));
          		while ($row[]= mysqli_fetch_assoc($result));


          		          $vetor[] = array('numero'=>$row['numero'],
                                        'nomeCompleto'=>$row['nomeCompleto'],
                                        'idEstudante'=>$row['idEstudante']);

	          // Convert the Array to a JSON String and echo it
		      echo json_encode($vetor);
                  break;

              case 2:

			$descricao = $_REQUEST['term'];

			$estudante = $sql_estudante->getIdEstByNameApelido($_SESSION['username'],2);
			$vetor = $sql_publicacao->listaEstudanteDisp($estudante,$descricao);
			$result = mysqli_query($db->openConection(),$vetor);

			while($row[] = mysqli_fetch_assoc($result));
                  echo json_encode($row);

			break;

                      case 3:
          		            $disciplina = $_POST['disp'];
                              $query= $sql_estudante->obterEstudantesDisciplina($disciplina, $curso);
                              $result = mysqli_query($db->openConection(),$query);
                              while ($row = mysqli_fetch_assoc($result)){
                                  echo '<li value="'.$row['numero'].'">'.$row['nomeCompleto'].'</li>';
                              }
                          break;

		case 4:

		        $filter = '%'.$_POST['keyword'].'%';
                $disp = $_POST['disp'];
                $cursos = $_POST['curso'];
                $curso = $query->getDisciplinaDocenteIdCurso($disp, $idDoc);
		        $result = mysqli_query($db->openConection(),$query->queryAutoComplete($filter,$cursos, $disp));
echo $query->queryAutoComplete($filter,$cursos, $disp);

		        while ($row = mysqli_fetch_assoc($result)){
                echo  '<li style="width:100%; font-size:12px" class="list-group-item" value="'.$row['numero'].'"
                onClick="obter_estudante_nota(this.value);">'.$row['nomeCompleto'].'
                  <span class="glyphicon glyphicon-chevron-right pull-right"></span></li>';

	                  /*$vetor_nrmec[] = Array( 'nrmec'=> $row['numero'],
	                                          'nomeCompleto'=> $row['nomeCompleto']);*/
	            }

				  // Convert the Array to a JSON String and echo it
		//echo json_encode($vetor_nrmec);

	          break;

		case 5:
            // retorna a lista de estudante de uma dada disciplina

            $disciplina = $_REQUEST['disp'];
            $curso = $_REQUEST['curso'];
          
            $result = mysqli_query($db->openConection(),
                $sql_estudante->obterEstudantesDisciplina($disciplina, $curso));

            $t =0;

            while ($row= mysqli_fetch_assoc($result)){

                if ($t%2 != 0){
                    echo '<tr class="remove_tr" style="background: #E8E8E8" >';
                }else{

                    echo '<tr class="remove_tr" style="background: #FFFAFA" >';
                }
                    echo'<td>&nbsp;</td><td class="nrmec">'.$row['numero'].'</td> <td>&nbsp;</td>';
                    echo '<td style="text-align:left">'.$row['nomeCompleto'].'</td>';
                    echo '<td><div style="text-align: right; float: right" class="">';
                    echo '<input type="number" id="nota" class="form-control" onchange="validar_nota(this.value)" placeholder="Atribuir classificação"/></div>';
                    echo '<input id="id_aluno" value="'.$row['idEstudante'].'" name="id_aluno" type="hidden" /></td>';
                    echo '<td class="nrmec"><input type="hidden" id="btn_nrmec" value="'.$row['numero'].'"/> </td></tr>';
                $t++;
            }

            break;


case 6:

if (isset($_GET['term'])){

  $row_array = array();
  $fetch = mysqli_query($con,"SELECT * from utilizador where utilizador.fullname like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,3");

  while ($row = mysqli_fetch_array($fetch)) {

    $row_array['value'] = $row['username'];
    $row_array['id_aluno']=$row['id'];
    $row_array['nomeCompleto']=$row['fullname'];
    $row_array['celular']=$row['celular1'];
    $row_array['email']=$row['email'];
   
    echo json_encode($row_array);
  
}

    break;

            case 7:
                  

                break;
		}


?>


