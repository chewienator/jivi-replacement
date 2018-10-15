<?php
session_start();
//include session check
include('../session_check.php');

//include the autoloader class
include('../autoloader.php');

//let's check if we can create timetables or period is closed
$options = new Options();
$option = $options->getOption('timetables_open');

if($option == 'false'){
    //timetable session is closed so goto the dashboard man!
    header('Location: /dashboard.php');
}

/* STUDENT INFORMATION FOR TIMETABLE */

//check if the link has an actual ID or not
if(empty($_GET['id'])){
    //no id, no timetable, go to accounts list
    header('Location: /admin/accounts_list.php');
}
//get user information
$account = new Account();
$user = $account->getAccount($_GET['id']);

//get user bachelor enrolment
$enrolment = new Enrolment();
$myEnrolment = $enrolment->getEnrolmentById($_GET['id']);

//lets get the course list available for this bachelor 
$course = new Course();
$courses = $course->getCoursesForTimetableStd($myEnrolment['bachelor_id']);

//lets grab all the timetable for this person
$timetable = new Timetable();
$myTimetable = $timetable->getUserTimetableStd($_GET['id']);

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
                <h2>Timetable Editor</h2>
                <p>Here is all information related to this student's current timetable</p>
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
            </div>
            <div class="row pt-3">
                <!-- search  subjects column -->
                <div class="col-md-4 p-3">
                    <h2>Subjects</h2>
                    <p>Subjects available for this bachelor.</p>
                    <div class="container-fluid">
                        <!-- search subject -->
                        <div class="row">
                            <div class="d-flex">
                                <input type="text" id="search" onkeyup="search()" placeholder="Search course" name="search">
                                <button> <i class="fa fa-search"> </i> </button>
                            </div>
                        </div>
                        
                        <!--search results -->
                        <div class="row pt-3">
                            <div class="list-group w-100">
                                <?php foreach($courses AS $key=>$course){ 
                                    //save the group id cause it will be lost in the sessions loop
                                    $group_id = $key;
                                ?>
                                <div class="list-group-item flex-column align-items-start searchable" data-name="<?php echo $course['course_name'].' - '.$course['course_code'].' - '.$course['group_name']; ?>">
                                    <div class="row">
                                        <div class="col-12 justify-content-between mb-1">
                                            <h6><?php echo $course['course_name'].' - '.$course['course_code'].' - '.$course['group_name']; ?></h6>
                                        </div>
                                        <div class="col-8 justify-content-between mb-1">
                                            <small>
                                            <?php 
                                                foreach($course['sessions'] AS $key=>$value) {
                                                    echo 'Session '. ($key+1) .': ';
                                                    switch($value['day']){
                                                        case 1:
                                                            echo "Monday";
                                                            break;
                                                        case 2:
                                                            echo "Tuesday";
                                                            break;
                                                        case 3:
                                                            echo "Wednesday";
                                                            break;
                                                        case 4:
                                                            echo "Thursday";
                                                            break;
                                                        case 5:
                                                            echo "Friday";
                                                            break;
                                                        case 6:
                                                            echo "Saturday";
                                                            break;
                                                    }
                                                    
                                                    switch($value['time_block']){
                                                        case 1:
                                                            echo " 8am - 10am";
                                                            break;
                                                        case 2: 
                                                            echo " 10am - 12pm";
                                                            break;
                                                        case 3:
                                                            echo " 1pm - 3pm";
                                                            break;
                                                        case 4:
                                                            echo " 3pm - 5pm";
                                                            break;
                                                        case 5:
                                                            echo " 5pm - 7pm";
                                                            break;
                                                        case 6:
                                                            echo " 7pm - 9pm";
                                                            break;
                                                    }
                                                    echo '<br>';
                                                }
                                            ?>   
                                            </small>
                                        </div>
                                        <div class="col-4 d-flex justify-content-end align-self-end">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <!--<button type="button" class="btn">i</button>-->
                                                <button type="button" class="btn btn-secondary" onclick="moveGroup(<?php echo $group_id; ?>);" data-group-id="<?php echo $group_id; ?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- second column TIMETABLE -->
                <div class="col-md-8 p-3">
                    <div class="row">
                        <div class="container-fluid">
                            <h2><?php echo $user['name'].' '.$user['surname']; ?> Timetable</h2>
                            <p><strong>Bachelor: </strong><?php echo $myEnrolment['bachelor_name'].' ('.$myEnrolment['cricos'].')'; ?></p>
                            <div class="table-responsive d-none d-lg-block">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">time / day</th>
                                        <th scope="col">Monday</th>
                                        <th scope="col">Tuesday</th>
                                        <th scope="col">Wednesday</th>
                                        <th scope="col">Thursday</th>
                                        <th scope="col">Friday</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="b-1">
                                        <th scope="row">8am - 10am</th>
                                        <td class="day-1"></td>
                                        <td class="day-2"></td>
                                        <td class="day-3"></td>
                                        <td class="day-4"></td>
                                        <td class="day-5"></td>
                                    </tr>
                                    <tr class="b-2">
                                        <th scope="row ">10am - 12am</th>
                                        <td class="day-1"></td>
                                        <td class="day-2"></td>
                                        <td class="day-3"></td>
                                        <td class="day-4"></td>
                                        <td class="day-5"></td>
                                    </tr>
                                    <tr class="b-3">
                                        <th scope="row">1pm - 3pm</th>
                                        <td class="day-1"></td>
                                        <td class="day-2"></td>
                                        <td class="day-3"></td>
                                        <td class="day-4"></td>
                                        <td class="day-5"></td>
                                    </tr>
                                    <tr class="b-4">
                                        <th scope="row">3pm - 5pm</th>
                                        <td class="day-1"></td>
                                        <td class="day-2"></td>
                                        <td class="day-3"></td>
                                        <td class="day-4"></td>
                                        <td class="day-5"></td>
                                    </tr>
                                    <tr class="b-5">
                                        <th scope="row">5pm - 7pm</th>
                                        <td class="day-1"></td>
                                        <td class="day-2"></td>
                                        <td class="day-3"></td>
                                        <td class="day-4"></td>
                                        <td class="day-5"></td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                            
                            <!-- Timetable shown as list of Days with name of subject and hours -->
                            <div class="container-fluid d-none d-sm-block d-md-block">
                                <p> </p>
                            </div>
                            <div class="d-flex justify-content-end">
                                <input type="hidden" id="user_id" value="<?php echo $_GET['id']; ?>"/>
                                <button type="button" class="btn btn-primary" onclick="submitTimetable();">Submit Timetable</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer>
        <?php include('includes/footer.php'); ?>
    </footer>
    <script type="text/javascript">
        <?php echo 'var availableCourses = '.json_encode($courses, JSON_PRETTY_PRINT).';'; ?>
        <?php echo 'var myTimetable = '.json_encode($myTimetable, JSON_PRETTY_PRINT).';'; ?>
    </script>
    <script type="text/javascript" src="/js/timetable.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>
</html>