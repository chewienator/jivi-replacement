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
                <div class="col-12">
                    <h4> Past Subjects </h4>
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