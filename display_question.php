<html>
    
    <head>
        
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
        
        <?php include 'config.php'; include 'navbar.php'; ?>
        
        <br><br>
        
        <span class="disp_none"><i id='71' class="fa fa-check fa-2x icon-invisible" aria-hidden='true'></i></span>
        
        <div class="container">
        
        <?php
            include 'db_connect.php';
            
            $query = "SELECT * from questions where qid = '".$_GET['qid']."'";
            
            if($result = mysqli_query($link, $query)) {
                
                $num_rows = mysqli_num_rows($result);
                
                if($num_rows < 1) {
                    header("Location: index.php");
                }
                
                $row = mysqli_fetch_array($result);
                
                $upvote = 0;
                    $downvote = 0;
                
                $loggedin = 1;
                
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
                else {
                    $loggedin = 0;
                }
                
                $qnd_user = $row['qnd_user']; ?>
            
                    <h4> <?php echo htmlentities($row['question_title']) ?> </h4> 
                    <hr width = '83%'>
                    <div class='row'>
                        <?php if($upvote == 0 && $downvote == 0) { ?>
                        <span class='col-sm-1'><i class='fa fa-star-o fa-2x' aria-hidden='true'></i><br><br><i class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' vote_type = 'uq' voted = '<?php echo $upvote; ?>' onclick='changevote(this)'></i><br><span id="qvotes"><?php echo $row['votes']; ?></span><br><i class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' vote_type = 'dq' voted = '<?php echo $downvote; ?>' onclick='changevote(this)'></i></span>
                        <?php } else if($upvote == 1 && $downvote == 0) { ?>
                        <span class='col-sm-1'><i class='fa fa-star-o fa-2x' aria-hidden='true'></i><br><br><i class='fa fa-2x fa-arrow-circle-o-up green' aria-hidden='true' vote_type = 'uq' voted = '<?php echo $upvote; ?>' onclick='changevote(this)'></i><br><span id="qvotes"><?php echo $row['votes']; ?></span><br><i class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' vote_type = 'dq' voted = '<?php echo $downvote; ?>' onclick='changevote(this)'></i></span>
                        <?php } else if($upvote == 0 && $downvote == 1) { ?>
                        <span class='col-sm-1'><i class='fa fa-star-o fa-2x' aria-hidden='true'></i><br><br><i class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' vote_type = 'uq' voted = '<?php echo $upvote; ?>' onclick='changevote(this)'></i><br><span id="qvotes"><?php echo $row['votes']; ?></span><br><i class='fa fa-2x fa-arrow-circle-o-down green' aria-hidden='true' vote_type = 'dq' voted = '<?php echo $downvote; ?>' onclick='changevote(this)'></i></span>
                        <?php } ?>
                    <div class='col-sm-11'> <?php echo $row['question']; ?> </div>
                    </div>
                    <br><br>
                    <div class='row'>
                        <div class='col-sm-1 col-sm-offset-8'><img width='60' height='45' src='./uploads/<?php echo htmlentities($row['qnd_user']) ?>' onerror= 'this.src="./uploads/defaultIcon.png";' /> </div>
                            <div class='col-sm-3'><span class='asked_by'>asked by </span><a href='profile.php?uname=<?php echo htmlentities($row['qnd_user']) ?>'> <?php echo htmlentities($row['qnd_user']) ?> </a><br><span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> on <?php echo htmlentities($row['q_created']) ?></span></div>
                        </div>
                        <hr>
            <?php
            }
            
            $query = "update questions set views = views + 1 where qid = '".$_GET['qid']."'";
            
            mysqli_query($link, $query);
        ?>
            
        
        <div id="answer_list">
            <div><h3>Answers</h3></div>
            <hr>

        <?php
            $marked = false;
            $query = "SELECT * from answers where qid = '".$_GET['qid']."' order by marked desc, votes desc";
        
            if($result = mysqli_query($link, $query)) {
                
                $acount = 1;
                while($row = mysqli_fetch_array($result)) {
                    
                    
                    
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
                    
                    if($row['marked'] == 1) {
                        $marked = true;
                        echo "<div class='row'>";
                        
                        
                        
                        if($upvote == 0 && $downvote == 0) {
                        echo "<span class='col-sm-1'><i id='".$row['aid']."'class='fa fa-check fa-2x green' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' vote_type = 'u' voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' vote_type = 'd' voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                        }
                        else if($upvote == 1 && $downvote == 0) {
                            echo "<span class='col-sm-1'><i id='".$row['aid']."'class='fa fa-check fa-2x green' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up green' aria-hidden='true' vote_type = 'u' voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' vote_type = 'd' voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                        }
                        else if($upvote == 0 && $downvote == 1) {
                            echo "<span class='col-sm-1'><i id='".$row['aid']."'class='fa fa-check fa-2x green' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' vote_type = 'u' voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down green' aria-hidden='true' vote_type = 'd' voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                        }
                        
                        echo "<span class='col-sm-11'>".($row['answer'])."</span>";
                        echo "</div>";
                        echo "<br><br>";
                        echo "<div class='row'>"; ?>
                        <div class='col-sm-1 col-sm-offset-8'><img width='60' height='45' src='./uploads/<?php echo $row['answered_user']; ?>' onerror= 'this.src="./uploads/defaultIcon.png";' /> </div>
                        <?php
                        echo "<div class='col-sm-3'><span class='asked_by'>answered by <a href='profile.php?uname=".htmlentities($row['answered_user'])."'>".htmlentities($row['answered_user'])."</a></span><br>";
                        echo "<span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> on </span>".$row['a_created']."";
                        echo "</div>";
                        echo "</div>";
                        echo "<hr width = '83%'>";
                    }
                    else {
                        echo "<div class='row'>";
                        
                        if(isset($_SESSION['username'])) {
                            if($qnd_user == $_SESSION['username']) {
                                
                                if($upvote == 0 && $downvote == 0) {
                                echo "<span class='col-sm-1'><i id='".$row['aid']."'class='fa fa-check fa-2x' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' vote_type = 'u' voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' vote_type = 'd' voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                                }
                                else if($upvote == 1 && $downvote == 0) {
                                    echo "<span class='col-sm-1'><i id='".$row['aid']."'class='fa fa-check fa-2x' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up green' aria-hidden='true' vote_type = 'u' voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' vote_type = 'd' voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                                }
                                else if($upvote == 0 && $downvote == 1) {
                                    echo "<span class='col-sm-1'><i id='".$row['aid']."'class='fa fa-check fa-2x' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' vote_type = 'u' voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down green' aria-hidden='true' vote_type = 'd' voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                                }
                            }
                            else {
                                if($upvote == 0 && $downvote == 0) {
                                    echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' vote_type = 'u' voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' vote_type = 'd' voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                                }
                                else if($upvote == 1 && $downvote == 0) {
                                    echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up green' aria-hidden='true' vote_type = 'u' voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' vote_type = 'd' voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                                }
                                else if($upvote == 0 && $downvote == 1) {
                                    echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' vote_type = 'u' voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down green' aria-hidden='true' vote_type = 'd' voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                                }
                            }
                        }
                        else {
                            if($upvote == 0 && $downvote == 0) {
                                echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' vote_type = 'u' voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' vote_type = 'd' voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                            }
                            else if($upvote == 1 && $downvote == 0) {
                                echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up green' aria-hidden='true' vote_type = 'u' voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true' vote_type = 'd' voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                            }
                            else if($upvote == 0 && $downvote == 1) {
                                echo "<span class='col-sm-1'><i id='".$aupid."' class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true' vote_type = 'u' voted='".$upvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i><br><span id='".$avoteid."'>".$row['votes']."</span><br><i id='".$adownid."' class='fa fa-2x fa-arrow-circle-o-down green' aria-hidden='true' vote_type = 'd' voted='".$downvote."' onclick='changevote_answer(this, ".$row['aid'].", ".$acount." )'></i></span>";
                            }
                        }
                        echo "<span class='col-sm-11'>".($row['answer'])."</span>";
                        echo "</div>";
                        echo "<br><br>";
                        echo "<div class='row'>"; ?>
                        <div class='col-sm-1 col-sm-offset-8'><img width='60' height='45' src='./uploads/<?php echo $row['answered_user']; ?>' onerror= 'this.src="./uploads/defaultIcon.png";' /> </div>
                        <?php
                        echo "<div class='col-sm-3'><span class='asked_by'>answered by <a href='profile.php?uname=".htmlentities($row['answered_user'])."'>".htmlentities($row['answered_user'])."</a></span><br>";
                        echo "<span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> on </span>".$row['a_created']."";
                        echo "</div>";
                        echo "</div>";
                        echo "<hr width = '83%'>";
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
        <?php if(isset($_SESSION['username'])) { ?>
        <button class="btn btn-primary nav-background white" onclick="submitanswer()">Submit</button> <?php } ?>
        </div>
        
        <script>
            
            var marked = "<?php echo $marked; ?>";
            
            function changetick(str) {
                
                var qnd_user =  "<?php echo $qnd_user; ?>";
                
                var session_user =  "<?php echo $_SESSION['username']; ?>";
                
                if(qnd_user == session_user) {
                
                    if(marked) {
                        var markedid = document.getElementsByClassName('green')[0].getAttribute('id')
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
                        document.getElementById(str).setAttribute('class','fa fa-check fa-2x green')
                        $.post('./mark_answer.php', {'markedid': str, 'qid': qid}, function(response) {
                        });
                    }
                    
                    //$.post('./mark_answer.php', {'markedid': str, 'qid': qid}, function(response) {
                    //});
                }
            }   
            
            function changevote(status) {
                
                if(status.getAttribute('voted') == 1) {
                    alert("You cannot vote")
                }
                else {
                    //alert("You can vote")
                    var qid =  "<?php echo $_GET['qid']; ?>";
                    v_type = status.getAttribute('vote_type')
                    
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
                            $("[vote_type='uq']").attr('voted',1)
                            $("[vote_type='dq']").attr('voted',0)
                            $("[vote_type='uq']").attr('class','fa fa-2x fa-arrow-circle-o-up green')
                            $("[vote_type='dq']").attr('class','fa fa-2x fa-arrow-circle-o-down')
                        }
                        else if(response['voted'] == 2) {
                            console.log("downvoted")
                            $("[vote_type='uq']").attr('voted',0)
                            $("[vote_type='dq']").attr('voted',1)
                            $("[vote_type='uq']").attr('class','fa fa-2x fa-arrow-circle-o-up')
                            $("[vote_type='dq']").attr('class','fa fa-2x fa-arrow-circle-o-down green')
                        }
                        else if(response['voted'] == 0) {
                            console.log("neutral")
                            $("[vote_type='uq']").attr('voted',0)
                            $("[vote_type='dq']").attr('voted',0)
                            $("[vote_type='uq']").attr('class','fa fa-2x fa-arrow-circle-o-up')
                            $("[vote_type='dq']").attr('class','fa fa-2x fa-arrow-circle-o-down')
                            
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
                
                if(status.getAttribute('voted') == 1) {
                    alert("You cannot vote")
                }
                else {
                    //alert("You can vote")
                    v_type = status.getAttribute('vote_type')
                    
                    if(v_type == 'd') {
                        //$("[vote_type='u']").attr('voted',0)
                        //$("[vote_type='d']").attr('voted',1)
                        v_type = 2
                    }
                    else if(v_type == 'u'){
                        //$("[vote_type='u']").attr('voted',1)
                        //$("[vote_type='d']").attr('voted',0)
                        v_type = 1
                    }
                    
                    console.log(aid, v_type)
                    $.post('./vote_answer.php', {'aid': aid, 'v_type': v_type}, function(response) {
                        console.log(response)
                        
                        if(response['voted'] == 1) {
                            console.log("upvoted")
                            /*$("[vote_type='u']").attr('voted',1)
                            $("[vote_type='d']").attr('voted',0)
                            $("[vote_type='u']").attr('class','fa fa-2x fa-arrow-circle-o-up green')
                            $("[vote_type='d']").attr('class','fa fa-2x fa-arrow-circle-o-down') */
                            
                            document.getElementById(upid).setAttribute('voted', 1)
                            document.getElementById(downid).setAttribute('voted', 0)
                            document.getElementById(upid).setAttribute('class','fa fa-2x fa-arrow-circle-o-up green')
                            document.getElementById(downid).setAttribute('class','fa fa-2x fa-arrow-circle-o-down')
                        }
                        else if(response['voted'] == 2) {
                            console.log("downvoted")
                            /*$("[vote_type='u']").attr('voted',0)
                            $("[vote_type='d']").attr('voted',1)
                            $("[vote_type='u']").attr('class','fa fa-2x fa-arrow-circle-o-up')
                            $("[vote_type='d']").attr('class','fa fa-2x fa-arrow-circle-o-down green') */
                            
                            document.getElementById(upid).setAttribute('voted', 0)
                            document.getElementById(downid).setAttribute('voted', 1)
                            document.getElementById(upid).setAttribute('class','fa fa-2x fa-arrow-circle-o-up')
                            document.getElementById(downid).setAttribute('class','fa fa-2x fa-arrow-circle-o-down green')
                            
                        }
                        else if(response['voted'] == 0) {
                            console.log("neutral")
                            /*$("[vote_type='u']").attr('voted',0)
                            $("[vote_type='d']").attr('voted',0)
                            $("[vote_type='u']").attr('class','fa fa-2x fa-arrow-circle-o-up')
                            $("[vote_type='d']").attr('class','fa fa-2x fa-arrow-circle-o-down')*/
                            
                            document.getElementById(upid).setAttribute('voted', 0)
                            document.getElementById(downid).setAttribute('voted', 0)
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
                                iDiv.innerHTML = "<div class='row'><span class='col-sm-1'><i id = "+response['aid']+" class='fa fa-check fa-2x' aria-hidden='true' onclick='changetick(this.id)'></i><br><br><i class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true'></i><br>0<br><i class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true'></i></span><span class='col-sm-11'>"+answer+"</div><br><br><div class='row'><div class='col-sm-1 col-sm-offset-8'><img width='60' height='45' src='./uploads/"+htmlEntities(response['username'])+"' onerror = 'this.src="+def+"' /></div><div class='col-sm-3'><span class='asked_by'>answered by <a href=''>"+htmlEntities(response['username'])+"</a></span><br><span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> now </span></div></div><hr width = '83%'>"
                            }
                            else {
                                iDiv.innerHTML = "<div class='row'><span class = 'disp_none'><i id = "+response['aid']+" class='fa fa-check fa-2x col-sm-1' aria-hidden='true' onclick='changetick(this.id)'></i></span><span class='col-sm-1'><i class='fa fa-2x fa-arrow-circle-o-up' aria-hidden='true'></i><br>0<br><i class='fa fa-2x fa-arrow-circle-o-down' aria-hidden='true'></i></span><span class='col-sm-11'>"+answer+"</div><br><br><div class='row'><div class='col-sm-1 col-sm-offset-8'><img width='60' height='45' src='./uploads/"+htmlEntities(response['username'])+"' onerror = 'this.src="+def+"' /></div><div class='col-sm-3'><span class='asked_by'>answered by <a href=''>"+htmlEntities(response['username'])+"</a></span><br><span class='asked_by'><i class='fa fa-clock-o' aria-hidden='true'></i> now </span></div></div><hr width = '83%'>"
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


