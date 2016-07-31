<?php

function redirect_to($new_location){
    header("Location: " . $new_location);
    exit;
}

function mysql_prep($string){
    global $connection;
    $prep_string = mysqli_real_escape_string($connection, $string);
    return $prep_string;
}
