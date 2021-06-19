<?php

require('../dbconf/getConection.php');
$db = new mySQLConnection();

    $term = $_GET['term'];

    $sql = "SELECT * from utilizador where utilizador.fullname like '%$term%' LIMIT 0 ,3";
    $fetch = mysqli_query($db->openConection(), $sql);

    while ($row = mysqli_fetch_array($fetch)) {

        $row_array[] = array('value' => $row['username'],
                            'id_aluno' => $row['id'],
                            'fullname' => $row['fullname'],
                            'celular' => $row['celular1'],
                            'email' => $row['email'] );
        echo json_encode($row_array);
}
