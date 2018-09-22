<?php
session_start();
//include the autoloader class
include('autoloader.php');
/*
$product_list = new Products;
$products = $product_list->getProducts();*/

$page_title = "Subjects";
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
                <div class="col-md-4 pt-3">
                    <h5>Subjects</h5>
                    <div class="container-fluid">
                        <div class="row">
                            <form action="/action_page.php"> <!-- action page? -->
                                <div class="d-flex">
                                    <input type="text" placeholder="Search course" name="search">
                                    <button type="submit"> <i class="fa fa-search"> </i> </button>
                                </div>
                            </form>
                        </div>
                        <div class="row pt-3">
                            <div class="list-group w-100">
                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="row">
                                        <div class="col justify-content-between">
                                            <h6 class="mb-1">Subject 3</h6>
                                            <small class="mb-1">code</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- second colomn -->
                <div class="col-md-8 pt-3">
                    <!-- Subject Detail row -->
                    <div class="row" >
                        <div class="container-fluid">
                            <div class="col-12">
                                <h5> Subject Name <?php echo $name; ?> </h5>
                                <div class="row">
                                    <div class="col-4 align-items-start">
                                        <h6> Course code:</h6>
                                    </div>
                                    <div class="col-6 align-items-end">
                                        <h6> IJSDJ002 </h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 align-items-start">
                                        <h6> Credit:</h6>
                                    </div>
                                    <div class="col-8 align-items-end">
                                        <h6> 6 </h6>
                                    </div>
                                </div>
                                  <div class="row">
                                    <div class="col-4 align-items-start">
                                        <h6> Hours per week: </h6>
                                    </div>
                                    <div class="col-6 align-items-start">
                                        <h6> 8 hrs </h6>
                                    </div>
                                </div>
                                <h6 class="mt-5"> LEARNING OUTCOMES </h6>
                                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                <h6 class="mt-5"> OVERVIEW</h6>
                                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                <!-- <p><?php echo $overview; ?></p> -->
                                <h6 class="mt-5"> ASSESSMENTS</h6>
                                <ul>
                                    <li> A1. </li>
                                    <li> A2. </li>
                                    <li> A3. </li>
                                </ul>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
    </body>
    <?php include('includes/footer.php'); ?>
   
</html>