<?php

    ini_set('display_errors',1);

    require 'DB.php';

    $db = new DB;

    session_start();

    //if posting
    if(isset($_POST['submit']))
    {
        if(isset($_POST['username']) && isset($_POST['password']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $sql = "SELECT username FROM tblUsers214 WHERE username =:username AND password = :password";
            $query = $db->connect()->prepare($sql);
            $query->bindParam(':username',$username, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            
            $query->execute();

            


            if($query->rowCount() > 0)
            {
                $_SESSION['username'] = $username;

                header('Location: sqlInjectSuccess.php');
            }
            else
            {
                echo "incorrect credentials";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post">
        <label for="username">Username</label>
        <br>
        <input type="text" placeholder="Please enter your username" name="username" id="username" >
        <br>
        <label for="password">Password</label>
        <br>
        <input type="password" placeholder="Please enter your password" name="password" id="password">
        <br>
        <input type="submit" name="submit" value="Login">
        <br>
    </form>
</body>
</html>