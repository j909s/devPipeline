<?php
    include 'sessionManage.php';


    require 'DB.php';
    require 'product.php';
    include 'nav.php';

    if (isset($_GET['productID'])) {
        $productID = $_GET['productID'];

        $db = new DB;

        $query = $db->connect()->prepare("SELECT * FROM tblProduct WHERE productID = :productID");
        $query->bindParam(':productID',$productID, PDO::PARAM_INT);
        $query->execute();

        $product = array();

        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $productID = $row['productID'];
            $name = $row['name'];
            $image = $row['image'];
            $price = $row['price'];
            $description = $row['description'];

            $product = new Product($productID, $name, $image, $price,$description);
        } 
    }

?>

<!DOCTYPE hmtl>
<html class="information-page">
    <head>
        <title>Information</title>
    </head>
    <body>
        <div class="header"><h1>Information about <?= $product->name() ?></h1></div>
        
        <img src="<?= $product->image()?>"  width="260px", height="320px" alt="Light Brew Image">
        <p>Product Name: <?= $product->name() ?></p>
        <p>Price: <?= $product->price() ?></p>
        <p>Description: <?= $product->description() ?></p>
        <br>
        <a href="index.php"><button class="btn">Return to Home Page</button></a>
    </body>
</html>