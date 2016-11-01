<?php
        include 'config.php';        
        include 'db_connect.php';


        $query = "SELECT * from question_votes where qid = '".$_POST['qid']."' and uid = '".$_SESSION['uid']."'";
        
        $result = mysqli_query($link, $query);

        $num_rows = mysqli_num_rows($result);

        if($num_rows == 0) {
            $query = "INSERT INTO question_votes (qid, uid, vote_type) VALUES ('".$_POST['qid']."', '".$_SESSION['uid']."', '".$_POST['v_type']."')";
            
            mysqli_query($link, $query);
            
            if($_POST['v_type'] == 2) {
                $query = "update questions set votes = votes - 1 where qid = '".$_POST['qid']."'";
                
                $voted = 2;
            }
            else if($_POST['v_type'] == 1) {
                $query = "update questions set votes = votes + 1 where qid = '".$_POST['qid']."'";
                
                $voted = 1;
            }
            
            mysqli_query($link, $query);
            
            $query = "select votes from questions where qid = '".$_POST['qid']."'";
            
            $result = mysqli_query($link, $query);
            
            $row = mysqli_fetch_array($result);
            
            $votes = $row[0];
            
            print_r(json_encode( ['voted'=> $voted, 'votes'=> $votes] ));
        }
        else {
            
            $row = mysqli_fetch_array($result);
            
            if($row['vote_type'] == 1) {
                $query = "delete from question_votes where uid = '".$_SESSION['uid']."' and qid = '".$_POST['qid']."'";
                mysqli_query($link, $query);
                $query = "update questions set votes = votes - 1 where qid = '".$_POST['qid']."'";
                
                $voted = 0;
            }
            else if($row['vote_type'] == 2) {
                $query = "delete from question_votes where uid = '".$_SESSION['uid']."' and qid = '".$_POST['qid']."'";
                mysqli_query($link, $query);
                $query = "update questions set votes = votes + 1 where qid = '".$_POST['qid']."'";
                
                $voted = 0;
            }
            
            mysqli_query($link, $query);
            
            $query = "select votes from questions where qid = '".$_POST['qid']."'";
            
            $result = mysqli_query($link, $query);
            
            $row = mysqli_fetch_array($result);
            
            $votes = $row['votes'];
            
            print_r(json_encode( ['voted'=> $voted, 'votes'=> $votes] ));
        }
?>