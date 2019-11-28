<?php
class kursi{
    private $conn;
    private $table_name = "kursi";

    public $ID_M;
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

    function readOne(){

        $query = "SELECT * FROM " . $this->table_name . " WHERE ID_M = ?";

        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $this->ID_M);

        $stmt->execute();

        
        return $stmt;
    }

    function create(){
        $query = "INSERT INTO " . $this->table_name . " SET ID_M=:ID_M, ID_K=:ID_K, ID_P=:ID_P, createdby=:createdby, modifiedby=:modifiedby";
    
        $stmt = $this->conn->prepare($query);
    
        $this->ID_M=htmlspecialchars(strip_tags($this->ID_M));
        $this->ID_K=htmlspecialchars(strip_tags($this->ID_K));
        $this->ID_P=htmlspecialchars(strip_tags($this->ID_P));
        $this->createdby=htmlspecialchars(strip_tags($this->createdby));
        $this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));

    
        $stmt->bindParam(":nama", $this->ID_M);
        $stmt->bindParam(":nomorhp", $this->ID_K);
        $stmt->bindParam(":tname", $this->ID_P);
        $stmt->bindParam(":createdby", $this->createdby);
        $stmt->bindParam(":modifiedby", $this->modifiedby);

        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    function update(){

        $query = "UPDATE " . $this->table_name . " SET ID_M=:ID_M, ID_K=:ID_K, ID_P=:ID_P, createdby=:createdby, createdat=:createdat, modifiedby=:modifiedby WHERE ID_K = :ID_K";

        $stmt = $this->conn->prepare($query);

        $this->ID_M=htmlspecialchars(strip_tags($this->ID_M));
        $this->ID_K=htmlspecialchars(strip_tags($this->ID_K));
        $this->ID_P=htmlspecialchars(strip_tags($this->ID_P));
        $this->createdby=htmlspecialchars(strip_tags($this->createdby));
        $this->createdat=htmlspecialchars(strip_tags($this->createdat));
        $this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));

        $stmt->bindParam(":ID_M", $this->ID_M);
        $stmt->bindParam(":ID_K", $this->ID_K);
        $stmt->bindParam(":ID_P", $this->ID_p);
        $stmt->bindParam(":createdby", $this->createdby);
        $stmt->bindParam(":createdat", $this->createdat);
        $stmt->bindParam(":modifiedby", $this->modifiedby);

        if($stmt->execute()){
            return true;
        }

        return false;
    }
    
    function delete(){

        $query = "DELETE FROM " . $this->table_name . " WHERE ID_K = ?";

        $stmt = $this->conn->prepare($query);

        $this->tname=htmlspecialchars(strip_tags($this->tname));

        $stmt->bindParam(1, $this->tname);

        if($stmt->execute()){
            return true;
        }

        return false;
        
    }
}
?>