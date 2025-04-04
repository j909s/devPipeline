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
<html class="register-page">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Tyne Brew Register Page</title>
    </head>
    <body>

        <div class="header-register">
            <h1>Register</h1>
        </div>
        <div class="image-box">
            <img src="img/Picture4.png" alt="logo" >
        </div>
    </body>
    <body>
        <div class="register-box">
            <form method="post">
                <label for="email" class="elabel">Email</label>
                <br>
                <input type="email" placeholder="email" name="email" class="email"><br>
                <label for="username" class="ulabel">Username</label>
                <br>
                <input type="text" placeholder="username" name="username" class="username"><br>
                <label for="password" class="plabel">Password</label>
                <br>
                <input type="password" placeholder="password" name="password" class="password"><br>
                <label for="cpassword" class="clabel">Confirm Password</label>
                <br>
                <input type="password" placeholder="confirm password" name="cpassword" class="confirm"><br>
                <input type="submit" value="sign-up" name="register" class="register"><br>
                <a href="login.php">Already have an account? Click here to log in!</a>
                
            </form>
        </div>

        <?php

            if(isset($_POST['register'])){
                //set post variables
                $email = $_POST['email'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $cpassword = $_POST['cpassword'];

                if(empty($email) || empty($username) || empty($password) || empty($cpassword)){
                    echo 'You must fill in every field to register!!';
                    die();
                }

                if($password != $cpassword){
                    echo'one or more fields are incorrect';
                    die();
                }
                
                if(strlen($email) < 5 || strlen($email) > 50){
                    echo'Your email does not fit the length requirements';
                    die();
                }
                
                if(strlen($username) < 3 || strlen($username) > 12){
                    echo'Your username does not fit the length requirements';
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

                if(!preg_match("/^[a-zA-Z0-9_]*$/", $username)){
                    echo'invalid username';
                    die();
                }

                $conn = $db->connect();
                if(!$conn){
                    echo'database failed to connect';
                }

                $emailQry = $conn->prepare("SELECT * FROM tblUsers3 WHERE email = :email OR username = :username");
                $emailQry->bindParam(':email', $email, PDO::PARAM_STR);
                $emailQry->bindParam(':username', $username, PDO::PARAM_STR);
                $emailQry->execute();

                if($emailQry->rowCount() > 0){
                    echo'email/username already in use';
                    die();
                }
                else{
                    $encryptedPass = password_hash($password, PASSWORD_DEFAULT);
                    $uuid = generateUUID();
                    $insertQry = $conn->prepare("INSERT INTO tblUsers3 (email, username, password, UUID) VALUES (:email, :username, :password, :uuid)");
                    $insertQry->bindParam(":email", $email, PDO::PARAM_STR);
                    $insertQry->bindParam(":username", $username, PDO::PARAM_STR);
                    $insertQry->bindParam(":password", $encryptedPass, PDO::PARAM_STR);
                    $insertQry->bindParam(":uuid", $uuid, PDO::PARAM_STR);

                    $insertQry->execute();

                    if($insertQry){
                        echo'account created successfully!';
                        header('Location: login.php');
                    }

                }



            }

            function generateUUID(){
                return time() . bin2hex(random_bytes(8));
            }

        ?>
    </body>
</html>
