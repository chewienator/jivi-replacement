<?php
session_start();

//include the autoloader class
include('../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    $error = array();
    
    //check for POST variables
    if($_POST['user_id'] == '' || count($_POST['courses']) == 0){
        $error['empty'] = 'An error occured, please try again later';
        $response['errors'] = $error;
        $response['success'] = false;
    }else{
        
        $timetable = new Timetable();
        
        $success = $timetable->create($_POST['user_id'], $_POST['courses']);
        
        if($success == true){
            $response = array('success' => true, 'redirect'=>'null', 'msg'=>'Timetable created.');
        }else{
            $error['query'] = 'System error, please try again later.';
            $response['errors'] = $error;
            $response['success'] = false;
        }
        $response = $success;
    }
    
    echo json_encode($response);
}

?>