<html>

    <head>
    
        <title>Home Page</title>
        
        <?php include 'header.php' ?>
        
    </head>
    
    <body>
        
        <?php include 'config.php'; include 'db_connect.php'; include 'navbar.php'; ?>
        
        <div class="container">
            
            <h3>Asked Questions</h3>
            <hr>
            <br><br>

            <?php

                $query = "SELECT * from questions where qnd_user = '".mysqli_real_escape_string($link, $_SESSION['username'])."'";

                if($result = mysqli_query($link, $query)) {
                    while($row = mysqli_fetch_array($result)) { 
            
                        $query_answers = "SELECT count(*) from answers where qid = '".$row['qid']."'";
                        $result_answers = mysqli_query($link, $query_answers);
                        $row_answers = mysqli_fetch_array($result_answers);
                    ?>
                    
                        <div class='row'>
                        <div class ='col-md-1'>
                        <span style="background-color: #4682B4; color:white; text-align: center;  border-radius: 3px; box-shadow: 0 0 6px #ccc;">Views</span><br>
                        <span style="position:relative; left:10px;"> <?php echo $row['views']; ?></span>
                        </div>
                        <div class ='col-md-1'>
                        <span style="background-color: #4682B4; color:white; text-align: center;  border-radius: 3px; box-shadow: 0 0 6px #ccc;">Votes</span><br>
                        <span style="position:relative; left:10px;"> <?php echo $row['votes']; ?></span>
                        </div>
                        <div class ='col-md-1'>
                        <span style="background-color: #4682B4; color:white; text-align: center;  border-radius: 3px; box-shadow: 0 0 6px #ccc;">Answers</span><br>
                        <span style="position:relative; left:10px;"> <?php echo $row_answers[0]; ?></span>
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
            
            document.getElementById("my_question").style.backgroundColor = "white";
            document.getElementById("my_question").style.color = "steelblue";
            
        </script>
        
    </body>
    <div class="footer"></div>

</html>