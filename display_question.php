<!DOCTYPE html>
<html lang="en">
    
    <head>
        
        <title>Display Question</title>
        <meta charset="UTF-8">
        
        <?php include 'header.php' ?>
        
        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    height:200
                });
            });
        </script>
        <script src="validations.js"></script>
    
    </head>
    
    <body>
        
        <?php include 'config.php'; include 'db_connect.php'; include 'navbar.php'; ?>
        
        <br><br>
        
        <span class="disp_none"><i id='71' class="fa fa-check fa-2x icon-invisible" aria-hidden='true'></i></span>
        
        <div class="container">
        
        <?php
            
            $query = "SELECT * from questions where qid = '".$_GET['qid']."'";
            
            if($result = mysqli_query($link, $query)) {
                
                $num_rows = mysqli_num_rows($result);
                
                if($num_rows < 1) {
                    header("Location: index.php");
                }
                
                $row = mysqli_fetch_array($result);
                
                $query_user = "SELECT * from users where user_name = '".$row['qnd_user']."'";
                $result_user = mysqli_query($link, $query_user);
                $row_user = mysqli_fetch_array($result_user);
                $score = $row_user['score'];
                
                if($row_user['grav_override'] == 1) { 
            
                    $img_src = "uploads/".$row_user['pic_name'];    
                } 
                else { 

                    $gravcheck = "http://www.gravatar.com/avatar/".md5( strtolower( trim( $row_user['email'] ) ) )."?d=404";

                    $response = get_headers($gravcheck);



                    if ($response[0] != "HTTP/1.1 404 Not Found"){ 

                        $img_src = "https://www.gravatar.com/avatar/".md5( strtolower( trim( $row_user['email'] ) ) );
                    } 
                    else { 

                        $img_src = "uploads/".$row_user['pic_name'];
                     } 
                }
                
                $upvote = 0;
                    $downvote = 0;
                
                if(isset($_SESSION['username'])) {
                
                $query = "SELECT * from question_votes where qid = '".$_GET['qid']."' and uid = '".$_SESSION['uid']."'";
                
                $result = mysqli_query($link, $query);
                
                $row1 = mysqli_fetch_array($result);
                
                if($row1['vote_type'] == 1) {
                    $upvote = 1;
                    $downvote = 0;
                }
                else if ($row1['vote_type'] == 2){
                    $upvote = 0;
                    $downvote = 1;
                }
                else {
                    $upvote = 0;
                    $downvote = 0;
                }
                }
                
                $qnd_user = $row['qnd_user']; 
                
                $freezed = $row['freeze']; 
                
                if($freezed == 1) {
                ?> <h3 style="color:red">Question Freezed</h3><?php
                }
            
                ?>
            
                    <?php if(isset($_SESSION['username'])) { ?>
            
                    <h4> <?php echo htmlentities($row['question_title']) ?> </h4> 
                    <hr style="width:50%">
                    <div class='row'>
                        <?php if($upvote == 0 && $downvote == 0) { ?>
                        <span class='col-sm-1'><i class='fa fa-star-o fa-2x' aria-hidden='true'></i><br><br><i class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'uq' data-voted = '<?php echo $upvote; ?>' onclick='changevote(this)'></i><br><span id="qvotes"><?php echo $row['votes']; ?></span><br><i class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'dq' data-voted = '<?php echo $downvote; ?>' onclick='changevote(this)'></i></span>
                        <?php } else if($upvote == 1 && $downvote == 0) { ?>
                        <span class='col-sm-1'><i class='fa fa-star-o fa-2x' aria-hidden='true'></i><br><br><i class='fa fa-2x fa-arrow-circle-o-up green' aria-hidden='true' data-vote_type = 'uq' data-voted = '<?php echo $upvote; ?>' onclick='changevote(this)'></i><br><span id="qvotes"><?php echo $row['votes']; ?></span><br><i class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'dq' data-voted = '<?php echo $downvote; ?>' onclick='changevote(this)'></i></span>
                        <?php } else if($upvote == 0 && $downvote == 1) { ?>
                        <span class='col-sm-1'><i class='fa fa-star-o fa-2x' aria-hidden='true'></i><br><br><i class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'uq' data-voted = '<?php echo $upvote; ?>' onclick='changevote(this)'></i><br><span id="qvotes"><?php echo $row['votes']; ?></span><br><i class='fa fa-2x fa-arrow-circle-o-down green' aria-hidden='true' data-vote_type = 'dq' data-voted = '<?php echo $downvote; ?>' onclick='changevote(this)'></i></span>
                        <?php } ?>
                    <div class='col-sm-11'> <?php echo $row['question']; ?> </div>
                    </div>
                    <br><br>
                    <div class='row'>
                        <div class='col-sm-1 col-sm-offset-8'><img width='60' height='60' src='<?php echo $img_src; ?>' alt='No Image Available' onerror= 'this.src="./uploads/defaultIcon.png";' /> </div>
                            <div class='col-sm-3'><span class='asked_by'>asked by </span><a href='profile.php?uname=<?php echo htmlentities($row['qnd_user']) ?>'> <?php echo htmlentities($row['qnd_user']) ?> </a>
                                <br>
                                <span class='asked_by'>User Score - <?php echo $score; ?></span>
                                <br>
                                <span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> on <?php echo htmlentities($row['q_created']) ?></span></div>
                        </div>
                        <hr>
            
                    <?php } else { ?>
            
                    <h4> <?php echo htmlentities($row['question_title']) ?> </h4> 
                    <hr style="width:50%">
                    <div class='row'>
                        <?php if($upvote == 0 && $downvote == 0) { ?>
                        <span class='col-sm-1'><i class='fa fa-star-o fa-2x' aria-hidden='true'></i><br><br><i class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'uq' data-voted = '<?php echo $upvote; ?>' ></i><br><span id="qvotes"><?php echo $row['votes']; ?></span><br><i class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'dq' data-voted = '<?php echo $downvote; ?>'></i></span>
                        <?php } else if($upvote == 1 && $downvote == 0) { ?>
                        <span class='col-sm-1'><i class='fa fa-star-o fa-2x' aria-hidden='true'></i><br><br><i class='fa fa-2x fa-arrow-circle-o-up green' aria-hidden='true' data-vote_type = 'uq' data-voted = '<?php echo $upvote; ?>'></i><br><span id="qvotes"><?php echo $row['votes']; ?></span><br><i class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'dq' data-voted = '<?php echo $downvote; ?>' ></i></span>
                        <?php } else if($upvote == 0 && $downvote == 1) { ?>
                        <span class='col-sm-1'><i class='fa fa-star-o fa-2x' aria-hidden='true'></i><br><br><i class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'uq' data-voted = '<?php echo $upvote; ?>'></i><br><span id="qvotes"><?php echo $row['votes']; ?></span><br><i class='fa fa-2x fa-arrow-circle-o-down green' aria-hidden='true' data-vote_type = 'dq' data-voted = '<?php echo $downvote; ?>' ></i></span>
                        <?php } ?>
                    <div class='col-sm-11'> <?php echo $row['question']; ?> </div>
                    </div>
                    <br><br>
                    <div class='row'>
                        <div class='col-sm-1 col-sm-offset-8'><img width='60' height='60' src='<?php echo $img_src; ?>' alt='No Image Available' onerror= 'this.src="./uploads/defaultIcon.png";' /> </div>
                            <div class='col-sm-3'><span class='asked_by'>asked by </span><a href='profile.php?uname=<?php echo htmlentities($row['qnd_user']) ?>'> <?php echo htmlentities($row['qnd_user']) ?> </a>
                                <br>
                                <span class='asked_by'>User Score - <?php echo $score; ?></span>
                                <br>
                                <span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> on <?php echo htmlentities($row['q_created']) ?></span>  </div>
                        </div>
                        <hr>
            
                    <?php } ?>
            <?php
            }
            
            $query = "update questions set views = views + 1 where qid = '".$_GET['qid']."'";
            
            mysqli_query($link, $query);
        ?>
            
        <?php 
            
            $per_page = 5;
            
            $query = "SELECT count(*) from answers where qid = '".$_GET['qid']."'";

            $result = mysqli_query($link, $query);

            $row = mysqli_fetch_array($result);

            $pages = ceil($row[0]/$per_page);

            if(!isset($_GET['page'])) {
                $page = 1;
            }
            else {
                $page = $_GET['page'];
            }
            
            $start = ($page - 1) * $per_page;
        
        ?>
        <div id="answer_list">
            <div class="row">
                <div class="col-sm-5"><h3>Answers</h3></div>
                <div class="col-sm-7">
                    <ul class="pagination">
                        <li><a href="?qid=<?php echo str_replace(' ', '', $_GET['qid']);?>&page=1">First</a></li>
                        <?php if($page > 1) { ?>
                      <li><a href="?qid=<?php echo str_replace(' ', '', $_GET['qid']);?>&page=<?php $inc_page = $page - 1; echo str_replace(' ', '', $inc_page) ?>">Previous</a></li>
                        <?php } else { ?>
                      <li><a>Previous</a></li>
                        <?php } ?>
                        <?php if($page > 2) { ?>
                        <li><a href="?qid=<?php echo str_replace(' ', '', $_GET['qid']);?>&page=<?php echo str_replace(' ', '', $page - 2); ?>"><?php echo str_replace(' ', '', $page - 2); ?></a></li>
                        <li><a href="?qid=<?php echo str_replace(' ', '', $_GET['qid']);?>&page=<?php echo str_replace(' ', '', $page - 1); ?>"><?php echo str_replace(' ', '', $page - 1); ?></a></li>
                        <?php } ?>
                      <li><a href="?qid=<?php echo str_replace(' ', '', $_GET['qid']);?>&page=<?php echo str_replace(' ', '', $page); ?>"><?php echo str_replace(' ', '', $page); ?></a></li>
                        <?php if($page < $pages - 2) { ?>
                        <li><a href="?qid=<?php echo str_replace(' ', '', $_GET['qid']);?>&page=<?php echo str_replace(' ', '', $page + 1); ?>"><?php echo str_replace(' ', '', $page + 1); ?></a></li>
                        <li><a href="?qid=<?php echo str_replace(' ', '', $_GET['qid']);?>&page=<?php echo str_replace(' ', '', $page + 2); ?>"><?php echo str_replace(' ', '', $page + 2); ?></a></li>
                        <?php } ?>
                        <?php if($page < $pages) { ?>
                      <li><a href="?qid=<?php echo str_replace(' ', '', $_GET['qid']);?>&page=<?php $inc_page = $page + 1; echo str_replace(' ', '', $inc_page) ?>">Next</a></li>
                        <?php } else { ?>
                      <li><a>Next</a></li>
                        <?php } ?>
                        <li><a href="?qid=<?php echo str_replace(' ', '', $_GET['qid']);?>&page=<?php echo $pages; ?>">Last - <?php echo $pages; ?></a></li>
                    </ul>
                </div>
            </div>
            <hr>
            
            

        <?php
            $marked = false;
            $query = "SELECT * from answers where qid = '".$_GET['qid']."' order by marked desc, votes desc limit $start, $per_page";
            
            function bbc2html($content) {
              $search = array (
                '/(\[b\])(.*?)(\[\/b\])/',
                '/(\[i\])(.*?)(\[\/i\])/',
                '/(\[u\])(.*?)(\[\/u\])/',
                '/(\[ul\])(.*?)(\[\/ul\])/',
                '/(\[li\])(.*?)(\[\/li\])/',
                '/(\[url=)(.*?)(\])(.*?)(\[\/url\])/',
                '/(\[url\])(.*?)(\[\/url\])/'
              );

              $replace = array (
                '<strong>$2</strong>',
                '<em>$2</em>',
                '<u>$2</u>',
                '<ul>$2</ul>',
                '<li>$2</li>',
                '<a href="$2" target="_blank">$4</a>',
                '<a href="$2" target="_blank">$2</a>'
              );

              return preg_replace($search, $replace, $content);
            }
        
            if($result = mysqli_query($link, $query)) {
                
                $acount = 1;
                while($row = mysqli_fetch_array($result)) {
                    
                    $query_user = "SELECT * from users where user_name = '".$row['answered_user']."'";
                    $result_user = mysqli_query($link, $query_user);
                    $row_user = mysqli_fetch_array($result_user);
                    $user_image = $row_user['pic_name'];
                    
                    $score = $row_user['score'];
                    
                    if($row_user['grav_override'] == 1) { 
            
                        $img_src = "uploads/".$row_user['pic_name'];    
                    } 
                    else { 

                        $gravcheck = "http://www.gravatar.com/avatar/".md5( strtolower( trim( $row_user['email'] ) ) )."?d=404";

                        $response = get_headers($gravcheck);



                        if ($response[0] != "HTTP/1.1 404 Not Found"){ 

                            $img_src = "https://www.gravatar.com/avatar/".md5( strtolower( trim( $row_user['email'] ) ) );
                        } 
                        else { 

                            $img_src = "uploads/".$row_user['pic_name'];
                         } 
                    }
                    
                    $aupid = "$acount"."u";
                    $adownid = "$acount"."d";
                    $avoteid = "$acount"."a";
                    
                    $upvote = 0;
                    $downvote = 0;
                    
                    if(isset($_SESSION['username'])) { 
                    
                        $query1 = "SELECT * from answer_votes where aid = '".$row['aid']."' and uid = '".$_SESSION['uid']."'";

                        $result1 = mysqli_query($link, $query1);

                        $row1 = mysqli_fetch_array($result1);

                        if($row1['vote_type'] == 1) {
                            $upvote = 1;
                            $downvote = 0;
                        }
                        else if ($row1['vote_type'] == 2){
                            $upvote = 0;
                            $downvote = 1;
                        }
                        else {
                            $upvote = 0;
                            $downvote = 0;
                        }
                        
                    }
                    
                    if(isset($_SESSION['username'])) {
                        if($row['marked'] == 1) {
                            $marked = true;

                            echo "<div class='row'>";



                            if($upvote == 0 && $downvote == 0) {
                            echo "<span class='col-sm-1'><i id='".$row['aid']."' class='fa fa-check fa-2x greenn' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                            }
                            else if($upvote == 1 && $downvote == 0) {
                                echo "<span class='col-sm-1'><i id='".$row['aid']."' class='fa fa-check fa-2x greenn' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up green' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                            }
                            else if($upvote == 0 && $downvote == 1) {
                                echo "<span class='col-sm-1'><i id='".$row['aid']."' class='fa fa-check fa-2x greenn' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down green' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                            }

                            echo "<span class='col-sm-11'>".bbc2html($row['answer'])."</span>";
                            echo "</div>";
                            echo "<br><br>";
                            echo "<div class='row'>"; ?>
                            <div class='col-sm-1 col-sm-offset-8'><img width='60' height='60' src='<?php echo $img_src; ?>' alt='No Image Available' onerror= 'this.src="./uploads/defaultIcon.png";' /> </div>
                            <?php
                            echo "<div class='col-sm-3'><span class='asked_by'>answered by <a href='profile.php?uname=".htmlentities($row['answered_user'])."'>".htmlentities($row['answered_user'])."</a></span><br>";
                            echo "<span class='asked_by'>Score - ".$score."</span><br>";
                            echo "<span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> on </span>".$row['a_created']."";
                            echo "</div>";
                            echo "</div>";
                            echo "<hr style='width:50%'>";
                        }
                    
                        else {
                            echo "<div class='row'>";

                            if(isset($_SESSION['username'])) {
                                if($qnd_user == $_SESSION['username']) {

                                    if($upvote == 0 && $downvote == 0) {
                                    echo "<span class='col-sm-1'><i id='".$row['aid']."' class='fa fa-check fa-2x' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                                    }
                                    else if($upvote == 1 && $downvote == 0) {
                                        echo "<span class='col-sm-1'><i id='".$row['aid']."' class='fa fa-check fa-2x' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up green' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                                    }
                                    else if($upvote == 0 && $downvote == 1) {
                                        echo "<span class='col-sm-1'><i id='".$row['aid']."' class='fa fa-check fa-2x' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down green' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                                    }
                                }
                                else {
                                    if($upvote == 0 && $downvote == 0) {
                                        echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                                    }
                                    else if($upvote == 1 && $downvote == 0) {
                                        echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up green' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                                    }
                                    else if($upvote == 0 && $downvote == 1) {
                                        echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down green' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                                    }
                                }
                            }
                            else {
                                if($upvote == 0 && $downvote == 0) {
                                    echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                                }
                                else if($upvote == 1 && $downvote == 0) {
                                    echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up green' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                                }
                                else if($upvote == 0 && $downvote == 1) {
                                    echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down green' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                                }
                            }
                            echo "<span class='col-sm-11'>".bbc2html($row['answer'])."</span>";
                            echo "</div>";
                            echo "<br><br>";
                            echo "<div class='row'>"; ?>
                            <div class='col-sm-1 col-sm-offset-8'><img width='60' height='60' src='<?php echo $img_src; ?>' alt='No Image Available' onerror= 'this.src="./uploads/defaultIcon.png";' /> </div>
                            <?php
                            echo "<div class='col-sm-3'><span class='asked_by'>answered by <a href='profile.php?uname=".htmlentities($row['answered_user'])."'>".htmlentities($row['answered_user'])."</a></span><br>";
                            echo "<span class='asked_by'>Score - ".$score."</span><br>";
                            echo "<span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> on </span>".$row['a_created']."";
                            echo "</div>";
                            echo "</div>";
                            echo "<hr style='width:50%'>";
                        }
                    }
                    else {
                        if($row['marked'] == 1) {
                            $marked = true;
                            echo "<div class='row'>";



                            if($upvote == 0 && $downvote == 0) {
                            echo "<span class='col-sm-1'><i id='".$row['aid']."' class='fa fa-check fa-2x greenn' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."'></i></span>";
                            }
                            else if($upvote == 1 && $downvote == 0) {
                                echo "<span class='col-sm-1'><i id='".$row['aid']."' class='fa fa-check fa-2x greenn' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up green' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' ></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' ></i></span>";
                            }
                            else if($upvote == 0 && $downvote == 1) {
                                echo "<span class='col-sm-1'><i id='".$row['aid']."' class='fa fa-check fa-2x greenn' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' ></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down green' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' ></i></span>";
                            }

                            echo "<span class='col-sm-11'>".bbc2html($row['answer'])."</span>";
                            echo "</div>";
                            echo "<br><br>";
                            echo "<div class='row'>"; ?>
                            <div class='col-sm-1 col-sm-offset-8'><img width='60' height='60' src='<?php echo $img_src; ?>' alt='No Image Available' onerror= 'this.src="./uploads/defaultIcon.png";' /> </div>
                            <?php
                            echo "<div class='col-sm-3'><span class='asked_by'>answered by <a href='profile.php?uname=".htmlentities($row['answered_user'])."'>".htmlentities($row['answered_user'])."</a></span><br>";
                            echo "<span>Score - ".$score."</span><br>";
                            echo "<span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> on </span>".$row['a_created']."";
                            echo "</div>";
                            echo "</div>";
                            echo "<hr style='width:50%'>";
                        }
                    
                        else {
                            echo "<div class='row'>";

                            if(isset($_SESSION['username'])) {
                                if($qnd_user == $_SESSION['username']) {

                                    if($upvote == 0 && $downvote == 0) {
                                    echo "<span class='col-sm-1'><i id='".$row['aid']."' class='fa fa-check fa-2x' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' ></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' ></i></span>";
                                    }
                                    else if($upvote == 1 && $downvote == 0) {
                                        echo "<span class='col-sm-1'><i id='".$row['aid']."' class='fa fa-check fa-2x' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up green' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' ></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' ></i></span>";
                                    }
                                    else if($upvote == 0 && $downvote == 1) {
                                        echo "<span class='col-sm-1'><i id='".$row['aid']."' class='fa fa-check fa-2x' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' ></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down green' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' ></i></span>";
                                    }
                                }
                                else {
                                    if($upvote == 0 && $downvote == 0) {
                                        echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' ></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' ></i></span>";
                                    }
                                    else if($upvote == 1 && $downvote == 0) {
                                        echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up green' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' ></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' ></i></span>";
                                    }
                                    else if($upvote == 0 && $downvote == 1) {
                                        echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' ></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down green' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' ></i></span>";
                                    }
                                }
                            }
                            else {
                                if($upvote == 0 && $downvote == 0) {
                                    echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' ></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' ></i></span>";
                                }
                                else if($upvote == 1 && $downvote == 0) {
                                    echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up green' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' ></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' ></i></span>";
                                }
                                else if($upvote == 0 && $downvote == 1) {
                                    echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' data-vote_type = 'u' data-voted='".$upvote."' ></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down green' aria-hidden='true' data-vote_type = 'd' data-voted='".$downvote."' ></i></span>";
                                }
                            }
                            echo "<span class='col-sm-11'>".bbc2html($row['answer'])."</span>";
                            echo "</div>";
                            echo "<br><br>";
                            echo "<div class='row'>"; ?>
                            <div class='col-sm-1 col-sm-offset-8'><img width='60' height='60' src='<?php echo $img_src; ?>' alt='No Image Available' onerror= 'this.src="./uploads/defaultIcon.png";' /> </div>
                            <?php
                            echo "<div class='col-sm-3'><span class='asked_by'>answered by <a href='profile.php?uname=".htmlentities($row['answered_user'])."'>".htmlentities($row['answered_user'])."</a></span><br>";
                            echo "<span class='asked_by'>Score - ".$score."</span><br>";
                            echo "<span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> on </span>".$row['a_created']."";
                            echo "</div>";
                            echo "</div>";
                            echo "<hr style='width:50%'>";
                        }
                    }
                    
                    $acount = $acount + 1;
                }
            }
        ?>
        </div>
        
        <br>
            <h3>Your Answer</h3>
        <br>
        <textarea id="summernote" name="summernote"></textarea>
        
            <div id="answer_errors" style="color:red"></div>
        <br>
        <?php if(isset($_SESSION['username']) && $freezed == 0) { ?>
            <button class="btn btn-primary nav-background white" onclick="submitanswer()">Submit</button> <?php } ?>
        </div>
        
        <script>
            
            // JS function to convert BBCode and HTML code - http;//coursesweb.net/javascript/
var BBCodeHTML = function() {
  var me = this;            // stores the object instance
  var token_match = /{[A-Z_]+[0-9]*}/ig;

  // regular expressions for the different bbcode tokens
  var tokens = {
    'URL' : '((?:(?:[a-z][a-z\\d+\\-.]*:\\/{2}(?:(?:[a-z0-9\\-._~\\!$&\'*+,;=:@|]+|%[\\dA-F]{2})+|[0-9.]+|\\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\\])(?::\\d*)?(?:\\/(?:[a-z0-9\\-._~\\!$&\'*+,;=:@|]+|%[\\dA-F]{2})*)*(?:\\?(?:[a-z0-9\\-._~\\!$&\'*+,;=:@\\/?|]+|%[\\dA-F]{2})*)?(?:#(?:[a-z0-9\\-._~\\!$&\'*+,;=:@\\/?|]+|%[\\dA-F]{2})*)?)|(?:www\\.(?:[a-z0-9\\-._~\\!$&\'*+,;=:@|]+|%[\\dA-F]{2})+(?::\\d*)?(?:\\/(?:[a-z0-9\\-._~\\!$&\'*+,;=:@|]+|%[\\dA-F]{2})*)*(?:\\?(?:[a-z0-9\\-._~\\!$&\'*+,;=:@\\/?|]+|%[\\dA-F]{2})*)?(?:#(?:[a-z0-9\\-._~\\!$&\'*+,;=:@\\/?|]+|%[\\dA-F]{2})*)?)))',
    'LINK' : '([a-z0-9\-\./]+[^"\' ]*)',
    'EMAIL' : '((?:[\\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*(?:[\\w\!\#$\%\'\*\+\-\/\=\?\^\`{\|\}\~]|&)+@(?:(?:(?:(?:(?:[a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(?:\\d{1,3}\.){3}\\d{1,3}(?:\:\\d{1,5})?))',
    'TEXT' : '(.*?)',
    'SIMPLETEXT' : '([a-zA-Z0-9-+.,_ ]+)',
    'INTTEXT' : '([a-zA-Z0-9-+,_. ]+)',
    'IDENTIFIER' : '([a-zA-Z0-9-_]+)',
    'COLOR' : '([a-z]+|#[0-9abcdef]+)',
    'NUMBER'  : '([0-9]+)'
  };

  var bbcode_matches = [];        // matches for bbcode to html

  var html_tpls = [];             // html templates for html to bbcode

  var html_matches = [];          // matches for html to bbcode

  var bbcode_tpls = [];           // bbcode templates for bbcode to html

  /**
   * Turns a bbcode into a regular rexpression by changing the tokens into
   * their regex form
   */
  var _getRegEx = function(str) {
    var matches = str.match(token_match);
    var nrmatches = matches.length;
    var i = 0;
    var replacement = '';

    if (nrmatches <= 0) {
      return new RegExp(preg_quote(str), 'g');        // no tokens so return the escaped string
    }

    for(; i < nrmatches; i += 1) {
      // Remove {, } and numbers from the token so it can match the
      // keys in tokens
      var token = matches[i].replace(/[{}0-9]/g, '');

      if (tokens[token]) {
        // Escape everything before the token
        replacement += preg_quote(str.substr(0, str.indexOf(matches[i]))) + tokens[token];

        // Remove everything before the end of the token so it can be used
        // with the next token. Doing this so that parts can be escaped
        str = str.substr(str.indexOf(matches[i]) + matches[i].length);
      }
    }

    replacement += preg_quote(str);      // add whatever is left to the string

    return new RegExp(replacement, 'gi');
  };

  /**
   * Turns a bbcode template into the replacement form used in regular expressions
   * by turning the tokens in $1, $2, etc.
   */
  var _getTpls = function(str) {
    var matches = str.match(token_match);
    var nrmatches = matches.length;
    var i = 0;
    var replacement = '';
    var positions = {};
    var next_position = 0;

    if (nrmatches <= 0) {
      return str;       // no tokens so return the string
    }

    for(; i < nrmatches; i += 1) {
      // Remove {, } and numbers from the token so it can match the
      // keys in tokens
      var token = matches[i].replace(/[{}0-9]/g, '');
      var position;

      // figure out what $# to use ($1, $2)
      if (positions[matches[i]]) {
        position = positions[matches[i]];         // if the token already has a position then use that
      } else {
        // token doesn't have a position so increment the next position
        // and record this token's position
        next_position += 1;
        position = next_position;
        positions[matches[i]] = position;
      }

      if (tokens[token]) {
        replacement += str.substr(0, str.indexOf(matches[i])) + '$' + position;
        str = str.substr(str.indexOf(matches[i]) + matches[i].length);
      }
    }

    replacement += str;

    return replacement;
  };

  /**
   * Adds a bbcode to the list
   */
  me.addBBCode = function(bbcode_match, bbcode_tpl) {
    // add the regular expressions and templates for bbcode to html
    bbcode_matches.push(_getRegEx(bbcode_match));
    html_tpls.push(_getTpls(bbcode_tpl));

    // add the regular expressions and templates for html to bbcode
    html_matches.push(_getRegEx(bbcode_tpl));
    bbcode_tpls.push(_getTpls(bbcode_match));
  };

  /**
   * Turns all of the added bbcodes into html
   */
  me.bbcodeToHtml = function(str) {
    var nrbbcmatches = bbcode_matches.length;
    var i = 0;

    for(; i < nrbbcmatches; i += 1) {
      str = str.replace(bbcode_matches[i], html_tpls[i]);
    }

    return str;
  };

  /**
   * Turns html into bbcode
   */
  me.htmlToBBCode = function(str) {
    var nrhtmlmatches = html_matches.length;
    var i = 0;

    for(; i < nrhtmlmatches; i += 1) {
      str = str.replace(html_matches[i], bbcode_tpls[i]);
    }

    return str;
  }

  /**
   * Quote regular expression characters plus an optional character
   * taken from phpjs.org
   */
  function preg_quote (str, delimiter) {
    return (str + '').replace(new RegExp('[.\\\\+*?\\[\\^\\]$(){}=!<>|:\\' + (delimiter || '') + '-]', 'g'), '\\$&');
  }

  // adds BBCodes and their HTML
  me.addBBCode('[b]{TEXT}[/b]', '<strong>{TEXT}</strong>');
  me.addBBCode('[i]{TEXT}[/i]', '<em>{TEXT}</em>');
  me.addBBCode('[u]{TEXT}[/u]', '<span style="text-decoration:underline;">{TEXT}</span>');
  me.addBBCode('[s]{TEXT}[/s]', '<span style="text-decoration:line-through;">{TEXT}</span>');
  me.addBBCode('[url={URL}]{TEXT}[/url]', '<a href="{URL}" title="link" target="_blank">{TEXT}</a>');
  me.addBBCode('[url]{URL}[/url]', '<a href="{URL}" title="link" target="_blank">{URL}</a>');
  me.addBBCode('[url={LINK}]{TEXT}[/url]', '<a href="{LINK}" title="link" target="_blank">{TEXT}</a>');
  me.addBBCode('[url]{LINK}[/url]', '<a href="{LINK}" title="link" target="_blank">{LINK}</a>');
  me.addBBCode('[img={URL} width={NUMBER1} height={NUMBER2}]{TEXT}[/img]', '<img src="{URL}" width="{NUMBER1}" height="{NUMBER2}" alt="{TEXT}" />');
  me.addBBCode('[img]{URL}[/img]', '<img src="{URL}" alt="{URL}" />');
  me.addBBCode('[img={LINK} width={NUMBER1} height={NUMBER2}]{TEXT}[/img]', '<img src="{LINK}" width="{NUMBER1}" height="{NUMBER2}" alt="{TEXT}" />');
  me.addBBCode('[img]{LINK}[/img]', '<img src="{LINK}" alt="{LINK}" />');
  me.addBBCode('[color=COLOR]{TEXT}[/color]', '<span style="{COLOR}">{TEXT}</span>');
  me.addBBCode('[highlight={COLOR}]{TEXT}[/highlight]', '<span style="background-color:{COLOR}">{TEXT}</span>');
  me.addBBCode('[quote="{TEXT1}"]{TEXT2}[/quote]', '<div class="quote"><cite>{TEXT1}</cite><p>{TEXT2}</p></div>');
  me.addBBCode('[quote]{TEXT}[/quote]', '<cite>{TEXT}</cite>');
  me.addBBCode('[blockquote]{TEXT}[/blockquote]', '<blockquote>{TEXT}</blockquote>');
};
var bbcodeParser = new BBCodeHTML();       // creates object instance of BBCodeHTML()
            
            var marked = "<?php echo $marked; ?>";
            
            function changetick(str) {
                
                var qnd_user =  "<?php echo $qnd_user; ?>";
                
                var freezed =  "<?php echo $freezed; ?>";
                
                var session_user =  "<?php echo $_SESSION['username']; ?>";
                
                if(qnd_user == session_user && freezed == 0) {
                
                    if(marked) {
                        var markedid = document.getElementsByClassName('greenn')[0].getAttribute('id')
                        console.log("str is ",str)
                        console.log("marked id is ",markedid)
                        document.getElementById(markedid).setAttribute('class','fa fa-check fa-2x ')
                    }
                
                    marked = true
                
                    var qid =  "<?php echo $_GET['qid']; ?>";
                
                    if(markedid == str){
                        marked = false
                        $.post('./unmark_answer.php', {'markedid': str, 'qid': qid}, function(response) {
                        });
                    }
                    else {
                        console.log("marking")
                        document.getElementById(str).setAttribute('class','fa fa-check fa-2x greenn')
                        $.post('./mark_answer.php', {'markedid': str, 'qid': qid}, function(response) { 
                            var markedid = str
                        });
                    }
                }
                else if(freezed == 1) {
                    alert("Question freezed, cannot mark")
                }
            }   
            
            function changevote(status) {
                
                if(status.getAttribute('data-voted') == 1) {
                    alert("You cannot vote")
                }
                else {
                    //alert("You can vote")
                    var qid =  "<?php echo $_GET['qid']; ?>";
                    v_type = status.getAttribute('data-vote_type')
                    
                    if(v_type == 'dq') {
                        v_type = 2
                    }
                    else if(v_type == 'uq'){
                        v_type = 1
                    }
                    
                    console.log(qid, v_type)
                    $.post('./vote.php', {'qid': qid, 'v_type': v_type}, function(response) {
                        console.log(response)
                        
                        if(response['voted'] == 1) {
                            console.log("upvoted")
                            $("[data-vote_type='uq']").attr('data-voted',1)
                            $("[data-vote_type='dq']").attr('data-voted',0)
                            $("[data-vote_type='uq']").attr('class','fa fa-2x fa-arrow-circle-o-up green')
                            $("[data-vote_type='dq']").attr('class','fa fa-2x fa-arrow-circle-o-down')
                        }
                        else if(response['voted'] == 2) {
                            console.log("downvoted")
                            $("[data-vote_type='uq']").attr('data-voted',0)
                            $("[data-vote_type='dq']").attr('data-voted',1)
                            $("[data-vote_type='uq']").attr('class','fa fa-2x fa-arrow-circle-o-up')
                            $("[data-vote_type='dq']").attr('class','fa fa-2x fa-arrow-circle-o-down green')
                        }
                        else if(response['voted'] == 0) {
                            console.log("neutral")
                            $("[data-vote_type='uq']").attr('data-voted',0)
                            $("[data-vote_type='dq']").attr('data-voted',0)
                            $("[data-vote_type='uq']").attr('class','fa fa-2x fa-arrow-circle-o-up')
                            $("[data-vote_type='dq']").attr('class','fa fa-2x fa-arrow-circle-o-down')
                            
                        }
                        
                        console.log(response["voted"])
                        console.log(response["votes"])
                        document.getElementById('qvotes').innerHTML=response['votes']
                    }, 'json');
                }
            }
            
            function changevote_answer(status, aid, vid) {
                
                console.log("acount is ", vid)
                
                upid = String(vid)+"u"
                downid = String(vid)+"d"
                avote = String(vid)+"a"
                
                console.log("up is ", upid, "down is ", downid)
                
                console.log(document.getElementById(upid))
                
                if(status.getAttribute('data-voted') == 1) {
                    alert("You cannot vote")
                }
                else {
                    //alert("You can vote")
                    v_type = status.getAttribute('data-vote_type')
                    
                    if(v_type == 'd') {
                        //$("[data-vote_type='u']").attr('voted',0)
                        //$("[data-vote_type='d']").attr('voted',1)
                        v_type = 2
                    }
                    else if(v_type == 'u'){
                        //$("[data-vote_type='u']").attr('voted',1)
                        //$("[data-vote_type='d']").attr('voted',0)
                        v_type = 1
                    }
                    
                    console.log(aid, v_type)
                    $.post('./vote_answer.php', {'aid': aid, 'v_type': v_type}, function(response) {
                        console.log(response)
                        
                        if(response['voted'] == 1) {
                            console.log("upvoted")
                            /*$("[data-vote_type='u']").attr('data-voted',1)
                            $("[data-vote_type='d']").attr('data-voted',0)
                            $("[data-vote_type='u']").attr('class','fa fa-2x fa-arrow-circle-o-up green')
                            $("[data-vote_type='d']").attr('class','fa fa-2x fa-arrow-circle-o-down') */
                            
                            document.getElementById(upid).setAttribute('data-voted', 1)
                            document.getElementById(downid).setAttribute('data-voted', 0)
                            document.getElementById(upid).setAttribute('class','fa fa-2x fa-arrow-circle-o-up green')
                            document.getElementById(downid).setAttribute('class','fa fa-2x fa-arrow-circle-o-down')
                        }
                        else if(response['voted'] == 2) {
                            console.log("downvoted")
                            /*$("[data-vote_type='u']").attr('voted',0)
                            $("[data-vote_type='d']").attr('voted',1)
                            $("[data-vote_type='u']").attr('class','fa fa-2x fa-arrow-circle-o-up')
                            $("[data-vote_type='d']").attr('class','fa fa-2x fa-arrow-circle-o-down green') */
                            
                            document.getElementById(upid).setAttribute('data-voted', 0)
                            document.getElementById(downid).setAttribute('data-voted', 1)
                            document.getElementById(upid).setAttribute('class','fa fa-2x fa-arrow-circle-o-up')
                            document.getElementById(downid).setAttribute('class','fa fa-2x fa-arrow-circle-o-down green')
                            
                        }
                        else if(response['voted'] == 0) {
                            console.log("neutral")
                            /*$("[data-vote_type='u']").attr('voted',0)
                            $("[data-vote_type='d']").attr('voted',0)
                            $("[data-vote_type='u']").attr('class','fa fa-2x fa-arrow-circle-o-up')
                            $("[data-vote_type='d']").attr('class','fa fa-2x fa-arrow-circle-o-down')*/
                            
                            document.getElementById(upid).setAttribute('data-voted', 0)
                            document.getElementById(downid).setAttribute('data-voted', 0)
                            document.getElementById(upid).setAttribute('class','fa fa-2x fa-arrow-circle-o-up')
                            document.getElementById(downid).setAttribute('class','fa fa-2x fa-arrow-circle-o-down')
                            
                        }
                        
                        console.log(response["voted"])
                        console.log(response["votes"])
                        document.getElementById(avote).innerHTML=response['votes']
                    }, 'json');
                }
            }
            
            
            
            function submitanswer() {
                
                var answer = $('#summernote').summernote('code')
                var qid =  "<?php echo $_GET['qid']; ?>";
                
                
                if(validate_summernote(answer)) {

                    var iDiv = document.createElement('div')

                    document.getElementById("answer_list").appendChild(iDiv)

                    $.post('./submit_answer.php', {'answer': answer, "qid": qid}, function(response){
                        if(response){
                            var qnd_user =  "<?php echo $qnd_user; ?>";
                            var session_user =  "<?php echo $_SESSION['username']; ?>";
                            
                            console.log(response['aid'])
                            
                            def = './uploads/defaultIcon.png";'

                            if(qnd_user == session_user) {
                                iDiv.innerHTML = "<div class='row'><span class='col-sm-1'><i id = "+response['aid']+" class='fa fa-check fa-2x' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true'></i><br>0<br><i class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true'></i></span><span class='col-sm-11'>"+bbcodeParser.bbcodeToHtml(answer)+"</div><br><br><div class='row'><div class='col-sm-1 col-sm-offset-8'><img width='60' height='45' src='./uploads/"+htmlEntities(response['username'])+"' alt='No Image Available' onerror = 'this.src="+def+"' /></div><div class='col-sm-3'><span class='asked_by'>answered by <a href=''>"+htmlEntities(response['username'])+"</a></span><br><span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> now </span></div></div><hr style='width:50%'>"
                            }
                            else {
                                iDiv.innerHTML = "<div class='row'><span class = 'disp_none'><i id = "+response['aid']+" class='fa fa-check fa-2x col-sm-1' aria-hidden='true' onclick='changetick(this.id)'></i></span><span class='col-sm-1'><i class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true'></i><br>0<br><i class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true'></i></span><span class='col-sm-11'>"+bbcodeParser.bbcodeToHtml(answer)+"</div><br><br><div class='row'><div class='col-sm-1 col-sm-offset-8'><img width='60' height='45' src='./uploads/"+htmlEntities(response['username'])+"' alt='No Image Available' onerror = 'this.src="+def+"' /></div><div class='col-sm-3'><span class='asked_by'>answered by <a href=''>"+htmlEntities(response['username'])+"</a></span><br><span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> now </span></div></div><hr style='width:50%'>"
                            }
                        }
                    }, 'json');
                }
                
                $('#summernote').summernote('code','')
            }
            
            $(".btn").mouseup(function(){
                $(this).blur();
            })
            
        </script>
        
    
    </body>

</html>


