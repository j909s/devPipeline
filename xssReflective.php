<?php
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XSS Reflective</title>
</head>
<body>
    <h2>XSS Reflective Attack Example</h2>
    <form method="GET">
        <input type="text" placeholder="enter a search term" name="search"><br>
        <input type="submit" name="submit" value="search">
    </form>

    <p>
        <?php if(isset($_GET['submit'])){
            echo "you have searched for " . $_GET['search'];
        }
        ?>
    </p>

</body>
</html>