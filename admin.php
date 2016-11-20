<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'header.php' ?>
</head>
<body>

<?php include 'config.php'; include 'db_connect.php'; include 'navbar.php'; ?>
<div class="container">
  <ul class="nav nav-tabs">
      
    <?php if(isset($_GET['q'])) { ?>
        <li><a data-toggle="tab" href="#users">Users</a></li>
        <li class="active"><a data-toggle="tab" href="#rq">Recent Questions</a></li>
    <?php } else { ?>
        <li class="active"><a data-toggle="tab" href="#users">Users</a></li>
        <li><a data-toggle="tab" href="#rq">Recent Questions</a></li>
    <?php } ?>
    
  </ul>

  <div class="tab-content">
      
    <?php if(isset($_GET['q'])) { ?>
    <div id="users" class="tab-pane fade">
    <?php } else { ?>
    <div id="users" class="tab-pane fade in active">
    <?php } ?>
        
    <h3>User List</h3>
    <?php 
        
        $per_page = 10;
            
        $query = "SELECT count(*) from users";

        $result = mysqli_query($link, $query);

        $row = mysqli_fetch_array($result);

        $pages = ceil($row[0]/$per_page);

        if(!isset($_GET['page'])) {
            header("location: admin.php?page=1&qpage=1");
        }
        else {
            $page = $_GET['page'];
        }

        $start = ($page - 1) * $per_page;
        
        $query = "SELECT user_name from users order by user_name limit $start, $per_page";
        
        if($result = mysqli_query($link, $query)){
            while($row = mysqli_fetch_array($result)) {
                ?> <a href='admin_users_profile.php?uname=<?php echo htmlentities($row[0]) ?>'> <?php echo htmlentities($row[0]) ?> </a> <br><br> <?php  
            }
        }     
    ?>
        
    <div class="row">
        <div class="col-sm-8"></div>
        <div class="col-sm-4">
            <ul class="pagination">
              <li><a href="?page= <?php $inc_page = $_GET['page'] - 1; echo $inc_page ?>&qpage=<?php echo $_GET['qpage']; ?>">Previous</a></li>
              <li><a href="?page=<?php echo $_GET['page']; ?>&qpage=<?php echo $_GET['qpage']; ?>"><?php echo $_GET['page']; ?></a></li>
              <li><a href="?page= <?php $inc_page = $_GET['page'] + 1; echo $inc_page ?>&qpage=<?php echo $_GET['qpage']; ?>">Next</a></li>
            </ul>
        </div>
    </div>
    </div>
      
    <?php if(isset($_GET['q'])) { ?>
    <div id="rq" class="tab-pane fade in active">
    <?php } else { ?>
    <div id="rq" class="tab-pane fade">
    <?php } ?>
    
      <h3>Recent Questions</h3>
        <?php
    
        $per_page = 10;

        $query = "SELECT count(*) from questions";

        $result = mysqli_query($link, $query);

        $row = mysqli_fetch_array($result);

        $pages = ceil($row[0]/$per_page);

            $page = $_GET['qpage'];

        $start = ($page - 1) * $per_page;
    
        $query = "SELECT * from questions order by qid desc limit $start, $per_page";
        
        if($result = mysqli_query($link, $query)){
            while($row = mysqli_fetch_array($result)) {
                ?> <a href='display_admin_ques.php?qid=<?php echo $row['qid'] ?>'> <?php echo htmlentities($row['question_title']) ?> </a> <br><br> <?php  
            }
        } 
                     
        ?>
        
        <div class="row">
        <div class="col-sm-8"></div>
        <div class="col-sm-4">
            <ul class="pagination">
              <li><a href="?page=<?php echo $_GET['page']; ?>&qpage= <?php $inc_page = $_GET['qpage'] - 1; echo $inc_page ?>&q=1">Previous</a></li>
              <li><a href="?page=<?php echo $_GET['page']; ?>&qpage=<?php echo $_GET['qpage']; ?>&q=1"><?php echo $_GET['qpage']; ?></a></li>
              <li><a href="?page=<?php echo $_GET['page']; ?>&qpage= <?php $inc_page = $_GET['qpage'] + 1; echo $inc_page ?>&q=1">Next</a></li>
            </ul>
        </div>
    </div>
    </div>
  </div>
</div>
    
<script>
    document.getElementById("admin").style.backgroundColor = "white";
    document.getElementById("admin").style.color = "steelblue";
</script>

</body>
</html>

