<?php
session_start();

//include the autoloader class
include('../../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    $error = "";
    
    $course = new Course();
    
    //EDIT course
    if($_POST['a'] == 'e'){
       
        if(strlen($_POST['id']) == 0){
            $error = "Something went wrong please try again.";
        }
        if(strlen($_POST['name']) == 0){
            $error = 'Name can\'t be empty.';
        }
        if(strlen($_POST['code']) == 0){
            $error = 'Program code can\'t be empty.';
        }
        if(strlen($_POST['hours_per_week']) == 0){
            $error = 'Hours per week can\'t be empty.';
        }
        if(strlen($_POST['credits']) == 0){
            $error = 'Credits can\'t be empty.';
        }
        
        if(strlen($error) == 0){
            //$id, $name, $overview, $learning_outcomes, $code, $hours_per_week, $credits
            $edit = $course->edit($_POST['id'], $_POST['name'], $_POST['overview'], $_POST['learning_outcomes'], $_POST['code'], $_POST['hours_per_week'], $_POST['credits']);
            
            if($edit == true){ //edited successfully
                $response = array('success' => true, 'redirect'=> 'none', 'msg' => 'Course Edited succesfully.');
            }else{
                $response = array('success' => false, 'redirect'=> 'none', 'msg' => 'Something went wrong please try again.');
            }
        }else{
            $response = array('success' => false, 'redirect'=> 'none', 'msg' => $error);
        }
    }
    
    //CREATE course
    if($_POST['a'] == 'n'){
        
        if(strlen($_POST['name']) == 0){
            $error = 'Name can\'t be empty.';
        }
        if(strlen($_POST['code']) == 0){
            $error = 'Program code can\'t be empty.';
        }
        if(strlen($_POST['hours_per_week']) == 0){
            $error = 'Hours per week can\'t be empty.';
        }
        if(strlen($_POST['credits']) == 0){
            $error = 'Credits can\'t be empty.';
        }
        
        if(strlen($error) == 0){
            $new = $course->create($_POST['name'], $_POST['overview'], $_POST['learning_outcomes'], $_POST['code'], $_POST['hours_per_week'], $_POST['credits']);
            
            if($new > 0){ //created successfully
                $response = array('success' => true, 'redirect'=> 'courses_list.php', 'msg' => 'Course Created succesfully.');
            }else{
                $response = array('success' => false, 'redirect'=> 'none', 'msg' => 'Something went wrong please try again.');
            }
        }else{
            $response = array('success' => false, 'redirect'=> 'none', 'msg' => $error);
        }
    }
    
    //DEACTIVATE course
    if($_POST['a'] == 'd'){
        
        $error = "";
        
        if(strlen($_POST['id']) == 0){
            $error = 'System error please try again later';
        }
        
        if(strlen($error) == 0){
            $deactivate = $course->deactivate($_POST['id']);
            
            if($deactivate){ //created successfully
                $response = array('success' => true, 'redirect'=> 'none', 'msg' => 'Bachelor Deleted succesfully.');
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