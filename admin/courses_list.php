<?php
session_start();
//include session check
include('../session_check.php');

//include the autoloader class
include('../autoloader.php');

//let's query for all created bachelors
$course = new Course();
$course_list = $course->getCourses();

$page_title = "Courses list";

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
                <h2>Courses List</h2>
                <p>Here you will find all courses created</p>
                <div class="row p-3 d-flex flex-row">
                    <a href="#menu-toggle" class="btn btn-secondary m-2" id="menu-toggle">Toggle Menu</a>
                    <a href="course.php?a=n" class="btn btn-primary m-2">Create New Course</a>
                    <div class="row m-3">
                        <input type="text" id="search" onkeyup="search()" placeholder="Search for course" name="search">
                        <button> <i class="fa fa-search"> </i> </button>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-6">
                    <div class="list-group w-100">
                        <?php foreach( $course_list AS $course){ ?>
                        <div class="list-group-item list-group-item-action flex-column align-items-start searchable" data-name="<?php echo $course['name'].' - '.$course['code']; ?>" data-bachelor-id="<?php echo $course['id']; ?>">
                            <div class="row">
                                <div class="col justify-content-between">
                                    <h6 class="mb-1"><?php echo $course['name'].' - '.$course['code']; ?></h6>
                                </div>
                                <div class="col d-flex justify-content-end align-self-center">
                                    <div class="btn-group" role="group" aria-label="action buttons">
                                        <a href="course.php?a=e&id=<?php echo $course['id']; ?>" class="btn btn-secondary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <button onclick="setId($(this))" type="button" class="btn btn-primary" data-toggle="modal" data-target="#warningMessage" data-bachelor-id="<?php echo $course['id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            
            <!-- second coloumn preview/detail bachelor-->
            
        
        </div>
        <!-- #page-content-wrapper -->

    </div>
    <!-- Warning Modal -->
    <div class="modal fade" id="warningMessage" tabindex="-1" role="dialog" aria-labelledby="warning" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="warning">Warning</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>
                <strong>Warning:</strong> If you delete this course, all current students enroled will be un enroled from bachelor.
                <br>Are you sure you want to continue?
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button id="deactivateBtn" type="button" onclick="deactivate()" class="btn btn-primary">Delete anyway</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- #wrapper -->
    <?php include 'includes/footer.php'; ?>
    
    <script type="text/javascript" src="/js/common.js"></script>
    <script type="text/javascript">
        
        //function change the function on the button on the modal
        function setId(button){
            $('#deactivateBtn').attr("onclick",'deactivate('+button[0].dataset.bachelorId+')');
        }
        
        //
        function deactivate(bachelor_id){
            $.ajax({
                url: '/admin/ajax/course.ajax.php',
                method: 'post',
                dataType: 'json',
                data: {a: 'd', id: bachelor_id },
            }).done( (response) => {
                $('#warningMessage').modal('toggle');
                
                /* modal fix (not working completely) */
                $('body').removeClass('modal-open'); 
                $('.modal-backdrop').remove();
                /* /fix */
                
                if(response.success == true){
                    msgHandler(true, response.msg);
                    $('[data-bachelor-id="'+bachelor_id+'"]').remove();
                }else{
                    msgHandler(false, response.msg);
                }
            });
        }
    </script>
</body>

</html>