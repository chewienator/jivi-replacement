<?php 
 
session_start();

//if we are logged in (session started)
if(isset($_SESSION['email'])){
    
    //is the user a student here is his menu
    if($_SESSION['user_type']=='Student'){
        $navs = array(
            'Dashboard' => array('file'=>'dashboard.php', 'icon'=>'fa fa-dashboard'),
            'Timetable' => array('file'=>'timetable.php', 'icon'=>'fa fa-calendar'),
            'Courses' =>  array('file'=>'courses.php', 'icon'=>'fa fa-object-group'),
            'Study Path' => array('file' => 'study_path.php', 'icon'=> 'fa fa-road'),
            //'Profile' =>  array('file'=>'profile.php', 'icon'=>'fa fa-user'),
            'Messages' =>  array('file'=>'messages.php', 'icon'=>'fa fa-envelope')
        );
    
        //let's check if we can create timetables or period is closed
        $options = new Options();
        $option = $options->getOption('timetables_open');
        if($option == 'false'){
            //remove the menu item if timetable creation is closed
            unset($nav['Timetable']);
        }
    }elseif($_SESSION['user_type']=='Teacher'){
        $navs = array(
            'Dashboard' => array('file'=>'dashboard.php', 'icon'=>'fa fa-dashboard'),
            'Courses' =>  array('file'=>'courses.php', 'icon'=>'fa fa-object-group'),
            'Messages' =>  array('file'=>'messages.php', 'icon'=>'fa fa-envelope')
        );
    }
    
    //the logo link is different depending on what user you are
    $logo_link = '/dashboard.php';
    
}else{
    $navs = array(
            'Home' => array('file'=>'/', 'icon'=>'fa fa-dashboard'),
            'About' => array('file'=>'/#about', 'icon'=>'fa fa-calendar'),
            'Services' =>  array('file'=>'/#services', 'icon'=>'fa fa-object-group'),
            'Contact' =>  array('file'=>'/#contact', 'icon'=>'fa fa-user'),
            'Log in' =>  array('file'=>'login.php', 'icon'=>'fa fa-envelope')
    );
    $logo_link = '/';
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
    <a href="<?php echo  $logo_link; ?>" class="navbar-brand">
        <img src="../images/hora.png"></img> 
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
<div id="msg" class="fixed-top alert" role="alert">
        This is an alert check it out!
</div>
