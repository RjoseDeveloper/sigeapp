<?php
include('../ajax/is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {

}
if (empty($_POST['descricao'])){
    $errors[] = "Nome Vazio";
} elseif (empty($_POST['credito'])) {
    $errors[] = "Creditos esta vazio";
} elseif (
    !empty($_POST['natureza'])
    && !empty($_POST['credito'])
    && !empty($_POST['descricao'])

) {

    require '../../dbconf/getConection.php';
    $db = new mySQLConnection();
    $con = $db->openConection();

    // escaping, additionally removing everything that could be (html/javascript-) code
    $descricao = mysqli_real_escape_string($con,(strip_tags($_POST["descricao"],ENT_QUOTES)));
    $credito = mysqli_real_escape_string($con,(strip_tags($_POST["credito"],ENT_QUOTES)));
    $codigo = rand(2018,2019) ; //mysqli_real_escape_string($con,(strip_tags($_POST["codigo"],ENT_QUOTES)));
    $date_added=date("Y-m-d");
    $natureza = $_POST['natureza'];
    $curso = $_POST['curso'];

    // check if user or email address already exists
    $sql = "SELECT * FROM disciplina WHERE idcurso = '$curso' AND descricao = '$descricao'";
    $query_check_user_name = mysqli_query($con,$sql);
    $query_check_user=mysqli_num_rows($query_check_user_name);

    if ($query_check_user >= 1) {
        $errors[] = "Para o curso seleccionado a disciplina ja foi registada  ";
    } else {
        // write new user's data into database
        $sql = "INSERT INTO disciplina(creditos,descricao,codigo,data_registo,natureza,idcurso)
                            VALUES('".$credito."','".$descricao."','".$codigo."','" . $date_added. "',
                            '" .$natureza. "','".$curso."')";

        $query_new_user_insert = mysqli_query($con,$sql);
       
        // if user has been added successfully
        if ($query_new_user_insert) {
            $messages[] = "Disciplina registada com sucesso.";
        } else {
            $errors[] = "Lamentamos houve problemas com os dados fornecidos";
        }
    }

} else {
    $errors[] = "Un error desconhecido ocorreu.";
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
        <strong>Opera????o efectuada</strong>
        <?php
        foreach ($messages as $message) {
            echo $message;
        }
        ?>
    </div>
<?php
}

?>