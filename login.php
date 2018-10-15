<?php
//include the autoloader class
include('autoloader.php');

//if the method request is POST
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    //let's validate if they are who they say...
    $account = new Account();
    $success = $account->authenticate($_POST['email'], $_POST['password']);
    
    if($success == true){ //login successful
        //redirect to dashboard
        header('location:/dashboard.php');
    }else{
        $message = 'Wrong credentials supplied.';
        $message_class = 'warning';
    }
   
}

?>
<!doctype html>
<html>
    <?php include('includes/head.php'); ?>
    <body>
        <?php include('includes/navbar.php'); ?>
        <!-- container -->
        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <form id="signin-form" method="post" action="login.php">
                        <h3>Log in to account</h3>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="you@example.com" required/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" name="password" id="password" placeholder="minimum 6 characters" required/>
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
        <script type="text/javascript" src="js/common.js"></script>
    </body>
</html>