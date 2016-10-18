<html>

    <head>
    
        <title>Home Page</title>
        
        <?php include 'header.php' ?>
        
    </head>
    
    <body>
        
        <?php include 'config.php'; include 'navbar.php'; ?>
        
        <div class="container">
            
            <h3>Recent Questions</h3>
            <br><br>

            <?php

                include 'db_connect.php';

                $query = "SELECT * from questions";

                if($result = mysqli_query($link, $query)) {
                    while($row = mysqli_fetch_array($result)) {
                        echo "<a href='display_question.php?qid=".$row['qid']."' data-toggle='tooltip' title = '' onmouseover='answer_tooltip(".$row['qid'].")' id = '".$row['qid']."' class = 'question_hyperlink'>".$row['question_title']."</a>";
                        echo "<br><br>";
                        echo "<div class='row'>";
                        echo "<div class='col-sm-4 col-sm-offset-8'><span class='asked_by'>asked by </span><a href=''>".$row['qnd_user']."</a></div>";
                        echo "</div>";
                        echo "<hr>";
                    }
                }
            ?>
        </div>
        
        <script>
            
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip(); 
            });
        
            function answer_tooltip(qid) {
                var answer = 'Helloww'
                document.getElementById(qid).setAttribute('title', answer)
            }
            
        </script>
        
    </body>

</html>