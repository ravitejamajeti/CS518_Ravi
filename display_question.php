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
                $row = mysqli_fetch_array($result);
                $qnd_user = $row['qnd_user'];
                    echo "<h4>".$row['question_title']."</h4>";
                    echo "<hr width = '83%'>";
                    echo "<div class='row'>";
                    echo "<span class='col-sm-1'><i class='fa fa-star-o fa-2x' aria-hidden='true'></i></span>";
                    echo "<div class='col-sm-11'>".$row['question']."</div>";
                    echo "</div>";
                    echo "<br><br>";
                    echo "<div class='row'>";
                    echo "<div class='col-sm-4 col-sm-offset-8'><span class='asked_by'>asked by </span><a href=''>".htmlentities($row['qnd_user'])."</a></div>";
                    echo "</div>";
                    echo "<hr>";
            }
        ?>
            
        <br>
        <div id="answer_list">

        <?php
            $marked = false;
            $query = "SELECT * from answers where qid = '".$_GET['qid']."'";
        
            if($result = mysqli_query($link, $query)) {
                while($row = mysqli_fetch_array($result)) {
                    
                    if($row['marked'] == 1) {
                        $marked = true;
                        echo "<div class='row'>";
                        echo "<span><i id='".$row['aid']."'class='fa fa-check fa-2x col-sm-1 green' aria-hidden='true' onclick='changetick(this.id)'></i></span>";
                        echo "<span class='col-sm-11'>".($row['answer'])."</span>";
                        echo "</div>";
                        echo "<br><br>";
                        echo "<div class='row'>";
                        echo "<div class='col-sm-4 col-sm-offset-8'><span class='asked_by'>answered by </span><a href=''>".htmlentities($row['answered_user'])."</a></div>";
                        echo "</div>";
                        echo "<hr width = '83%'>";
                    }
                    else {
                        echo "<div class='row'>";
                        
                        if(isset($_SESSION['username'])) {
                            if($qnd_user == $_SESSION['username']) {
                                echo "<span><i id='".$row['aid']."'class='fa fa-check fa-2x col-sm-1' aria-hidden='true' onclick='changetick(this.id)'></i></span>";
                            }
                            else {
                                echo "<span class = 'disp_none'><i id='".$row['aid']."'class='fa fa-check fa-2x col-sm-1 disp_none' aria-hidden='true' onclick='changetick(this.id)'></i></span>";
                                echo "<span class='col-sm-1'></span>";
                            }
                        }
                        else {
                            echo "<span class = 'disp_none'><i id='".$row['aid']."'class='fa fa-check fa-2x col-sm-1 disp_none' aria-hidden='true' onclick='changetick(this.id)'></i></span>";
                            echo "<span class='col-sm-1'></span>";
                        }
                        echo "<span class='col-sm-11'>".($row['answer'])."</span>";
                        echo "</div>";
                        echo "<br><br>";
                        echo "<div class='row'>";
                        echo "<div class='col-sm-4 col-sm-offset-8'><span class='asked_by'>answered by </span><a href=''>".htmlentities($row['answered_user'])."</a></div>";
                        echo "</div>";
                        echo "<hr width = '83%'>";
                    } 
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
                        document.getElementById(markedid).setAttribute('class','fa fa-check fa-2x col-sm-1')
                    }
                
                    marked = true
                
                    var qid =  "<?php echo $_GET['qid']; ?>";
                
                    if(markedid == str){
                        marked = false
                    }
                    else {
                        document.getElementById(str).setAttribute('class','fa fa-check fa-2x col-sm-1 green')
                    }
                    
                    $.post('./mark_answer.php', {'markedid': str, 'qid': qid}, function(response) {
                    });
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

                            if(qnd_user == session_user) {
                                iDiv.innerHTML = "<div class='row'><span><i class='fa fa-check fa-2x col-sm-1' aria-hidden='true' onclick='changetick(this.id)'></i></span><span class='col-sm-11'>"+answer+"</div><br><br><div class='row'><div class='col-sm-4 col-sm-offset-8'><span class='asked_by'>answered by </span><a href=''>"+htmlEntities(response['username'])+"</a></div></div><hr width = '83%'>"
                            }
                            else {
                                iDiv.innerHTML = "<div class='row'><span class = 'disp_none'><i class='fa fa-check fa-2x col-sm-1' aria-hidden='true' onclick='changetick(this.id)'></i></span><span class='col-sm-1'></span><span class='col-sm-11'>"+answer+"</div><br><br><div class='row'><div class='col-sm-4 col-sm-offset-8'><span class='asked_by'>answered by </span><a href=''>"+htmlEntities(response['username'])+"</a></div></div><hr width = '83%'>"
                            }
                        }
                    }, 'json');
                }
            }
            
            $(".btn").mouseup(function(){
                $(this).blur();
            })
            
        </script>
        
    
    </body>

</html>

