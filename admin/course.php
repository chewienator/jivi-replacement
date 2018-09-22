<?php
session_start();
//include the autoloader class
include('../autoloader.php');

//we need the bachelors list for this page
$bachelor = new Bachelor();
$bachelor_list = $bachelor->getBachelors();

//lets check if they want to edit or create
if($_GET['a'] == 'e'){ 
    //lets get them the information they want
    $course = new Course();
    $info = $course->getCourse($_GET['id']);
    $page_title = "Edit Course";
    print_r($info);
    
}elseif($_GET['a'] == 'n'){ //create a new one
    $page_title = "Create Bachelor";
}

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
                <h2>Course</h2>
                <p>Here is all information related to this course</p>
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
            </div>
            <div class="row pt-3">
                <div class="col-6">
                    <form id="course" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="<?php echo $info['name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <select name="bachelor_id" class="form-control">
                                <?php foreach($bachelor_list AS $bachelor){
                                    //check if the course belongs to this bachelor
                                    if($bachelor['id'] == $info['bachelor_id']){ $selected = "selected"; }else{ $selected =""; }
                                    echo '<option value="'.$bachelor['id'].'" '.$selected.'>'.$bachelor['name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="overview">Overview</label>
                            <textarea class="form-control" name="overview" id="overview" rows="4"><?php echo $info['overview']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="learning_outcomes">Learning Outcomes</label>
                            <textarea class="form-control" name="learning_outcomes" id="learning_outcomes" rows="4"><?php echo $info['learning_outcomes']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="cricos">Program code</label>
                            <input type="text" name="code" class="form-control" id="code" value="<?php echo $info['code']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="hours_per_week">Hours per week</label>
                            <input type="text" name="hours_per_week" class="form-control" id="hours_per_week" value="<?php echo $info['hours_per_week']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="credits">Credits</label>
                            <input type="text" name="credits" class="form-control" id="credits" value="<?php echo $info['credits']; ?>" required>
                        </div>
                        <input type="hidden" name="a" value="<?php echo $_GET['a']; ?>">
                        <input type="hidden" name="h" value="course">
                        
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