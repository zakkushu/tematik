<?php
class Admin{
 
    private $conn;
    private $table_name = "administrator";
 
    public $ID_A;
    public $nama;
    public $email;
    public $password;
    public $createdby;
    public $createdat;
    public $modifiedby;
 
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
 
        $query = "SELECT
                   *
                FROM
                    administrator" ;
     
        $stmt = $this->conn->prepare($query);
     
        $stmt->execute();
     
        return $stmt;
    }



    function create(){
    
        $query = "INSERT INTO " . $this->table_name . " SET nama=:nama, email=:email, password=:password, createdby=:createdby, modifiedby=:modifiedby";
    
        $stmt = $this->conn->prepare($query);
    
        $this->nama=htmlspecialchars(strip_tags($this->nama));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->createdby=htmlspecialchars(strip_tags($this->createdby));
        $this->modifiedby=htmlspecialchars(strip_tags($this->modifiedby));
    
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":createdby", $this->createdby);
        $stmt->bindParam(":modifiedby", $this->modifiedby);

        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
    function readOne(){

        $query = "SELECT * FROM " . $this->table_name . " WHERE ID_A = ? LIMIT 0,1";

        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $this->ID_A);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nama = $row['nama'];
        $this->email = $row['email'];
        $this->password = $row['password'];
    }

    function update(){

        $query = "UPDATE " . $this->table_name . " SET nama = :nama, email = :email, password = :password, createdby=:createdby, modifiedby=:modifiedby WHERE ID_A = :ID_A";

        $stmt = $this->conn->prepare($query);

        $this->nama=htmlspecialchars(strip_tags($this->nama));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
    
        $stmt->bindParam(":ID_A", $this->ID_A);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":createdby", $this->createdby);
        $stmt->bindParam(":modifiedby", $this->modifiedby);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function login(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ? LIMIT 0,1";

        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $this->email);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->email = $row['email'];
        $this->password = $row['password'];
    }

    // delete the product
    function delete(){

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_A = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->ID_A=htmlspecialchars(strip_tags($this->ID_A));

        // bind id of record to delete
        $stmt->bindParam(1, $this->ID_A);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
        
    }

}
?>