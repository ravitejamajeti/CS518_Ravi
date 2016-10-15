<?php

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
    echo "Please log in first to see this page.";
    header("Location: login.php");
}

?>

<html>

    <head>
    
        <title>Ask your Question</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" href="style.css">
        
        
        <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
        
    </head>
    
    <body>
        
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
              </button>
              <a class="navbar-brand" href="#">WebSiteName</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="ask_question.php">Ask Question</a></li>
                <li><a href="#">Page 2</a></li> 
                <li><a href="#">Page 3</a></li> 
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              </ul>
            </div>
          </div>
        </nav>
        
       
    
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
                    
                    <button type="submit" class="btn btn-primary black-background white">Submit</button>
                    
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