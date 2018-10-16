<?php
session_start();
//include session check
include('session_check.php');

//include the autoloader class
include('autoloader.php');

//we create an object of course
$message = new Message();
//let's get the courses list
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
                <!-- first page -->
                <div class="col-md-12 col-lg-4 p-3 animated page1">
                    <h2>Subjects</h2>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="d-flex">
                                <input type="text" id="search" onkeyup="search()" placeholder="Search message" name="search">
                                <button> <i class="fa fa-search"> </i> </button>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="list-group w-100"><!-- main list container -->
                                <?php foreach($myMessage AS $message){ //loop thru results array ?>
                                <div class="list-group-item list-group-item-action flex-column align-items-start searchable" data-name="<?php echo $message['subject'].' - '.$message['date']; ?>">
                                    <div class="row">
                                        <div class="col-12 justify-content-between" onclick="loadMessage(<?php echo $message['id']; ?>)">
                                            <h6 class="mb-1"> <?php echo $message['subject']; ?></h6>
                                        </div>
                                        <div class="col-8 justify-content-between mb-1">
                                            <small class="mb-1"> <?php echo Textutility::DateTimeFormat($message['date']); ?></small>
                                        </div>
                                        <p> <?php echo TextUtility::summarize($message['body'],10); ?></p>
                                    </div>
                                </div>
                                <?php  }  //closing the loop ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- second page -->
                <div class="col-md-12 col-lg-8 p-3 animated page2" style="display:none;">
                    <!-- Subject Detail row -->
                    <div class="row" >
                        
                        <div class="container-fluid">
                            <div class="col-12">
                                <button type="button" class="btn btn-info mb-3 d-none d-md-block d-lg-none" onclick="goBackAnimation()"> <i class="fa fa-angle-left fa-2x"></i> </i> </button>
                                <h2 id="message_subject"></h2>
                                <small id="message_date"></small>
                                <p id="message_body"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    
    <?php include('includes/footer.php'); ?>
    <script type="text/javascript" src="/js/common.js"></script>
    <script type="text/javascript">
        function loadCourse(id){
            //we do the ajax request for the message information
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
                    $('#messaeg_date').html(response.info.date);
                    $('#message_body').html(response.info.body);
                   
                },
                complete: function() {
                    openDetailAnimation();
                }
            });
        }
    </script>
</html>