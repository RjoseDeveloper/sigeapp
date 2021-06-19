<?php
	/*-------------------------
	Autor: rjose
	---------------------------*/
include('../ajax/is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
require_once("../../Query/ContabilidadeSQL.php");
$session_id= session_id();
$idaluno=$_REQUEST['idaluno'];

if (isset($_REQUEST['finality'])){
    $idactividade = $_REQUEST['finality'];
}


//if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}
//if (isset($_POST['precio_venta'])){$precio_venta=$_POST['precio_venta'];}

require '../../dbconf/getConection.php';
$db= new mySQLConnection();
$con = $db->openConection();

if (isset($_GET['id']))//codigo elimina un elemento del array
{
$id_tmp=intval($_GET['id']);
$delete=mysqli_query($con, "DELETE FROM prestacao WHERE iduser='".$id_tmp."'");
}

$simbolo_moneda="MZN";
$contas = new ContabilidadeSQL();
?>

<table class="table">
<tr>
	<th class='text-center'>CODIGO</th>
    <th class='text-center'>DETAILS</th>
	<th class='text-center'>TAXA A PAGAR</th>
    <th class='text-center'>VALOR PAGO</th>
    <th class='text-center'>STATUS</th>
	<th class='text-right'>TAXAS EM DIVIDA</th>
    <th class='text-center'>DATA PAG.</th>
    <th class='text-center'>MULTAS</th>
	<th class='text-right'>TOTAL</th>
	<th>ACÇÕES</th>
</tr>

<?php

	$sql=mysqli_query($con, $contas->all_paymantes('one',$idaluno));
    //echo $contas->all_paymantes('one',$idaluno);
    $subtotal=0;
    $total_iva=0;
    $total_factura=0;
    $subtotal_juro =0;
    $valor_a_pagar=0;

    while ($row=mysqli_fetch_array($sql))
	{
	    $idaluno=$row["id"];
        $nr_mec=$row["codigo"];
	    $fullname=$row['fullname'];
	    $details=$row['descricao'];
	    $status=$row['status'];
	    $montante=$row['valor'];
        $celualr=$row['celular'];
        $juro=$row['juro'];
        $data_aded=$row['datapay'];
        $taxa = $row['taxa'];
        $cal_juro = ($juro*$taxa)/100;
        $subtotal_juro = $cal_juro + $taxa;
        $valor_a_pagar=0;

        if ($status == -1){$text_estado="Pagar";$label_class='label-warning';}
        else{$text_estado="Paga";$label_class='label-success';}
        $valor_a_pagar = $taxa;
        $divida = $valor_a_pagar - $montante;
	
		?>
		<tr>
			<td class='text-center'><?php echo $nr_mec;?></td>
			<td class='text-left'><?php echo $details;?></td>

            <?php if ($status == 1){;}?>

            <td class='text-center'><?php echo $valor_a_pagar .',00';?></td>
            <td class='text-center'><?php echo $taxa .',00';?></td>

			<td class='text-right'><span class="label <?php echo $label_class;?>"><?php echo $text_estado;?></span></td>
            <td class='text-center'><?php echo $divida.',00';?></td>
            <td class='text-center'><?php echo $data_aded;?></td>
            <td class='text-center'><?php echo $cal_juro .',00';?></td>
            <td class='text-right'><?php echo $subtotal_juro .',00';?></td>


			<td class='text-center'>

                <?php  if ($divida > 0){ ?>

                <a href="#" onclick="pagar('<?php echo $idaluno?>')">
                    <i class="glyphicon glyphicon-credit-card"></i></a>
                <?php }?>

                <a href="#" onclick="eliminar('<?php echo $idaluno?>')">
                    <i class="glyphicon glyphicon-trash"></i></a>

            </td>
		</tr>		
		<?php
        $subtotal+=$row['valor'];
        $total_iva+=$cal_juro;
        $total_factura+= $subtotal+$total_iva;
	}
?>
<tr>
    <td style="border: none"></td><td style="border: none"></td> <td></td>
	<td class='text-right' colspan=4>SUBTOTAL PAGO<?php echo $simbolo_moneda;?></td>
    <td></td>
	<th class='text-right'><?php echo number_format($subtotal,2);?></th>
	<td></td>
</tr>
<tr>
    <td style="border: none"></td><td style="border: none"></td> <td></td>
	<td class='text-right' colspan=4>TOTAL MULTAS (%) <?php echo $simbolo_moneda;?></td>
    <td></td>
	<th class='text-right'><?php echo number_format($total_iva,2);?></th>
	<td></td>
</tr>
<tr>
    <td style="border: none"></td><td style="border: none"></td> <td></td>
	<td class='text-right' colspan=4>TOTAL GERAL <?php echo $simbolo_moneda;?></td>
    <td></td>
	<th class='text-right'><?php echo number_format($total_factura,2);?></th>
	<td></td>
</tr>

</table>
