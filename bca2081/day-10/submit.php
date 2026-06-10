<?php
require_once "./database.php";

$name = $_POST['username'];
$email =  $_POST['email'];
$password = $_POST['password'];  

$insert = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')";
$result = $conn->query($insert);
// $result = mysqli_query($conn, $insert);
if($result){
    echo "result has been inserted";
    header("Location:form.php");
}else{
    echo "result has not been inserted";

}



