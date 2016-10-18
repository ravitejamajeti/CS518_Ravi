<?php

include 'config.php';

if (isset($_SESSION['username'])) {
} else {
    echo "Please log in first to see this page.";
    header("Location: samplogin.php");
}

?>

<html>

    <head>
    
        <title>Ask your Question</title>
        
        <?php include 'header.php' ?>
        <script src="validations.js"></script>
        
        <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 200
            });
        });
        
        
        </script>
        
    </head>
    
    <body>
        
        <?php include 'navbar.php'; ?>
        
        <?php
        
        $posted = true;
        
            include 'db_connect.php';
            
            if($_POST) {

                $query = "INSERT INTO questions (question, question_title, qnd_user, views, q_created) VALUES ('".mysqli_real_escape_string($link, $_POST['summernote'])."', '".mysqli_real_escape_string($link, $_POST['question_title'])."', '".mysqli_real_escape_string($link, $_SESSION['username'])."', 0, now())";

                $result = mysqli_query($link, $query);
                
                if($result) {
                    $posted = true;
                }
                else{
                    $posted = false;
                }
                    
            
            }
            
        ?>
    
        <div class="container">
    
            <form method="post" onsubmit="return validate_question()" name="question_post"> 
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
                            <!--<textarea class="form-control" name="question_content" style="height: 100px"></textarea>-->
                            <textarea id="summernote" name="summernote"></textarea>
                        </div>
                    </div>
                    <div id="question_errors" style="color:red"></div>
                    <br>
                    <button type="submit" class="btn btn-primary nav-background white">Submit</button>
                    <br>
                    <div style="color:green"><?php if($_POST) {if($posted == true) { echo "Question Submitted Successfully"; } }?> </div>
                </div>
            </form>
                    
        </div>
            
        <script>
            document.getElementById("ask").style.backgroundColor = "white";
            document.getElementById("ask").style.color = "steelblue";
        
        </script>
    </body>
    <div class="footer"></div>
</html>