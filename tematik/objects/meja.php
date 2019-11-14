<?php
class meja{
    private $conn;
    private $table_name = "meja";

    public $ID_E;
    public $ID_M;
    public $tname;
    public $createdby;
    public $createdat;
    public $modifiedby;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT * FROM meja ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create(){
        $query = "INSERT INTO " . $this->table_name . " SET ID_E=:ID_E, ID_M=:ID_M, tname=:tname, createdby=:createdby, createdat=:createdat, modifiedby=:modifiedby";
    
        $stmt = $this->conn->prepare($query);
    
        $this->ID_E=htmlspecialchars(strip_tags($this->ID_E));
        $this->ID_M=htmlspecialchars(strip_tags($this->ID_M));
        $this->tname=htmlspecialchars(strip_tags($this->tname));
        $this->createdby=htmlspecialchars(strip_tags($this->createdby));
        $this->createdat=htmlspecialchars(strip_tags($this->createdat));
        $this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));

    
        $stmt->bindParam(":nama", $this->ID_E);
        $stmt->bindParam(":nomorhp", $this->ID_M);
        $stmt->bindParam(":tname", $this->tname);
        $stmt->bindParam(":createdby", $this->createdby);
        $stmt->bindParam(":createdat", $this->createdat);
        $stmt->bindParam(":modifiedby", $this->modifiedby);

        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    function update(){

        $query = "UPDATE " . $this->table_name . " SET ID_E=:ID_E, ID_M=:ID_M, tname=:tname, createdby=:createdby, createdat=:createdat, modifiedby=:modifiedby WHERE tname = :tname";

        $stmt = $this->conn->prepare($query);

        $this->ID_E=htmlspecialchars(strip_tags($this->ID_E));
        $this->ID_M=htmlspecialchars(strip_tags($this->ID_M));
        $this->tname=htmlspecialchars(strip_tags($this->tname));
        $this->createdby=htmlspecialchars(strip_tags($this->createdby));
        $this->createdat=htmlspecialchars(strip_tags($this->createdat));
        $this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));

        $stmt->bindParam(":ID_E", $this->ID_E);
        $stmt->bindParam(":ID_M", $this->ID_M);
        $stmt->bindParam(":tname", $this->tname);
        $stmt->bindParam(":createdby", $this->createdby);
        $stmt->bindParam(":createdat", $this->createdat);
        $stmt->bindParam(":modifiedby", $this->modifiedby);

        if($stmt->execute()){
            return true;
        }

        return false;
    }
    
    function delete(){

        $query = "DELETE FROM " . $this->table_name . " WHERE tname = ?";

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