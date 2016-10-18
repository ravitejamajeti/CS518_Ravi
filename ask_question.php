<?php

include 'config.php';

if (isset($_SESSION['username'])) {
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
    echo "Please log in first to see this page.";
    header("Location: login.php");
}

?>

<html>

    <head>
    
        <title>Ask your Question</title>
        
        <?php include 'header.php' ?>
        
    </head>
    
    <body>
        
        <?php include 'navbar.php'; ?>
    
        <div class="container">
    
            <form> 
                <div class="form-group">
                    <label for="question_title">Title of Question</label>
                        <div class="row">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name = "question_title" id="question_title" placeholder="Example question">
                            </div>
                        </div>
                    <br>
                    <br>
                    <label for="question_content">Description of Question</label>
                    <div class="row">
                        <div class="col-sm-10">
                            <textarea class="form-control" name="question_content" style="height: 100px"></textarea>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary nav-background white">Submit</button>
                </div>
            </form>
                    
        </div>
            
         <?php
        
            include 'db_connect.php';
            
            if($_GET) {

                $query = "INSERT INTO questions (question, question_title, qnd_user) VALUES ('".$_GET['question_content']."', '".$_GET['question_title']."', '".$_SESSION['username']."')";

                mysqli_query($link, $query);    
            
            }
            
        ?>
        
    </body>
</html>