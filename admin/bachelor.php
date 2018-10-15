<?php
session_start();
//include session check
include('../session_check.php');

//include the autoloader class
include('../autoloader.php');

//lets check if they want to edit or create
if($_GET['a'] == 'e'){ //edit the bachelor
    //lets get them the information for the achelor they want
    $bachelor = new Bachelor();
    $info = $bachelor->getBachelor($_GET['id']);
    $page_title = "Edit Bachelor";
    
    //for curriculum
    //we need all courses available for the dropdown list
    $courses = new Course();
    $course_list = $courses->getCoursesForCurrirulum($_GET['id']);
    
    //we need to get curriculum (table with relationship between bachelors and courses)
    $curriculum = new Curriculum();
    $curriculum_list = $curriculum->getCurrentCurriculum($_GET['id']);
    
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
                <h2>Bachelors</h2>
                <p>Here you will find all information bachelor related</p>
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
                <a href="bachelor.php?a=n" class="btn btn-primary">Create New Bachelor</a>
            </div>
            <div class="row pt-3">
                <div class="col-6">
                    <form id="main-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="<?php echo $info['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="cricos">CRICOS</label>
                            <input type="text" name="cricos" class="form-control" id="cricos" value="<?php echo $info['cricos']; ?>">
                        </div>
                        <input type="hidden" name="a" value="<?php echo $_GET['a']; ?>">
                        <input type="hidden" name="h" value="bachelor">
                        
                        <?php if($_GET['a'] == 'e'){ ?>
                        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                        <?php  }  ?>
                        
                        <button class="btn btn-primary mt-2" id="save-btn" type="submit"/>Save</button>
                    </form>
                </div>
                <div class="col-6">
                    <div class="container">
                        <h6>Curriculum</h6>
                        
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCourseModal">Add course to curriculum</button>
                        
                        <div class="container-fluid pt-3">
                            <div class="list-group w-100 curriculum-list">
                                <?php foreach($curriculum_list AS $course){ ?>
                                <div class="list-group-item flex-column align-items-start <?php echo 'c'.$course['course_id']; ?>">
                                    <div class="row">
                                        <div class="col justify-content-between">
                                            <h6 class="mb-1"><a href="/admin/course.php?a=e&id=<?php echo $course['course_id']; ?>"><?php echo $course['name'].' '.$course['code']; ?></a></h6>
                                        </div>
                                        <div class="col d-flex justify-content-end align-self-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-danger" onclick="curriculum('d',<?php echo $course['course_id']; ?>);"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    <!-- add course to curriculum Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourse" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourse">Add course to Curriculum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex mb-3">
                        <input type="text" id="search" onkeyup="search()" placeholder="Search course" name="search">
                        <button> <i class="fa fa-search"> </i> </button>
                    </div>
                    <div class="list-group w-100 scrollableModal modal-course-list">
                        <?php foreach($course_list AS $course){ ?>
                        <div class="list-group-item flex-column align-items-start searchable mcl<?php echo $course['id']; ?>" data-name="<?php echo $course['name'].' - '.$course['code']; ?>">
                            <div class="row">
                                <div class="col justify-content-between">
                                    <h6 class="mb-1"><a href="/admin/course.php?a=e&id=<?php echo $course['id']; ?>" target="_blank"><?php echo $course['name'].' '.$course['code']; ?></a></h6>
                                </div>
                                <div class="col d-flex justify-content-end align-self-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-success" onclick="curriculum('n',<?php echo $course['id']; ?>);"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="js/form_submit.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>
    <script type="text/javascript">
        
        function curriculum(a, course_id){
            $.ajax({
                url: '/admin/ajax/curriculum.ajax.php',
                method: 'post',
                dataType: 'json',
                data: {a: a, bachelor_id: <?php echo $info['id']; ?>, course_id: course_id },
            }).done( (response) => {
                if(response.success == true){
                    //if delete was successfull
                    if(response.div.length > 0 && a =='d'){
                        //remove from current curriculum
                        $('.c'+course_id).remove();
                        //add to modal list
                        $('.'+response.div).append(response.course);
                        
                    }else if(response.div.length > 0 && a == 'n'){
                        //we have to append the new course
                        $('.'+response.div).append(response.course);
                        //remove it from the modal list
                        $('.mcl'+course_id).remove();
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