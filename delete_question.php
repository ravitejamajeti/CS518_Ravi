<?php
        
        include 'db_connect.php';
        
        include 'config.php';

        $query = "delete from answer_votes where aid in (select aid from answers where qid = '".$_POST['qid']."')";
        
        mysqli_query($link, $query);

        $query = "delete from answers where qid = '".$_POST['qid']."'";

        mysqli_query($link, $query);

        $query = "update users set score = score - (select sum(votes) from questions where qid = '".$_POST['qid']."') where user_name = (select qnd_user from questions where qid = '".$_POST['qid']."')";

        mysqli_query($link, $query);

        $query = "delete from question_votes where qid = '".$_POST['qid']."'";

        mysqli_query($link, $query);
            
        $query = "delete from questions where qid = '".$_POST['qid']."'";
        
        mysqli_query($link, $query);
       
?>
    
