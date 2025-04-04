<?php
    //<ng</b>:  Undefined array key 2 in <b>/home/storage/927/4182927/user/htdocs/jsmith/cmp214/productEdit.php</b> on line <b>61</b><br />
    session_start();

    require "DB.php";
    require 'product.php';
    include 'nav.php';

    $db = new DB;
    

    if(!isset($_GET['productID'])|| !is_numeric($_GET['productID']))
    {
        header('Location: admin.php');
    }
    else
    {
        $productID = $_GET['productID'];
        $query= $db->connect()->prepare("SELECT * FROM tblProduct WHERE productID = '$productID' LIMIT 1");
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            if(!empty($name) || !empty($price))
            {
                $query= $db->connect()->prepare("UPDATE tblProduct SET name = '$name', price = '$price', description = '$description' WHERE productID = '$productID'");
                $query->execute();
                header('location: admin.php');
            }
        }
        
        
    }


?>

<!DOCTYPE html>
<html lang="en" class="product-edit">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <div class="header"><h1>Edit Product Form:</h1></div>

<p>Edit and fill in all fields to complete form update!</p>
    <form method="post" action=<?php echo $_SERVER['PHP_SELF'] . "?productID=" . $productID;?> enctype="multipart/form-data">
        <label for="name">Product Name: </label>
        <br>
        <input type="text" value="<?php echo $row['name']?>" id="name" name="name">
        <br><br>
        <label for="price">Product Price: </label>
        <br>
        <input type="text" value="<?php echo $row['price']?>" id="price" name="price">
        <br><br>
        <label for="desc">Product Details: </label>
        <br>
        <input type="text" value="<?php echo $row['description']?>" id="desc" name="desc">
        <br><br>
        <input type="submit" name="update" value="Update" id="complete">
    </form>
</body>
</html>