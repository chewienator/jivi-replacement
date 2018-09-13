<?php
session_start();
//include the autoloader class
include('autoloader.php');
/*
$product_list = new Products;
$products = $product_list->getProducts();*/

$page_title = "Home Page";
?>
<!doctype html>
<html>
    <?php include('includes/head.php'); ?>
    <body>
        <?php include('includes/navbar.php'); ?>
        <!-- container -->
        <div class="container-fluid">
            <div class="row">
                <div id="#about">
                    <p> here explain what is "TIM" h2</p>
                    
                </div>
                <div id="#services">
                    <p> here explain services maybe in h2 </p>
                </div>
                <div id="#contact">
                    <p> here form for contact </p>
                    
                </div>
            </div>
        </div><!-- end of container div -->
    </body>
</html>