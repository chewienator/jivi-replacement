<?php 
class Curriculum extends Database{
    
    public $curriculum = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get current curriculum for this bachelor ID
    public function getCurrentCurriculum($id){
        $query = "SELECT 
                        course.name,
                        course.code,
                        curriculum.* 
                    FROM course 
                    JOIN curriculum ON course.id = curriculum.course_id 
                    WHERE curriculum.bachelor_id = ? 
                    ORDER BY course.name ASC, course.code ASC";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->curriculum, $row );
        }
        return $this->curriculum;
        
    }
    
    //create a new course
    public function newCurriculum($name, $code, $credit, $hours_per_week, $learning_outcomes,$overview, $assignments, $bachelor_id){
        $query = "INSERT INTO course (name, code, credit, hours_per_week, learning_outcomes, overview, assignments) VALUES (?,?,?,?,?,?,?)";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('sssssss', $name, $code, $credit, $hours_per_week, $learning_outcomes, $overview, $assignments);
       
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
    
    //Delete a course from curriculum
    public function delCurriculum($bachelor_id, $course_id){
        $query = "DELETE FROM curriculum WHERE bachelor_id = ? AND course_id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('ii', $bachelor_id, $course_id);
        $statement->execute();
        
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
}

?>