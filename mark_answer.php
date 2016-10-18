<?php
        
        include 'db_connect.php';

        $query = "UPDATE answers set marked = 0 where qid = '".$_POST['qid']."'";
        
        mysqli_query($link, $query);

        $query = "UPDATE answers set marked = 1 where aid = '".$_POST['markedid']."' and qid = '".$_POST['qid']."'";
        
        mysqli_query($link, $query);
       
?>
    