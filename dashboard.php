<?php
session_start();
//include the autoloader class
include('autoloader.php');
/*
$product_list = new Products;
$products = $product_list->getProducts();*/

$page_title = "Dashboard";
?>
<!doctype html>
<html>
    <?php include('includes/head.php'); ?>
    <body>
        <?php include('includes/navbar.php'); ?>
        <!-- container -->
        <div class="container-fluid">
            <div class="row">
                <!-- messages colomn -->
                <div class="col-lg-4">
                    <div class="row">
                        <div class="container-fluid">
                            <h4> Messages </h4>
                            <div class="list-group">
                             <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                 <div class="d-flex justify-content-between">
                                     <h6 class="mb-1">Message 1</h6>
                                     <small>3 days ago</small>
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
                    <!-- Profile row -->
                    <div class="row" >
                        <h4 class="col-12"> Profile </h4>
                        <div class="col-4">
                            <img src="/images/ashley.png" class="img-fluid" alt="img-thumbnail">
                        </div>
                        <div class=col-8>
                            <ul>
                                <li> Name:  <?php echo $_SESSION['first_name']; ?> </li>
                                <li> Surname:</li> 
                                <li> Bachelor: </li>   
                                <li> Term: </li>
                                <li> Attendance: </li>
                            </ul>
                        </div>
                    </div>
                    <!-- timetable column -->
                    <div class="row">
                        <h4 class="col-12"> My Weekly Timetable </h4>
                    </div>
                </div>
                <?php 
                /*foreach($products AS $product){ 
                ?>
                <div class="col-md-3">
                    <h3><a href="/detail.php?product_id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></h3>
                    <a href="/detail.php?product_id=<?php echo $product['id']; ?>">
                        <img src="/images/products/<?php echo $product['image_file_name']; ?>" class="img-fluid"></img>
                    </a>
                    <p><?php echo Textutility::sumarize($product['description'], 25); ?></p>
                    <span class="font-weight-bold">$<?php echo $product['price']; ?></span>
                </div>
                <?php } */?>
            </div>
            
        </div><!-- end of container div -->
    </body>
</html>