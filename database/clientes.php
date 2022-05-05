<?php
    class Client {
        private $conn;
        
        private $db_table = "cliente";

        public $id;
        public $name;
        public $email;

        public function __construct($db){
            $this-> conn = $db;
        }

        public function getClient(){
            $sqlQuery = "SELECT id, nome, email FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }       

        public function createClient(){
            $sqlQuery = "INSERT INTO
            ". $this->db_table ."
        SET 
            nome = :nome,
            email = :email";
          
            $stmt = $this->conn->prepare($sqlQuery);
    
            $this->nome=htmlspecialchars(strip_tags($this->nome));
            $this->email=htmlspecialchars(strip_tags($this->email));
        
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":email", $this->email);
    
            if ($stmt->execute()){
                return true;
            } 
            return false;
        }

    }
?>