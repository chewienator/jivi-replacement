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
            <div class="row">
                <div class="col-4">
                    <img src="/images/ashley.png" class="img-fluid">
                </div>
                <div class="col-8">
                    <h4> My details</h4>
                    <ul>
                         <li> Name:  <?php echo $_SESSION['first_name']; ?> </li>
                         <li> Surname:</li> 
                         <li> Bachelor: </li>   
                         <li> Term: </li>
                         <li> Attendance: </li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>