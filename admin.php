<?php
    //this page will let the admin create new products as well as manage others that already exist e.g. change the price
    //admin can also manage user orders - do this by listing customer orders then changing values that exist if they want to edit them

    include 'sessionManage.php';

    require "DB.php";
    require 'adminFunctions.php';
    require 'product.php';
    require 'order.php';
    include 'nav.php';


    $db = new DB;

    if(isset($_POST['removeProduct']))
    {
        $productID = $_POST['id'];
        removeP($db, $productID);
    }

    if(isset($_POST['removeOrder']))
    {
        $OrderID = $_POST['id'];
        removeO($db, $OrderID);
    }

    $query = $db->connect()->prepare("SELECT * FROM tblOrder ");
        $query->execute();
        
        $order= array();

        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $OrderID = $row['OrderID'];
            $userID = $row['userID'];
            $totalPrice = $row['totalPrice'];
            $totalItems = $row['totalItems'];
            $payType = $row['payType'];
            $cardNum = $row['cardNum'];
            $postcode = $row['postcode'];
            $date = $row['date'];
            $orderVal = $row['orderVal'];
            

            $order[] = new Order($OrderID,$userID, $totalPrice,$totalItems, $payType, $cardNum,$postcode, $date,$orderVal);
        } 

        $query = $db->connect()->prepare("SELECT * FROM tblProduct");
        $query->execute();
        
        $products = array();

        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $productID = $row['productID'];
            $name = $row['name'];
            $price = $row['price'];
            $image = $row['image'];
            $description = $row['description'];
            

            $products[] = new Product($productID, $name, $image,$price,$description);
        } 

        
?>

<!DOCTYPE html>
<html lang="en" class="admin-page">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal</title>
</head>
<body>
    <div class="header"><h1>Admin Base</h1></div>
    
    <a href="createProduct.php" class="addProduct">Add new product to shop page</a>
    <h2>Current Products</h2>
    <div class="product">
        <? foreach ($products as $p): ?>
                <img src="<?= $p->image()?>"  width="260px", height="320px" alt="Light Brew Image">
                <p>Product Name: <?= $p->name() ?></p>
                <p>Product Price: <?= $p->price() ?></p>
                <a href="productEdit.php?productID=<?= $p->productID() ?>"><button class="btn">Edit Product Details</button></a>
                <br>
                <form method="post" class="vals">
                    <input type="hidden" value="<?=$p->productID() ?>" name="id">
                    <input type="submit" class="btn" name="removeProduct" value="Remove Product">
                </form>
        <? endforeach ?>
    </div>

    <h2>Customer Orders </h2>
        <div class="orders">
            <? foreach ($order as $o): ?>
                <p>Customer ID: <?= $o->userID() ?></p>
                <p>Total Price: £ <?= $o->totalPrice() ?></p>
                <p>Total Items: <?= $o->totalItems() ?></p>
                <p>Pay Method: <?= $o->payType() ?></p>
                <p>Date of Purchase: <?= $o->date() ?></p>
                <br>
                <a href="orderEdit.php?OrderID=<?= $o->OrderID() ?>"><button class="btn">Edit Order Details</button></a>
                <br>
                <form method="post" class="vals">
                    <input type="hidden" value="<?=$o->OrderID() ?>" name="id">
                    <input type="submit" class="btn" name="removeOrder" value="Remove Order">
                </form>
            <? endforeach ?>
        </div>
       
</body>
</html>