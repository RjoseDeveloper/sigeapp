<?php

	require_once("../dbconf/getConection.php");
	require_once('../Query/AutenticarSQL.php');

if (!session_start()){
    session_start();
}

$user = $_POST['username'];
$pass = $_POST['password'];
$acao = $_POST['acao'];


$db = new mySQLConnection();
$autenticarSQL = new AutenticarSQL();

	switch($acao){

		case 1:


			break;

		    case 2:

                $sql =  $autenticarSQL->acesso_sistema($user,$pass);
                $dados = mysqli_query($db->openConection(),$sql);
            
                if ($row = mysqli_fetch_assoc($dados)){

                    $_SESSION['tipo'] = $row['tipo'];
                    $_SESSION['nomeC'] = $row['fullname'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['user_login_status'] =1;
                    $_SESSION['id']= $row['id'];

                    ?>
                    <script>window.location="../sigeapp/view/main.php";</script>
                <?php }else{
                    echo 'Utilizador ou Dados Invalidos!';

                }
                $db->closeDatabase();
	        break;
            case 3:
                session_start(); //to ensure you are using same session
                session_destroy(); //destroy the sessio
                exit();
            break;
	}
?>
