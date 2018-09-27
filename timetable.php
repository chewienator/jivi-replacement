<?php
session_start();
//include session check
include('session_check.php');

//include the autoloader class
include('autoloader.php');

//lets get the course list 
$course = new Course();
$myCourse = $course->getCourses(); 

//lets grab all the timetable for this person
$timetable = new Timetable();
$myTimetable = $timetable->getUserTimetable($_SESSION['id']);

$page_title = "Timetable";

?>

<!doctype html>
<html>
    <?php include('includes/head.php'); ?>
    <body>
        <?php include('includes/navbar.php'); ?>
        <!-- container -->
        <div class="container-fluid">
            <div class="row">
                <!-- second colomn TIMETABLE -->
                <div class="col-md-12 p-3">
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
    </body>
    <footer>
        <?php include('includes/footer.php'); ?>
    </footer>
    <script type="text/javascript">
        <?php echo 'var myTimetable = '.json_encode($myTimetable, JSON_PRETTY_PRINT).';'; ?>
        $(document).ready(function(){
            fillTimetable(myTimetable);
        });
        function fillTimetable(table){
                
            for (var key in table) {
                //append the data to the actual block
                $('.b-'+table[key].time_block+' .day-'+table[key].day).append(table[key].course_name+' - Room: <b>'+table[key].room_name+'</b');
            }
        }
        
    </script>
</html>