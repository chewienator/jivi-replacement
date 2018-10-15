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
                <!-- FIRST PAGE -->
                <div class="col-md-12 col-lg-4 p-3 animated page1">
                    <h2>Messages</h2>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="d-flex">
                                <input type="text" id="search" onkeyup="search()" placeholder="Search message" name="search">
                                <button> <i class="fa fa-search"> </i> </button>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="list-group w-100">
                                <?php foreach($myMessage AS $message){  ?>
                                <div class="list-group-item list-group-item-action flex-column align-items-start searchable" data-name="<?php echo $message['subject'].' - '.$message['date']; ?>">
                                    <div class="row">
                                        <div class="col justify-content-between" onclick="loadMessage(<?php echo $message['id']; ?>)">
                                            <h6 class="mb-1"><?php echo $message['subject']; ?></h6>
                                            <small class="mb-1"> <?php echo Textutility::dateTimeFormat($message['date']); ?></small>
                                        </div>
                                    </div>
                                </div>
                                <?php  }  //closing the loop ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- second PAGE -->
                <div class="col-md-12 col-lg-8 p-3 animated page2" style="display:none;">
                    <!-- Message details -->
                    <div class="row m1" >
                        <div class="container-fluid">
                            <button type="button" class="btn btn-info mb-3 d-none d-md-block d-lg-none" onclick="goBackAnimation()"> <i class="fa fa-angle-left fa-2x"></i> </i> </button> <!--should only be visible on mobile -->
                            <h2 class="col-12" id="message_subject"></h2>
                            <h6 id="message_date"></h6>
                            <p id="message_body"></p>
                        </div>
                    </div>
                    <!--<div class="row m2" style="display:none;" >
                        <div class="container-fluid">
                            <h2 class="col-12"> Message 2 </h2>
                            <div class=col-12>
                                <h6> Message Object 2</h6>
                                <p> Lorem ipsum 2 .... </p>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </body>
    <?php include('includes/footer.php'); ?>
    
    <script type="text/javascript" src="/js/common.js"></script>
    <script type="text/javascript">
    function loadMessage(id){
            //we do the ajax request for the course information
            $.ajax({
                url: '/ajax/message.ajax.php',
                method: 'post',
                dataType: 'json',
                data: {id: id },
                beforeSend: function() {
                    // fadeout page 2
                    $('.page2').hide()
                },
                success: function(response) {
                    msgHandler(response.success, response.msg);
                    //lets modifiy the information on the actual page
                    
                    $('#message_subject').html(response.info.subject);
                    $('#message_date').html(response.info.date);
                    $('#message_body').html(response.info.body);
                    
                },
                complete: function() {
                    openDetailAnimation();
                }
            });
        }
    </script>

</html>