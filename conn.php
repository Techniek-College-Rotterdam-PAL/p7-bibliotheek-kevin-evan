<?php

$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=localhost;dbname=testdb", $username, $password);
} catch (PDOException $error) {
    echo $error->getMessage();
}
