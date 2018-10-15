<?php
session_start();
//include session check
include('../session_check.php');

//include the autoloader class
include('../autoloader.php');

//we need the bachelors list for this page
$bachelor = new Bachelor();
$bachelor_list = $bachelor->getBachelors();

//user types for accounts
$user_type = array('Admin','Student','Teacher');

//active options
$active_options = array('No'=>0,'Yes'=>1);

//lets check if they want to edit or create
if($_GET['a'] == 'e'){ 
    //lets get them the information they want
    $course = new Account();
    $info = $course->getAccount($_GET['id']);
    
    //only for students
    if($info['user_type']=='Student'){
        $bachelors = new Bachelor();
        $bachelor_list = $bachelor->getBachelors();
        //get user bachelor enrolment
        $enrolment = new Enrolment();
        $myEnrolment = $enrolment->getEnrolmentById($_GET['id']);
    }
    
    
    $page_title = "Edit Account";

}elseif($_GET['a'] == 'n'){ //create a new one
    $page_title = "Create Account";
}

print_r($myEnrolment);
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
                <h2>Account</h2>
                <p>Here is all information related to this account</p>
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
            </div>
            <div class="row pt-3">
                <div class="col-6">
                    <form id="main-form" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <label for="user_type">Account type</label>
                            <select name="user_type" id="user_type" class="form-control">
                                <?php foreach($user_type AS $type){
                                    //check if the course belongs to this bachelor
                                    if($type == $info['user_type']){ $selected = "selected"; }else{ $selected =""; }
                                    echo '<option '.$selected.'>'.$type.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="active">Active</label>
                            <select name="active" id="active" class="form-control">
                                <?php foreach($active_options AS $key => $value){
                                    //check if the course belongs to this bachelor
                                    if($value == $info['active']){ $selected = "selected"; }else{ $selected =""; }
                                    echo '<option value="'.$value.'" '.$selected.'>'.$key.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" id="name" value="<?php echo $info['name']; ?>" required/>
                        </div>
                        <div class="form-group">
                            <label for="surname">Surname</label>
                        <input class="form-control" type="text" name="surname" id="surname" value="<?php echo $info['surname']; ?>"required/>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input class="form-control" type="email" name="email" id="email" value="<?php echo $info['email']; ?>" placeholder="you@example.com" required/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" name="password" id="password" placeholder="minimum 6 characters"/>
                        </div>
                        <div class="form-group">
                            <label for="profile_image">Profile Image</label>
                            <input class="form-control" type="file" name="profile_image" id="profile_image"/>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input class="form-control" type="text" name="address" id="address" value="<?php echo $info['address']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone / Mobile</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="<?php echo $info['phone']; ?>"/>
                        </div>
                        
                        <input type="hidden" name="a" value="<?php echo $_GET['a']; ?>">
                        <input type="hidden" name="h" value="account">
                        
                        
                        <?php if($_GET['a'] == 'e'){ ?>
                        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                        <input type="hidden" name="old_pw" value="<?php echo $info['password']; ?>">
                        <?php  }  ?>
                        <button class="btn btn-primary mt-2" id="save-btn" type="submit"/>Save</button>
                    </form>
                </div>
                <div class="col-6">
                    <div class="container">
                        <h6>Enrolment</h6>
                        
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createGroup">Enrol Student</button>
                        
                        <div class="container-fluid pt-3">
                            <div class="list-group w-100 curriculum-list">
                                <?php 
                                if(count($myEnrolment) > 0){
                                ?>
                                <div class="list-group-item flex-column align-items-start <?php echo 'c'.$myEnrolment['bachelor_id']; ?>">
                                    <div class="row">
                                        <div class="col justify-content-between">
                                            <h6 class="mb-1"><a href="/admin/bachelor.php?a=e&id=<?php echo $myEnrolment['bachelor_id']; ?>"><?php echo $myEnrolment['bachelor_name'].' -  '.$myEnrolment['cricos']; ?></a></h6>
                                        </div>
                                        <div class="col d-flex justify-content-end align-self-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-danger" onclick="enrolment('d',<?php echo $myEnrolment['bachelor_id']; ?>);"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php  }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
        <!-- add course to curriculum Modal -->
        <div class="modal fade" id="createGroup" tabindex="-1" role="dialog" aria-labelledby="addGroup" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addGroup">Enrol student in a bachelor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="group-form" method="post">
                            <div class="form-group">
                                <label for="bachelor_id">Bachelor</label>
                                <select name="bachelor_id" class="form-control" required>
                                    <option></option>
                                    <?php 
                                    if(count($bachelor_list)>0){
                                        
                                        foreach($bachelor_list AS $bachelor){
                                            echo '<option value="'.$bachelor['id'].'">'.$bachelor['name'].' '.$bachelor['code'].'</option>';
                                        }
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
                        <button id="submitGroup" type="button" onclick="submitEnrol()" class="btn btn-primary">Enrol student</button>
                    </div>
                </div>
            </div>
        </div>
    
        <script type="text/javascript" src="js/form_submit.js"></script>
        <script type="text/javascript" src="/js/common.js"></script>
        <script type="text/javascript">
            
            //this function sends the data to create a new group
            function submitEnrol(){
                
                let formData = $('#group-form').serialize();
                $.ajax({
                    url: '/admin/ajax/enrolment.ajax.php',
                    method: 'post',
                    dataType: 'json',
                    data: formData,
                }).done( (response) => {
                    $('#createGroup').modal('toggle');
                
                        /* modal fix (not working completely) */
                        $('body').removeClass('modal-open'); 
                        $('.modal-backdrop').remove();
                        /* /fix */
                    if(response.success == true){
                        if(response.div.length > 0){
                            //we have to append the new course
                            $('.'+response.div).append(response.bachelor);
                        }
                    }
                    //popup the notification message
                    msgHandler(response.success, response.msg);
                });
            }
            
            //function to delete groups
            function enrolment(a, bachelor_id){
                $.ajax({
                    url: '/admin/ajax/enrolment.ajax.php',
                    method: 'post',
                    dataType: 'json',
                    data: {a: a, bachelor_id: bachelor_id , id: <?php echo $info['id']; ?> },
                }).done( (response) => {
                    if(response.success == true){
                        //if delete was successfull
                        if(response.div.length > 0 && a =='d'){
                            //remove from current course
                            $('.c'+bachelor_id).remove();
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