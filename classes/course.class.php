<?php 
class Course extends Database{
    
    public $course = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get list of courses available
    public function getCourses(){
        $query = "SELECT 
                        course.id,
                        course.name,
                        course.code, 
                        bachelor.name AS bachelor_name 
                    FROM `course` 
                    JOIN curriculum ON course.id = curriculum.course_id 
                    JOIN bachelor ON bachelor.id = curriculum.bachelor_id 
                    ORDER BY curriculum.bachelor_id ASC, course.name ASC";
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
        $query = "SELECT 
                        course.*,
    			        curriculum.bachelor_id
                    FROM `course` 
                    JOIN curriculum ON course.id = curriculum.course_id 
                    WHERE id = ?";
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
    public function create($name, $code, $credit, $hours_per_week, $learning_outcomes,$overview, $assignments){
        $query = "INSERT INTO course (name, code, credit, hours_per_week, learning_outcomes, overview, assignments) VALUES (?,?,?,?,?,?,?)";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('sssssss', $name, $code, $credit, $hours_per_week, $learning_outcomes, $overview, $assignments);
        $statement->execute();
        
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
    
    //edit a course
    public function edit($name, $code, $credit, $hours_per_week, $learning_outcomes,$overview, $assignments){
        $query = "UPDATE course SET name = ?, code = ?, credit = ?, hours_per_week = ?, learning_outcomes = ?, overview = ?, assignments = ? WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('sssssssi', $name, $code, $credit, $hours_per_week, $learning_outcomes,$overview, $assignments, $id);
        $statement->execute();
        
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
}

?>