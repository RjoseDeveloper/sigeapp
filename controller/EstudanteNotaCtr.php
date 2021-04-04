<?php


   class EstudanteNotaController{
       private $db;

       public function __construct(){
           $this->db = new mySQLConnection();
       }

       public function read($id){
		   if ($this->db){

			   $query= "SELECT * FROM estudante_nota WHERE idPautaNormal={$id}";
			   $result_set = mysqli_query($this->db->openConection(),$query);
			   $found = mysqli_fetch_assoc($result_set);

               return(print_r($found));

		   }else{return(false);}
		$this->db->closeDatabase();
       }

	   //In this Place use this form

	    public function insertF1($idp, $nota, $idest, $status, $details){

 		   $query = 'INSERT INTO `estudante_nota`( `idPautaNormal`, `nota`, `idaluno`, `status`, `details`) VALUES (?,?,?,?,?)';

		   $stmt = mysqli_prepare($this->db->openConection(),$query);
		   $res= mysqli_stmt_bind_param($stmt,'idiss',$idp, $nota, $idest, $status, $details);

    	   if (mysqli_stmt_execute($stmt)){
		   		echo '<div class="alert alert-success">Pauta Enviada com Sucesso</div>';
		   }else{
			   echo('<div class="alert alert-danger">Lamentamos Houve um erro no envio da Pauta</div>');
			 }
            //echo 'id estudante: '. $idest;
	   }

       /*actualuza nota estudante*/

       public function update($idNota, $nota){

           $query = "UPDATE estudante_nota SET nota = ? WHERE idNota = ?";
           $stmt = mysqli_prepare($this->db->openConection(),$query);
           $result = mysqli_stmt_bind_param($stmt,'id',$idNota, $nota);
           if (mysqli_stmt_execute($stmt)){

                echo('<div class="alert alert-success"> Nota actualizada com sucesso para ['.$nota.']</div>');
           }else{
               echo('<div class="alert alert-danger">Nao foi possivel publicar a pauta</div>');
             }
         $this->db->closeDatabase();

       }

       public function delete($id){

		     $query = "DELETE FROM `estudante_nota` WHERE `idPautaNormal`= ?";
		     if ($stmt = mysqli_prepare($this->db->openConection(),$query)){
			   $result = mysqli_stmt_bind_param($stmt,'i',$id);
			   if(mysqli_stmt_execute($stmt)){
					echo('removido com sucesso!');
		  	   }else{
			   		echo('problemas na remocao!');
			   }
		    $this->db->closeDatabase();
           }
       }

       public function selectAll(){

		   $db = new mySQLConnection();
		   $query= "SELECT * FROM `estudante_nota`";
		   $result_set = mysqli_query($this->db->openConection(),$query);
		   while ($row = mysqli_fetch_assoc($result_set)){
				echo $row['nota'];
			}

       }
   }

?>
