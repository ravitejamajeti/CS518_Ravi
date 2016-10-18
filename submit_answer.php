<?php
        
        include 'db_connect.php';
        
        include 'config.php';
        
        $query = "INSERT INTO answers (qid, answered_user, answer, marked, a_created) VALUES ('".mysqli_real_escape_string($link, $_POST['qid'])."', '".mysqli_real_escape_string($link, $_SESSION['username'])."', '".mysqli_real_escape_string($link, $_POST['answer'])."', 0, now())";
        
        mysqli_query($link, $query);

        $query = "SELECT aid FROM answers ORDER BY aid DESC LIMIT 1";
            
        $result = mysqli_query($link, $query);
            
        $row = mysqli_fetch_array($result);
        
        print_r(json_encode( ['answer'=> $_POST['answer'], 'username'=> $_SESSION['username'], 'aid'=> $row['aid']] ));
       
?>
    
