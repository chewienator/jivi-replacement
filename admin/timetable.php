<?php
session_start();
//include session check
include('../session_check.php');

//include the autoloader class
include('../autoloader.php');

//get user bachelor enrolment
$enrolment = new Enrolment();
$myEnrolment = $enrolment->getEnrolmentById($_GET['id']);

//lets get the course list available for this bachelor 
$course = new Course();
$courses = $course->getCoursesForTimetable($myEnrolment['bachelor_id']);

//lets grab all the timetable for this person
$timetable = new Timetable();
$myTimetable = $timetable->getUserTimetable($_GET['id']);

$page_title = "Timetable creator";

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
                <h2>Timetable creator</h2>
                <p>Here you will find all information for a student's timetable</p>
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
            </div>
            <div class="row pt-3">

            </div>
        </div>
        <!-- /#page-content-wrapper -->
    <script type="text/javascript" src="js/form_submit.js"></script>
    <script type="text/javascript">
        
        function removeCourse(course){
            console.log(course);
            $.ajax({
                url: '/admin/ajax/curriculum.ajax.php',
                method: 'post',
                dataType: 'json',
                data: {a: 'd', bachelor_id: <?php echo $info['id']; ?>, course_id: course[0].dataset.courseId },
            }).done( (response) => {
                $('.spinner').remove();
                if(response.success == true){
                    if(response.div.length > 0){
                        $('.'+response.div).remove();
                    }
                    console.log(response.msg);
                }else{
                    console.log('login failed');
                }
            });
        }
    </script>
    </div>
    <!-- /#wrapper -->
    <?php include 'includes/footer.php'; ?>

</body>

</html>