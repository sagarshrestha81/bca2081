<?php

require_once "./database.php";
$tableSql = "SELECT * FROM users";
$result = $conn->query($tableSql);


if ($result->num_rows > 0) {

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
    <table border="1">

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
        <?php foreach ($result as $r) { ?>

            <tr>
                <td><?php echo $r['id'] ?></td>
                <td><?php echo $r['name'] ?></td>
                <td><?php echo $r['email'] ?></td>
                <td><?php echo $r['password'] ?></td>
                <td>
                    <a href="edit">Edit</a>
                    <a href="delete">Delete</a>
            </td>
            </tr>
        <?php } ?>


    </table>

</body>

</html>