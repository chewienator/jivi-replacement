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
                
                <!-- messages column -->
                <div class="col-md-4 pt-3">
                    <div class="row">
                        <div class="container-fluid">
                            <h5> Messages </h5>
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
                <div class="col-md-8 pt-3">
                    <!-- Profile colo -->
                    <div class="row" >
                        <div class="container-fluid">
                            <h5> Profile </h5>
                            <div class="row">
                                <div class="col-3">
                                    <img src="../images/dummy_image.jpg" class="img-fluid profile-image" alt="img-thumbnail">
                                </div>
                                <div class=col-9>
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
                    </div>
                    <!-- timetable column -->
                    <div class="row">
                        <div class="container-fluid">
                            <h5 class="col-sm-12 pt-3 "> My Weekly Timetable </h5>
                        </div> <!-- insert table from timetable.php -->
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
    <footer>
        <?php include('includes/footer.php'); ?>
    </footer>
</html>