<?php

$link = mysqli_connect("localhost", "root", "", "dev_v1");

if(mysqli_connect_error()) {
    
    die("Error in database connection");
}
?>