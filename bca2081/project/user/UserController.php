<?php
require_once './../database/connection.php';


if (isset($_POST['action']) && $_POST['action'] == 'register') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($username && $email && $password) {
        try {
            $insert = "INSERT INTO users (name,email,password) VALUES ('$username','$email','$password')";
            $result = $conn->query($insert);
            // $result = mysqli_query($conn, $insert);
            if ($result) {

                $result = [
                    'responseCode' => 200,
                    'status' => 'success',
                    "message" => "result has been inserted"
                ];


            } else {
                $result = [
                    'responseCode' => 200,
                    'status' => 'error',
                    "message" => "result has not been inserted"
                ];

            }
        } catch (Exception $e) {
            $result = [
                'responseCode' => 200,
                'status' => 'error',
                "message" => "Something went wrong"
            ];
        }
        echo json_encode($result);

    }
}