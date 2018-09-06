<?php
session_start();

//include the autoloader class
include('../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    $error = array();
    
    $values[] = array('email'=>$_POST['email'], 'password'=>$_POST['password']);
    $response['values'] = json_encode($values);
    
    //check for POST variables
    if($_POST['email'] == '' || $_POST['password'] == ''){
        $error['empty'] = 'One of the fields is empty.';
        $response['errors'] = $error;
        $response['success'] = false;
    }else{
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $account = new Account();
        
        $auth = $account->authenticate($email, $password);
        
        if($auth == true){
            $response['success'] = true;
            $_SESSION['email'] = $email;
        }else{
            $error['auth'] = 'Wrong credentials supplied.';
            $response['errors'] = $error;
            $response['success'] = false;
        }
    }
    
    echo json_encode($response);
}

?>