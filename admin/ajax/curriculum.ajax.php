<?php
session_start();

//include the autoloader class
include('../../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    $error = array();
    
   
    $curriculum = new Curriculum();
    
    //NEW CURRICULUM
    if($_POST['a'] == 'n'){
        
        $add = $curriculum->addCurriculum($_POST['bachelor_id'], $_POST['course_id']);
            
        if($add){ //success
            //before we can reply back we need the need the new course list item generated
            $course = new Course();
            $course_info = $course->getCourse($_POST['course_id']);
            
            $list_item = '
                <div class="list-group-item flex-column align-items-start c'.$course_info['id'].'">
                    <div class="row">
                        <div class="col justify-content-between">
                            <h6 class="mb-1"><a href="/admin/course.php?a=e&id='.$course_info['id'].'">'.$course_info['name'].' '.$course_info['code'].'</a></h6>
                        </div>
                        <div class="col d-flex justify-content-end align-self-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-danger" onclick="curriculum(\'d\', '.$course_info['id'].');"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>';
            
            $response = array('success' => true, 'div'=>'curriculum-list', 'msg' => 'Curriculum added succesfully.', 'course'=>$list_item);
        }else{
            $response = array('success' => false, 'msg' => 'Something went wrong please try again.');
        }
    }
    
    //DELETE curriculum relation
    if($_POST['a'] == 'd'){
        
        $delete = $curriculum->delCurriculum($_POST['bachelor_id'], $_POST['course_id']);
            
        if($delete){ //success
            //we deleted the course from one list, but
            //we need it available in the modal list now
            $course = new Course();
            $course_info = $course->getCourse($_POST['course_id']);
            
            $list_item = '
                <div class="list-group-item flex-column align-items-start searchable mcl'.$course_info['id'].'" data-name="'.$course_info['name'].' - '.$course_info['code'].'">
                    <div class="row">
                        <div class="col justify-content-between">
                            <h6 class="mb-1"><a href="/admin/course.php?a=e&id='.$course_info['id'].'">'.$course_info['name'].' '.$course_info['code'].'</a></h6>
                        </div>
                        <div class="col d-flex justify-content-end align-self-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-success" onclick="curriculum(\'n\', '.$course_info['id'].');"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>';
            
            $response = array('success' => true, 'div'=>'modal-course-list', 'msg' => 'Curriculum removed succesfully.', 'course'=>$list_item);
        }else{
            $response = array('success' => false, 'msg' => 'Something went wrong please try again.');
        }
    }
   
    echo json_encode($response);
}

?>