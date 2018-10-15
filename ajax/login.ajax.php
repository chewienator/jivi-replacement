<?php
session_start();

//include the autoloader class
include('../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    $error = array();
    
    //check for POST variables
    if($_POST['email'] == '' || $_POST['password'] == ''){
        $response = array('success' => false, 'redirect'=>'none', 'msg'=>'One of the fields is empty.');
    }else{
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $account = new Account();
        
        $auth = $account->authenticate($email, $password);
        
        if($auth == true){
            //check if is an admin or a student to make the correct redirect
            if($_SESSION['user_type'] == 'Admin'){
                $redirect = '/admin/';
            }else{
                $redirect = '/dashboard.php';
            }
            $response = array('success' => true, 'redirect'=>$redirect);
        }else{
            $response = array('success' => false, 'redirect'=>'none', 'msg'=>'Wrong credentials supplied.');
        }
    }
    
    echo json_encode($response);
}

?>