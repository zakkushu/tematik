<?php
	class pelanggan{
		private $conn;
		private $table_name = "pelanggan";

		public $ID_P;
		public $nama;
		public $nomorhp;
		public $email;
		public $kehadiran;
		public $ID_E;
		public $ID_K;

		public function __construct($db){
			$this->conn = $db;
		}

		function read(){
			$query = "SELECT * FROM pelanggan";

			$stmt = $this->conn->prepare($query);
	        $stmt->execute();
	        return $stmt;
		}

		function create(){
			$query = "INSERT INTO " . $this->table_name . " SET nama=:nama, nomorhp=:nomorhp, email=:email, kehadiran=:kehadiran";
	    
	        $stmt = $this->conn->prepare($query);
	    
	        $this->nama=htmlspecialchars(strip_tags($this->nama));
	        $this->nomorhp=htmlspecialchars(strip_tags($this->nomorhp));
	        $this->email=htmlspecialchars(strip_tags($this->email));
	        $this->kehadiran=htmlspecialchars(strip_tags($this->kehadiran));

	    
	        $stmt->bindParam(":nama", $this->nama);
	        $stmt->bindParam(":nomorhp", $this->nomorhp);
	        $stmt->bindParam(":email", $this->email);
	        $stmt->bindParam(":kehadiran", $this->kehadiran);

	        if($stmt->execute()){
	            return true;
	        }
	    
	        return false;
		}
		function readOne(){

	        $query = "SELECT * FROM " . $this->table_name . " WHERE ID_P = ? LIMIT 0,1";

	        $stmt = $this->conn->prepare( $query );

	        $stmt->bindParam(1, $this->ID_P);

	        $stmt->execute();

	        $row = $stmt->fetch(PDO::FETCH_ASSOC);

	        $this->nama = $row['nama'];
	        $this->nomorhp = $row['nomorhp'];
	        $this->email = $row['email'];
	        $this->kehadiran = $row['kehadiran'];
	    }

	     function update(){

	        $query = "UPDATE " . $this->table_name . " SET nama=:nama, nomorhp=:nomorhp, email=:email, kehadiran=:kehadiran WHERE ID_P = :ID_P";

	        $stmt = $this->conn->prepare($query);

	      $this->nama=htmlspecialchars(strip_tags($this->nama));
	        $this->nomorhp=htmlspecialchars(strip_tags($this->nomorhp));
	        $this->email=htmlspecialchars(strip_tags($this->email));
	        $this->kehadiran=htmlspecialchars(strip_tags($this->kehadiran));

	    	$stmt->bindParam(":ID_P", $this->ID_P);
	        $stmt->bindParam(":nama", $this->nama);
	        $stmt->bindParam(":nomorhp", $this->nomorhp);
	        $stmt->bindParam(":email", $this->email);
	        $stmt->bindParam(":kehadiran", $this->kehadiran);

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