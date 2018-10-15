<?php
session_start();

//include the autoloader class
include('../../autoloader.php');

//check request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $response = array();
    $error = array();
    
   
    $session = new Session();
    
    //NEW session
    if($_POST['a'] == 'n'){
        
        //before we create the session we need to check if the room is actually available
        $rooms = new Room();
        $room = $rooms->checkRoomAvailability($_POST['room_id'], $_POST['day'], $_POST['time_block']);
        
       
        if(count($room) == 0){
        
            //all good lets create the session then
            $add = $session->create($_POST['id'], $_POST['day'], $_POST['time_block'], $_POST['room_id']);
            
            //get the room name
            $room = $rooms->getRoom($_POST['room_id']);
                
            if($add > 0){ //success because it retunr the id number
                //helping arrays
                $days = array(
                            1 =>'Monday', 
                            2 =>'Tuesday', 
                            3 =>'Wednesday',
                            4 =>'Thursday',
                            5 =>'Friday'
                        );
                $blocks = array(
                            1=>'8.00am - 10.00am', 
                            2=>'10.00am - 12.00am', 
                            3=>'1.00pm - 3.00pm',
                            4=>'3.00pm - 5.00pm',
                            5=>'5.00pm - 7.00pm'
                        );
                
                $list_item = '
                    <div class="list-group-item flex-column align-items-start c'.$add.'">
                        <div class="row">
                            <div class="col justify-content-between">
                                <h6 class="mb-1">'.$room['name'].' '.$days[$_POST['day']].' - '.$blocks[$_POST['time_block']].'</h6>
                            </div>
                            <div class="col d-flex justify-content-end align-self-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-danger" onclick="session(\'d\', '.$add.');"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>';
                
                $response = array('success' => true, 'div'=>'curriculum-list', 'msg' => 'Session created succesfully.', 'session'=>$list_item);
            }else{
                $response = array('success' => false, 'msg' => 'Something went wrong please try again.');
            }
        }else{
            $response = array('success' => false, 'msg' => 'Room is booked at this day and time', 'err'=>$room);
        }
    }
    
    //DELETE session relation
    if($_POST['a'] == 'd'){
        
        $delete = $session->remove($_POST['session_id']);
            
        if($delete){ //success
            $response = array('success' => true, 'div'=>'curriculum-list', 'msg' => 'Session removed succesfully.');
        }else{
            $response = array('success' => false, 'msg' => 'Something went wrong please try again.');
        }
    }
   
    echo json_encode($response);
}

?>