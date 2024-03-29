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
            
                <?php if($row['freeze'] == 0) { ?>
                    <button id="frz" class="btn btn-warning" onclick="freeze(1)" type="button">Freeze</button>
                <?php } else if($row['freeze'] == 1) { ?>
                    <button id="frz" class="btn btn-success" onclick="freeze(0)" type="button">UnFreeze</button>
                <?php } ?>
            
                <button class="btn btn-danger" onclick="del()" type="button">Delete</button>
            
                <br><br>
            
                <h4 class='q_title' id="q_title"> <?php echo htmlentities($row['question_title']) ?> </h4>
            
                <input type="text" class="form-control" name = "question_title" id="question_title" placeholder="Example question" style="display:none">

            
                <button id="edit" class="btn btn-primary" onclick="edit_title('q_title')" type="button">Edit</button>
                <button id="save" class="btn btn-primary" onclick="save_title('q_title')" type="button">Save</button>
                
                <br><br>
            
            <?php } ?>
            
                <div class='ques'> <?php echo $row['question']; ?> </div>
            
                <div>Tags : <?php 
                            $pieces = explode(" ", $row['tags']);
                            foreach($pieces as $v){ ?>
                            <a href='tags.php?tag=<?php echo $v ?>'> <?php echo $v." "; ?> </a>
                            
                            <?php }?>
                </div>
                <br>
            
                <button id="edit" class="btn btn-primary" onclick="edit('ques')" type="button">Edit</button>
                <button id="save" class="btn btn-primary" onclick="save('ques')" type="button">Save</button>
                    
        </div>
        
        <script>
            
            function decodeHtml(html) {
                var txt = document.createElement("textarea");
                txt.innerHTML = html;
                return txt.value;
            }
            
            function htmlEntities(str) {
                return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
            }
            
            function edit_title() {
                
                document.getElementById('question_title').style.display = 'block';
                
                document.getElementById('q_title').style.display = 'none';
                
                document.getElementById('question_title').value = decodeHtml(document.getElementById('q_title').innerHTML)
                
            }
            
            function save_title() {
                
                var makrup = document.getElementById('question_title').value
                
                var qid =  "<?php echo $_GET['qid']; ?>";
                
                $.post('./update_question.php', {'question': makrup, "qid": qid, 't_or_d': 0 }, function(response){})
                
                document.getElementById('q_title').style.display = 'block';
                
                document.getElementById('q_title').innerHTML = htmlEntities(makrup)
                
                document.getElementById('question_title').style.display = 'none';
            }
        
            var edit = function(cls) {
              $('.'+cls).summernote({focus: true});
            };

            var save = function(cls) {
              var qid =  "<?php echo $_GET['qid']; ?>";
              var makrup = $('.'+cls).summernote('code');
                if(cls == 'q_title'){
                    $.post('./update_question.php', {'question': makrup, "qid": qid, 't_or_d': 0 }, function(response){})
                }
                else if(cls == 'ques'){
                    $.post('./update_question.php', {'question': makrup, "qid": qid, 't_or_d': 1 }, function(response){})
                }
              $('.'+cls).summernote('destroy');
            };
            
            function freeze(f_type) {
                var qid =  "<?php echo $_GET['qid']; ?>";
                $.post('./freeze_question.php', {"qid": qid, 'f_type': f_type}, function(response){
                    
                    if(f_type == 0) {
                    
                        document.getElementById('frz').setAttribute('class','btn btn-warning')
                        document.getElementById('frz').setAttribute('onclick','freeze(1)')
                        document.getElementById('frz').innerHTML = "Freeze"
                    
                    }
                    else if(f_type == 1) {
                    
                        document.getElementById('frz').setAttribute('class','btn btn-success')
                        document.getElementById('frz').setAttribute('onclick','freeze(0)')
                        document.getElementById('frz').innerHTML = "UnFreeze"
                    
                    }
                })
            }
            
            function del() {
                var qid =  "<?php echo $_GET['qid']; ?>";
                $.post('./delete_question.php', {"qid": qid}, function(response){
                    
                    location.replace("admin.php?page=1&qpage=1");
                })
            }
            
        </script>
    
    </body>

</html>


