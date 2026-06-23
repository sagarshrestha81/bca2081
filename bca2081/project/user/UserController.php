<?php
require_once './../database/connection.php';


if (isset($_POST['action']) && $_POST['action'] == 'register') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($username && $email && $password) {
        $insert = "INSERT INTO users (name,email,password) VALUES ('$username','$email','$password')";
        $result = $conn->query($insert);
        // $result = mysqli_query($conn, $insert);
        if ($result) {
            echo "result has been inserted";

        } else {
            echo "result has not been inserted";

        }
    }
}