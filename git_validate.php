<?php
include("db_connect.php");

if(isset($_GET['code']))
    {
        
            $code = $_GET['code'];
            $post = http_build_query(array(
                'client_id' => '453aef7beb615c7cef32',
                'redirect_url' => 'http://localhost/web/index.php',
                'client_secret' => '542e8db4b1ce0c9803e0e6ab2f0e6a0b03bdaf41',
                'code' => $code,
            ));
            
            $context = stream_context_create(
                array(
                    "http" => array(
                        "method" => "POST",
                        'header'=> "Content-type: application/x-www-form-urlencoded\r\n" .
                                    "Content-Length: ". strlen($post) . "\r\n".
                                    "Accept: application/json" ,  
                        "content" => $post,
                    )
                )
            );

            $json_data = file_get_contents("https://github.com/login/oauth/access_token", false, $context);
            $r = json_decode($json_data , true);
            $access_token = $r['access_token'];
            $scope = $r['scope']; 

            /*- Get User Details -*/
            $url = "https://api.github.com/user?access_token=".$access_token."";
            $options  = array('http' => array('user_agent'=> $_SERVER['HTTP_USER_AGENT']));
            $context  = stream_context_create($options);
            $data = file_get_contents($url, false, $context); 
            $user_data  = json_decode($data, true);
        
            $username1 = $user_data['login'];
            echo $username1;
    
            /*- Get User e-mail Details -*/                
            $url = "https://api.github.com/user/emails?access_token=".$access_token."";
            $options  = array('http' => array('user_agent'=> $_SERVER['HTTP_USER_AGENT']));
            $context  = stream_context_create($options);
            $emails =  file_get_contents($url, false, $context);
            $email_data = json_decode($emails, true);
            $email_id = $email_data[0]['email'];
            $email_primary = $email_data[0]['primary'];
            $email_verified = $email_data[0]['verified'];
    
            $query = mysqli_query($link,"SELECT * FROM users WHERE user_name = '$username1' limit 1");  
            
            
            if(mysqli_num_rows($query)==1)
            {
                //echo "hello";
                session_start();
                
                $data=mysqli_fetch_array($query,1);
                
                $_SESSION["username"]=$username1;
                $_SESSION['loggedin'] = true;
                $_SESSION['uid'] = $data['uid'];
                $_SESSION['role'] = $data['role'];
                $_SESSION["gitvar"]=$data["git_user"];
                
                header("Location: index.php");

            }
            else
            {
            $query1= "INSERT INTO users (user_name, email, password, git_user, country) VALUES ('$username1','$email_id','password123',1,'India')";
                $result = mysqli_query($link,$query1);
                $query2 = mysqli_query($link,"SELECT * FROM users WHERE user_name = '$username1' limit 1");
               
                if(mysqli_num_rows($query2)==1)
                {
                    session_start();
                
                    $data1=mysqli_fetch_array($query2,1);

                    $_SESSION["username"]=$username1;
                    $_SESSION['loggedin'] = true;
                    $_SESSION["uid"]=$data1["uid"];
                    $_SESSION["role"]=$data1["role"];
                    $_SESSION["gitvar"]=$data1["git_user"];
                    
                    header("Location: index.php");
                }
                else 
                {
                    echo "fail";
                    echo mysqli_error($link);
                }  
            }
}  
            
?>