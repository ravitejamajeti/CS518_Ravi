    <nav class="navbar nav-background">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" onclick="removeclass()">
                <span class="icon-bar">Hi</span>
              </button>
              <a href="index.php" class="navbar-brand logo white" href="#">ODU HangOuts</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li><a href="ask_question.php" id="ask" class="white">Ask Question</a></li>
                <li><a href="allquestions.php" id="ask" class="white">All Questions</a></li>
            <?php
                if (isset($_SESSION['username'])) { ?>
                    <li><a href="my_questions.php" id="my_question" class="white">Asked</a></li> 
                    <li><a href="my_answers.php" id="my_answer" class="white">Answered</a></li>
            <?php  } ?>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <li class='white' style="position:relative; top:13px "><label for="tags">Search: </label> <input class='green' id="tags" onkeydown="search(this)"></li>
                  <?php
                      if (!isset($_SESSION['username'])) {?>
                        <li id='signup'><a href='signup.php' class='white'><span class='glyphicon glyphicon-user'></span> Sign Up </a></li>
                        <li><a href='samplogin.php' class='white'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
                    <?php  }
                      else {?>
                        <li id='signup'><a href='profile.php?uname=<?php echo $_SESSION['username'] ?>' class='white'><span class='glyphicon glyphicon-user'></span> <?php echo $_SESSION['username'];?> </a></li>
                        <li><a href='logout.php' class='white'><span class='glyphicon glyphicon-log-in'></span> Logout</a></li>
                     <?php }
                  ?>
              </ul>
            </div>
          </div>
    </nav>

<?php 
    $query = "SELECT user_name from users";
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_array($result)) {
        $users[]=$row[0];
    }
?>
<script>
    
    var users_array = <?php echo json_encode($users );?>;
    
    console.log(users_array);
    
  $( function() {
    $( "#tags" ).autocomplete({
      source: users_array
    });
  } );
    
    function search(ele) {
    if(event.keyCode == 13) {
        location.replace("profile.php?uname="+ele.value);
    }
}
  </script>