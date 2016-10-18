<?php
        
        include 'db_connect.php';

        $query = "UPDATE answers set marked = 0 where qid = '".$_POST['qid']."'";
        
        mysqli_query($link, $query);
       
?>
    