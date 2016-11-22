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
                
                $query_user = "SELECT score from users where user_name = '".$row['qnd_user']."'";
                $result_user = mysqli_query($link, $query_user);
                $row_user = mysqli_fetch_array($result_user);
                $score = $row_user['score'];
                
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
                        <div class='col-sm-1 col-sm-offset-8'><img width='60' height='60' src='./uploads/<?php echo htmlentities($row['qnd_user']) ?>' alt='No Image Available' onerror= 'this.src="./uploads/defaultIcon.png";' /> </div>
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
                        <div class='col-sm-1 col-sm-offset-8'><img width='60' height='60' src='./uploads/<?php echo htmlentities($row['qnd_user']) ?>' alt='No Image Available' onerror= 'this.src="./uploads/defaultIcon.png";' /> </div>
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
        
            if($result = mysqli_query($link, $query)) {
                
                $acount = 1;
                while($row = mysqli_fetch_array($result)) {
                    
                    $query_user = "SELECT score from users where user_name = '".$row['answered_user']."'";
                    $result_user = mysqli_query($link, $query_user);
                    $row_user = mysqli_fetch_array($result_user);
                    
                    $score = $row_user['score'];
                    
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

                            echo "<span class='col-sm-11'>".($row['answer'])."</span>";
                            echo "</div>";
                            echo "<br><br>";
                            echo "<div class='row'>"; ?>
                            <div class='col-sm-1 col-sm-offset-8'><img width='60' height='60' src='./uploads/<?php echo $row['answered_user']; ?>' alt='No Image Available' onerror= 'this.src="./uploads/defaultIcon.png";' /> </div>
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
                            echo "<span class='col-sm-11'>".($row['answer'])."</span>";
                            echo "</div>";
                            echo "<br><br>";
                            echo "<div class='row'>"; ?>
                            <div class='col-sm-1 col-sm-offset-8'><img width='60' height='60' src='./uploads/<?php echo $row['answered_user']; ?>' alt='No Image Available' onerror= 'this.src="./uploads/defaultIcon.png";' /> </div>
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

                            echo "<span class='col-sm-11'>".($row['answer'])."</span>";
                            echo "</div>";
                            echo "<br><br>";
                            echo "<div class='row'>"; ?>
                            <div class='col-sm-1 col-sm-offset-8'><img width='60' height='60' src='./uploads/<?php echo $row['answered_user']; ?>' alt='No Image Available' onerror= 'this.src="./uploads/defaultIcon.png";' /> </div>
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
                            echo "<span class='col-sm-11'>".($row['answer'])."</span>";
                            echo "</div>";
                            echo "<br><br>";
                            echo "<div class='row'>"; ?>
                            <div class='col-sm-1 col-sm-offset-8'><img width='60' height='60' src='./uploads/<?php echo $row['answered_user']; ?>' alt='No Image Available' onerror= 'this.src="./uploads/defaultIcon.png";' /> </div>
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
                                iDiv.innerHTML = "<div class='row'><span class='col-sm-1'><i id = "+response['aid']+" class='fa fa-check fa-2x' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true'></i><br>0<br><i class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true'></i></span><span class='col-sm-11'>"+answer+"</div><br><br><div class='row'><div class='col-sm-1 col-sm-offset-8'><img width='60' height='45' src='./uploads/"+htmlEntities(response['username'])+"' alt='No Image Available' onerror = 'this.src="+def+"' /></div><div class='col-sm-3'><span class='asked_by'>answered by <a href=''>"+htmlEntities(response['username'])+"</a></span><br><span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> now </span></div></div><hr style='width:50%'>"
                            }
                            else {
                                iDiv.innerHTML = "<div class='row'><span class = 'disp_none'><i id = "+response['aid']+" class='fa fa-check fa-2x col-sm-1' aria-hidden='true' onclick='changetick(this.id)'></i></span><span class='col-sm-1'><i class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true'></i><br>0<br><i class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true'></i></span><span class='col-sm-11'>"+answer+"</div><br><br><div class='row'><div class='col-sm-1 col-sm-offset-8'><img width='60' height='45' src='./uploads/"+htmlEntities(response['username'])+"' alt='No Image Available' onerror = 'this.src="+def+"' /></div><div class='col-sm-3'><span class='asked_by'>answered by <a href=''>"+htmlEntities(response['username'])+"</a></span><br><span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> now </span></div></div><hr style='width:50%'>"
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


