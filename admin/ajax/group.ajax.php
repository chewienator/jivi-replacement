<?php
session_start();

//include the autoloader class
include('../../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    $error = array();
    
   
    $group = new Group();
    
    //NEW CURRICULUM
    if($_POST['a'] == 'n'){
        $add = $group->create($_POST['name'], $_POST['id'], $_POST['teacher_id']);
            
        if($add > 0){ //success
            //before we can reply back we need the need the new group list item generated
            $course = new Course();
            $course_info = $course->getCourse($_POST['id']);
            
            $list_item = '
                <div class="list-group-item flex-column align-items-start c'.$add.'">
                    <div class="row">
                        <div class="col justify-content-between">
                            <h6 class="mb-1"><a href="/admin/group.php?a=e&id='.$add.'">'.$course_info['name'].' '.$_POST['name'].'</a></h6>
                        </div>
                        <div class="col d-flex justify-content-end align-self-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-danger" onclick="group(\'d\', '.$add.');"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>';
            
            $response = array('success' => true, 'div'=>'curriculum-list', 'msg' => 'Group created succesfully.', 'group'=>$list_item);
        }else{
            $response = array('success' => false, 'msg' => 'Something went wrong please try again.');
        }
    }
    
    //DELETE group relation
    if($_POST['a'] == 'd'){
        
        $delete = $group->deactivate($_POST['group_id']);
            
        if($delete){ //success
            $response = array('success' => true, 'div'=>'curriculum-list', 'msg' => 'Group removed succesfully.');
        }else{
            $response = array('success' => false, 'msg' => 'Something went wrong please try again.');
        }
    }
   
    echo json_encode($response);
}

?>