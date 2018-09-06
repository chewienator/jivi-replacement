<?php 
class Account extends Database{
    
    //create error array to store errors
    public $errors = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    public function create($email, $password){
        $errors = array();
        
        //validate email
        if( filter_var($email, FILTER_VALIDATE_EMAIL) == false ){ // !filter_var($email, FILTER_VALIDATE_EMAIL)
            $errors['email'] = 'invalid email address.';
        }
        
        if( strlen($password) < 6 ){
            $errors['password'] = 'minimum 6 characters.';
        }
        
        //check if there are no errors
        if(count($errors) == 0){
            //create the account
            $query = "INSERT INTO account 
                    (email, password, created, accessed, profile_img, active) 
                    VALUES 
                    (?, ?, NOW(), NOW(), 'default.jpg', 1)";
            
            //hash the password
            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            //query the database
            $statement = $this -> connection -> prepare($query);
            $statement -> bind_param('ss', $email, $hash);
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
        $query = "SELECT email,password,profile_img,username 
                FROM account 
                WHERE email = ? AND active = 1";
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
            $img = $account['profile_img'];
            $username = $account['username'];
            $match = password_verify($password, $hash);
            if($match == true){
                //password correct
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $username;
                return true;
            }else{
                //wrong password   
                return false;
            }
        }
    }
}

?>