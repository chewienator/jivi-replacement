<?php
session_start();
//include session check
include('session_check.php');

//include the autoloader class
include('autoloader.php');

$profile = new Account();
$myProfile = $profile->getAccount($_SESSION['id']);

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
                <div class="col-md-4 d-none d-md-block">
                    <div class="row">
                        <div class="container-fluid">
                            <h2> Messages </h2>
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
                             <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex justify-content-between">
                                      <h6 class="mb-1">Message 3</h6>
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
                             <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex justify-content-between">
                                      <h6 class="mb-1">Message 3</h6>
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
                             <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex justify-content-between">
                                      <h6 class="mb-1">Message 3</h6>
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
                             <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex justify-content-between">
                                      <h6 class="mb-1">Message 3</h6>
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
                             <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex justify-content-between">
                                      <h6 class="mb-1">Message 3</h6>
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
                <div class="col-md-8 p-3">
                    <!-- Profile colo -->
                    <div class="row" >
                        <div class="container-fluid">
                            <h2> Profile </h2>
                            <div class="row">
                                <div class="col-3">
                                    <img src="../images/dummy_image.jpg" class="img-fluid profile-image" alt="img-thumbnail" <?php echo $myProfile['profile_image']; ?> >
                                </div>
                                <div class=col-9>
                                    <ul>
                                        <li> Name:  <?php echo $myProfile['name']; ?> </li>
                                        <li> Surname: <?php echo $myProfile['surname']; ?></li> 
                                        <li> Mobile: <?php echo $myProfile['phone']; ?></li> 
                                        <li> Address: <?php echo $myProfile['address']; ?></li>
                                        <li> Student number: <?php echo $myProfile['id']; ?> </li> 
                                        <li> eMail: <?php echo $myProfile['email']; ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- timetable column -->
                    <div class="row">
                        <div class="container-fluid">
                            <h2 class="col-sm-12 pt-3 "> My Weekly Timetable </h2>
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
        <?php include('includes/footer.php'); ?>
</html>