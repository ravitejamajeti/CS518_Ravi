<!DOCTYPE html>
<html>

    <head>
    
        <title>Profile Page</title>
        <meta charset="UTF-8">
        
        <?php include 'header.php' ?>
        
    </head>
    
    <body>
        
        <?php include 'config.php'; include 'db_connect.php'; include 'navbar.php'; ?>
        
        <?php 
        
            function generateRandomString($length = 10) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
        
            if(isset($_POST['submit'])){
                
                $target_dir = "uploads/";
                
                $target_file = $target_dir . basename($_FILES["file"]["name"]);
                
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                else {
                    
                    $pic_name = generateRandomString();
                    move_uploaded_file($_FILES['file']['tmp_name'],"uploads/".$pic_name);

                    $query = "update users set grav_override = 1 where user_name = '".$_SESSION['username']."'";
                    mysqli_query($link, $query);
                    $query = "update users set pic_name = '".$pic_name."' where user_name = '".$_SESSION['username']."'";
                    mysqli_query($link, $query);
                }
            }
        
            if(isset($_POST['del_prof'])){
                $query = "select * from users where user_name = '".$_SESSION['username']."'";
                $result = mysqli_query($link, $query);
                $row = mysqli_fetch_array($result);
                unlink("uploads/".$row['pic_name']);
                
                $query = "update users set grav_override = 0 where user_name = '".$_SESSION['username']."'";
                mysqli_query($link, $query);
            }
        ?>
        <div class="container">
            <div class="row">
                <div class ='col-md-4'>
                    
                    <?php 
                    
                        $query = "select * from users where user_name = '".$_GET['uname']."'";
                        $result = mysqli_query($link, $query);
                        $row = mysqli_fetch_array($result);
                        
                            
                    
                        if($row['grav_override'] == 1) { ?>
                    
                            <img width='100' height='100' src='./uploads/<?php echo $row['pic_name']; ?>' alt='No Image Available' onerror= 'this.src="./uploads/defaultIcon.png";' /> 
                        <?php } 
                        else { 
                    
                            $gravcheck = "http://www.gravatar.com/avatar/".md5( strtolower( trim( $row['email'] ) ) )."?d=404";
                    
                            $response = get_headers($gravcheck);
                            
                            
                            
                            if ($response[0] != "HTTP/1.1 404 Not Found"){ ?>
                                <img src="https://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $row['email'] ) ) ); ?>" />
                            <?php } 
                            else { ?>
                                <img width='100' height='100' src='./uploads/<?php echo $row['pic_name']; ?>' alt='No Image Available' onerror= 'this.src="./uploads/defaultIcon.png";' /> 
                        <?php } } ?>
                    
                    
                    <br><br>
                    <?php if (isset($_SESSION['username'])) { 
                            if($_SESSION['username'] == $_GET['uname']) {?>
                                <form method="post" enctype="multipart/form-data">
                                    <input type="file" name="file">
                                    <input type="submit" name="submit">
                                    <button type="delete" name="del_prof">Delete Picture</button>
                                </form>
                            <?php } 
                    } ?>
                </div>
                <div class ='col-md-8 prof_details'>Username - <?php echo $_GET['uname']; ?>
                    <br><br>
                    <?php 
                        $query = "SELECT sum(votes) from questions where qnd_user = '".mysqli_real_escape_string($link, $_GET['uname'])."'";
                        $result = mysqli_query($link, $query);
                        $row = mysqli_fetch_array($result);
                    ?>
                    <span>Score - <?php echo $row[0] ?> </span>
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

                $query = "SELECT * from questions where qnd_user = '".mysqli_real_escape_string($link, $_GET['uname'])."'";

                if($result = mysqli_query($link, $query)) {
                    while($row = mysqli_fetch_array($result)) { ?>
                    
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