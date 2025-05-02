<?php
    include 'sessionManage.php';
    require "DB.php";
    require 'product.php';
    require 'basketFunctions2.php';
    include 'nav.php';


    $db = new DB;

    

    if(!isset($_SESSION['basket']))
    {
        $_SESSION['basket'] = array();
    }

    //if posting
    if(isset($_POST['add']))
    {
        $productID = $_POST['id'];
        add($db,$productID);
        header('location: '.$_SERVER['HTTP_REFERER']);
    }

    if(isset($_POST['remove']))
    {
        $productID = $_POST['id'];
        remove($db, $productID);
        header('location: '.$_SERVER['HTTP_REFERER']);
    }

    if(isset($_POST['clear']))
    {
        clear();
        header('location: '.$_SERVER['HTTP_REFERER']);
    }


    
    if(!isset($_POST['']))
    {
        $conn = $db->connect();
                if(!$conn){
                    echo'database failed to connect';
                }
                else{
                    echo'this is connected';
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
    }

    if(isset($_POST['all']))
    {
        $filter = 'all';
        

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
    }
   
    if(isset($_POST['priceASC']))
    {
        $filter = 'priceASC';
        echo 'price low to high';

        $query = $db->connect()->prepare("SELECT * FROM tblProduct ORDER BY price ASC");
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
    }
    if(isset($_POST['priceDESC']))
    {
        $filter = 'priceDESC';
        echo 'price high to low';

        $query = $db->connect()->prepare("SELECT * FROM tblProduct ORDER BY price DESC");
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
    }
    if(isset($_POST['nameASC']))
    {
        $filter = 'nameASC';
        echo 'name a-z';

        $query = $db->connect()->prepare("SELECT * FROM tblProduct ORDER BY name ASC");
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
    }

    if(isset($_POST['nameDESC']))
    {
        $filter = 'nameDESC';
        echo 'name z-a';

        $query = $db->connect()->prepare("SELECT * FROM tblProduct ORDER BY name DESC");
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
    }

 
    
  
?>

<!DOCTYPE hmtl>
<html class="index-page">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Tyne Brew Home</title>
    </head>
    <body>
    
        <div class="header-index">
            
            <h1>Tyne Brew Ground Coffee</h1>
            
        </div>
            <div class="index-image"><img src="img/coffee.png" alt="main"></div>
            <h2>-Quality products from the comfort of home-</h2>
            <h3>Create your order below</h3>
            <form method="post">
                    <div class="filter">
                        <input type="submit" class="btn" name="all" value="All Products">
                        <input type="submit" class="btn" name="priceASC" value="Price Low-High">
                        <input type="submit" class="btn" name="priceDESC" value="Price High-Low">
                        <input type="submit" class="btn" name="nameASC" value="Name A-Z">
                        <input type="submit" class="btn" name="nameDESC" value="Name Z-A">
                    </div>
                </form>
            <form method="post" class="clear">
                <input type="submit" class="btn" name="clear" value="Clear Basket">
            </form>
            <div class="products">
                <? foreach ($products as $p): ?>
                    <img src="<?= $p->image()?>"  width="260px", height="320px" alt="Light Brew Image">
                    <p>Product Name: <?= $p->name() ?></p>
                    <p>Product Price: <?= $p->price() ?></p>
                    <p>Product Description: <?= $p->description() ?></p>
                    <a href="information.php?productID=<?= $p->productID() ?>"><button class="btn">More Info</button></a>
                    <br>
                    <form class="vals" method="post">
                        <input type="hidden" value="<?=$p->productID() ?>" name="id">
                        
                        <input type="submit" class="btn" name="add" value="Add To Basket" >
                        <input type="submit" class="btn" name="remove" value="Remove from Basket" >
                    </form>
                <? endforeach ?>
            </div>
     

    </body> 
</html>

