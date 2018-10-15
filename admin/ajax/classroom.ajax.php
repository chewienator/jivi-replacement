<?php
session_start();

include('../../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    $error = "";
    
    $room = new Room();
    
    //EDIT room
    if($_POST['a'] == 'e'){
       
        if(strlen($_POST['id']) == 0){
            $error['id'] = "Something went wrong please try again.";
        }
        if(strlen($_POST['name']) == 0){
            $error['name'] = 'Name can\'t be empty.';
        }
        
        if(strlen($error) == 0){
            $edit = $room->edit($_POST['id'], $_POST['name'], $_POST['active']);
            
            if($edit == true){ //edited successfully
                $response = array('success' => true, 'redirect'=> 'none', 'msg' => 'Classroom Edited succesfully.');
            }else{
                $response = array('success' => false, 'redirect'=> 'none', 'msg' => 'Something went wrong please try again.');
            }
        }else{
            $response = array('success' => false, 'redirect'=> 'none', 'msg' => $error);
        }
    }
    
    //CREATE classroom
    if($_POST['a'] == 'n'){
        
        if(strlen($_POST['name']) == 0){
            $error = 'Name can\'t be empty.';
        }
        
        if(strlen($error) == 0){
            $new = $room->create($_POST['name']);
            
            if($new > 0){ //created successfully
                $response = array('success' => true, 'redirect'=> "classrooms_list.php", 'msg' => 'Classroom Created succesfully.');
            }else{
                $response = array('success' => false, 'redirect'=> 'none', 'msg' => 'Something went wrong please try again.');
            }
        }else{
            $response = array('success' => false, 'redirect'=> 'none', 'msg' => $error);
        }
    }
    
    //DEACTIVATE classroom
    if($_POST['a'] == 'd'){
        
        $error = "";
        
        if(strlen($_POST['id']) == 0){
            $error = 'System error please try again later';
        }
        
        if(strlen($error) == 0){
            $deactivate = $room->deactivate($_POST['id']);
            
            if($deactivate){ //created successfully
                $response = array('success' => true, 'redirect'=> 'none', 'msg' => 'Classroom Deleted succesfully.');
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