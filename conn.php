<?php

class DatabaseConnection {
    private $conn;

    public function __construct($username, $password, $dbname) {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

$username_db = "root";
$password_db = "";
$dbname = "evke_books";


$database = new DatabaseConnection($username_db, $password_db, $dbname);
$conn = $database->getConnection();

?>