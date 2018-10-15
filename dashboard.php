<?php
session_start();

include('session_check.php');
include('autoloader.php');

$profile = new Account();
$myProfile = $profile->getAccount($_SESSION['id']);

$message = new Message();
$myMessage = $message ->getMessages();

if($_SESSION['user_type'] == 'Student'){
    
    //get user bachelor enrolment
    $enrolment = new Enrolment();
    $myEnrolment = $enrolment->getEnrolmentById($_SESSION['id']);
    
    //lets get the course list available for this bachelor 
    $course = new Course();
    $courses = $course->getCoursesForTimetableStd($myEnrolment['bachelor_id']);
    
    //lets grab all the timetable for this person
    $timetable = new Timetable();
    $myTimetable = $timetable->getUserTimetableStd($_SESSION['id']);
    
    $sortedTT = new Timetable();
    $mysortedTT = $sortedTT->sortedTimeTableStd($_SESSION['id']);

}elseif($_SESSION['user_type']=='Teacher'){
    //lets get the course list available for this bachelor 
    $course = new Course();
    $courses = $course->getCoursesForTimetableTch();
    
    //lets grab all the timetable for this person
    $timetable = new Timetable();
    $myTimetable = $timetable->getUserTimetableTch($_SESSION['id']);
    
    $sortedTT = new Timetable();
    $mysortedTT = $sortedTT->sortedTimeTableTch($_SESSION['id']);
}


$days = array(
            1 =>'Monday', 
            2 =>'Tuesday', 
            3 =>'Wednesday',
            4 =>'Thursday',
            5 =>'Friday'
        );
$blocks = array(
            1=>'8.00am - 10.00am', 
            2=>'10.00am - 12.00am', 
            3=>'1.00pm - 3.00pm',
            4=>'3.00pm - 5.00pm',
            5=>'5.00pm - 7.00pm'
        );

$page_title = "Dashboard";
?>
<!doctype html>
<html>
    <?php include('includes/head.php'); ?>
    <body>
        <?php include('includes/navbar.php'); ?>
        <!-- container -->
        <div class="container-fluid">
            <div class="row">
                
                <!-- messages column -->
                <div class="col-md-4 d-none d-lg-block p-3">
                    <div class="row">
                        <div class="container-fluid">
                            <h2> Messages </h2>
                            <div class="list-group p-3">
                                <?php foreach($myMessage AS $message){  ?>
                                 <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex justify-content-between">
                                         <h6 class="mb-1"><?php echo $message['subject']; ?></h6>
                                         <small><?php echo $message['date']; ?></small>
                                    </div>
                                    <p class="mb-1"><?php echo $message['body']; ?></p>
                                </a>
                             <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- second colomn -->
                <div class="col-md-8 p-3">
                    <?php if($_SESSION['user_type'] == 'Student'){ ?>
                    <!-- Profile colo -->
                    <div class="row" >
                        <div class="container-fluid">
                            <h2> Profile </h2>
                            <div class="row">
                                <div class="col-3">
                                    <img src="../images/dummy-person.jpg" class="img-fluid profile-image" alt="img-thumbnail" <?php echo $myProfile['profile_image']; ?> >
                                </div>
                                <div class=col-9>
                                    <ul>
                                        <li> Name:  <?php echo $myProfile['name']; ?> </li>
                                        <li> Surname: <?php echo $myProfile['surname']; ?></li> 
                                        <li> Mobile: <?php echo $myProfile['phone']; ?></li> 
                                        <li> Address: <?php echo $myProfile['address']; ?></li>
                                        <li> Student number: <?php echo $myProfile['id']; ?> </li> 
                                        <li> eMail: <?php echo $myProfile['email']; ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- timetable column -->
                    <div class="row">
                        <div class="container-fluid">
                            <h2 class="col-sm-12 pt-3"> My Weekly Timetable </h2>
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
                            <div class="d-lg-none d-md-block">
                                <ul class="list-group p-3">
                                    <?php 
                                    $day = 0;
                                    foreach($mysortedTT AS $session){  
                                    
                                        //if this is the first time we are displaying this day
                                        if($day != $session['day']){
                                            echo'
                                            <li class="list-group-item active activeTT">
                                                <h6 class="mb-1">'.$days[$session['day']].'</h6>
                                            </li>';
                                            $day = $session['day'];
                                        }

                                        echo'<li class="list-group-item">
                                                    '.$session['name'].' - '.$session['room_name'].'<br>
                                                    '.$blocks[$session['time_block']].'
                                            </li>';
                                  } ?>
                                </ul>
                            </div>
                        </div> <!-- insert table from timetable.php -->
                    </div>
                </div>
            </div>
        </div><!-- end of container div -->
    </body>
    <?php include('includes/footer.php'); ?>
    <script type="text/javascript">
        <?php echo 'var availableCourses = '.json_encode($courses, JSON_PRETTY_PRINT).';'; ?>
        <?php echo 'var myTimetable = '.json_encode($myTimetable, JSON_PRETTY_PRINT).';'; ?>
    </script>
    <script type="text/javascript" src="/js/timetable.js"></script>
</html>