<?php
	class guestlist{
		private $conn;
		private $table_name = "guestlist";

		public $ID_E;
		public $ID_P;
		public $IDD_M;
		public $ID_K;
		public $kehadiran;
		public $raffle;
		public $createdat;
		public $createdby;
		public $modifiedby;

		public function __construct($db){
			$this->conn = $db;
		}

		function read(){
			$query = "SELECT * FROM guestlist ";

			$stmt = $this->conn->prepare($query);
	        $stmt->execute();
	        return $stmt;
		}

		function create(){
			$query = "INSERT INTO " . $this->table_name . " SET ID_E=:ID_E, ID_P=:ID_P, IDD_M=:IDD_M, ID_K=:ID_K, kehadiran=:kehadiran, raffle=:raffle, createdby=:createdby, modifiedby=:modifiedby";
	    
	        $stmt = $this->conn->prepare($query);
	    
	        $this->ID_E=htmlspecialchars(strip_tags($this->ID_E));
	        $this->ID_P=htmlspecialchars(strip_tags($this->ID_P));
	        $this->IDD_M=htmlspecialchars(strip_tags($this->IDD_M));
			$this->ID_K=htmlspecialchars(strip_tags($this->ID_K));
			$this->kehadiran=htmlspecialchars(strip_tags($this->kehadiran));
			$this->raffle=htmlspecialchars(strip_tags($this->raffle));
			$this->createdby=htmlspecialchars(strip_tags($this->createdby));
			$this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));

	    
	        $stmt->bindParam(":ID_E", $this->ID_E);
	        $stmt->bindParam(":ID_P", $this->ID_P);
	        $stmt->bindParam(":IDD_M", $this->IDD_M);
			$stmt->bindParam(":ID_K", $this->ID_K);
			$stmt->bindparam(":kehadiran", $this->kehadiran);
			$stmt->bindparam("raffle", $this->raffle);
			$stmt->bindParam(":createdby", $this->createdby);
			$stmt->bindParam(":modifiedby", $this->modifiedby);

	        if($stmt->execute()){
	            return true;
	        }
	    
	        return false;
		}

		function update(){

	        $query = "UPDATE " . $this->table_name . " SET ID_E=:ID_E, ID_P=:ID_P, IDD_M=:IDD_M, ID_K=:ID_K, kehadiran=:kehadiran, raffle=:raffle, createdby=:createdby, modifiedby=:modifiedby WHERE ID_P = :ID_P";

	        $stmt = $this->conn->prepare($query);

			$this->ID_E=htmlspecialchars(strip_tags($this->ID_E));
	        $this->ID_P=htmlspecialchars(strip_tags($this->ID_P));
	        $this->IDD_M=htmlspecialchars(strip_tags($this->IDD_M));
	        $this->ID_K=htmlspecialchars(strip_tags($this->ID_K));
			$this->kehadiran=htmlspecialchars(strip_tags($this->kehadiran));
			$this->raffle=htmlspecialchars(strip_tags($this->raffle));
			$this->createdby=htmlspecialchars(strip_tags($this->createdby));
			$this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));

	    	$stmt->bindParam(":ID_E", $this->ID_E);
	        $stmt->bindParam(":ID_P", $this->ID_P);
	        $stmt->bindParam(":IDD_M", $this->IDD_M);
			$stmt->bindParam(":ID_K", $this->ID_K);
			$stmt->bindparam(":kehadiran", $this->kehadiran);
			$stmt->bindparam("raffle", $this->raffle);
			$stmt->bindParam(":createdby", $this->createdby);
			$stmt->bindParam(":modifiedby", $this->modifiedby);

	        if($stmt->execute()){
	            return true;
	        }

	        return false;
		}
		
		function delete(){

	        $query = "DELETE FROM " . $this->table_name . " WHERE ID_P = ?";

	        $stmt = $this->conn->prepare($query);

	        $this->ID_P=htmlspecialchars(strip_tags($this->ID_P));

	        $stmt->bindParam(1, $this->ID_P);

	        if($stmt->execute()){
	            return true;
	        }

	        return false;
	        
    	}
	}
?>