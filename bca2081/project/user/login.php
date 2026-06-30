<?php
require_once './../includes/main.php';
?>


<section class="container my-5">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-9 col-md-12 ">
            <h2 class="text-center">Login Account</h2>
            <form action="" method="POST" id="login-account">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <button type="submit" value="login" class="btn btn-primary">Login</button>
            </form>
        </div>



    </div>


</section>




<?php
require_once '../includes/footer.php';
?>