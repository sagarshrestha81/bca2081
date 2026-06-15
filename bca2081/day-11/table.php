<?php

require_once "./database.php";

if(isset($_POST['delete'])){
    $id = $_POST['delete'];
    $deleteSql= "DELETE FROM users WHERE id = '$id'";
    $deleteResult = $conn->query($deleteSql);
    if($deleteResult){
        echo "result has been deleted";        
    }else{
        echo "result has not been deleted";
    }
}


$tableSql = "SELECT id,name,email,password FROM users";
$result = $conn->query($tableSql);




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
            <th>Action</th>
        </tr>
        <?php foreach ($result as $r) { ?>

            <tr>
                <td><?php echo $r['id'] ?></td>
                <td><?php echo $r['name'] ?></td>
                <td><?php echo $r['email'] ?></td>
                <td>
                    <a href="./form.php?id=<?php echo $r['id'] ?>">Edit</a>
                    <form action="" method="POST">
                        <button name="delete" value="<?php echo $r['id'] ?>" type="submit">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>
        <?php } ?>


    </table>

</body>

</html>