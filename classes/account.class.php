<?php 
class Account extends Database{
    
    private $account = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get list of ALL accounts and information available
    public function getAccounts(){
        $query = "SELECT * FROM account ORDER BY name ASC";//needs to change according to database
        $statement = $this->connection->prepare($query);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->account, $row );
        }
        return $this->account;
    }
    
    //get specific account by ID (only one)
    public function getAccount($id){ //receive an ID (is a number)
        //we create the query for the database
        $query = "SELECT * FROM account WHERE id = ?"; 
        $statement = $this->connection->prepare($query); //the functions here are basically to connect and prepare query
        $statement->bind_param('i', $id); //we bind (pass the parameter to replace the ? with)
        $statement->execute(); //self explanatory...execute query
        
        $result = $statement->get_result(); //we get result in the variable result
        
        //get the result
        $row = $result->fetch_assoc(); //that result is an assosiative array, so we need a variable to store
        $this->account = $row; //make the private array account (look at the start of the class) equal to the row
        
        return $this->account; //send this array as return of the method
    }
    
    //get ist of teacher accounts
    public function getTeacherAccounts(){
        $query = "SELECT id, name, surname FROM account WHERE user_type = 'Teacher' ORDER BY name ASC";//needs to change according to database
        $statement = $this->connection->prepare($query);
        //$statement->bind_param('s', $email);
        $statement->execute();
        
        $result = $statement->get_result();
        
        //loop thru query results
        while( $row = $result->fetch_assoc() ){
            array_push( $this->account, $row );
        }
        return $this->account;
    }
    
    public function create($name, $surname, $email, $password, $user_type, $profile_image, $address, $phone, $active){
       
            //create the account
            $query = "INSERT INTO account 
                    (name, surname, email, password, user_type, profile_image, address, phone, active) 
                    VALUES 
                    (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            //hash the password
            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            //query the database
            $statement = $this -> connection -> prepare($query);
            $statement -> bind_param('ssssssssi', $name, $surname, $email, $hash, $user_type, $profile_image, $address, $phone, $active);
            $succes = $statement->execute() ? true : false;
            
            //check what type of error code (just in case)
            if($succes == false && $this->connection->error =='1062'){ //duplicate email error
                $errors ='email address already used';
                $this->errors = $errors;
                
                return $errors;
            }else{
                return $succes;
            }
    }
    
    //edit accounts
    public function edit($id, $name, $surname, $email, $password, $password2, $user_type, $profile_image, $address, $phone, $active){
       
            //create the account
            $query = "UPDATE account SET
                    name=?, 
                    surname=?, 
                    email =?,
                    password=?, 
                    user_type=?,
                    profile_image=?, 
                    address=?, 
                    phone=?, 
                    active=?
                    WHERE id = ?";
                    
            //check we have a new pasword to set
            if(strlen($password) >0 ){
                //hash the password
                $hash = password_hash($password, PASSWORD_DEFAULT);
            }else{
                $hash = $password2;
            }
            //query the database
            $statement = $this -> connection -> prepare($query);
            $statement -> bind_param('ssssssssii', $name, $surname, $email, $hash, $user_type, $profile_image, $address, $phone, $active, $id);
            $succes = $statement->execute() ? true : false;
            
            //check what type of error code (just in case)
            if($succes == false && $this->connection->error =='1062'){ //duplicate email error
                $errors ='email address already used';
                $this->errors = $errors;
                
                return $errors;
            }else{
                return $succes;
            }
    }
    
    public function authenticate($email, $password){
        $query = "SELECT id, name, email, password, user_type, profile_image FROM account WHERE email = ? AND active = 1";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('s', $email);
        $statement->execute();
        
        $result = $statement->get_result();
        if($result->num_rows == 0){ //no record found-account doesn't exist
            return false;
        }else{
            $account = $result->fetch_assoc();
            
            $match = password_verify($password, $account['password']);
            if($match == true){
                //remove the password hash from the information
                unset($account['password']);
                
                //start session and add information from account to the session
                session_start();
                $_SESSION = $account;
                
                return true;
            }else{
                //wrong password   
                return false;
            }
        }
    }
}
?>