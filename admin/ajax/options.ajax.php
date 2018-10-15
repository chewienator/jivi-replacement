<?php
session_start();

//include the autoloader class
include('../../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    
    //since what we want to do is the inverse of what it being receivd then
    if($_POST['value'] == 'true'){
        $value = 'false';
    }elseif($_POST['value']=='false'){
        $value = 'true';
    }
    $options = new Options();
    $option = $options->switchOption($_POST['o'],$value);
        
    if($option == true){
        $response = array('success' => true, 'redirect'=>'none', 'msg'=>'Option saved' , 'rr'=>$option);
    }else{
        $response = array('success' => false, 'redirect'=>'none', 'msg'=>'System error.');
    }
    
    echo json_encode($response);
}

?>