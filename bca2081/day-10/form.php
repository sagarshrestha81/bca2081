<?php
require_once "./database.php";
if (isset($_POST['submit'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($name && $email && $password) {
        $insert = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')";
        $result = $conn->query($insert);
        // $result = mysqli_query($conn, $insert);
        if ($result) {
            echo "result has been inserted";

        } else {
            echo "result has not been inserted";

        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>User form</h2>
    <form action="#" method="POST">
        <div>
            <label for="name">Name</label>
            <input type="text" name="username" id="name">
        </div>
        <div>
            <label for="email">email</label>
            <input type="text" name="email" id="email">
        </div>
        <div>
            <label for="password">password</label>
            <input type="text" name="password" id="password">
        </div>
        <button type="submit" name="submit">Submit</button>
        <button type="reset">reset</button>
        <button type="button">btn</button>
    </form>

</body>

</html>