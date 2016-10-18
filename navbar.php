    <nav class="navbar  nav-background">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" onclick="removeclass()">
                <span class="icon-bar">Hi</span>
              </button>
              <a class="navbar-brand white" href="#">WebSiteName</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li><a href="index.php" class="white">Home</a></li>
                <li><a href="ask_question.php" class="white">Ask Question</a></li>
                <li><a href="#" class="white">Asked</a></li> 
                <li><a href="#" class="white">Answered</a></li> 
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <?php
                      if (!isset($_SESSION['username'])) {?>
                        <li id='signup'><a href='#' class='white'><span class='glyphicon glyphicon-user'></span> Sign Up </a></li>
                        <li><a href='login.php' class='white'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
                    <?php  }
                      else {?>
                        <li id='signup'><a href='#' class='white'><span class='glyphicon glyphicon-user'></span> <?php echo $_SESSION['username'];?> </a></li>
                        <li><a href='logout.php' class='white'><span class='glyphicon glyphicon-log-in'></span> Logout</a></li>
                     <?php }
                  ?>
              </ul>
            </div>
          </div>
    </nav>