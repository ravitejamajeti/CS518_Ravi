<html>

    <head>
    
        <title>Home Page</title>
        
        <?php include 'header.php' ?>
        
    </head>
    
    <body>
        
        <?php include 'config.php'; include 'navbar.php'; ?>
        
        <div class="container">
            
            <h3>Asked Questions</h3>
            <hr>
            <br><br>

            <?php

                include 'db_connect.php';

                $query = "SELECT * from questions where qnd_user = '".mysqli_real_escape_string($link, $_SESSION['username'])."'";

                if($result = mysqli_query($link, $query)) {
                    while($row = mysqli_fetch_array($result)) {
                        echo "<div class='row'>";
                        echo "<div class ='col-sm-1'><i class='fa fa-eye' aria-hidden='true'><span style='color: dark grey'>Views<p class = 'col-sm-6'>".$row['views']."</p></span></i></div>";
                        echo "<a href='display_question.php?qid=".$row['qid']."' rel='tooltip' data-html='true' title = '' onmouseover='answer_tooltip(this.id)' id = '".$row['qid']."' class = 'question_hyperlink col-sm-11 red-tooltip'>".$row['question_title']."</a>";
                        echo "</div>";
                        echo "<br><br>";
                        echo "<div class='row'>";
                        echo "<div class='col-sm-4 col-sm-offset-8 asked_by'><span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> on </span>".$row['q_created']."</div>";
                        echo "</div>";
                        echo "<hr>";
                    }
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