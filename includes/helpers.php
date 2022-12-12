<?php

function pre($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function validate_input($input){
    $input = stripslashes(trim($input));
    //$input = filter_var($input, FILTER_SANITIZE_STRING);
    $input = htmlentities($input,ENT_QUOTES);
    //$input = trim(htmlspecialchars($input));
    return $input;
}