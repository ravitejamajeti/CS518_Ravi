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
        
        $query = "SELECT * from users order by score desc limit $start, $per_page";
        
        if($result = mysqli_query($link, $query)){
            while($row = mysqli_fetch_array($result)) {
                
                if($row['git_user'] == 0) {  
                if($row['grav_override'] == 1) { 
            
                    $img_src = "uploads/".$row['pic_name'];    
                } 
                else { 

                    $gravcheck = "http://www.gravatar.com/avatar/".md5( strtolower( trim( $row['email'] ) ) )."?d=404";

                    $response = get_headers($gravcheck);



                    if ($response[0] != "HTTP/1.1 404 Not Found"){ 

                        $img_src = "https://www.gravatar.com/avatar/".md5( strtolower( trim( $row['email'] ) ) );
                    } 
                    else { 

                        $img_src = "uploads/".$row['pic_name'];
                    } 
                }}
                else {
                            $img_src = 'https://github.com/'.$row['user_name'].'.png';
                        }
        
                $query1 = "select count(qid) from questions where qnd_user = '".$row['user_name']."'";
                $result1 = mysqli_query($link, $query1);
                $row1 = mysqli_fetch_array($result1);
                
                $query2 = "select count(aid) from answers where answered_user = '".$row['user_name']."'";
                $result2 = mysqli_query($link, $query2);
                $row2 = mysqli_fetch_array($result2);
        ?>
                <div class="row">
                    <div class='col-sm-1'><img width='60' height='60' src='<?php echo $img_src; ?>' onerror= 'this.src="./uploads/defaultIcon.png";' /></div><div class="col-sm-3"><a href='profile.php?uname=<?php echo htmlentities($row['user_name']) ?>'> <?php echo htmlentities($row['user_name']) ?> </a><br><span>User Score - <?php echo $row['score']?></span>
                    <br><span>Questions Count - <?php echo $row1[0]?></span><br><span>Answers Count - <?php echo $row2[0]?></span></div> 
                </div>
                <br>
             <?php  
            }
        }     
    ?>
        
    <div class="row">
        <div class="col-sm-7"></div>
        <div class="col-sm-5">
            <ul class="pagination">
                <li><a href="?page=1&qpage=<?php echo $_GET['qpage']; ?>">First</a></li>
                <?php if($_GET['page'] > 1) { ?>
              <li><a href="?page= <?php $inc_page = $_GET['page'] - 1; echo $inc_page ?>&qpage=<?php echo $_GET['qpage']; ?>">Previous</a></li>
                <?php } else { ?>
                <li><a>Previous</a></li>
                <?php } ?>
              <li><a href="?page=<?php echo $_GET['page']; ?>&qpage=<?php echo $_GET['qpage']; ?>"><?php echo $_GET['page']; ?></a></li>
                <?php if($_GET['page'] < $pages) { ?>
              <li><a href="?page= <?php $inc_page = $_GET['page'] + 1; echo $inc_page ?>&qpage=<?php echo $_GET['qpage']; ?>">Next</a></li>
                <?php } else { ?>
                <li><a>Next</a></li>
                <?php } ?>
                <li><a href="?page=<?php echo $pages; ?>&qpage=<?php echo $_GET['qpage']; ?>">Last - <?php echo $pages; ?></a></li>
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
        ?> 
            <a href='display_admin_ques.php?qid=<?php echo $row['qid'] ?>'> <?php echo htmlentities($row['question_title']) ?> </a> 
            <br> 
            <span>Question Value : <?php echo $row['votes']; ?> </span> 
            -- Asked By : <a href='profile.php?uname=<?php echo htmlentities($row['qnd_user']) ?>'> <?php echo htmlentities($row['qnd_user']) ?> </a>
            <br><br> 
        <?php  
            }
        } 
                     
        ?>
        
        <div class="row">
        <div class="col-sm-7"></div>
        <div class="col-sm-5">
            <ul class="pagination">
                <li><a href="?page=<?php echo $_GET['page']; ?>&qpage=1&q=1">First</a></li>
                <?php if($_GET['qpage'] > 1) { ?>
              <li><a href="?page=<?php echo $_GET['page']; ?>&qpage= <?php $inc_page = $_GET['qpage'] - 1; echo $inc_page ?>&q=1">Previous</a></li>
                <?php } else { ?>
                <li><a>Previous</a></li>
                <?php } ?>
              <li><a href="?page=<?php echo $_GET['page']; ?>&qpage=<?php echo $_GET['qpage']; ?>&q=1"><?php echo $_GET['qpage']; ?></a></li>
                <?php if($_GET['qpage'] < $pages) { ?>
              <li><a href="?page=<?php echo $_GET['page']; ?>&qpage= <?php $inc_page = $_GET['qpage'] + 1; echo $inc_page ?>&q=1">Next</a></li>
                <?php } else { ?>
                <li><a>Next</a></li>
                <?php } ?>
                <li><a href="?page=<?php echo $_GET['page']; ?>&qpage=<?php echo $pages?>&q=1">Last - <?php echo $pages; ?></a></li>
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

    </div>
    </div>
</body>
</html>

