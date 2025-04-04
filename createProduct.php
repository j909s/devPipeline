
<?php

    require "DB.php";
    include 'nav.php';

    if (isset($_POST['upload'])){

        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['desc'];

        $targetDir = "img/";
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        $type = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $supported = ['image/jpg', 'image/jpeg', 'image/png'];
        

        if(file_exists($targetFile)){
            echo 'file already exists';
            exit() ;
        }

        if($_FILES['image']['size']>3000000 || $_FILES['image']['size']=== 0){
            echo'file size incorrect';
            exit() ;
        }

        if(!in_array(mime_content_type($_FILES['image']['tmp_name']), $supported)){
            echo 'file type not supported';
            exit() ;
        }
        if(!getimagesize($_FILES['image']['tmp_name'])){
            echo 'file is not an image';
            exit() ;
        }
        if(move_uploaded_file($_FILES['image']['tmp_name'],$targetFile)){
            $db = new DB;

            $query = $db->connect()->prepare("INSERT into tblProduct (name,image,price,description) VALUES ('$name','$targetFile','$price','$description')");
            $query->execute();

            header('location: '.$_SERVER['HTTP_REFERER']);
        }
    }

?>

<!DOCTYPE html>
<html lang="en" class="product-add">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
</head>
<body>
    <div class="header"><h1>Add a New Product!</h1></div>
    <p>Fill in all the field to submit a new product</p>
    
    <form method="post" action="createProduct.php" enctype="multipart/form-data">
        <label for="name">Product Name: </label>
        <br>
        <input type="text" placeholder="Enter Product Name" id="name" name="name">
        <br><br>
        <label for="price">Product Price: </label>
        <br>
        <input type="text" placeholder="Enter Product Price" id="price" name="price">
        <br><br>
        <label for="image">Select an Image File</label>
        <br>
        <input type="file" id="image" name="image" accept="image/*">
        <br><br>
        <label for="desc">Product Description: </label>
        <br>
        <input type="text" placeholder="Enter Product Description" id="desc" name="desc">
        <br><br>
        <input type="submit" name="upload" value="Create" id="complete">
    </form>
    
</body>
</html>