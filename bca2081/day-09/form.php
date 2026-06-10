<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>User form</h2>
   <form action="submit.php" method="POST">
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
    <button type="submit" >Submit</button>
    <button type="reset" >reset</button>
    <button type="button" >btn</button>
   </form>

</body>

</html>