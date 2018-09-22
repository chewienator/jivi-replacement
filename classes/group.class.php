<?php 
class Group extends Database{  //or Course?
    
    public $bachelor = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get list of group available
    public function getGroup(){
        $query = "SELECT * FROM group ORDER BY name ASC";
        $statement = $this->connection->prepare($query);
        //$statement->bind_param('s', $email);
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
        $query = "SELECT * FROM group WHERE id = ?";
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
        $query = "INSERT INTO bachelor (name, course_id, teacher_id) VALUES (?,?,?)";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('sss', $name, $course_id, $teacher_id);
        $statement->execute();
        
        $succes = $statement->execute() ? true : false;
        
        return $succes;
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
}

?>