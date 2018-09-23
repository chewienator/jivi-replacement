<?php
session_start();

//include the autoloader class
include('../../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    $error = array();
    
   
    $account = new Account();
/*    
    //EDIT
    if($_POST['a'] == 'e'){
       
        if(strlen($_POST['id']) == 0){
            $error['id'] = "Something went wrong please try again.";
        }
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
            //$id, $name, $overview, $learning_outcomes, $code, $hours_per_week, $credits
            $edit = $account->edit($_POST['id'], $_POST['name'], $_POST['overview'], $_POST['learning_outcomes'], $_POST['code'], $_POST['hours_per_week'], $_POST['credits']);
            
            if($edit == true){ //edited successfully
                $response = array('success' => true, 'redirect'=> 'none');
            }else{
                $response = array('success' => false, 'redirect'=> 'none', 'msg' => 'Something went wrong please try again.');
            }
        }else{
            $response = array('success' => false, 'redirect'=> 'none', 'msg' => $error);
        }
    }
 */   
    //NEW 
    if($_POST['a'] == 'n'){
        
        $myimage = 'default.jpg';
        $new = $account->create($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password'], $_POST['user_type'], $myimage, $_POST['address'], $_POST['phone'], $_POST['active']);
            
        if($new == true){ //created successfully
            $response = array('success' => true, 'redirect'=> "accounts_list.php", 'msg' => 'Account created succesfully.');
        }else{
            $response = array('success' => false, 'redirect'=> 'none', 'msg' => $new);
        }
    }
/*    
    //DELETE 
    if($_POST['a'] == 'd'){
        
        $delete = $account->delete($_POST['bachelor_id'], $_POST['course_id']);
            
        if($delete){ //success
            $response = array('success' => true, 'div'=>'c'.$_POST['course_id'], 'msg' => 'Curriculum removed succesfully.');
        }else{
            $response = array('success' => false, 'msg' => 'Something went wrong please try again.');
        }
    }
   */
    echo json_encode($response);
}

?>