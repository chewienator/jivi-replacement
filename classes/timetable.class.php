<?php 
class Timetable extends Database{
    
    public $timetable = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get specific timetable for student ID (only one)
    public function getUserTimetableStd($id){
        $query = "SELECT group_id FROM timetable WHERE user_id = ? ORDER BY group_id ASC";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->timetable, $row );
        }
        return $this->timetable;
    }
    
    //get specific timetable for teacher ID (only one)
    public function getUserTimetableTch($id){
        $query = "SELECT id AS group_id FROM `group` WHERE teacher_id = ? ORDER BY id ASC";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->timetable, $row );
        }
        return $this->timetable;
    }
    
    //get the sorted timetable for the student ID
    public function sortedTimeTableStd($id){
        $query = "SELECT 
                        session.day, 
                        session.time_block, 
                        room.name AS room_name,
                        course.name 
                    FROM timetable 
                    JOIN `group` AS cgroup ON timetable.group_id = cgroup.id 
                    JOIN session ON session.group_id = cgroup.id 
                    JOIN course ON cgroup.course_id = course.id
                    JOIN room ON session.room_id = room.id
                    WHERE user_id = ? 
                    ORDER BY day ASC, time_block ASC";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->timetable, $row );
        }
        return $this->timetable;
    }
    
    //get the sorted timetable for the Teachers ID
    public function sortedTimeTableTch($id){
        $query = "SELECT 
                        session.day, 
                        session.time_block, 
                        room.name AS room_name,
                        course.name 
                    FROM timetable 
                    JOIN `group` AS cgroup ON timetable.group_id = cgroup.id 
                    JOIN session ON session.group_id = cgroup.id 
                    JOIN course ON cgroup.course_id = course.id
                    JOIN room ON session.room_id = room.id
                    WHERE cgroup.teacher_id = ? 
                    ORDER BY day ASC, time_block ASC";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->timetable, $row );
        }
        return $this->timetable;
    }
    
    //create user's timetable with what's submitted
    public function create($id, $groups){
        
        //first we need to clear any record for this users timetable to replace it
        //with the new timetable
        $query = "DELETE FROM timetable WHERE user_id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('i', $id);
        $success = $statement->execute();
        
        //if query ran correctly then inser the new
        if($success){
            //get the number of groups to be enroled in
            $numGroups = count($groups);
            
            $types =""; //initializing variable
            $add_to_query = array(); //initializing array
            $query_params = array();//initializing query params array
            
            //create query additional row to be inserted
            foreach($groups AS $group){
                
                //creating an array to add multiple rows for insertion
                $add_to_query[] = '(?,?)';
                //creating the query params
                $query_params[] = (int)$id;
                $query_params[] = (int)$group;
                //create string for type in bind
                $types .= "ii";
            }
            
            //convert the aditional query array to string separated by coma
            $add_to_query = implode(",",$add_to_query);
             
            $query = "INSERT INTO timetable (user_id, group_id) VALUES $add_to_query";
            
            $statement = $this->connection->prepare($query);
            
            $params = array_merge(array($types), $query_params);
            
            foreach( $params as $key => $value ) {
                $params[$key] = &$params[$key];
            }
            
            call_user_func_array(array($statement, "bind_param"), $params);
            
            $success = $statement->execute() ? true : false;
            
        }
        return $success;
        
    }
    
 
}

?>