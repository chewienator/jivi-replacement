<?php
session_start();
include('../session_check.php');
include('../autoloader.php');

//lets check if they want to edit or create
if($_GET['a'] == 'e'){ //edit the message
    //lets get them the information for the message they want
    $message = new Message();
    $info = $message->getMessage($_GET['id']);
    $page_title = "Edit Message";
    
}elseif($_GET['a'] == 'n'){ //create a new one
    $page_title = "Create Message";
}

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
                <p>Here you can create messages to be shown to users</p>
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
                <a href="message.php?a=n" class="btn btn-primary">Create New Message</a>
            </div>
            <div class="row pt-3">
                <div class="col-6">
                    <form id="main-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" class="form-control" id="subject" value="<?php echo $info['subject']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="date">date</label>
                            <input type="text" name="date" class="form-control" id="date" value="<?php echo $info['date']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="body">text</label>
                            <input type="text" name="body" class="form-control" id="body" value="<?php echo $info['body']; ?>">
                        </div>
                        <input type="hidden" name="a" value="<?php echo $_GET['a']; ?>">
                        <input type="hidden" name="h" value="message">
                        
                        <?php if($_GET['a'] == 'e'){ ?>
                        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                        <?php  }  ?>
                        
                        <button class="btn btn-primary mt-2" id="save-btn" type="submit"/>Save</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    <script type="text/javascript" src="js/form_submit.js"></script>
    <script type="text/javascript">
    </script>
    </div>
    <!-- /#wrapper -->
    <?php include 'includes/footer.php'; ?>

</body>

</html>