<?php
session_start();
//include session check
include('session_check.php');

//include the autoloader class
include('autoloader.php');

//1st, we create an OBJECT of class Account
$profile = new Account(); //wrote a lot there...:p

//we create a variable to store the information we want to pull from the database.
//if you go to Account.class.php you can see the method with the query lets go there! :)
$myProfile = $profile->getAccount($_SESSION['id']); //$_SESSION stores all info for the session.

//as you can see we are calling the METHOD getAccount(your ID)
//whatever the method finds, we will store it inside $myProfile variable (variables are like buckets)
//so now we can use our bucket and get the contents from it...go to name in the html...

//print_r($myProfile);

$page_title = "Profile";
?>
<!doctype html>
<html>
    <?php include('includes/head.php'); ?>
    <body>
        <?php include('includes/navbar.php'); ?>
        <!-- container -->
        <div class="container-fluid">
            <!-- imagine col -->
            <div class="row">
                <div class="col-sm-4 p-3">
                    <img src="../images/dummy_image.jpg" class="img-fluid profile-image" <?php echo $myProfile['profile_image']; ?>>
                </div>
                <div class="col-sm-8 p-3">
                    <h2> My details</h2>
                    <ul>
                         <li> Name:  <?php echo $myProfile['name']; ?> </li>
                         <li> Surname: <?php echo $myProfile['surname']; ?></li> 
                         <li> Mobile: <?php echo $myProfile['phone']; ?></li> 
                         <li> Address: <?php echo $myProfile['address']; ?></li>
                         <li> Student number: <?php echo $myProfile['id']; ?> </li> 
                         <li> eMail: <?php echo $myProfile['email']; ?></li>
                    </ul>
                    </ul>
                </div>
            </div>
           <!-- <div class="row">
                <div class="col-12 p-3"> 
                    <h2> Past Subjects </h2>
                </div>
                <div class="col-6 align-items-start">
                    <p> subject name</p>
                </div>
                <div class="col-6 align items-start">
                    <p> result</p>
                </div> 
            </div> -->
        </div>
    </body>
        <?php include('includes/footer.php'); ?>
</html>