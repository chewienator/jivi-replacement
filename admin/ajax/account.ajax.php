<?php
session_start();

//include the autoloader class
include('../../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    $error = array();
    
   
    $account = new Account();
    
    //EDIT
    if($_POST['a'] == 'n'){
        $errors = "";
            
            //validate email
        if( filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false ){ // !filter_var($email, FILTER_VALIDATE_EMAIL)
            $errors = 'invalid email address.';
        }
        
        if( strlen($_POST['password']) < 6 ){
            $errors = 'minimum 6 characters.';
        }
        
        //check if name is empty
        if( strlen($_POST['name']) == 0 ){
            $errors = 'Please type in your name.';
        }
        
        //check if surname is empty
        if( strlen($_POST['surname']) == 0 ){
            $errors = 'Please type in your surname.';
        }
        if(strlen($_POST['user_type']) == 0){
            $error = 'User type can\'t be empty.';
        }
            
            //check if there are no errors
            if(strlen($errors) == 0){
                
                $myimage = 'default.jpg';
                $new = $account->create($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password'], $_POST['user_type'], $myimage, $_POST['address'], $_POST['phone'], $_POST['active']);
                    
                if($new == true){ //created successfully
                    $response = array('success' => true, 'redirect'=> 'accounts_list.php', 'msg' => 'Account saved succesfully.');
                }else{
                    $response = array('success' => false, 'redirect'=> 'none');
                }
            }else{
                $response = array('success' => false, 'redirect'=> 'none', 'msg' => $error);
            }
    }
    //NEW 
    if($_POST['a'] == 'e'){
         $errors = "";
        
        //validate email
        if( filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false ){ // !filter_var($email, FILTER_VALIDATE_EMAIL)
            $errors = 'invalid email address.';
        }
        
        if( (strlen($_POST['password']) <6) && (strlen($_POST['old_pw']) < 6) ){
            $errors = 'minimum 6 characters.';
        }
        
        //check if name is empty
        if( strlen($_POST['name']) == 0 ){
            $errors = 'Please type in your name.';
        }
        
        //check if surname is empty
        if( strlen($_POST['surname']) == 0 ){
            $errors = 'Please type in your surname.';
        }
        if(strlen($_POST['user_type']) == 0){
            $error = 'User type can\'t be empty.';
        }
        
        //check if there are no errors
        if(strlen($errors) == 0){
            
            $myimage = 'default.jpg';
            $new = $account->edit($_POST['id'],$_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password'], $_POST['old_pw'], $_POST['user_type'], $myimage, $_POST['address'], $_POST['phone'], $_POST['active']);
                
            if($new == true){ //created successfully
                $response = array('success' => true, 'redirect'=> 'none', 'msg' => 'Account saved succesfully.');
            }else{
                $response = array('success' => false, 'redirect'=> 'none');
            }
        }else{
            $response = array('success' => false, 'redirect'=> 'none', 'msg' => $error);
        }
    }

    echo json_encode($response);
}

?>