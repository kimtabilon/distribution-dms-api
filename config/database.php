<?php
class Database{
 
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "a6e3a2c9_mage2";
    private $username = "root";
    private $password = "";
    public $conn;
   /* private $host = "127.0.0.1";
    private $db_name = "a6e3a2c9_mage2";
    private $username = "a6e3a2c9_mage2";
    private $password = "p6RH3N80i65N9yiGc5";
    public $conn;*/
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>