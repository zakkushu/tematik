<?php
	class guestlist{
		private $conn;

		public $ID_E;
		public $ID_P;
		public $ID_M;
		public $ID_K;

		public function __construct($db){
			$this->conn = $db;
		}

		function read(){
			$query = "SELECT nama_e, nama from guestlist g inner join pelanggan p on p.iD_P = g.ID_P inner join events e on g.ID_E = e.ID_E";

			$stmt = $this->conn->prepare($query);
	        $stmt->execute();
	        return $stmt;
		}
	}
?>