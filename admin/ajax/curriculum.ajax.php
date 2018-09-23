<?php
session_start();

//include the autoloader class
include('../../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    $error = array();
    
   
    $curriculum = new Curriculum();
    
    //NEW 
    if($_POST['a'] == 'n'){
        
        if(strlen($_POST['name']) == 0){
            $error['name'] = 'Name can\'t be empty.';
        }
        if(strlen($_POST['code']) == 0){
            $error['code'] = 'Program code can\'t be empty.';
        }
        if(strlen($_POST['hours_per_week']) == 0){
            $error['hours_per_week'] = 'Hours per week can\'t be empty.';
        }
        if(strlen($_POST['credits']) == 0){
            $error['credits'] = 'Credits can\'t be empty.';
        }
        
        if(count($error) == 0){
            $new = $course->newCurriculum($_POST['name'], $_POST['overview'], $_POST['learning_outcomes'], $_POST['code'], $_POST['hours_per_week'], $_POST['credits']);
            
            if($new > 0){ //created successfully
                $response = array('success' => true, 'redirect'=> "courses_list.php", 'msg' => 'Course Created succesfully.');
            }else{
                $response = array('success' => false, 'redirect'=> 'none', 'msg' => 'Something went wrong please try again.');
            }
        }else{
            $response = array('success' => false, 'redirect'=> 'none', 'msg' => $error);
        }
    }
    
    //DELETE curriculum relation
    if($_POST['a'] == 'd'){
        
        $delete = $curriculum->delCurriculum($_POST['bachelor_id'], $_POST['course_id']);
            
        if($delete){ //success
            $response = array('success' => true, 'div'=>'c'.$_POST['course_id'], 'msg' => 'Curriculum removed succesfully.');
        }else{
            $response = array('success' => false, 'msg' => 'Something went wrong please try again.');
        }
    }
   
    echo json_encode($response);
}

?>