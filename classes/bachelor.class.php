<?php 
class Bachelor extends Database{
    
    public $bachelor = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get list of ALL bachelors available
    public function getBachelors(){
        $query = "SELECT * FROM bachelor ORDER BY name ASC";
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
        $query = "INSERT INTO bachelor (name, cricos) VALUES (?,?)";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('ss', $name, $cricos);
        $statement->execute();
        
        if($statement->execute()){
            return $statement->insert_id;
        }else{
            return false;
        }
    }
    
    //edit a bachelor
    public function edit($id, $name, $cricos){
        $query = "UPDATE bachelor SET name = ?, cricos = ? WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('ssi', $name, $cricos, $id);
        $statement->execute();
        
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
}

?>