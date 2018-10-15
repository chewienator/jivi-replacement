<?php 
class Message extends Database{
    
    public $message = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get list of ALL messages available
    public function getMessages(){
        $query = "SELECT * FROM message ORDER BY date ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->message, $row );
        }
        return $this->message;
    }
    
    //get specific message by ID (only one)
    public function getMessage($id){
        $query = "SELECT * FROM message WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //get the result
        $row = $result->fetch_assoc();
        $this->message = $row;
        
        return $this->message;
    }
    
    //create a new message
    public function create($subject, $date, $body){
        $query = "INSERT INTO message (subject, date, body) VALUES (?,?,?)";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('sss', $subject, $date, $body);
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
    
    //edit a message
    public function edit($id, $subject, $date, $body){
        $query = "UPDATE message SET subject = ?, date = ?, body = ? WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('sssi', $subject, $date, $body, $id);
        
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
}

?>
echo date('l jS \of F Y h:i:s A');
