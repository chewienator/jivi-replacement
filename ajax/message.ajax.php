<?php
session_start();

include('../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    
    //check for POST variables
    if($_POST['id'] == ''){
        $error = 'An error occured, please try again later';
    }
    
    if(strlen($error) == 0){
        
        $message = new Message();
        
        $message_info = $message->getMessage($_POST['id']);
        
        $response = array('success' => true, 'msg'=> 'Message loaded', 'info' =>$message_info );
        
    }else{ //there were errors
        $response = array('success' => false, 'msg'=> $error);
    }
    
    echo json_encode($response);
}

?>