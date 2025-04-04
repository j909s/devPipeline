<?php
include 'sessionManage.php';

//$conn = new PDO("mysql:host=mysql-200-130.mysql.prositehosting.net;dbname=jsmith","jsmith","Password20*");
require "DB.php";
require 'product.php';
require 'basketFunctions.php';
require 'nav.php';

$db = new DB;

?>

<!DOCTYPE hmtl>
<html class="login-page">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Tyne Brew Login Page</title>
    </head>
    <body>
      
        <div class="header-login">
            <h1>Login</h1>
        </div>
        <div class="image-box">
            <img src="img/logo3.png" alt="logo" style="size:50px 50px; " >
        </div>
            
    </body>
    <body>
        <div class="login-box">
            <form method="post">
                <label for="email" class="elabel">Email</label>
                <br>
                
                <input type="email" placeholder="email" name="email" class="email"><br>
                <label for="password" class="plabel">Password</label>
                <br>
                
                <input type="password" placeholder="password" name="password" class="password"><br>
                <input type="submit" value="login" name="login" class="login"><br>
                <a href="register.php">Don't Have an account? Click here to make one!!</a>
            </form>
        </div>
        <?php

            if(isset($_POST['login'])){
                //set post variables
                $email = $_POST['email'];
                $password = $_POST['password'];
    

                if(empty($email) || empty($password)){
                    echo 'You must fill in every field to register!!';
                    die();
                }

                if(strlen($email) < 5 || strlen($email) > 50){
                    echo'Your email does not fit the length requirements';
                    die();
                }
                

                if(strlen($password) < 3 || strlen($password) > 100){
                    echo'Your password does not fit the length requirements';
                    die();
                }

                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    echo'invalid email address!';
                    die();
                }



                $conn = $db->connect();
                if(!$conn){
                    echo'database failed to connect';
                }

                $emailQry = $conn->prepare("SELECT * FROM tblUsers3 WHERE email = :email");
                $emailQry->bindParam(':email', $email, PDO::PARAM_STR);
                $emailQry->execute();

                if($emailQry->rowCount() > 0){
                    $result = $emailQry->fetch(PDO::FETCH_ASSOC);
                    if(password_verify($password, $result['password'])){
                        echo'login success';
                        if($result['admin']==1)
                        {
                            $_SESSION['admin'] = true;
                            $_SESSION['loggedin'] = true;
                            $_SESSION['userID'] = $result['userID'];
                            header('Location: index.php');
                            exit();
                        }else{
                            
                            $_SESSION['loggedin'] = true;
                            $_SESSION['userID'] = $result['userID'];
                            header('Location: index.php');
                            exit();
                        }
                        
                    }
                    else{
                        
                        echo'login failed';
                        $_SESSION['loggedin'] = false;

                    }
                }else{
                    echo'login failed 1';
                }



            



            }

        ?>
    </body>
</html>