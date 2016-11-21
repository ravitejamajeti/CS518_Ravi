<?php
        
        include 'db_connect.php';
        
        include 'config.php';

        if($_POST['t_or_d'] == 0){
            
            $query = "update questions set question_title = '".mysqli_real_escape_string($link, $_POST['question'])."' where qid = '".$_POST['qid']."'";
            
        }
        else if($_POST['t_or_d'] == 1){
            $query = "update questions set question = '".mysqli_real_escape_string($link, $_POST['question'])."' where qid = '".$_POST['qid']."'";
        }
        
        mysqli_query($link, $query);
       
?>
    
