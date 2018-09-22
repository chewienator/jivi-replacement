<?php 
/* tricking the system so we can test login version */
session_start();
$_SESSION['email'] = 'a@b.com';
$_SESSION['first_name'] = 'Jennifer';
/* end trick */

//if we are logged in (session started)
if(isset($_SESSION['email'])){
        $navs = array(
            'Dashboard' => array('file'=>'dashboard.php', 'icon'=>'fa fa-dashboard'),
            'Timetable' => array('file'=>'timetable.php', 'icon'=>'fa fa-calendar'),
            'Courses' =>  array('file'=>'courses.php', 'icon'=>'fa fa-object-group'),
            'Profile' =>  array('file'=>'profile.php', 'icon'=>'fa fa-user'),
            'Messages' =>  array('file'=>'messages.php', 'icon'=>'fa fa-envelope')
        );
}else{
    $navs = array(
            'Home' => '/',
            'About' => '/#about',
            'Services' => '/#services',
            'Contact' => '/#contact',
            'Log in' => 'login.php',
        );
}
?>
<!--navbar -->
<?php if(isset($_SESSION['email'])){ ?>
<div class="userbar container-fluid">
    <div class="row">
        <div class="col-md-6 offset-md-6 text-right pb-1">
            <p>Welcome to TiM <?php echo $_SESSION['first_name']; ?> <a href="logout.php" class="btn-log btn-primary btn-sm" type="button">Log out</a></p> 
        </div>
    </div>
</div>
<?php } ?>
<nav class="navbar navbar-dark bg-dark bg-light navbar-expand-md sticky-top" >
    <a href="/" class="navbar-brand">
        <img src="Logo here"></img> LOGO
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="main-menu">
        <p class="d-block d-sm-none" style="color:white;">Hello You <!-- php name --> </p>
        <ul class="navbar-nav ml-auto">
            <?php 
            foreach($navs as $key => $value){
                echo "<li class=\"nav-item\">
                        <a href=\"/$value[file]\" class=\"nav-link\"><!--<img src=\"images/$value[icon]\">--><i class=\"$value[icon] pr-2\" aria-hidden=\"true\"></i>$key</a>
                    </li>";
            }
            ?>
        </ul>
    </div>
</nav>




<!-- <li>
        <a href="#">
            <img src="...">
            <p>Dashboard</p>
        </a>
    </li>