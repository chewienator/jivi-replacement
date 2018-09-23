<?php 
//when we create an object of this class, it creates with 2 private variables in this case they are both arrays
//errors, and account, we will use them to pass information to the methods, and return information to the user.
//so far our object is empty...its just waiting for us to do stuff with it.
//lets go to profile.php
/*

a class is an abstract concept

for example Car
a car can have 4 wheels, or be red, or have a sunroof, whatever right?

so class or CAR would look somwething lie this:

Class Car{}

thats it... weird isnt it? but lets add attributes to it...

Class Car{
    public $color;
    public $model;
    prublic $brand;
}

ok, now, lets say we want to create a specific Car, so we create an INSTANCE of Car (object)

$myCar = new Car(); 
There we have a car!!!!yay

now lets say, that i want my car to be red or be able to chane the color; so lets create a METHOD
to be able to change the color

Class Car{
    public $color;
    public $model;
    prublic $brand;
    
    public function changeColor($carColor){
        $this->$color = $carColor;
    }
}

ok then...we created a methos to change our car's color...now let's change it!

$myCar->changeColor('red');

thats it our car is now red :)

now let's get more advanced...let's say we DONT know what model is...so we need to grab it from the database...

we add another method to do this...

Class Car{
    public $color;
    public $model;
    prublic $brand;
    
    public function __construct(){ //this is our constructor
        parent::__construct();
    }
    
    public function changeColor($carColor){
        $this->$color = $carColor;
    }
    
    //im going to modify a query to create the method, and here is where you see most coding is 
    copy pasting and mofiying
    
    //get car model
    public function getCarModel($carID){
        $query = "SELECT model FROM car WHERE car_id = ?";
        $statement = $this->connection->prepare($query);
        //$statement->bind_param('s', $carID);
        $statement->execute();
        
        $result = $statement->get_result();
        
        $row = $result->fetch_assoc();
        $this->model = $row
        
        return $this->model;
    }
}
forgot the constructor, sorry...
DONE :)

now let's find out our cars model...

$model = $myCar->getCarModel(1); //assuming our car is ID 1 

now, at the moment the vriable $model has the model of the car if we want to print it on the html...

<?php echo $model; ?>//done well in between php tags...which is what we've done on profile...
let go have a look and profile again...and tell me if its more clear...






*/
class Account extends Database{
    
    //create error array to store errors
    private $errors = array();
    private $account = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    //get list of ALL accounts and information available
    public function getAccounts(){
        $query = "SELECT * FROM account ORDER BY name ASC";//needs to change according to database
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
    
    //get specific account by ID (only one)
    //this method does this:
   
    public function getAccount($id){ //receive an ID (is a number)
        //we create the query for the database
        $query = "SELECT id, name, surname, email, profile_image, address, phone, active FROM account WHERE id = ?"; 
        $statement = $this->connection->prepare($query); //the functions here are basically to connect and prepare query
        $statement->bind_param('i', $id); //we bind (pass the parameter to replace the ? with)
        $statement->execute(); //self explanatory...execute query
        
        $result = $statement->get_result(); //we get result in the variable result
        
        //get the result
        $row = $result->fetch_assoc(); //that result is an assosiative array, so we need a variable to store
        $this->account = $row; //make the private array account (look at the start of the class) equal to the row
        
        return $this->account; //send this array as return of the method
    }
    
    public function create($name, $surname, $email, $password, $user_type, $profile_image, $address, $phone, $active){
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
        if(strlen($_POST['user_type']) == 0){
            $error['user_type'] = 'User type can\'t be empty.';
        }
        
        //check if there are no errors
        if(count($errors) == 0){
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