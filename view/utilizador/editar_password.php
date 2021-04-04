<?php
include('../ajax/is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing phpUnitTest to older versions of PHP)

}		
		if (empty($_POST['user_id_mod'])){
			$errors[] = "ID vazio";
		}  elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $errors[] = "Password Vazia";
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $errors[] = "A senha e a sua repeticao devem ser as mesmas";
        }  elseif (
			 !empty($_POST['user_id_mod'])
			&& !empty($_POST['user_password_new'])
            && !empty($_POST['user_password_repeat'])
            && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
        ) {
            require '../../dbconf/getConection.php';
            $db = new mySQLConnection();
            $con = $db->openConection();
			
				$user_id=intval($_POST['user_id_mod']);
				$user_password = $_POST['user_password_new'];

				//$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
					// write new user's data into database
                    $sql = "UPDATE utilizador SET password='".$user_password."' WHERE id='".$user_id."'";
                    $query = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($query) {
                        $messages[] = "Password modificado com sucesso";
                    } else {
                        $errors[] = "Verificamos um problemas ao tentar registar os dados da password";
                    }
                
            
        } else {
            $errors[] = "Um erro ocorreu ao registar os dados";
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