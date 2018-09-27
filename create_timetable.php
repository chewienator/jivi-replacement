<?php
session_start();
//include session check
include('session_check.php');

//include the autoloader class
include('autoloader.php');

//get user bachelor enrolment
$enrolment = new Enrolment();
$myEnrolment = $enrolment->getEnrolmentById($_SESSION['id']);

//lets get the course list 
$course = new Course();
$courses = $course->getCoursesForTimetable($myEnrolment['bachelor_id']);

$page_title = "Timetable creator";

?>

<!doctype html>
<html>
    <?php include('includes/head.php'); ?>
    <body>
        <?php include('includes/navbar.php'); ?>
        <!-- container -->
        <div class="container-fluid">
            <div class="row">
                
                <!-- search  subjects column -->
                <div class="col-md-4 p-3">
                    <h2>Subjects</h2>
                    <div class="container-fluid">
                        <!-- search subject -->
                        <div class="row">
                            <form action="/action_page.php"> <!-- action page? -->
                                <div class="d-flex">
                                    <input type="text" placeholder="Search course" name="search">
                                    <button type="submit"> <i class="fa fa-search"> </i> </button>
                                </div>
                            </form>
                        </div>
                        
                        <!--search results -->
                        <div class="row pt-3">
                            <div class="list-group w-100">
                                <?php foreach($courses AS $key=>$course){ 
                                    //save the group id cause it will be lost in the sessions loop
                                    $group_id = $key;
                                ?>
                                <div class="list-group-item flex-column align-items-start">
                                    <div class="row">
                                        <div class="col-12 justify-content-between mb-1">
                                            <h6><?php echo $course['course_name'].' - '.$course['course_code']; ?></h6>
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
                                                <button type="button" class="btn btn-secondary"  onclick="moveGroup($(this));" data-group-id="<?php echo $group_id; ?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <!-- second colomn TIMETABLE -->
                <div class="col-md-8 p-3">
                    <div class="row">
                        <div class="container-fluid">
                            <h2> My Timetable </h2>
                            <p> create your timetable before enrolling for your next term  </p>
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
                                <button type="button" class="btn btn-primary">Enrol</button>
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
        <?php echo 'var myCourses = '.json_encode($courses, JSON_PRETTY_PRINT).';'; ?>
        var myTimetable = [];
        
        //This function will add or remove a group from our timetable
        function moveGroup(group){
            
            groupId = group[0].dataset.groupId;
            //lets grab the sessions from the group
            sessions = myCourses[groupId].sessions;
            
            //session collision check
            
            //check if the group has been selected (group added to timetable)
            if($(group).hasClass('selected')){
                
                //remove sessions from timetable
                for (var key in sessions){
                    $('.b-'+sessions[key].time_block+' .day-'+sessions[key].day).empty();
                }
                
                //remove group from myTimetable array
                myTimetable = jQuery.grep(myTimetable, function(value) {
                  return value != groupId;
                });
                
                //change icon to + and back to normal button color
                $(group).removeClass('btn-danger selected').addClass('btn-secondary').children().removeClass('fa-minus').addClass('fa-plus');                
            
            }else{ //we are adding the course group to our timetable
                
                //add sessions to timetable
                for (var key in sessions){
                    $('.b-'+sessions[key].time_block+' .day-'+sessions[key].day).append(myCourses[groupId].course_name+' - Room: <b>'+sessions[key].room+'</b');
                }
                
                //add group to myTimetable array
                myTimetable.push(groupId);
                
                //change the icon to an X and change the color of the button and add selected class
                $(group).removeClass('btn-secondary').addClass('btn-danger selected').children().removeClass('fa-plus').addClass('fa-minus');
            }
        }
        
    </script>
</html>