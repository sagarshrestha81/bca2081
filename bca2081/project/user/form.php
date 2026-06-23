<?php
require_once './../includes/main.php';
?>


<section class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-9 col-md-12 ">
            <h2 class="text-center">Register Account</h2>
            <form action="" method="POST" id="register-account">
                <div class="mb-3">
                    <label for="usernameInputEmail1" class="form-label">Username</label>
                    <input type="text" class="form-control" id="usernameInputEmail1" name="username">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="email">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <button type="submit" value="register" class="btn btn-primary">Signup</button>
            </form>
        </div>



    </div>


</section>





<!-- <form action="#" method="POST">
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
    
    <button type="button" class="btn btn-success btn-lg">button</button>

</form> -->



<?php
require_once '../includes/footer.php';
?>