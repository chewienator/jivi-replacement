<?php 
class Session extends Database{
    
    public $session = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get list of session available
    public function getSession(){
        $query = "SELECT * FROM session ORDER BY name ASC";
        $statement = $this->connection->prepare($query);
        //$statement->bind_param('s', $email);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->session, $row );
        }
        return $this->session;
    }
    
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
    
    //create a new session
    public function create($group_id, $day, $time_block, $room){
        $query = "INSERT INTO session (group_id, day, time_block, room) VALUES (?,?,?,?)";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('ssss', $group_id, $day, $time_block, $room);
        $statement->execute();
        
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
    
    //edit a session
    public function edit($id, $group_id, $day, $time_block, $room){
        $query = "UPDATE session SET name = ?, group_id = ?, day = ?, time_block = ?, room = ? WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('ssssi', $group_id, $day, $time_block, $room, $id);
        $statement->execute();
        
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
}

?>