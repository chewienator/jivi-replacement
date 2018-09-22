<?php
session_start();
//include the autoloader class
include('../autoloader.php');

//lets check if they want to edit or create
if($_GET['a'] == 'e'){ //edit the bachelor
    //lets get them the information for the achelor they want
    $bachelor = new Bachelor();
    $info = $bachelor->getBachelor($_GET['id']);
    $page_title = "Edit Bachelor";
    
}elseif($_GET['a'] == 'n'){ //create a new one
    $page_title = "Create Bachelor";
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
                <h2>Bachelors</h2>
                <p>Here you will find all information bachelor related</p>
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
                <a href="bachelor.php?a=n" class="btn btn-primary">Create New Bachelor</a>
            </div>
            <div class="row pt-3">
                <div class="col-6">
                    <form id="bachelor" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="<?php echo $info['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="cricos">CRICOS</label>
                            <input type="text" name="cricos" class="form-control" id="cricos" value="<?php echo $info['cricos']; ?>">
                        </div>
                        <input type="hidden" name="a" value="<?php echo $_GET['a']; ?>">
                        
                        <?php if($_GET['a'] == 'e'){ ?>
                        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                        <?php  }  ?>
                        
                        <button class="btn btn-primary mt-2" id="save-btn" type="submit"/>Save</button>
                    </form>
                </div>
                <div class="col-6">Here there be a calendar for the day?</div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    <script type="text/javascript" src="js/bachelor.js"></script>
    </div>
    <!-- /#wrapper -->
    <?php include 'includes/footer.php'; ?>

</body>

</html>