<?php
session_start();
include('session_check.php');

//include the autoloader class
include('autoloader.php');

// $study_path = new Study_path();
// $myStudy_path = $study_path->getStudy_path(); 


$page_title = "My Study Path";
?>
<!doctype html>
<html>
    <?php include('includes/head.php'); ?>
    <body>
        <?php include('includes/navbar.php'); ?>
        <!-- container -->
        <div class="container-fluid">
            <div class="row">
                <!-- study path's subjects list colomn -->
                <div class="col-md-4 p-3">
                    <h2>My Study Path</h2>
                    <div class="container-fluid">
                        <div class="row pt-3">
                            <div class="list-group w-100">
                                <!-- <*/?php foreach($myStudy_path AS $study_path){ ?> -->
                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="row">
                                        <div class="col justify-content-between">
                                            <h6 class="mb-1">SUB NAME <!-- </*?php echo $course['name']; ?>--></h6>
                                            <small class="mb-1"> INT4567 <!--<*/?php echo $course['code']; ?>--></small>
                                        </div>
                                    </div>
                                </div>
                                <!-- </*?php } ?> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- second colomn -->
                <div class="col-md-8 p-3 d-none d-md-block">
                    <!-- Subject Detail row -->
                    <div class="row" >
                        <div class="container-fluid">
                            <div class="col-12">
                                <h2> SUBJ NAME <!-- </*?php echo $course['name']; ?>--> </h2>
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
    </body>
    <?php include('includes/footer.php'); ?>
</html>