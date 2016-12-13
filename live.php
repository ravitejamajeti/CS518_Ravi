<?php
        
        include 'db_connect.php';
        
        include 'config.php';

        $query = "SELECT distinct(country) FROM questions,users WHERE TIMESTAMPDIFF(SECOND, q_created, NOW()) < 300 and qnd_user = user_name";
            
        $result = mysqli_query($link, $query);
            
        //$row = mysqli_fetch_array($result);
        
        $emparray = array();
        while($row =mysqli_fetch_assoc($result))
        {
            $emparray[] = $row;
        }

        print_r(json_encode($emparray));
       
?>