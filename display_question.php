<html>
    
    <head>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" href="style.css">
    
    
    </head>
    
    <body>
        
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
              </button>
              <a class="navbar-brand" href="#">WebSiteName</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="ask_question.php">Ask Question</a></li>
                <li><a href="#">Page 2</a></li> 
                <li><a href="#">Page 3</a></li> 
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li id="signup"><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                  <?php
                  session_start();
                  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
                    echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
                  }
                  else {
                    echo "<li><a href='logout.php'><span class='glyphicon glyphicon-log-in'></span> Logout</a></li>";
                  }
                    ?>
              </ul>
            </div>
          </div>
        </nav>
        
        <?php echo "Question ID is ".$_GET['qid']; ?>
        
        <br><br>
        
        <div id="answer_list"></div>
        
        <textarea id="submit-answer" class="form-control" name="submit-answer" style="height: 100px"></textarea>
        
        <br><br>
        
        <button type="submit" class="btn btn-primary black-background white" onclick="submitanswer()">Submit</button>
        
        <script>
        
            document.getElementById("signup").style.display = "none";
            
            function submitanswer() {
                
                    var answer = document.getElementById("submit-answer").value
                    
                    if(answer != "") {
                    
                    var iDiv = document.createElement('div')
            
                    document.getElementById("answer_list").appendChild(iDiv)
                
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            iDiv.innerHTML = this.responseText;
                        }
                    }
                    
                    xmlhttp.open("GET", "submit_answer.php?q="+answer, true);
                    xmlhttp.send();
                    }
                
                document.getElementById("submit-answer").value = "";
            }
            
            $(".btn").mouseup(function(){
    $(this).blur();
})
            
        </script>
        
    
    </body>

</html>

