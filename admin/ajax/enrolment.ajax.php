<?php
session_start();

//include the autoloader class
include('../../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    $error = array();
    
   
    $enrolment = new Enrolment();
    
    //NEW Enrolment
    if($_POST['a'] == 'n'){
        
        //all good lets create the enrolment then
        $add = $enrolment->create($_POST['id'], $_POST['bachelor_id']);
        
        if($add){
            
            //get bachelor info to create the new list item
            $bachelors = new Bachelor();
            $bachelor = $bachelors->getBachelor($_POST['bachelor_id']);
            
            $list_item = '
                    <div class="list-group-item flex-column align-items-start c'.$bachelor['id'].'">
                        <div class="row">
                            <div class="col justify-content-between">
                                <h6 class="mb-1"><a href="/admin/bachelor.php?a=e&id='.$bachelor['id'].'">'.$bachelor['name'].' - '.$bachelor['cricos'].'</a></h6>
                            </div>
                            <div class="col d-flex justify-content-end align-self-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-danger" onclick="enrolment(\'d\', '.$bachelor['id'].');"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>';
            $response = array('success' => true, 'div'=>'curriculum-list', 'msg' => 'Student enroled succesfully.', 'bachelor'=>$list_item);
        }else{
            $response = array('success' => false, 'msg' => 'Can\'t enrol student in multiple bacherlors.');
        }
        
    }
    
    //DELETE session relation
    if($_POST['a'] == 'd'){
        
        $delete = $enrolment->unenrolStudent($_POST['id'], $_POST['bachelor_id']);
            
        if($delete){ //success
            $response = array('success' => true, 'div'=>'curriculum-list', 'msg' => 'Session removed succesfully.');
        }else{
            $response = array('success' => false, 'msg' => 'Something went wrong please try again.', 'err'=>$delete);
        }
    }
   
    echo json_encode($response);
}

?>