<?php 
/* tricking the system so we can test login version */
session_start();
$_SESSION['email'] = 'a@b.com';
$_SESSION['first_name'] = 'Jennifer';
/* end trick */

//if we are logged in (session started)
if(isset($_SESSION['email'])){
    $navs = array(
            'Dashboard' => 'dashboard.php',
            'Timetable' => 'timetable.php',
            'Courses' => 'courses.php',
            'Profile' => 'profile.php',
            'Messages' => 'messages.php'
        );
}else{
    $navs = array(
            'Home' => '/',
            'About' => '/#about',
            'Services' => '/#services',
            'Contact' => '/#contact',
            'Log in' => 'login.php',
            'Expression of interest' => 'eoi.php'
        );
}
?>
<!--navbar -->
<?php if(isset($_SESSION['email'])){ ?>
<div class="row">
    <div class="container-fluid pt-1 pb-1">
        <div class="col-md-4 offset-md-8 text-right">
            Welcome to TiM <?php echo $_SESSION['first_name']; ?>
            <button class="btn btn-secondary btn-sm" type="button">Log out</button>
        </div>
    </div>
</div>
<?php } ?>
<nav class="navbar navbar-dark bg-dark navbar-expand-md">
    <a href="/" class="navbar-brand"><img src=""></img>Logo here</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="main-menu">
        <p class="d-block d-sm-none" style="color:white;">Hello You</p>
        <ul class="navbar-nav ml-auto">
            <?php 
            foreach($navs as $key => $value){
                echo "<li class=\"nav-item\">
                        <a href=\"/$value\" class=\"nav-link\">$key</a>
                    </li>";
            }
            ?>
        </ul>
    </div>
</nav>