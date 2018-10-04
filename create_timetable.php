<?php
session_start();
//include session check
include('session_check.php');

//include the autoloader class
include('autoloader.php');

//let's check if we can create timetables or period is closed
$options = new Options();
$option = $options->getOption('timetables_open');
if($option == 'false'){
    //timetable session is closed so goto the dashboard man!
    header('Location: /dashboard.php');
}

//get user bachelor enrolment
$enrolment = new Enrolment();
$myEnrolment = $enrolment->getEnrolmentById($_SESSION['id']);

//lets get the course list available for this bachelor 
$course = new Course();
$courses = $course->getCoursesForTimetable($myEnrolment['bachelor_id']);

//lets grab all the timetable for this person
$timetable = new Timetable();
$myTimetable = $timetable->getUserTimetable($_SESSION['id']);

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
                                                <button type="button" class="btn btn-secondary" onclick="moveGroup($(this));" data-group-id="<?php echo $group_id; ?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
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
        var myGroups = [];
        
        $(document).ready(function(){
            //if we already have a timetable saved, load it
            if(myTimetable.length > 0){
                fillTimetable(myTimetable);
            }else{
                console.log(myTimetable);
            }
        });
        
        //this function load the timetable
        function fillTimetable(table){
            //loop thru your saved timetable groups
            for (var key in table) {
                //append the data to the actual block
                $('.b-'+table[key].time_block+' .day-'+table[key].day).append(table[key].course_name+' - Room: <b>'+table[key].room_name+'</b');
            
                //check if the group does not exist already in the array
                if(myGroups.indexOf(table[key].id) == -1){
                    //add the group to myGroups array so we keep track
                    myGroups.push(table[key].id);
                    //change the button state for that group to selected
                    $('[data-group-id='+table[key].id+']').removeClass('btn-secondary').addClass('btn-danger selected').children().removeClass('fa-plus').addClass('fa-minus');
                }else{
                    console.log(myGroups.indexOf(table[key].id));
                }
            }
        }
        
        //This function will add or remove a group from our timetable
        function moveGroup(group){
            
            groupId = group[0].dataset.groupId;
            //lets grab the sessions from the group
            sessions = availableCourses[groupId].sessions;
            
            //session collision check
            
            //check if the group has been selected (group added to timetable)
            if($(group).hasClass('selected')){
                
                //remove sessions from timetable
                for (var key in sessions){
                    $('.b-'+sessions[key].time_block+' .day-'+sessions[key].day).empty();
                }
                
                //remove group from myGroups array
                myGroups = jQuery.grep(myGroups, function(value) {
                  return value != groupId;
                });
                
                //change icon to + and back to normal button color
                $(group).removeClass('btn-danger selected').addClass('btn-secondary').children().removeClass('fa-minus').addClass('fa-plus');                
            
            }else{ //we are adding the course group to our timetable
                
                //add sessions to timetable
                for (var key in sessions){
                    $('.b-'+sessions[key].time_block+' .day-'+sessions[key].day).append(availableCourses[groupId].course_name+' - Room: <b>'+sessions[key].room+'</b');
                }
                
                //add group to myGroups array
                myGroups.push(parseInt(groupId));
                
                //change the icon to an X and change the color of the button and add selected class
                $(group).removeClass('btn-secondary').addClass('btn-danger selected').children().removeClass('fa-plus').addClass('fa-minus');
            }
        }
        function submitTimetable(){
            console.log(myGroups);
            $.ajax({
                url: '/ajax/timetable.ajax.php',
                method: 'post',
                dataType: 'json',
                data: {a: 'n', user_id: <?php echo $_SESSION['id']; ?>, courses: myGroups },
            }).done( (response) => {
                console.log(response);
                /*$('.spinner').remove();
                if(response.success == true){
                    if(response.div.length > 0){
                        $('.'+response.div).remove();
                    }
                    console.log(response.msg);
                }else{
                    console.log('login failed');
                }*/
            });
        }
        
        //this will be our search function to be implemented
        /*
        function search(){
            var input, filter, ul, li, a, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }*/
        
    </script>
</html>