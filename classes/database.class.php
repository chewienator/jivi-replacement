<?php 
/*
    Bloody database connector class
*/

class Database{
    
    //dbinfo vars
    private $username;
    private $password;
    private $dbhost;
    private $dbname;
    protected $connection; //our connection var
    
    //class constructor
    public function __construct(){
        $this ->username = getenv("dbuser");
        $this ->password = getenv("dbpassword");
        $this ->dbhost = getenv("dbhost");
        $this ->dbname = getenv("dbname");
        
        //create the actual conneciton to the DB
        $this->connection = mysqli_connect($this->dbhost, $this->username, $this->password, $this->dbname);
    }
}

?>