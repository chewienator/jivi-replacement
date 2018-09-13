<?php
session_start();
//include the autoloader class
include('autoloader.php');
/*
$product_list = new Products;
$products = $product_list->getProducts();*/

$page_title = "Timetable";
?>
<!doctype html>
<html>
    <?php include('includes/head.php'); ?>
    <body>
        <?php include('includes/navbar.php'); ?>
        <!-- container -->
        <div class="container-fluid">
            <div class="row">
                <!-- search  subjects colomn -->
                <div class="col-lg-4">
                    <div class="row">
                        <div class="container-fluid">
                            <h4> Courses </h4>
                            <div class="search-container">
                                <form action="/action_page.php">
                                    <input type="text" placeholder="Search subject" name="search">
                                    <button type="submit"> <i class="fa fa-search"> </i> </button>
                                </form>
                            </div> 
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                 <div class="d-flex justify-content-between">
                                     <h6 class="mb-1">Message 1</h6>
                                </div>
                                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                             </a>
                             <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1">Message 2</h6>
                                    <small class="text-muted">3 days ago</small>
                                </div>
                                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                             </a>
                             <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex justify-content-between">
                                      <h6 class="mb-1">Message 3</h6>
                                      <small class="text-muted">3 days ago</small>
                                </div>
                                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                              </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- second colomn -->
                <div class="col-lg-8">
                    <!-- Subject Detail row -->
                    <div class="row" >
                        <h4 class="col-12"> Subject Name </h4>
                        <p> Subject description here </p>
                    </div>
            </div>
        </div>
    </body>
</html>