<html>
    
    <head>
        
        <?php include 'header.php' ?>
    
    </head>
    
    <body>
        
        <?php include 'config.php'; include 'db_connect.php'; include 'navbar.php'; ?>
        
        <div class="container">
            
            <?php
            
            $query = "SELECT * from questions where qid = ".$_GET['qid'];
            
            if($result = mysqli_query($link, $query)) {
                
                $row = mysqli_fetch_array($result);
                
                ?>
                <h4 class='ques'> <?php echo htmlentities($row['question_title']) ?> </h4> 
            
            <?php } ?>
            
                <div class='ques'> <?php echo $row['question']; ?> </div>
            
            <button id="edit" class="btn btn-primary" onclick="edit()" type="button">Edit</button>
            <button id="save" class="btn btn-primary" onclick="save()" type="button">Save</button>
                    
        </div>
        
        <script>
        
            var edit = function() {
              $('.ques').summernote({focus: true});
            };

            var save = function() {
              var makrup = $('.ques').summernote('code');
              $('.ques').summernote('destroy');
            };
            
        </script>
    
    </body>

</html>


