<?php
    require 'DB.php';

    $db = new DB;

    if(isset($_POST['submit']))
    {
        $query = $db->connect()->prepare("INSERT INTO tblXssComments (comment) VALUES (:comment)");
        $query->bindParam(":comment", $_POST['comment'],PDO::PARAM_STR);
        $query->execute();
    }

    $commments = array();
    $query = $db->connect()->query("SELECT * FROM tblXssComments");
    while($row = $query->fetch(PDO::FETCH_ASSOC))
    {
        $comments[] = $row['comment'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XSS stored</title>
</head>
<body>
    <h2>XSS stored Demo</h2>
    <form method="POST">
        <input type="text" placeholder="enter comment" name="comment">
        <input type="submit" name="submit" value="submit">
    </form>
    
    <?php foreach($comments as $comment): ?>
        <?= $comment ?>
        <br>

    <?php endforeach ?>
</body>
</html>