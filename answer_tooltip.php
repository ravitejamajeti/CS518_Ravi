<?php

        include 'db_connect.php';
        
        include 'config.php';
        
        $query = "SELECT answer from answers where qid = '".$_POST['qid']."' limit 1";
        
        mysqli_query($link, $query);

        if($result = mysqli_query($link, $query)) {
            $row = mysqli_fetch_array($result);
                echo $row['answer'];
        }
?>