<?php 


function show_error($query) { 
    global $connection;
    if(!$query) {
        die("Query Failed " . mysqli_error($connection));
    }
}


function escape($string) {
    
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}


?>