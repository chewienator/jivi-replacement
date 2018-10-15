<?php 
class Room extends Database{
    
    public $room = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get list of rooms available
    public function getRooms(){
        $query = "SELECT * FROM room WHERE active = 1 ORDER BY name ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->room, $row );
        }
        return $this->room;
    }
    
    //get specific room by ID
    public function getRoom($id){
        $query = "SELECT * FROM room WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //get the result
        $row = $result->fetch_assoc();
        $this->room = $row;
        
        return $this->room;
    }
    
    //get specific room SESSIONS for availability check
    public function checkRoomAvailability($room_id, $day, $time_block){
        $query = "SELECT * FROM session JOIN room ON room.id = session.room_id WHERE room_id = ? AND day = ? AND time_block = ? AND room.active = 1";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('iii', $room_id, $day, $time_block);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //get the result
        $row = $result->fetch_assoc();
        $this->room = $row;
        
        return $this->room;
    }
    
    //create a new room
    public function create($name){
        $query = "INSERT INTO room (name, active) VALUES (?,1)";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('s', $name);
        
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
    
    //edit a room
    public function edit($id, $name){
        $query = "UPDATE room SET name = ? WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('si', $name, $id);
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
    
    //"delete" deactivate a room
    public function deactivate($id){
        $query = "UPDATE room SET active = 0 WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
            
        $success = $statement->execute() ? true : false;
        
        return $success;
    }
}

?>