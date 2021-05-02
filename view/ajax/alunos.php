<?php
if (isset($_GET['term'])){

    require_once '../../dbconf/getConection.php';
    $db= new mySQLConnection();
    $con = $db->openConection();
$row_array = array();
/* If connection to database, run sql statement. */
if ($con)
{
	$sql ="SELECT * from utilizador";

	$fetch = mysqli_query($con,"where utilizador.fullname like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,3");

	/* Retrieve and store in array the results of the query.*/
	while ($row = mysqli_fetch_array($fetch)) {

		$row_array['value'] = $row['username'];
		$row_array['id_aluno']=$row['id'];
		$row_array['nomeCompleto']=$row['fullname'];
		$row_array['celular']=$row['celular1'];
		$row_array['email']=$row['email'];
		//array_push($return_arr,$row_array);
    }

    echo json_encode($row_array);
	
}

/* Free connection resources. */
mysqli_close($con);

/* Toss back results as json encoded array. */


}
?>