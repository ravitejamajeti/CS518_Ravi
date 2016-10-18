<?php
        
        include 'db_connect.php';
        
        include 'config.php';

        //$qid = mysqli_real_escape_string($_POST['qid']);
        
        $query = "INSERT INTO answers (qid, answered_user, answer, marked) VALUES ('".$_POST['qid']."', '".$_SESSION['username']."', '".$_POST['answer']."', 0)";
        
        mysqli_query($link, $query);
        
        print_r(json_encode( ['answer'=> $_POST['answer'], 'username'=> $_SESSION['username']] ));
       
?>
    
