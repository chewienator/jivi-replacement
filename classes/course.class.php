<?php 
class Course extends Database{
    
    public $course = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get list of courses available 
    public function getCourses(){
        $query = "SELECT 
                        id,name,code
                    FROM course
                    ORDER BY name ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->course, $row );
        }
        return $this->course;
    }
    
    //get specific course by ID
    public function getCourse($id){
        $query = "SELECT * FROM course WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //get the result
        $row = $result->fetch_assoc();
        $this->course = $row;
        
        return $this->course;
        
    }
    
    //create a new course
    public function create($name, $overview, $learning_outcomes, $code, $hours_per_week, $credits){
        $query = "INSERT INTO course 
                        (name, overview, learning_outcomes, code, hours_per_week, credits) 
                    VALUES 
                        (?,?,?,?,?,?)";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('ssssss', $name, $overview, $learning_outcomes, $code, $hours_per_week, $credits);
        $statement->execute();
        
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
    
    //edit a course
    public function edit($id, $name, $overview, $learning_outcomes, $code, $hours_per_week, $credits){
        $query = "UPDATE course SET 
                        name = ?,
                        overview = ?,
                        learning_outcomes = ?,
                        code = ?,
                        hours_per_week = ?,
                        credits = ? 
                    WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('ssssssi', $name, $overview, $learning_outcomes, $code, $hours_per_week, $credits, $id);
        $statement->execute();
        
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
}

?>