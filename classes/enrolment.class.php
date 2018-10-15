<?php 
class Enrolment extends Database{
    
    public $enrolment = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get bachelor where student is enroled
    public function getEnrolmentById($id){
        $query = "SELECT name AS bachelor_name, cricos, bachelor_id 
                    FROM enrolment JOIN bachelor ON enrolment.bachelor_id = bachelor.id 
                    WHERE student_id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        $this->enrolment = $result->fetch_assoc();
        
        return $this->enrolment;
    }
    
    //get the students enroled in this bachelor
    public function getEnrolmentsInBachelor($id){
        $query = "SELECT name, surname, id 
                    FROM enrolment 
                    JOIN account ON enrolment.student_id = account.id 
                    WHERE bachelor_id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        $this->enrolment = $result->fetch_assoc();
        
        return $this->enrolment;
    }
    
    //create a new message
    public function create($id, $bachelor_id){
        $query = "INSERT INTO enrolment (student_id, bachelor_id) VALUES (?,?)";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('ii', $id, $bachelor_id);
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
    
    //deletes enrolments from bachelor
    public function unenrolStudent($id, $bachelor_id){
        $query = "DELETE FROM enrolment WHERE student_id = ? AND bachelor_id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('ii', $id, $bachelor_id);
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
    
    //deletes enrolments from bachelor
    public function deleteEnrolments($id){
        $query = "DELETE FROM enrolment WHERE bachelor_id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $succes = $statement->execute() ? true : false;
        
        return $result;
    }
    
}