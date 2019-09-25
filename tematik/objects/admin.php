<?php
class Admin{
 
    // database connection and table name
    private $conn;
    private $table_name = "administrator";
 
    // object properties
    public $ID_A;
    public $nama;
    public $email;
    public $password;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
 
        // select all query
        $query = "SELECT
                   *
                FROM
                    administrator" ;
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    // create product
    function create(){
    
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET nama=:nama, email=:email, password=:password";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->nama=htmlspecialchars(strip_tags($this->nama));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
    
        // bind values
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    // used when filling up the update product form
    function readOne(){

        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . " WHERE ID_A = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->ID_A);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->nama = $row['nama'];
        $this->email = $row['email'];
        $this->password = $row['password'];
    }

    // update the product
    function update(){

        // update query
        $query = "UPDATE " . $this->table_name . " SET nama = :nama, email = :email, password = :password WHERE ID_A = :ID_A";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nama=htmlspecialchars(strip_tags($this->nama));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
    
        // bind values
        $stmt->bindParam(":ID_A", $this->ID_A);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
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