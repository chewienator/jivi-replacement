<?php

function loadClass($className){
    //define class directory
    $classdir = 'classes';
    // define root application directory
    $root = $_SERVER["DOCUMENT_ROOT"];
    $classFile = strtolower($className) . '.class.php';
    //include the class file
    include($root . '/' . $classdir . '/' .$classFile);
}

//register loadClass as a class loader
spl_autoload_register('loadClass');
?>