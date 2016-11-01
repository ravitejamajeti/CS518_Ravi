<html>    
    <head>
    <?php include 'config.php' ?>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        
        <style>
        
body, html {
    height: 100%;
    background:url(bg.jpg),linear-gradient(steelblue,white);
     background-size: 6000px 100px,6000px 500px;
    background-repeat: no-repeat,no-repeat;

}

.login_box{
    background:#f7f7f7;
    border:3px solid #F4F4F4;
    padding-left: 15px;
    margin-bottom:25px;
    }
.input_title{
    color:rgba(164, 164, 164, 0.9);
    padding-left:3px;
        margin-bottom: 2px;
    }

hr{
    width:100%;
}
    
.welcome{
    font-family: "myriad-pro",sans-serif;
    font-style: normal;
    font-weight: 100;
    color:#FFFFFF;
    margin-bottom:25px;
    margin-top:50px;

}

.login_title{
    font-family: "myriad-pro",sans-serif;
    font-style: normal;
    font-weight: 100;
    color:rgba(164, 164, 164, 0.44);
}

.card-container.card {
    max-width: 350px;

}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
    border-radius:0;
    background:#43A6EB;
    height: 55px;
    margin-bottom:10px;
}

/*
 * Card component
 */
.card {
    background-color: #FFFFFF;
    /* just in case there no content*/
    padding: 1px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 15%x;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}

/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;

    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
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
    </head>
    
    <body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <?php
            include 'db_connect.php';
            $invalid = true; 

            if($_POST)
            {
                //echo "Userid entered is : ".$_POST['loginid'];
                //echo "Password entered is : ".$_POST['password'];

                $query = "SELECT * FROM users where user_name = '".mysqli_real_escape_string($link, $_POST['loginid'])."' and password = '".mysqli_real_escape_string($link, $_POST['password'])."'";

                if($result = mysqli_query($link, $query))
                {
                    $row = mysqli_fetch_array($result);

                    //print_r($row);

                    if($row)
                    {
                        $_SESSION['loggedin'] = true;
                        $_SESSION['username'] = $_POST['loginid'];
                        $_SESSION['uid'] = $row['uid'];
                        $user = true;
                        ?> <script> location.replace("index.php"); </script> 
             <?php  }
                }
                $invalid = false;  
            }

?>

    <div class="container">
    <h1 class="welcome text-center">ODU HangOuts</h1>
        <div class="card card-container">
        <h2 class='login_title text-center'>Login</h2>
        <hr>

            <form name="myForm" class="form-signin" method="post" onsubmit="return validateForm()">
                <span id="reauth-email" class="reauth-email"></span>
                <p class="input_title">Email</p>
                <input type="text" id="inputEmail" class="login_box" placeholder="username" name="loginid" required autofocus>
                <p class="input_title">Password</p>
                <input type="password" id="inputPassword" class="login_box" placeholder="******" name="password" required>
                <div id="remember" class="checkbox">
                    <label>
                        
                    </label>
                </div>
                <button class="btn btn-lg btn-primary" type="submit">Login</button>
                <br>
                <?php
                if($invalid == false) {
                    echo "<font color='red'>Invalid username or password</font>";
                }
            ?>
            </form>
        </div>
    </div>
        
    
    </body>
    
    </html>