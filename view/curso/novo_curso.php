<?php
include('../ajax/is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nome'])) {
           $errors[] = "Nome do Curso Vazio";
        } else if (empty($_POST['nivel'])){
			$errors[] = "Quantidade de Turmas vazio";
		} else if ($_POST['estado']==""){
			$errors[] = "Seleccionar uma instituicao";
		} else if (empty($_POST['taxa'])){
			$errors[] = "Taxa de Matricula Vazia";
		} else if (
			!empty($_POST['nome']) &&
			!empty($_POST['taxa'])
		){
		/* Connect To Database*/
        require '../../dbconf/getConection.php';
        $db = new mySQLConnection();
        $con = $db->openConection();

		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nome"],ENT_QUOTES)));
		$estado=intval($_POST['estado']);
		$precio_venta=floatval($_POST['taxa']);
        $responsavel = $_POST['campo_utilizador'];
        $qtd_turma = $_POST['nivel'];
        $periodo = $_POST['regime'];

		$date_added=date("Y-m-d");
        $num =rand(date('Y'), 2000);

		$sql="INSERT INTO curso(descricao, codigo, data_registo, qtd_turmas, taxa_matricula, idperiodo, coordenador, details)
                                    VALUES('".$nombre."','".$num."','" . $date_added . "','" .$qtd_turma. "','" .$precio_venta. "','" .$periodo. "','" .$responsavel. "','" .$nombre. "')";


        $query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert) {
                $messages[] = "Registo adicionado com sucesso.";
                $last_row = $con->insert_id;
                //echo $last_row;

                for ($i = 0; $i < $qtd_turma;) {
                    $i++;
                    $value = "Turma [". $i."]";
                    $sql1 = "INSERT INTO turma(descricao, idcurso) value('" . $value . "','" . $last_row . "') ";
                    mysqli_query($con, $sql1);

                }

                if ($periodo == 5) {

                    $horas = $_POST['horas'];

                $sql2 = "INSERT INTO carga_horaria(idperiodo, horas) value('" . $periodo . "','" . $horas . "') ";
                mysqli_query($con, $sql2);
            }

                $messages[] = "<br>Turmas Criadas Com Sucesso.";

			} else{
				$errors []= "Problemas no Cadastro tente novamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconhecido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Opera????o Efectuada</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>