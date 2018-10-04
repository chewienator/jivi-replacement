<?php

Class Textutility{
    public static function sumarize($string, $count){
        //explode the string into the array words, separated by space
        $words = explode(" ", $string);
        $length = count($words);
        $results = array();
        $counter = 0;
        foreach($words as $word){
            if($counter < $count){
                array_push($results, $word);
                $counter++;
            }
        }
        //return sumary plus horizontal elipsis
        return implode(" ",$results). "&hellip;";
    }
    
    public static function dateTimeFormat($date){
        return date('d/m/Y g:i A', strtotime($date));
    }
}
?>