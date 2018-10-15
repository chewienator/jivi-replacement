<?php
session_start();

//include the autoloader class
include('../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    
    //check for POST variables
    if($_POST['user_id'] == '' || ($_POST['user_id'] != $_SESSION['id'] && $_SESSION['user_type'] != 'Admin')){
        $error = 'An error occured, please try again later';
    }elseif(count($_POST['courses']) == 0){ //courses empty
        $error = 'Please add course(s) to your timesheet';
    }
    
    if(strlen($error) == 0){
        
        $timetable = new Timetable();
        
        $success = $timetable->create($_POST['user_id'], $_POST['courses']);
        
        if($success == true){
            if($_SESSION['user_type']=='Admin'){
                $redirect = '/admin/account.php?a=e&id='.$_POST['user_id'];
            }elseif($_SESSION['user_type']=='Student'){
                $redirect = '/dashboard.php';
            }
            $response = array('success' => true, 'redirect'=> $redirect, 'msg'=>'Timetable submited successfully.');
        }else{//db error
            $response = array('success' => false, 'redirect'=>'none', 'msg'=>'System error, please try again later.');
        }
        
    }else{ //there were errors
        $response = array('success' => false, 'redirect'=>'none', 'msg'=> $error);
    }
    
    echo json_encode($response);
}

?>