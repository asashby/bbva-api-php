<?php
    class registro{

        // Connection
        private $conn;

        // Table
        private $db_table = "registro";

        // Columns
        public $user;
        public $pass;
        public $document_type;
        public $document_number;
        public $created_date;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getCredentials(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createCredentials(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        user = :user, 
                        pass = :pass, 
                        document_type = :document_type, 
                        document_number = :document_number, 
                        created_date = :created_date";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->user=htmlspecialchars(strip_tags($this->user));
            $this->pass=htmlspecialchars(strip_tags($this->pass));
            $this->document_type=htmlspecialchars(strip_tags($this->document_type));
            $this->document_number=htmlspecialchars(strip_tags($this->document_number));
            $this->created_date=htmlspecialchars(strip_tags($this->created_date));
        
            // bind data
            $stmt->bindParam(":user", $this->user);
            $stmt->bindParam(":pass", $this->pass);
            $stmt->bindParam(":document_type", $this->document_type);
            $stmt->bindParam(":document_number", $this->document_number);
            $stmt->bindParam(":created_date", $this->created_date);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteEmployee(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>