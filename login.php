<?php
//include the autoloader class
include('autoloader.php');

//if the method request is POST
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    //$password = $_POST['password'];
    
    $_SESSION['email'] = $email;
    $_SESSION['first_name'] = 'Jennifer';
    /* end trick */
    /*
    $account = new Account();
    $success = $account->authenticate($email, $password);
    
    if($success == true){ //login successful
        session_start();
        $_SESSION['email'] = $email;
        //redirect to home page
        header('location:index.php');
    }else{
        $message = 'Wrong credentials supplied.';
        $message_class = 'warning';
    }
    */
}

?>
<!doctype html>
<html>
    <?php include('includes/head.php'); ?>
    <body>
        <?php include('includes/navbar.php'); ?>
        <!-- container -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <form id="signin-form" method="post" action="login.php">
                        <h3>Log in to account</h3>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="you@example.com"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" name="password" id="password" placeholder="minimum 6 characters"/>
                        </div>
                        <button class="btn btn-primary mt-2" id="signin-btn" type="submit"/>Sign in</button>
                    </form>
                    <?php 
                        if($message){
                            echo "<div class=\"alert alert-$message_class alert-dismissable fade show\">
                                    $message
                                    <button class=\"close\" type=\"button\" data-dismiss=\"alert\">&times;</button>
                            </div>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="js/login.js"></script>
    </body>
</html>