<?php 
 
session_start();

if(isset($_SESSION['email'])){ ?>

?>
    
<div class="userbar container-fluid">
    <div class="row">
        <div class="col-md-6 p-1 justify-content-start">
            <img src="../images/hora.png"></img> 
        </div>
        <div class="col-md-6 offset-md-6 text-right pb-1">
            <p>Welcome to Hora <?php echo $_SESSION['name']; ?> </p> 
        </div>
    </div>
</div>