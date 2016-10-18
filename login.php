
<!DOCTYPE html>

<html lang="en">
    
    <?php include 'config.php'; ?>
    
    <head>
      
        <meta charset="utf-8">      
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">      
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        
        <style>

            .containerlogin {
                width: 400px;
                height: 222px;
                border: 5px solid grey;
                border-radius: 5%;
            }
    
        </style>
               
        <script>
            function validateForm() {
                var x = document.forms["myForm"]["loginid"].value;
                x = x.trim()
                if (x == null || x == "" || x == " ") {
                    alert("Login must be filled out");
                    return false;
                }
                
                x = document.forms["myForm"]["password"].value;
                x = x.trim()
                if (x == null || x == "" || x == " ") {
                    alert("Password must be filled out");
                    return false;
                }
            }
        </script>
    
        <?php include 'header.php' ?>
      
    </head>
    
    <body>
        
        <div class="containerlogin">
      
            <form name="myForm" method="post" onsubmit="return validateForm()">

                <div class="form-group">
                
                    <label for="formGroupExampleInput">UserName</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Username" name="loginid">
                </div>
  
                <div class="form-group">
                    <label for="formGroupExampleInput2">Password</label>
                    <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="Password" name="password">
                </div>
    
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
      
        </div>
      
        <?php

            include 'db_connect.php';
            

            if($_POST)
            {
                //echo "Userid entered is : ".$_POST['loginid'];
                //echo "Password entered is : ".$_POST['password'];

                $query = "SELECT * FROM users where user_name = '".mysqli_real_escape_string($link, $_POST['loginid'])."' and password = '".mysqli_real_escape_string($link, $_POST['password'])."'";

                if($result = mysqli_query($link, $query))
                {
                    $row = mysqli_fetch_array($result);

                    print_r($row);

                    if($row)
                    {
                        $_SESSION['loggedin'] = true;
                        $_SESSION['username'] = $_POST['loginid'];
                        $user = true;
                        header("Location: ask_question.php");
                    }
                }
                echo "Invalid username or password";  
            }

        ?>
      
  </body>
    
</html>