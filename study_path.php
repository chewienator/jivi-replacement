<?php
session_start();
include('session_check.php');
include('autoloader.php');

$study_path = new Study_path();
$myStudy_path = $study_path->getStudy_path($_SESSION['id']); 

$course = new Course();
$courses = $course->getCourses();

$page_title = "Study Path";
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
                    <h2>Study Path</h2>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="d-flex">
                                <input type="text" id="search" onkeyup="search()" placeholder="Search course" name="search">
                                <button> <i class="fa fa-search"> </i> </button>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="list-group w-100"><!-- main list container -->
                                <?php foreach($myStudy_path AS $course){ ?>
                                <div class="list-group-item list-group-item-action flex-column align-items-start searchable" data-name="<?php echo $course['name'].' - '.$course['code']; ?>">
                                    <div class="row">
                                        <div class="col justify-content-between" onclick="loadStudy_path(<?php echo $study_path['course_id']; ?>)">
                                            <h6 class="mb-1"><?php echo $course['name']; ?></h6>
                                            <small class="mb-1"> <?php echo $course['code']; ?></small>
                                        </div>
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
                                <button type="button" class="btn btn-info mb-3" onclick="goBackAnimation()"> <i class="fa fa-angle-left fa-2x"></i> </i> </button>
                                <div class="row">
                                    <div class="col-4 align-items-start">
                                        <h6> Course code: </h6>
                                    </div>
                                    <div class="col-6 align-items-end">
                                        <h6 id="course_code"></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 align-items-start">
                                        <h6> Credit:</h6>
                                    </div>
                                    <div class="col-8 align-items-end">
                                        <h6 id="course_credits"></h6>
                                    </div>
                                </div>
                                  <div class="row">
                                    <div class="col-4 align-items-start">
                                        <h6> Hours per week: </h6>
                                    </div>
                                    <div class="col-6 align-items-start">
                                        <h6 id="course_hours"></h6>
                                    </div>
                                </div>
                                <h6 class="mt-5"> LEARNING OUTCOMES </h6>
                                <p id="course_learning_outcomes"></p>
                                <h6 class="mt-5"> OVERVIEW</h6>
                                <p id="course_overview"></p>
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
        function loadStudy_path(id){
            //we do the ajax request for the course information
            $.ajax({
                url: '/ajax/course.ajax.php',
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
                    
                    $('#course_name').html(response.info.name);
                    $('#course_code').html(response.info.code);
                    $('#course_credits').html(response.info.credits);
                    $('#course_hours').html(response.info.hours_per_week);
                    $('#course_learning_outcomes').html(response.info.learning_outcomes);
                    $('#course_overview').html(response.info.overview);
                    
                },
                complete: function() {
                    openDetailAnimation();
                }
            });
        }
    </script>
</html>