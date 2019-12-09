<?php
	class events{
		private $conn;
		private $table_name = "events";

		public $ID_E;
		public $nama_e;
		public $lokasi_e;
		public $tanggal_e;
		public $waktu_e;
		public $jumlah_m;
		public $jumlah_k;
		public $createdby;
		public $createdat;
		public $modifiedby;
		public $notes;

		public function __construct($db){
			$this->conn = $db;
		}

		function read(){
			$query = "SELECT * FROM events";

			$stmt = $this->conn->prepare($query);
	        $stmt->execute();
	        return $stmt;
		}

		function create(){
			 $query = "INSERT INTO " . $this->table_name . " SET nama_e=:nama_e, lokasi_e=:lokasi_e, tanggal_e=:tanggal_e, waktu_e=:waktu_e, jumlah_m=:jumlah_m, createdby=:createdby, modifiedby=:modifiedby, notes=:notes";
	    
	        $stmt = $this->conn->prepare($query);
	    
	        $this->nama_e=htmlspecialchars(strip_tags($this->nama_e));
	        $this->lokasi_e=htmlspecialchars(strip_tags($this->lokasi_e));
	        $this->tanggal_e=htmlspecialchars(strip_tags($this->tanggal_e));
	        $this->waktu_e=htmlspecialchars(strip_tags($this->waktu_e));
	        $this->jumlah_m=htmlspecialchars(strip_tags($this->jumlah_m));
			$this->createdby=htmlspecialchars(strip_tags($this->createdby));
			$this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));
			$this->notes=htmlspecialchars(strip_tags($this->notes));
	    
	        $stmt->bindParam(":nama_e", $this->nama_e);
	        $stmt->bindParam(":lokasi_e", $this->lokasi_e);
	        $stmt->bindParam(":tanggal_e", $this->tanggal_e);
	        $stmt->bindParam(":waktu_e", $this->waktu_e);
	        $stmt->bindParam(":jumlah_m", $this->jumlah_m);
			$stmt->bindParam(":createdby", $this->createdby);
			$stmt->bindParam(":modifiedby", $this->modifiedby);
			$stmt->bindParam(":notes", $this->notes);

	        

	        if($stmt->execute()){
	            return true;
	        }
	    
	        return false;
		}
		function readOne(){

	        $query = "SELECT * FROM " . $this->table_name . " WHERE ID_E = ? LIMIT 0,1";

	        $stmt = $this->conn->prepare( $query );

	        $stmt->bindParam(1, $this->ID_E);

	        $stmt->execute();

	        $row = $stmt->fetch(PDO::FETCH_ASSOC);

	        $this->nama_e = $row['nama_e'];
	        $this->lokasi_e = $row['lokasi_e'];
	        $this->tanggal_e = $row['tanggal_e'];
	        $this->waktu_e = $row['waktu_e'];
			$this->jumlah_m = $row['jumlah_m'];
			$this->createdby = $row['createdby'];
			$this->createdat = $row['createdat'];
			$this->modifiedby = $row['modifiedby'];
			$this->notes = $row['notes'];
	    }

	     function update(){

	        $query = "UPDATE " . $this->table_name . " SET nama_e=:nama_e, lokasi_e=:lokasi_e, tanggal_e=:tanggal_e, waktu_e=:waktu_e, jumlah_m=:jumlah_m, createdby=:createdby, createdat=:createdat, modifiedby=:modifiedby, notes=:notes WHERE ID_E = :ID_E";

	        $stmt = $this->conn->prepare($query);

	        $this->ID_E=htmlspecialchars(strip_tags($this->ID_E));
	        $this->nama_e=htmlspecialchars(strip_tags($this->nama_e));
	        $this->lokasi_e=htmlspecialchars(strip_tags($this->lokasi_e));
	        $this->tanggal_e=htmlspecialchars(strip_tags($this->tanggal_e));
	        $this->waktu_e=htmlspecialchars(strip_tags($this->waktu_e));
			$this->jumlah_m=htmlspecialchars(strip_tags($this->jumlah_m));
			$this->createdby=htmlspecialchars(strip_tags($this->createdby));
			$this->createdat=htmlspecialchars(strip_tags($this->createdat));
			$this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));
	        $this->notes=htmlspecialchars(strip_tags($this->notes));
	    
	    	$stmt->bindParam(":ID_E", $this->ID_E);
	        $stmt->bindParam(":nama_e", $this->nama_e);
	        $stmt->bindParam(":lokasi_e", $this->lokasi_e);
	        $stmt->bindParam(":tanggal_e", $this->tanggal_e);
	        $stmt->bindParam(":waktu_e", $this->waktu_e);
	        $stmt->bindParam(":jumlah_m", $this->jumlah_m);
			$stmt->bindParam(":createdby", $this->createdby);
			$stmt->bindParam(":createdat", $this->createdat);
			$stmt->bindParam(":modifiedby", $this->modifiedby);
			$stmt->bindParam(":notes", $this->notes);

	        if($stmt->execute()){
	            return true;
	        }

	        return false;
    	}
    	  function delete(){

	        $query = "DELETE FROM " . $this->table_name . " WHERE ID_E = ?";

	        $stmt = $this->conn->prepare($query);

	        $this->ID_E=htmlspecialchars(strip_tags($this->ID_E));

	        $stmt->bindParam(1, $this->ID_E);

	        if($stmt->execute()){
	            return true;
	        }

	        return false;
	        
    	}
	}
?>