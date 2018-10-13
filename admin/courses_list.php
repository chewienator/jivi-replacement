<?php
session_start();
//include session check
include('../session_check.php');

//include the autoloader class
include('../autoloader.php');

//let's query for all created bachelors
$course = new Course();
$course_list = $course->getCourses();

$page_title = "Courses list";

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
                <h2>Courses List</h2>
                <p>Here you will find all courses created</p>
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
                <a href="course.php?a=n" class="btn btn-primary">Create New Course</a>
                <div class="row p-3">
                    <form action="/action_page.php"> <!-- action page? -->
                        <div class="d-flex">
                            <input type="text" placeholder="Search bachelor" name="search">
                            <button type="submit"> <i class="fa fa-search"> </i> </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-4 p-3">
                    <div class="list-group w-100">
                        <?php foreach( $course_list AS $course ){ ?>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="row">
                                <div class="col justify-content-between">
                                    <h6 class="mb-1"><?php echo $course['name'].' - '.$course['code']; ?></h6>
                                </div>
                                <div class="col d-flex justify-content-end align-self-center">
                                    <div class="btn-group" role="group" aria-label="action buttons">
                                        <a href="course.php?a=e&id=<?php echo $course['id']; ?>" class="btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                
                
                <div class="col-md-8 p-3 d-none d-md-block">
                    <div class="row" >
                        <div class="container-fluid">
                            <div class="col-12">
                                <h2>  <?php echo $course['name']; ?> </h2>
                                <div class="row">
                                    <div class="col-4 align-items-start">
                                        <h6> Course code: </h6>
                                    </div>
                                    <div class="col-6 align-items-end">
                                        <h6> <?php echo $course['code']; ?> </h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 align-items-start">
                                        <h6> Credit:</h6>
                                    </div>
                                    <div class="col-8 align-items-end">
                                        <h6> <?php echo $course['credits']; ?> </h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 align-items-start">
                                        <h6> Hours per week: </h6>
                                    </div>
                                    <div class="col-6 align-items-start">
                                        <h6> <?php echo $course['hours_per_week']; ?> </h6>
                                    </div>
                                </div>
                                <h6 class="mt-5"> LEARNING OUTCOMES </h6>
                                <p> <?php echo $course['learning_outcomes']; ?></p>
                                <h6 class="mt-5"> OVERVIEW</h6>
                                <p> <?php echo $course['overview']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <?php include 'includes/footer.php'; ?>

</body>

</html>