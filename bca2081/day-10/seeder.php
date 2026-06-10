<?php
require_once "./database.php";
if ($conn) {
    echo "connected";
} else {
    echo "NOT CONNECTED";
}

// for users
$userInsertSql = "INSERT INTO users (name,email,password) 
                VALUES ('sagar','sagar@gmail.com',1234),
                        ('sohan','sohan@gmail.com',3456),
                        ('sujan','sujan@gmail.com',7890)";
$record = $conn->query($userInsertSql);
if($record){
    echo "inserted into database";
}else{
    echo "not inserted into database";

}

