<?php
	class mySQLConnection{
		
		private $connection;

        private $URL = "localhost";
        private $PASSWORD="dblinkx";
        private $USER ="root";
        private $DB ="sigairis";
        private $PORT ="3306";


    public function openConection(){

			$this->connection = mysqli_connect($this->URL,$this->USER,$this->PASSWORD,$this->DB,$this->PORT)
				or die(mysqli_error());
			return($this->connection);
				}
				
		public function closeDatabase(){
			if (isset($this->connection)){
				mysqli_close($this->connection);
				unset($this->connection);
				}
			}
		public function query($sql){
			$result = mysqli_query($sql, $this->connection);
			if (!$result){
				die("Erro no metodo de Consulta: ".mysqli_errno());
			}
		return($result);
		}
	
	}
	
?>



