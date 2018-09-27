<?php 
class Enrolment extends Database{
    
    public $enrolment = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get list of session available
    public function getEnrolmentById($id){
        $query = "SELECT * FROM enrolment WHERE student_id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        $this->enrolment = $result->fetch_assoc();
        
        return $this->enrolment;
    }
}