<?php
        
        include 'db_connect.php';
        
        include 'config.php';
            
            $query = "delete from questions where qid = '".$_POST['qid']."'";
        
        mysqli_query($link, $query);
       
?>
    
