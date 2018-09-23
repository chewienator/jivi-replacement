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
    $page_title = "Edit Account";

}elseif($_GET['a'] == 'n'){ //create a new one
    $page_title = "Create Account";
}

print_r($info);

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
                            <label for="user_type">Name</label>
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
                            <input class="form-control" type="password" name="password" id="password" placeholder="minimum 6 characters" required/>
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
                        <!--<div class="form-group">
                            <select name="bachelor_id" class="form-control">
                                <?php foreach($bachelor_list AS $bachelor){
                                    //check if the course belongs to this bachelor
                                    if($bachelor['id'] == $info['bachelor_id']){ $selected = "selected"; }else{ $selected =""; }
                                    echo '<option value="'.$bachelor['id'].'" '.$selected.'>'.$bachelor['name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>-->
                        <?php 
                            if($message){
                                echo "<div class=\"alert alert-$message_class alert-dismissable fade show\">
                                        $message
                                        <button class=\"close\" type=\"button\" data-dismiss=\"alert\">&times;</button>
                                </div>";
                            }
                        ?>
                        <input type="hidden" name="a" value="<?php echo $_GET['a']; ?>">
                        <input type="hidden" name="h" value="account">
                        
                        <?php if($_GET['a'] == 'e'){ ?>
                        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                        <?php  }  ?>
                        <button class="btn btn-primary mt-2" id="save-btn" type="submit"/>Save</button>
                    </form>
                </div>
                <div class="col-6">Here there be a calendar for the day?</div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    <script type="text/javascript" src="js/form_submit.js"></script>
    </div>
    <!-- /#wrapper -->
    <?php include 'includes/footer.php'; ?>

</body>

</html>