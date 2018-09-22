<?php
session_start();
//include the autoloader class
include('autoloader.php');
/*
$product_list = new Products;
$products = $product_list->getProducts();*/

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
                <div class="col-sm-4 pt-3">
                    <img src="../images/dummy_image.jpg" class="img-fluid profile-image">
                </div>
                <div class="col-sm-8 pt-3">
                    <h5> My details</h5>
                    <ul>
                         <li> Name:  <?php echo $_SESSION['first_name']; ?> </li>
                         <li> Surname:</li> 
                         <li> Bachelor: </li>   
                         <li> Term: </li>
                         <li> Attendance: </li>
                         <li> Mobile</li> 
                         <li> Address: </li>   
                         <li> Emergency Contact: </li>
                         <li> Student number: </li>
                         <li> eMail: </li>
                    </ul>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pt-3"> <!-- Do I leave col-12 with two col-6 if I want to keep the same size for evry device? -->
                    <h5> Past Subjects </h5>
                </div>
                <div class="col-6 align-items-start">
                    <p> subject name</p>
                </div>
                <div class="col-6 align items-start">
                    <p> result</p>
                </div> <!-- do i have to make it as a list to be able to import data from server? -->
            </div>
        </div>
    </body>
    <footer>
        <?php include('includes/footer.php'); ?>
    </footer>
</html>