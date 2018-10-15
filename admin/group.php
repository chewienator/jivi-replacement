<?php
session_start();
include('../session_check.php');
include('../autoloader.php');

//lets check if they want to edit or create
if($_GET['a'] == 'e'){ //edit the message
    //lets get them the information for the message they want
    $group = new Group();
    $info = $group->getGroup($_GET['id']);
    $accounts = new Account();
    $teacher_accounts = $accounts->getTeacherAccounts();
    $rooms = new Room();
    $room_list = $rooms->getRooms();
    $sessions = new Session();
    $session_list = $sessions->getSessions($_GET['id']);
    $page_title = "Edit Group";
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
                <h2>Group</h2>
                <p>Here you can edit groups and add session blocks for it</p>
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
            </div>
            <div class="row pt-3">
                <div class="col-6">
                    <form id="main-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="<?php echo $info['name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="teacher_id">Teacher</label>
                            <select name="teacher_id" class="form-control">
                                <?php 
                                if(count($teacher_accounts)>0){
                                    foreach($teacher_accounts AS $teacher){
                                        //check if the course belongs to this bachelor
                                        if($teacher['id'] == $info['teacher_id']){ $selected = "selected"; }else{ $selected =""; }
                                        echo '<option value="'.$teacher['id'].'" '.$selected.'>'.$teacher['name'].' '.$teacher['surname'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="a" value="e">
                        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                        
                        <button class="btn btn-primary mt-2" id="save-btn" type="submit"/>Save</button>
                    </form>
                </div>
                <div class="col-6">
                    <div class="container">
                        <h6>Sessions</h6>
                        
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createGroup">Create new session</button>
                        
                        <div class="container-fluid pt-3">
                            <div class="list-group w-100 curriculum-list">
                                <?php 
                                if(count($session_list) >0){
                                    foreach($session_list AS $session){ 
                                ?>
                                <div class="list-group-item flex-column align-items-start <?php echo 'c'.$session['id']; ?>">
                                    <div class="row">
                                        <div class="col justify-content-between">
                                            <h6 class="mb-1"><?php echo $session['name'].' '.$days[$session['day']].' - '.$blocks[$session['time_block']]; ?></a></h6>
                                        </div>
                                        <div class="col d-flex justify-content-end align-self-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-danger" onclick="session('d',<?php echo $session['id']; ?>);"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     <!-- /#page-content-wrapper -->
        <!-- Modal -->
        <div class="modal fade" id="createGroup" tabindex="-1" role="dialog" aria-labelledby="addGroup" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addGroup">Create session block</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="group-form" method="post">
                            <div class="form-group">
                                <label for="room_id">Room</label>
                                <select name="room_id" class="form-control" required>
                                    <option></option>
                                    <?php 
                                    if(count($room_list)>0){
                                        
                                        foreach($room_list AS $room){
                                            echo '<option value="'.$room['id'].'">'.$room['name'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="day">Day</label>
                                <select name="day" class="form-control" required>
                                    <option></option>
                                    <?php 
                                    foreach($days AS $value => $day){
                                            echo '<option value="'.$value.'">'.$day.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="time_block">Time Block</label>
                                <select name="time_block" class="form-control" required>
                                    <option></option>
                                    <?php 
                                    foreach($blocks AS $value => $block){
                                            echo '<option value="'.$value.'">'.$block.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="hidden" name="a" value="n">
                            <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                         </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button id="submitSession" type="button" onclick="submitSession()" class="btn btn-primary">Create session</button>
                    </div>
                </div>
            </div>
        </div>
    
        <script type="text/javascript" src="js/form_submit.js"></script>
        <script type="text/javascript" src="/js/common.js"></script>
        <script type="text/javascript">
            
            //this function sends the data to create a new group
            function submitSession(){
                
                let formData = $('#group-form').serialize();
                $.ajax({
                    url: '/admin/ajax/session.ajax.php',
                    method: 'post',
                    dataType: 'json',
                    data: formData,
                }).done( (response) => {
                    if(response.success == true){
                        if(response.div.length > 0){
                            //we have to append the new course
                            $('.'+response.div).append(response.session);
                        }
                    }
                    $('#createGroup').modal('toggle');
                
                    /* modal fix (not working completely) */
                    $('body').removeClass('modal-open'); 
                    $('.modal-backdrop').remove();
                    /* /fix */
                    
                    //popup the notification message
                    msgHandler(response.success, response.msg);
                });
            }
            
            //function to delete groups
            function session(a, session_id){
                $.ajax({
                    url: '/admin/ajax/session.ajax.php',
                    method: 'post',
                    dataType: 'json',
                    data: {a: a, session_id: session_id },
                }).done( (response) => {
                    if(response.success == true){
                        //if delete was successfull
                        if(response.div.length > 0 && a =='d'){
                            //remove from current course
                            $('.c'+session_id).remove();
                        }
                    }
                    //popup the notification message
                    msgHandler(response.success, response.msg);
                });
            }
        </script>
    </div>
    <!-- /#wrapper -->
    <?php include 'includes/footer.php'; ?>

</body>

</html>