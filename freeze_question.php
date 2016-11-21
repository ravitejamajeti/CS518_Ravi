<?php
        
        include 'db_connect.php';
        
        include 'config.php';
            
            $query = "update questions set freeze = '".$_POST['f_type']."' where qid = '".$_POST['qid']."'";
        
        mysqli_query($link, $query);
       
?>
    
