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
			 $query = "INSERT INTO " . $this->table_name . " SET nama_e=:nama_e, lokasi_e=:lokasi_e, tanggal_e=:tanggal_e, waktu_e=:waktu_e, jumlah_m=:jumlah_m, jumlah_k=:jumlah_k";
	    
	        $stmt = $this->conn->prepare($query);
	    
	        $this->nama_e=htmlspecialchars(strip_tags($this->nama_e));
	        $this->lokasi_e=htmlspecialchars(strip_tags($this->lokasi_e));
	        $this->tanggal_e=htmlspecialchars(strip_tags($this->tanggal_e));
	        $this->waktu_e=htmlspecialchars(strip_tags($this->waktu_e));
	        $this->jumlah_m=htmlspecialchars(strip_tags($this->jumlah_m));
	        $this->jumlah_k=htmlspecialchars(strip_tags($this->jumlah_k));
	    
	        $stmt->bindParam(":nama_e", $this->nama_e);
	        $stmt->bindParam(":lokasi_e", $this->lokasi_e);
	        $stmt->bindParam(":tanggal_e", $this->tanggal_e);
	        $stmt->bindParam(":waktu_e", $this->waktu_e);
	        $stmt->bindParam(":jumlah_m", $this->jumlah_m);
	        $stmt->bindParam(":jumlah_k", $this->jumlah_k);
	        

	        if($stmt->execute()){
	            return true;
	        }
	    
	        return false;
		}
	}
?>