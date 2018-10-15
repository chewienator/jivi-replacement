<?php
session_start();
include('../session_check.php');

include('../autoloader.php');

//lets check if they want to edit or create
if($_GET['a'] == 'e'){ //edit the room
    //lets get them the information for the room they want
    $room = new Room();
    $info = $room->getRoom($_GET['id']);
    $page_title = "Edit Classroom";
    
}elseif($_GET['a'] == 'n'){ //create a new one
    $page_title = "Create Classroom";
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
                <h2>Classrooms</h2>
                <p>Here you will find all classrooms's information</p>
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
                <a href="classroom.php?a=n" class="btn btn-primary">Create New Classroom</a>
            </div>
            <div class="row pt-3">
                <div class="col-6">
                    <form id="main-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="<?php echo $info['name']; ?>">
                        </div>
                        <input type="hidden" name="a" value="<?php echo $_GET['a']; ?>">
                        <input type="hidden" name="h" value="classroom">
                        
                        <?php if($_GET['a'] == 'e'){ ?>
                        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                        <?php  }  ?>
                        
                        <button class="btn btn-primary mt-2" id="save-btn" type="submit"/>Save</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    
    <script type="text/javascript" src="js/form_submit.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>
    <script type="text/javascript">
        
        function classroom(a, room_id){
            $.ajax({
                url: '/admin/ajax/classroom.ajax.php',
                method: 'post',
                dataType: 'json',
                data: {a: a, room_id: <?php echo $info['id']; ?>, },
            }).done( (response) => {
                if(response.success == true){
                    //if delete was successfull
                    if(response.div.length > 0 && a =='d'){
                        //remove from current classroom
                        $('.c'+room_id).remove();
                        //add to modal list
                        $('.'+response.div).append(response.room);
                        
                    }else if(response.div.length > 0 && a == 'n'){
                        //we have to append the new room
                        $('.'+response.div).append(response.room);
                        //remove it from the modal list
                        $('.mcl'+room_id).remove();
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