<html>

    <head>
    
        <title>Home Page</title>
        
        <?php include 'header.php' ?>
        
    </head>
    
    <body>
        
        <?php include 'config.php'; include 'navbar.php'; ?>
        
        
  	<!--<h1>Tooltip with HTML</h1>
	<a href="#" data-toggle="tooltip" data-placement="right" data-html="true" title="1st line of text <br> 2nd line of text">Hover over me</a>

        <a id="hiii" rel="tooltip" data-html="true" title="<p>Not implemented</p><br>Impl" class="btn" onmouseover="answer_tooltip()">Hi</a>-->
        
        <div class="container">
            
            <h3>Recent Questions</h3>
            <hr>
            <br><br>

            <?php

                include 'db_connect.php';

                $query = "SELECT * from questions";

                if($result = mysqli_query($link, $query)) {
                    while($row = mysqli_fetch_array($result)) {
                        echo "<div class='row'>";
                        echo "<div class ='col-sm-1'><i class='fa fa-eye' aria-hidden='true'><span style='color: dark grey'>Views</span></i></div>";
                        echo "<a href='display_question.php?qid=".$row['qid']."' rel='tooltip' data-html='true' title = '' onmouseover='answer_tooltip(this.id)' id = '".$row['qid']."' class = 'question_hyperlink col-sm-11 red-tooltip'>".$row['question_title']."</a>";
                        echo "</div>";
                        echo "<br><br>";
                        echo "<div class='row'>";
                        echo "<div class='col-sm-4 col-sm-offset-8'><span class='asked_by'><i class='fa fa-user' aria-hidden='true'></i> asked by </span><a href=''>".$row['qnd_user']."</a></div>";
                        echo "</div>";
                        echo "<hr>";
                    }
                }
            ?>
        </div>
        
        <script>
            
            $(document).ready(function() {
                //$('[data-toggle="tooltip"]').tooltip(); 
                $('a[rel=tooltip]').tooltip();
            });
            
            function answer_tooltip(qid) {
                
                $.post('./answer_tooltip.php', {"qid": qid}, function(response){
                    $("#"+qid).attr('data-original-title', response);
                    
                    console.log(response)
                })
                //var answer = '<p>Helloww</p><br><p>second line</p>'
                //document.getElementById(qid).setAttribute('title', answer)
                
                //id = parseInt(id)
                //$("#"+id).attr('data-original-title', "<p>the title</p>Hi");
                //console.log(id)
//                $('#hiii').tooltip({
//                    title: 'My Tooltip text'
//                });
            }
            
        </script>
        
    </body>

</html>