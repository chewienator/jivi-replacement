<?php
session_start();
include('../session_check.php');
include('../autoloader.php');

$message = new Message();
$message_list = $message->getMessages();


$page_title = "Messages list";
?>
        
<!DOCTYPE html>
<html>
    <?php include('../includes/head.php'); ?>
<body>
<link href="css/style.css" rel="stylesheet">
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <?php include 'includes/navbar.php'; ?>  
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            
            
            <div class="container-fluid">
                <h2>Messages</h2>
                <p>Here you will find all messages created</p>
                <div class="row p-3 d-flex flex-row">
                    <a href="#menu-toggle" class="btn btn-secondary m-2" id="menu-toggle">Toggle Menu</a>
                    <a href="message.php?a=n" class="btn btn-primary m-2">Create New Message</a>
               </div>
            <div class="row pt-3">
                <div class="col-6">
                    <div class="list-group w-100">
                        <?php foreach( $message_list AS $message){ ?>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="row">
                                <div class="col justify-content-between">
                                    <h6 class="mb-1"><?php echo $message['subject']; ?></h6>
                                </div>
                                <div class="col d-flex justify-content-end align-self-center">
                                    <div class="btn-group" role="group" aria-label="action buttons">
                                        <a href="message.php?a=e&id=<?php echo $message['id']; ?>" class="btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            
            <!-- second coloumn -->
            <div> </div>
        
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include 'includes/footer.php'; ?>

</body>

</html>