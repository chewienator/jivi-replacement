<?php 
class Session extends Database{
    
    public $session = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get list of ALL sessions for a specific group
    public function getSessions($id){
        $query = "SELECT 
                        session.*, 
                        room.name 
                    FROM session 
                    JOIN room ON room.id = session.room_id 
                    WHERE group_id = ? 
                    ORDER BY session.day ASC, session.time_block ASC";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->session, $row );
        }
        return $this->session;
    }
 /*   
    //get specific session by ID
    public function getSession($id){
        $query = "SELECT * FROM session WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->session, $row );
        }
        return $this->session;
    }
  */  
    //create a new session
    public function create($group_id, $day, $time_block, $room_id){
        $query = "INSERT INTO session (group_id, day, time_block, room_id) VALUES (?,?,?,?)";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('iiii', $group_id, $day, $time_block, $room_id);
        
        $statement->execute();
        
        return $statement->insert_id;
    }
    
    //edit a session
    public function edit($id, $group_id, $day, $time_block, $room_id){
        $query = "UPDATE session SET name = ?, group_id = ?, day = ?, time_block = ?, room_id = ? WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('ssssi', $group_id, $day, $time_block, $room_id, $id);
        $statement->execute();
        
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
    
    //"delete" deactivate a group
    public function remove($id){
        $query = "DELETE FROM session WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
            
        $success = $statement->execute() ? true : false;
        
        return $success;
    }
}

?>