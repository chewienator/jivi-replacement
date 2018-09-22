<?php 
class Room extends Database{
    
    public $room = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get list of rooms available
    public function getRoom(){
        $query = "SELECT * FROM room ORDER BY name ASC";
        $statement = $this->connection->prepare($query);
        //$statement->bind_param('s', $email);
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
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->room, $row );
        }
        return $this->room;
    }
    
    //create a new room
    public function create($name){
        $query = "INSERT INTO room (name) VALUES (?)";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('s', $name);
        $statement->execute();
        
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
    
    //edit a room
    public function edit($id, $name){
        $query = "UPDATE room SET name = ? WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('si', $name, $id);
        $statement->execute();
        
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
}

?>