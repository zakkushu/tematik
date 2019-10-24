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
			$query = "SELECT * FROM tamu ";

			$stmt = $this->conn->prepare($query);
	        $stmt->execute();
	        return $stmt;
		}
	}
?>