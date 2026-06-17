<?php
require_once '../includes/header.php';
?>

<h2>Add User</h2>
<form action="#" method="POST">
    <div>
        <label for="name">Name</label>
        <input type="text" name="username" id="name" value="">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="text" name="password" id="password">
    </div>
    <button type="submit" name="submit">
        Submit
    </button>
    <button type="button" class="btn btn-success btn-lg">button</button>

</form>

<?php
require_once '../includes/footer.php';
?>