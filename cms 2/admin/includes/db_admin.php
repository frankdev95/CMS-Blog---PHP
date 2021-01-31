<?php 

$connection = mysqli_connect('localhost', 'root', 'root', 'cms');

if(!$connection) {
    die('Connection Failed' . "<br>" . mysqli_error());
}

?>