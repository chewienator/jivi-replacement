<?php 
class Timetable extends Database{
    
    public $timetable = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get specific timetable by user ID (only one)
    public function getUserTimetable($id){
        $query = "SELECT 
                        cgroup.name AS group_name,
                        cgroup.id,
                        course.name AS course_name,
                        session.day,
                        session.time_block,
                        room.name AS room_name 
                    FROM timetable 
                    JOIN `group` AS cgroup ON timetable.group_id = cgroup.id 
                    JOIN `course` ON course.id = cgroup.course_id
                    JOIN `session` ON cgroup.id = session.group_id
                    JOIN `room` ON session.room_id = room.id
                    WHERE user_id = ? ORDER BY session.day ASC, session.time_block ASC";
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
    
 
}

?>