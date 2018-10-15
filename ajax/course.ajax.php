<?php
session_start();

//include the autoloader class
include('../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    
    //check for POST variables
    if($_POST['id'] == ''){
        $error = 'An error occured, please try again later';
    }
    
    if(strlen($error) == 0){
        
        $course = new Course();
        
        $course_info = $course->getCourse($_POST['id']);
        
        $response = array('success' => true, 'msg'=> 'Course loaded', 'info' =>$course_info );
        
    }else{ //there were errors
        $response = array('success' => false, 'msg'=> $error);
    }
    
    echo json_encode($response);
}

?>