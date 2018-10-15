<?php 
class Bachelor extends Database{
    
    public $bachelor = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get list of ALL bachelors available
    public function getBachelors(){
        $query = "SELECT * FROM bachelor WHERE active = 1 ORDER BY name ASC";
        $statement = $this->connection->prepare($query);
        //$statement->bind_param('s', $email);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->bachelor, $row );
        }
        return $this->bachelor;
    }
    
    //get specific bachelor by ID (only one)
    public function getBachelor($id){
        $query = "SELECT * FROM bachelor WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //get the result
        $row = $result->fetch_assoc();
        $this->bachelor = $row;
        
        return $this->bachelor;
    }
    
    //create a new bachelor
    public function create($name, $cricos){
        $query = "INSERT INTO bachelor (name, cricos, active) VALUES (?,?, 1)";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('ss', $name, $cricos);
        
        $success = $statement->execute() ? true : false;
        
        return $success;
    }
    
    //edit a bachelor
    public function edit($id, $name, $cricos){
        $query = "UPDATE bachelor SET name = ?, cricos = ? WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('ssi', $name, $cricos, $id);
        
        $success = $statement->execute() ? true : false;
        
        return $success;
    }
    
    //"delete" deactivate a bachelor
    public function deactivate($id){
        $query = "UPDATE bachelor SET active = 0 WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
            
        $success = $statement->execute() ? true : false;
        
        return $success;
    }
}

?>