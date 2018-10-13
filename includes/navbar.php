<?php 
 
session_start();

//if we are logged in (session started)
if(isset($_SESSION['email'])){
        $navs = array(
            'Dashboard' => array('file'=>'dashboard.php', 'icon'=>'fa fa-dashboard'),
            'Timetable' => array('file'=>'timetable.php', 'icon'=>'fa fa-calendar'),
            'Courses' =>  array('file'=>'courses.php', 'icon'=>'fa fa-object-group'),
            'Study Path' => array('file' => 'study_path.php', 'icon'=> 'fa fa-road'),
            'Profile' =>  array('file'=>'profile.php', 'icon'=>'fa fa-user'),
            'Messages' =>  array('file'=>'messages.php', 'icon'=>'fa fa-envelope')
        );
}else{
    $navs = array(
            'Home' => array('file'=>'/', 'icon'=>'fa fa-dashboard'),
            'About' => array('file'=>'/#about', 'icon'=>'fa fa-calendar'),
            'Services' =>  array('file'=>'/#services', 'icon'=>'fa fa-object-group'),
            'Contact' =>  array('file'=>'/#contact', 'icon'=>'fa fa-user'),
            'Log in' =>  array('file'=>'login.php', 'icon'=>'fa fa-envelope')
    );
}

//this part of the navbar is only visible if you are logged in
if(isset($_SESSION['email'])){ ?>

<div class="userbar container-fluid">
    <div class="row">
        <div class="col-md-6 offset-md-6 text-right pb-1">
            <p>Welcome to Hora <?php echo $_SESSION['name']; ?> <a href="/logout.php" class="btn-log btn-primary btn-sm" type="button">Log out</a></p> 
        </div>
    </div>
</div>

<?php } ?>

<!--navbar -->
<nav class="navbar navbar-dark bg-dark bg-light navbar-expand-md sticky-top" >
    <a href="/" class="navbar-brand">
        <img src="Logo here"></img> 
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="main-menu">
        <?php 
        //this part of the navbar is only visible if you are logged in
        if(isset($_SESSION['email'])){ ?>
        <p class="d-block d-sm-none">Hello <?php echo $_SESSION['name']; ?> </p>
        <?php } ?>
        
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