<?php
require_once "./database.php";

// $conn = mysqli_connect($host,$username,$password);
// var_dump($conn );
echo "<br>";
$conn = new mysqli($host, $username, $password);
if ($conn) {
    echo "Server connected";
    
    $sql = "CREATE DATABASE IF NOT EXISTS $db";
    $result = $conn->query($sql);
    if ($result) {
        echo "Database created";
    } else {
        echo "Database not created";
    }

    $connDb = new mysqli($host, $username, $password, $db);
    if ($connDb) {
        echo "Database connected";
    } else {
        echo "Database not connected";
    }
    $sqlTable = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";
    $resultTable = $connDb->query($sqlTable);
    if ($resultTable) {
        echo "Table created";
    } else {
        echo "Table not created";
    }
    


}
