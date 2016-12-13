<!DOCTYPE html>
<html>

    <head>
    
        <title>Home Page</title>
        <meta charset="UTF-8">
        
        <?php include 'header.php' ?>
        
    </head>
    
    <body>
        
        <?php include 'config.php'; include 'db_connect.php'; include 'navbar.php'; ?>
        
        <div class="container">
            
            <h3>Top Questions</h3>
            <hr>
            <br>

            <?php

                $query = "SELECT * from questions order by votes desc limit 5";

                if($result = mysqli_query($link, $query)) {
                    while($row = mysqli_fetch_array($result)) { 
            
                        $query1 = "SELECT * from users where user_name = '".$row['qnd_user']."'";
                        $result1 = mysqli_query($link, $query1);
                        $row1 = mysqli_fetch_array($result1);
                        
                        if($row1['git_user'] == 0) {
                        if($row1['grav_override'] == 1) { 
            
                            $img_src = "uploads/".$row1['pic_name'];    
                        } 
                        else { 
                    
                            $gravcheck = "http://www.gravatar.com/avatar/".md5( strtolower( trim( $row1['email'] ) ) )."?d=404";
                    
                            $response = get_headers($gravcheck);
                            
                            
                            
                            if ($response[0] != "HTTP/1.1 404 Not Found"){ 
                            
                                $img_src = "https://www.gravatar.com/avatar/".md5( strtolower( trim( $row1['email'] ) ) );
                            } 
                            else { 
                            
                                $img_src = "uploads/".$row1['pic_name'];
                             } 
                        }}
                        else {
                            $img_src = 'https://github.com/'.$row1['user_name'].'.png';
                        }
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
                        <span style="position:relative; left:10px;"> <?php echo $row['views']; ?></span>
                        </div>
                        <a href="display_question.php?qid=<?php echo $row['qid']; ?> " data-rel="tooltip" data-html="true" title = "" onmouseover="answer_tooltip(this.id)" class = "question_hyperlink col-md-9 red-tooltip" id = "<?php echo $row['qid']; ?>" > <?php echo htmlentities($row['question_title']); ?></a>
                        </div>
                        <br><br>
                        <div class='row'>
                            <div class='col-sm-3'></div>
                        <div class='col-sm-5'>Tags : <?php 
                            $pieces = explode(" ", $row['tags']);
                            foreach($pieces as $v){ ?>
                            <a href='tags.php?tag=<?php echo $v ?>'> <?php echo $v." "; ?> </a>
                            
                            <?php }
                        ?></div>
                        <div class='col-sm-1'><img width='60' height='60' src='<?php echo $img_src; ?>' alt='No Image Available' onerror= 'this.src="./uploads/defaultIcon.png";' /> </div>
                            <div class='col-sm-3'><span class='asked_by'>asked by </span><a href='profile.php?uname=<?php echo htmlentities($row['qnd_user']) ?>'> <?php echo htmlentities($row['qnd_user']) ?> </a><br><span class='asked_by'>User Score - <?php echo $row1['score']; ?></span ><br><span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> on <?php echo htmlentities($row['q_created']) ?></span></div>
                        </div>
                        <hr>
                        
                    <?php }
                }
            ?>
        </div>
        
        <script>
            
            $(document).ready(function() {
                $('a[data-rel=tooltip]').tooltip();
            });
            
            function answer_tooltip(qid) {
                
                $.post('./answer_tooltip.php', {"qid": qid}, function(response){
                    $("#"+qid).attr('data-original-title', response);
                    
                    console.log(response)
                })
            }
            
        </script>
        
        <div class="footer"></div>
        
    </body>

</html>