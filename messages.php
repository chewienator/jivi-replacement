<?php
session_start();
//include session check
include('session_check.php');

//include the autoloader class
include('autoloader.php');

$message = new Message();
$myMessage = $message->getMessages(); 

$page_title = "Messages";

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
                                <?php foreach($myMessage AS $message){ //loop thru results array ?>
                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex justify-content-between">
                                         <h6 class="mb-1"> <?php echo $message['subject']; ?> </h6>
                                         <small>  <?php echo Textutility::dateTimeFormat($message['date']); ?> </small>
                                    </div>
                                    <p class="mb-1"> <?php echo Textutility::sumarize($message['body'], 10); ?></p>
                                 </a>
                             <?php } //closing the loop ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- second colomn -->
                <div class="col-md-8 d-none d-md-block p-3">
                    <!-- Message details -->
                    <div class="row m1" >
                        <div class="container-fluid">
                            <h2 class="col-12"> Message </h2>
                            <div class=col-12>
                                <h6> Message Object</h6>
                                <p> Lorem ipsum .... </p>
                            </div>
                        </div>
                    </div>
                    <div class="row m2" style="display:none;" >
                        <div class="container-fluid">
                            <h2 class="col-12"> Message 2 </h2>
                            <div class=col-12>
                                <h6> Message Object 2</h6>
                                <p> Lorem ipsum 2 .... </p>
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
    <?php include('includes/footer.php'); ?>
    
</html>