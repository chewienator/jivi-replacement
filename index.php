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
        </div>
    </body>
</html>