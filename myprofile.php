<html>

    <head>
    
        <title>Home Page</title>
        
        <?php include 'header.php' ?>
        
    </head>
    
    <body>
        
        <?php include 'config.php'; include 'navbar.php'; ?>
        
        <?php 
            if(isset($_POST['submit'])){
                move_uploaded_file($_FILES['file']['tmp_name'],"uploads/".$_SESSION['username']);   
            }
        ?>
        <div class="container">
            <div class="row">
                <div class ='col-md-4'> 
                    <img width='100' height='100' src='./uploads/<?php echo $_SESSION['username']; ?>' onerror= 'this.src="./uploads/defaultIcon.png";' /> 
                    <br><br>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="file">
                        <input type="submit" name="submit">
                    </form>
                </div>
                <div class ='col-md-8 prof_details'>Username - <?php echo $_SESSION['username']; ?>
                    <br><br>
                    <span>Rank</span>
                    <br><br>
                    <span>Questions Count</span>
                    <br><br>
                    <span>Answers Count</span>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            
            <h3>My Questions</h3>
            <hr>
            <br><br>

            <?php

                include 'db_connect.php';

                $query = "SELECT * from questions where qnd_user = '".mysqli_real_escape_string($link, $_SESSION['username'])."'";

                if($result = mysqli_query($link, $query)) {
                    while($row = mysqli_fetch_array($result)) { ?>
                    
                        <div class='row'>
                        <div class ='col-md-1'>
                        <span style="background-color: #4682B4; color:white; text-align: center;  border-radius: 3px; box-shadow: 0 0 6px #ccc;">Views</span><br>
                        <span style="position:relative; left:10px;"> <?php echo $row['views']; ?></span>
                        </div>
                        <div class ='col-md-1'>
                        <span style="background-color: #4682B4; color:white; text-align: center;  border-radius: 3px; box-shadow: 0 0 6px #ccc;">Votes</span><br>
                        <span style="position:relative; left:10px;"> <?php echo $row['views']; ?></span>
                        </div>
                        <div class ='col-md-1'>
                        <span style="background-color: #4682B4; color:white; text-align: center;  border-radius: 3px; box-shadow: 0 0 6px #ccc;">Answers</span><br>
                        <span style="position:relative; left:10px;"> <?php echo $row['views']; ?></span>
                        </div>
                        <a href="display_question.php?qid= <?php echo $row['qid']; ?> "rel="tooltip" data-html="true" title = "" onmouseover="answer_tooltip(this.id)" class = "question_hyperlink col-md-9 red-tooltip" id = "<?php echo $row['qid']; ?>" > <?php echo htmlentities($row['question_title']); ?></a>
                        </div>
                        <br><br>
                        <div class="row">
                        <div class="col-sm-4 col-sm-offset-8"><span class="asked_by"><i class="fa fa-user" aria-hidden="true"></i> asked by </span><a href=""> <?php echo $row['qnd_user'];  ?></a></div>
                        </div>
                        <div class="row">
                        <div class="col-sm-4 col-sm-offset-8 asked_by"><span class="asked_by"><i class="fa fa-clock-o" aria-hidden="true"></i> on </span>
                        <?php echo $row['q_created']; ?> </div>
                        </div>
                        <hr>
                        
                    <?php }
                }
            ?>
        </div>
        
        <script>
            
            $(document).ready(function() {
                $('a[rel=tooltip]').tooltip();
            });
            
            function answer_tooltip(qid) {
                
                $.post('./answer_tooltip.php', {"qid": qid}, function(response){
                    $("#"+qid).attr('data-original-title', response);
                    
                    console.log(response)
                })
            }
            
        </script>
        
    </body>
    <div class="footer"></div>

</html>