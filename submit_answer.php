<?php
        
        include 'db_connect.php';
        
        include 'config.php';
        
        $query = "INSERT INTO answers (qid, answered_user, answer, marked) VALUES ('".mysqli_real_escape_string($link, $_POST['qid'])."', '".mysqli_real_escape_string($link, $_SESSION['username'])."', '".mysqli_real_escape_string($link, $_POST['answer'])."', 0)";
        
        mysqli_query($link, $query);
        
        print_r(json_encode( ['answer'=> $_POST['answer'], 'username'=> $_SESSION['username']] ));
       
?>
    
