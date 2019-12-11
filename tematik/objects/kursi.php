<?php
class kursi{
    private $conn;
    private $table_name = "kursi";

    public $IDD_M;
    public $ID_K;
    public $ID_P;
    public $createdby;
    public $createdat;
    public $modifiedby;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT * FROM kursi ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function rilreadOne(){
        $query = "SELECT IDD_M, p.ID_P, nama FROM " .$this->table_name . ", pelanggan p WHERE ID_K = ? LIMIT 0,1";
        $stmt = $this->conn->prepare( $query );

	        $stmt->bindParam(1, $this->ID_K);

	        $stmt->execute();

	        $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->IDD_M = $row['IDD_M'];
            $this->ID_P = $row['ID_P'];
            $this->nama = $row['nama'];
    }

    function readOne(){

        $query = "SELECT IDD_M, ID_K, p.ID_P, p.nama, k.createdby, k.createdat, k.modifiedby FROM kursi k INNER JOIN pelanggan p on IDD_M = ? WHERE k.ID_P = p.ID_P ORDER BY k.createdat ASC";

        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $this->IDD_M);

        $stmt->execute();

        
        return $stmt;
    }

    

    function create(){
        $query = "INSERT INTO " . $this->table_name . " SET IDD_M=:IDD_M, ID_P=:ID_P, createdby=:createdby, modifiedby=:modifiedby";
    
        $stmt = $this->conn->prepare($query);
    
        $this->IDD_M=htmlspecialchars(strip_tags($this->IDD_M));
        $this->ID_P=htmlspecialchars(strip_tags($this->ID_P));
        $this->createdby=htmlspecialchars(strip_tags($this->createdby));
        $this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));

    
        $stmt->bindParam(":IDD_M", $this->IDD_M);
        $stmt->bindParam(":ID_P", $this->ID_P);
        $stmt->bindParam(":createdby", $this->createdby);
        $stmt->bindParam(":modifiedby", $this->modifiedby);

        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    function update(){

        $query = "UPDATE " . $this->table_name . " SET IDD_M=:IDD_M, ID_K=:ID_K, ID_P=:ID_P, createdby=:createdby, modifiedby=:modifiedby WHERE ID_K = :ID_K";

        $stmt = $this->conn->prepare($query);

        $this->IDD_M=htmlspecialchars(strip_tags($this->IDD_M));
        $this->ID_K=htmlspecialchars(strip_tags($this->ID_K));
        $this->ID_P=htmlspecialchars(strip_tags($this->ID_P));
        $this->createdby=htmlspecialchars(strip_tags($this->createdby));
        $this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));

        $stmt->bindParam(":IDD_M", $this->IDD_M);
        $stmt->bindParam(":ID_K", $this->ID_K);
        $stmt->bindParam(":ID_P", $this->ID_P);
        $stmt->bindParam(":createdby", $this->createdby);
        $stmt->bindParam(":modifiedby", $this->modifiedby);

        if($stmt->execute()){
            return true;
        }

        return false;
    }
    
    function delete(){

        $query = "DELETE FROM " . $this->table_name . " WHERE ID_K = ?";

        $stmt = $this->conn->prepare($query);

        $this->ID_K=htmlspecialchars(strip_tags($this->ID_K));

        $stmt->bindParam(1, $this->ID_K);

        if($stmt->execute()){
            return true;
        }

        return false;
        
    }
}
?>