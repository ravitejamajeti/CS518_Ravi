<?php

$link = mysqli_connect("localhost", "admin", "M0n@rch$", "dev_v1");

if(mysqli_connect_error()) {
    
    die("Error in database connection");
}
?>