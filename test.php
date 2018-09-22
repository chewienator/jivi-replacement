<?php 
//include the autoloader class
include('autoloader.php');

/*
$test = new Bachelor();
$result = $test->getBachelors();

print_r($result);


$test2 = new Bachelor();
$result2 = $test2->getBachelor(1);

print_r($result2);

$test3 = new Bachelor();

$new = $test3->newBachelor('IT','C2737');
if($new){ echo 'all good created the bachelor<br>'; }else{ echo 'comething went wrong<br>'; }

$test4 = new Bachelor();

$new = $test4->editBachelor(1,'design', 'tttr884');
if($new){ echo 'all good edited the bachelor <br>'; }else{ echo 'comething went wrong <br>'; }
*/

$acc = new Account();

$new = $acc->create('carlos', 'gomez', 'carlo.75@gmail.com','password', 'Admin');


if($new){ 
    echo 'all good created account <br>'; 
}else{ 
    
    $message = implode(' ', $acc->errors); 
    echo 'scomething went wrong <br>'.$message; 
}

?>