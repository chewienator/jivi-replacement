<?php
session_start();
//include session check
include('session_check.php');

//include the autoloader class
include('autoloader.php');
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
                <div class="col-md-4 p-3">
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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- second colomn -->
                <div class="col-md-8 p-3">
                    <!-- Message details -->
                    <div class="row" >
                        <div class="container-fluid">
                            <h2 class="col-12"> Message </h2>
                            <div class=col-12>
                                <h6> Message Object</h6>
                                <p> Lorem ipsum .... </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                /*foreach(message AS message){ 
                ?>
                <div">
                    <h3><a href="/messages.php?message=<?php echo message['id']; ?>"><?php echo $message['object']; ?></a></h3>
                    <p><?php echo $message['text']; ?></p>
                    <span class="font-weight-bold">$<?php echo $message ['time']>
                </div>
                <?php } */?>
            </div>
        </div>
    </body>
    <footer>
        <?php include('includes/footer.php'); ?>
    </footer>
</html>