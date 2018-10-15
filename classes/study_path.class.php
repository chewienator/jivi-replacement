<?php 
class Study_path extends Database{
    
    public $study_path = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get list of subjects for 'my study path'  
    public function getCoursesForStudy_path($user_id){
        $query = "SELECT 
                        course.*
                    FROM study_path AS sp
                    JOIN course ON sp.course_id = course.id
                    WHERE sp.user_id = ?
                    ORDER BY course.name ASC";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->sp, $row );
        }
        return $this->sp;
    }
    
    //get specific sp by ID
    public function getsp($id){
        $query = "SELECT * FROM sp WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //get the result
        $row = $result->fetch_assoc();
        $this->sp = $row;
        
        return $this->sp;
        
    }
    
    //get courses available to add on sp depending on user ID
    public function getCoursesForStudy_path($id){
        
        $query = "SELECT 
                        course.name, 
                        course.code,
                        course.id AS course_id,
                    FROM course
                    JOIN study_path ON course.id = study_path.course_id 
                    WHERE course_id = ? ORDER BY course.name ASC";
        
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        $result_array = array();
        $session_array = array();
        $last_id = 0;
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            
            /*//first we need the group info on the array
            if($row['group_id'] != $last_id || $last_id == 0){
                $result_array[$row['group_id']] = array(
                                'course_name' => $row['name'], 
                                'course_code'=>$row['code'], 
                                'course_id'=>$row['course_id'],
                                'group_name'=>$row['group_name'], 
                                'sessions'=>array()
                            );
                //lets update the last id with current group id
                $last_id = $row['group_id'];
            }
            
            //check if we are looking at the same group and if so, add a new session to array
            if($row['group_id'] == $last_id || $last_id == 0){
                $result_array[$row['group_id']]['sessions'][] = array('day'=>$row['day'], 'time_block'=>$row['time_block'],'room'=>$row['room_name']);
            }
        }
        
        $this->course = $result_array;
        return $this->course;
    }
    
    create a new course
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
    } */
}

?>