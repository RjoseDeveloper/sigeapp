<?php
include('../ajax/is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing phpUnitTest to older versions of PHP)
}		
//		if (empty($_POST['firstname2'])){
//			$errors[] = "Nome Vazio";
//		} elseif (empty($_POST['lastname2'])){
//			$errors[] = "Apelido Vazio";
//		}  elseif (empty($_POST['user_name2'])) {
//            $errors[] = "Nome de utilizador esta vazio";
//        }  elseif (strlen($_POST['user_name2']) > 64 || strlen($_POST['user_name2']) < 2) {
//            $errors[] = "Nome de usuario no pode ser inferior a 2 o mais de 64 caracteres";
//        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name2'])) {
//            $errors[] = "Nome de utilizador não se com o esquema de nome: que começa de aZ  e os números permitidos são 2 a 64 caracteres";
//        } elseif (empty($_POST['user_email2'])) {
//            $errors[] = "O correo electronico no pode estar vazio";
//        } elseif (strlen($_POST['user_email2']) > 64) {
//            $errors[] = "O correo electrónico no pode ser superior a 64 caracteres";
//        } elseif (!filter_var($_POST['user_email2'], FILTER_VALIDATE_EMAIL)) {
//            $errors[] = "O endereço do correo electrónico no está en un formato de correio electrónico válida";
//        } elseif (
//			!empty($_POST['user_name2'])
//			&& !empty($_POST['firstname2'])
//			&& !empty($_POST['lastname2'])
//            && strlen($_POST['user_name2']) <= 64
//            && strlen($_POST['user_name2']) >= 2
//            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name2'])
//            && !empty($_POST['user_email2'])
//            && strlen($_POST['user_email2']) <= 64
//            && filter_var($_POST['user_email2'], FILTER_VALIDATE_EMAIL)
//          )
//         {
             require '../../dbconf/getConection.php';
             $db = new mySQLConnection();
             $con = $db->openConection();
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $firstname = mysqli_real_escape_string($con,(strip_tags($_POST["fullname"],ENT_QUOTES)));
				$user_role = mysqli_real_escape_string($con,(strip_tags($_POST["user_role"],ENT_QUOTES)));
				$user_name = mysqli_real_escape_string($con,(strip_tags($_POST["username"],ENT_QUOTES)));
                $user_email = mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
                $user_curso = mysqli_real_escape_string($con,(strip_tags($_POST["user_curso"],ENT_QUOTES)));
				
				$user_id=intval($_POST['mod_id']);
					
               
					// write new user's data into database
                    $sql = "UPDATE utilizador SET nomeCompleto='".$firstname."', idprevilegio='".$user_role."',
                            username='".$user_name."',curso_id='".$user_curso."', email='".$user_email."' WHERE id='".$user_id."';";

//                    $dara = "UPDATE utilizador set nomeCompleto='$firstname',
//                              idprevilegio='$user_role', username='$user_name', email='$user_email'
//                              WHERE ";
                    $query_update = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($query_update) {
                        $messages[] = "A conta ja foi modificada com sucesso";
                    } else {
                        $errors[] = "O registo de dados falhou volte a registar novamente.";
                    }
                
            
//        } else {
//            $errors[] = "Un error desconhecido ocorreu.";
//        }
		
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
						<strong>Operação Efectuada</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>