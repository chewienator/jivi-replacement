<?php
session_start();
//include session check
include('session_check.php');

//include the autoloader class
include('autoloader.php');

//we create an object of course all good! 
$course = new Course();

//or a better way to say it is...
//the bucket where you wanted to store the results is named myProfile
//the object let's you access the methods of the class and get info, remember that.

$myCourse = $course->getCourses(); 
//ok lets go print the list! 


$page_title = "Subjects";
?>
<!doctype html>
<html>
    <?php include('includes/head.php'); ?>
    <body>
        <?php include('includes/navbar.php'); ?>
        <!-- container -->
        <div class="container-fluid">
            <div class="row">
                <!-- search  subjects colomn -->
                <div class="col-md-4 p-3">
                    <h2>Subjects</h2>
                    <div class="container-fluid">
                        <div class="row">
                            <form action="/action_page.php"> <!-- action page? -->
                                <div class="d-flex">
                                    <input type="text" placeholder="Search course" name="search">
                                    <button type="submit"> <i class="fa fa-search"> </i> </button>
                                </div>
                            </form>
                        </div>
                        <div class="row pt-3">
                            <div class="list-group w-100"><!-- main list container -->
                                <?php foreach($myCourse AS $course){ //loop thru results array ?>
                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="row">
                                        <div class="col justify-content-between">
                                            <h6 class="mb-1"><?php echo $course['name']; ?></h6>
                                            <small class="mb-1"> <?php echo $course['code']; ?></small>
                                        </div>
                                    </div>
                                </div>
                                <?php } //closing the loop ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- second colomn -->
                <div class="col-md-8 p-3">
                    <!-- Subject Detail row -->
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
    </body>
    <footer>
        <?php include('includes/footer.php'); ?>
    </footer>
   
</html>