<?php
session_start();
include('../../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    $error = array();
    
    $message = new Message();
    
    //EDIT message
    if($_POST['a'] == 'e'){
       
        if(strlen($_POST['id']) == 0){
            $error['id'] = "Something went wrong please try again.";
        }
        if(strlen($_POST['subject']) == 0){
            $error['subject'] = 'Subject can\'t be empty.';
        }
        if(strlen($_POST['date']) == 0){
            $error['date'] = 'Date can\'t be empty.';
        }
        if(strlen($_POST['body']) == 0){
            $error['body'] = 'Body can\'t be empty.';
        }
        
        if(count($error) == 0){
            $edit = $message->edit($_POST['id'], $_POST['subject'], $_POST['date'], $_POST['body'], $_POST['active']);
            
            if($edit == true){ //edited successfully
                $response = array('success' => true, 'redirect'=> 'none', 'msg' => 'Message Edited succesfully.' );
            }else{
                $response = array('success' => false, 'redirect'=> 'none', 'msg' => 'Something went wrong please try again.');
            }
        }else{
            $response = array('success' => false, 'redirect'=> 'none', 'msg' => $error);
        }
    }
    
    //CREATE message
    if($_POST['a'] == 'n'){
        
        if(strlen($_POST['subject']) == 0){
            $error['subject'] = 'Subject can\'t be empty.';
        }
        if(strlen($_POST['date']) == 0){
            $error['date'] = 'Date can\'t be empty.';
        }
        if(strlen($_POST['body']) == 0){
            $error['body'] = 'Body can\'t be empty.';
        }
        
        if(count($error) == 0){
            $new = $message->create($_POST['subject'], $_POST['date'], $_POST['body']);
            
            if($new > 0){ //created successfully
                $response = array('success' => true, 'redirect'=> "messages_list.php", 'msg' => 'Message Created succesfully.');
            }else{
                $response = array('success' => false, 'redirect'=> 'none', 'msg' => 'Something went wrong please try again.');
            }
        }else{
            $response = array('success' => false, 'redirect'=> 'none', 'msg' => $error);
        }
    }
    
    //DEACTIVATE message
    if($_POST['a'] == 'd'){
        
        $error = "";
        
        if(strlen($_POST['id']) == 0){
            $error = 'System error please try again later';
        }
        
        if(strlen($error) == 0){
            $deactivate = $message->deactivate($_POST['id']);
            
            if($deactivate){ //created successfully
                $response = array('success' => true, 'redirect'=> 'none', 'msg' => 'Message Deleted succesfully.');
            }else{
                $response = array('success' => false, 'redirect'=> 'none', 'msg' => 'Something went wrong please try again.');
            }
        }else{
            $response = array('success' => false, 'redirect'=> 'none', 'msg' => $error);
        }
    }
    
    echo json_encode($response);
}

?>