<?php 
class Account extends Database{
    
    //create error array to store errors
    public $errors = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    public function create($name, $surname, $email, $password, $user_type){
        $errors = array();
        
        //validate email
        if( filter_var($email, FILTER_VALIDATE_EMAIL) == false ){ // !filter_var($email, FILTER_VALIDATE_EMAIL)
            $errors['email'] = 'invalid email address.';
        }
        
        if( strlen($password) < 6 ){
            $errors['password'] = 'minimum 6 characters.';
        }
        
        //check if name is empty
        if( strlen($name) == 0 ){
            $errors['name'] = 'Please type in your name.';
        }
        
        //check if surname is empty
        if( strlen($surname) == 0 ){
            $errors['surname'] = 'Please type in your surname.';
        }
        
        //check if there are no errors
        if(count($errors) == 0){
            //create the account
            $query = "INSERT INTO account 
                    (name, surname, email, password, user_type, profile_image, active) 
                    VALUES 
                    (?, ?, ?, ?, ?, 'default.jpg', 1)";
            
            //hash the password
            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            //query the database
            $statement = $this -> connection -> prepare($query);
            $statement -> bind_param('sssss', $name, $surname, $email, $hash, $user_type);
            $succes = $statement->execute() ? true : false;
            
            //check what type of error code (just in case)
            if($succes == false && $this->connection->errno =='1062'){ //duplicate email error
                $errors['email']='email address already used';
                $this->errors = $errors;
            }
            return $succes;
            
        }else{
            //inform the user about errors
            $this->errors = $errors;
            return false;
        }
    }
    
    public function authenticate($email, $password){
        $query = "SELECT name, email, password, user_type FROM account WHERE email = ? AND active = 1";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('s', $email);
        $statement->execute();
        
        $result = $statement->get_result();
        if($result->num_rows == 0){ //no record found
            return false;
        }else{
            $account = $result->fetch_assoc();
            $email = $account['email'];
            $hash = $account['password'];
            $user_type = $account['user_type'];
            $name = $account['name'];
            $match = password_verify($password, $hash);
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