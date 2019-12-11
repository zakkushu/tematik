<?php
	class pelanggan{
		private $conn;
		private $table_name = "pelanggan";

		public $ID_P;
		public $nama;
		public $nickname;
		public $nomorhp;
		public $email;
		public $createdat;
		public $createdby;
		public $modifiedby;

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
			$query = "INSERT INTO " . $this->table_name . " SET nama=:nama, nickname=:nickname, nomorhp=:nomorhp, email=:email, createdby=:createdby, modifiedby=:modifiedby";
	    
	        $stmt = $this->conn->prepare($query);
	    
	        $this->nama=htmlspecialchars(strip_tags($this->nama));
	        $this->nickname=htmlspecialchars(strip_tags($this->nickname));
	        $this->nomorhp=htmlspecialchars(strip_tags($this->nomorhp));
	        $this->email=htmlspecialchars(strip_tags($this->email));
			$this->createdby=htmlspecialchars(strip_tags($this->createdby));
			$this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));

	    
	        $stmt->bindParam(":nama", $this->nama);
	        $stmt->bindParam(":nickname", $this->nickname);
	        $stmt->bindParam(":nomorhp", $this->nomorhp);
			$stmt->bindParam(":email", $this->email);
			$stmt->bindParam(":createdby", $this->createdby);
			$stmt->bindParam(":modifiedby", $this->modifiedby);


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
	        $this->nickname = $row['nickname'];
	    }

	     function update(){

	        $query = "UPDATE " . $this->table_name . " SET ID_P=:ID_P, nama=:nama, nickname=:nickname, nomorhp=:nomorhp, email=:email, createdby=:createdby, modifiedby=:modifiedby WHERE ID_P =:ID_P";

	        $stmt = $this->conn->prepare($query);

			$this->ID_P=htmlspecialchars(strip_tags($this->ID_P));
	      	$this->nama=htmlspecialchars(strip_tags($this->nama));
			$this->nickname=htmlspecialchars(strip_tags($this->nickname));
	        $this->nomorhp=htmlspecialchars(strip_tags($this->nomorhp));
			$this->email=htmlspecialchars(strip_tags($this->email));
			$this->createdby=htmlspecialchars(strip_tags($this->createdby));
			$this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));

	    	$stmt->bindParam(":ID_P", $this->ID_P);
	        $stmt->bindParam(":nama", $this->nama);
	        $stmt->bindParam(":nickname", $this->nickname);
	        $stmt->bindParam(":nomorhp", $this->nomorhp);
			$stmt->bindParam(":email", $this->email);
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