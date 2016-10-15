
<!DOCTYPE html>

<html lang="en">
    
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
                if (x == null || x == "") {
                    alert("Name must be filled out");
                    return false;
                }
            }
        </script>
    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
      
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
                echo "Userid entered is : ".$_POST['loginid'];
                echo "Password entered is : ".$_POST['password'];

                $query = "SELECT * FROM users where user_name = '".$_POST['loginid']."' and password = '".$_POST['password']."'";

                if($result = mysqli_query($link, $query))
                {
                    $row = mysqli_fetch_array($result);

                    print_r($row);

                    if($row)
                    {
                        session_start();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['username'] = $_POST['loginid'];
                        header("Location: ask_question.php");
                    }
                }

            }

        ?>
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
      
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
      
  </body>
    
</html>