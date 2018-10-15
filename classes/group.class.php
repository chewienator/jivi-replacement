<?php 
class Group extends Database{
    
    public $group = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get list of ALL group available
    public function getGroups(){
        $query = "SELECT * FROM `group` WHERE active = 1 ORDER BY name ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->group, $row );
        }
        return $this->group;
    }
    
    //get specific group by ID
    public function getGroup($id){
        $query = "SELECT * FROM `group` WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //get the result
        $row = $result->fetch_assoc();
        $this->group = $row;
        
        return $this->group;
    }
    
    //get the groups for course by ID
    public function getGroupsFromCourse($id){
        $query = "SELECT 
                        course.name AS course_name, 
                        cgroup.*,
						account.name AS teacher_name,
						account.surname AS teacher_surname
                    FROM course 
                    JOIN `group` AS cgroup ON cgroup.course_id = course.id
					JOIN account ON account.id = cgroup.teacher_id
                    WHERE course.id =? AND cgroup.active = 1";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->group, $row );
        }
        return $this->group;
        
    }
    
    //create a new group
    public function create($name, $course_id, $teacher_id){
        $query = "INSERT INTO `group` (name, course_id, teacher_id, active) VALUES (?,?,?, 1)";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('sii', $name, $course_id, $teacher_id);
        
        $statement->execute();
        
        return $statement->insert_id;
    }
    
    //edit a course
    public function edit($id, $name, $course_id, $teacher_id){
        $query = "UPDATE course SET name = ?, course_id = ?, teacher_id = ? WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('sssi', $name, $course_id, $teacher_id, $id);
        $statement->execute();
        
        $succes = $statement->execute() ? true : false;
        
        return $succes;
    }
    
    //"delete" deactivate a group
    public function deactivate($id){
        $query = "UPDATE `group` SET active = 0 WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
            
        $success = $statement->execute() ? true : false;
        
        return $success;
    }
}

?>