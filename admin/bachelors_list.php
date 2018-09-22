<?php
session_start();
//include the autoloader class
include('../autoloader.php');

//let's query for all created bachelors
$bachelor = new Bachelor();
$bachelor_list = $bachelor->getBachelors();


$page_title = "Bachelor list";
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
                <h2>Bachelors List</h2>
                <p>Here you will find all bachelors created</p>
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
                <a href="bachelor.php?a=n" class="btn btn-primary">Create New Bachelor</a>
            </div>
            <div class="row pt-3">
                <div class="col-6">
                    <div class="list-group w-100">
                        <?php foreach( $bachelor_list AS $bachelor){ ?>
                        <div class="list-group-item flex-column align-items-start">
                            <div class="row">
                                <div class="col justify-content-between">
                                    <h6 class="mb-1"><?php echo $bachelor['name']; ?></h6>
                                </div>
                                <div class="col d-flex justify-content-end align-self-center">
                                    <div class="btn-group" role="group" aria-label="action buttons">
                                        <a href="bachelor.php?a=e&id=<?php echo $bachelor['id']; ?>" class="btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-6">Here there be a calendar for the day?</div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include 'includes/footer.php'; ?>

</body>

</html>