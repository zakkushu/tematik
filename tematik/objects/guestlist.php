<?php
	class guestlist{
		private $conn;
		private $table_name = "guestlist";

		public $ID_G;
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

		function readOne(){

			$query = "SELECT g.ID_E, g.IDD_M, m.tname, g.ID_K, g.ID_P, p.nama, kehadiran, raffle, g.createdby, g.createdat, g.modifiedby FROM guestlist g
				INNER JOIN meja m on m.IDD_M = g.IDD_M
				INNER JOIN pelanggan p on p.ID_P = g.ID_P
				WHERE g.ID_E = ?";
	
			$stmt = $this->conn->prepare( $query );
	
			$stmt->bindParam(1, $this->ID_E);
	
			$stmt->execute();
	
			
			return $stmt;
		}

		function hadir(){
			$query = "SELECT p.nama, kehadiran FROM guestlist g
				INNER JOIN pelanggan p on g.ID_P = p.ID_P
				WHERE kehadiran = 'ya'";

			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		function nohadir(){
			$query = "SELECT p.nama, kehadiran FROM guestlist g
				INNER JOIN pelanggan p on g.ID_P = p.ID_P
				WHERE kehadiran = 'tidak'";

			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		function update(){

			$query = "UPDATE " . $this->table_name . " SET ID_P=:ID_P, IDD_M=:IDD_M, ID_K=:ID_K, kehadiran=:kehadiran, modifiedby=:modifiedby WHERE IDD_M = :IDD_M AND ID_K = :ID_K";

			$stmt = $this->conn->prepare($query);

			$this->ID_P=htmlspecialchars(strip_tags($this->ID_P));
			$this->IDD_M=htmlspecialchars(strip_tags($this->IDD_M));
			$this->ID_K=htmlspecialchars(strip_tags($this->ID_K));
			$this->kehadiran=htmlspecialchars(strip_tags($this->kehadiran));
			$this->createdby=htmlspecialchars(strip_tags($this->createdby));
			$this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));

			$stmt->bindParam(":ID_P", $this->ID_P);
			$stmt->bindParam(":IDD_M", $this->IDD_M);
			$stmt->bindParam(":ID_K", $this->ID_K);
			$stmt->bindparam(":kehadiran", $this->kehadiran);
			$stmt->bindParam(":createdby", $this->createdby);
			$stmt->bindParam(":modifiedby", $this->modifiedby);

			if($stmt->execute()){
			    return true;
			}

			return false;
		}
		
		function delete(){

	        $query = "DELETE FROM " . $this->table_name . " WHERE IDD_M = ?";

	        $stmt = $this->conn->prepare($query);

	        $this->IDD_M=htmlspecialchars(strip_tags($this->IDD_M));

	        $stmt->bindParam(1, $this->IDD_M);

	        if($stmt->execute()){
	            return true;
	        }

	        return false;
	        
    	}
	}
?>
