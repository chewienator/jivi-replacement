<?php

//if the user has no session (not logged in send him to home page)

if(strlen($_SESSION['email']) == 0){
    header('Location: /');
}
?>