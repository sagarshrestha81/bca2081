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
if (isset($_GET['id'])) {
    $updateId = $_GET['id'];
    $updateSql = "SELECT name,email FROM users WHERE id = '$updateId'";
    $updateResult = $conn->query($updateSql);
    $updateData = $updateResult->fetch_assoc();
}

if (isset($_POST['update'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($name && $email) {
        $updateSql = "UPDATE users SET name = '$name', email = '$email'";
        if ($password) {
            $updateSql .= ",password = '$password'";
        }
        $updateSql .= " WHERE id = '$updateId'";
        $updateResult = $conn->query($updateSql);
        if ($updateResult) {
            echo "result has been updated";
            header("location: ./table.php");
        } else {
            echo "result has not been updated";
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
    <h2><?php echo isset($updateId) ? "Edit User" : "Add User"; ?></h2>
    <form action="#" method="POST">
        <div>
            <label for="name">Name</label>
            <input type="text" name="username" id="name" value="<?php echo $updateData['name'] ?? '' ?>">
        </div>
        <div>
            <label for="email">email</label>
            <input type="text" name="email" id="email" value="<?php echo $updateData['email'] ?? '' ?>">
        </div>
        <div>
            <label for="password">password</label>
            <input type="text" name="password" id="password">
        </div>
        <button type="submit" name="<?php echo isset($updateId) ? "update" : "submit"; ?>">
            <?php echo isset($updateId) ? "Update" : "Submit"; ?>
        </button>
    </form>

</body>

</html>