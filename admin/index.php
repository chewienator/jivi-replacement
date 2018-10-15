<?php
session_start();
//include session check
include('../session_check.php');

//include the autoloader class
include('../autoloader.php');

//let's check if we can create timetables or period is closed
$options = new Options();
$option = $options->getOption('timetables_open');
//options for the button
if($option == 'false'){
    $btn_class = 'btn-primary';
    $btn_text = 'Open Timetable registration';
}elseif($option == 'true'){
    $btn_class = 'btn-secondary';
    $btn_text = 'Close Timetable registration';
    
}   

$page_title = "Admin Dashboard";
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
                <h2>Admin Panel</h2>
                <p>This is the admin panel, all hail the great Admin!</p>
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
                <button type="button" onclick="ttRegistration()" id="ttRegistration" data-state="<?php echo $option; ?>" class="btn <?php echo $btn_class; ?>"><?php echo $btn_text; ?></button>
            </div>
            <div class="row pt-3">
                <div class="col-6">Here there be nice stats</div>
                <div class="col-6">Here there be a calendar for the day?</div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include 'includes/footer.php'; ?>
    <script type="text/javascript" src="/js/common.js"></script>
    <script type="text/javascript">
        
        function ttRegistration(){
            let button = $('#ttRegistration');
            let state = button[0].dataset.state;
            
            $.ajax({
                url: '/admin/ajax/options.ajax.php',
                method: 'post',
                dataType: 'json',
                data: {o: 'timetables_open', value: state },
            }).done( (response) => {
                if(response.success == true){
                    
                    if(state == 'true'){ //reg are open
                        //switch color and status
                        button.removeClass('btn-secondary').addClass('btn-primary').attr('data-state','false').text('Open Timetable registration');
                      
                    }
                    if(state=='false'){
                        button.removeClass('btn-primary').addClass('btn-secondary').attr('data-state','true').text('Close Timetable registration');
                        
                    }   
                    
                }
                //popup the notification message
                msgHandler(response.success, response.msg);
            });
        }
    </script>

</body>

</html>