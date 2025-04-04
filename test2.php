<?php
    include 'sessionManage.php';

    ini_set("display_errors",1);
    require "DB.php";
    require 'order.php';
    include 'nav.php';


    $db = new DB;
    $totalPrice = 0;
    $totalItems = 0;



    foreach($_SESSION['basket'] as $item)
    {
        $totalPrice += $item['price'] * $item['quantity'];
    }

    foreach($_SESSION['basket'] as $item)
    {
        $totalItems += $item['quantity'];
    }

    if(isset($_POST['pay']))

    {
        $myfile = fopen("order.txt", "w") or die("Unable to open file!");
        fclose($myfile);


        for($i = 0; $i < count($_SESSION['basket']); $i++)
        {
           $productID =$_SESSION['basket'][$i]['productID'];
           $name = $_SESSION['basket'][$i]['name'];
           $price = $_SESSION['basket'][$i]['price'];
           $quantity = $_SESSION['basket'][$i]['quantity'];
           
           
            $myfile = fopen("order.txt", "a") or die("Unable to open file!");
            $txt = $productID . "\n";
            fwrite($myfile, $txt);
            $txt = $name . "\n";
            fwrite($myfile, $txt);
            $txt = $price. "\n";
            fwrite($myfile, $txt);
            $txt = $quantity. "\n";
            fwrite($myfile, $txt);
            fclose($myfile);

        }

            $userID = $_SESSION['userID'];
            $payType = $_POST['payType'];
            $cardNum = $_POST['cardNum'];
            $postcode = $_POST['postcode'];
            $date = date("y/m/d");
            $orderVal = file_get_contents('order.txt');

            $db = new DB;

            $query = $db->connect()->prepare("INSERT into tblOrder (userID,totalPrice,totalItems,payType,cardNum,postcode,date,orderVal) VALUES ('$userID','$totalPrice','$totalItems','$payType','$cardNum','$postcode','$date','$orderVal')");
            $query->execute();


            header('location: '.$_SERVER['HTTP_REFERER']);

            
        
    }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tyne View Coffee - Checkout</title>
    </head>
    <body>
        <div class="header">
            <h1>Tyne Brew Ground Coffee - Checkout</h1>
        </div>

        <table>
            <tr>
                <th></th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            
            <?php for($i = 0; $i < count($_SESSION['basket']); $i++): ?>
                <tr>
                    <th><img src="<?=$_SESSION['basket'][$i]['image'] ?>" width="50px" height="50px"></th>
                    <th><?= $_SESSION['basket'][$i]['name'] ?></th>
                    <th>
                        <div>
                            <form method="post">
                                <input type="hidden" value="<?= $_SESSION['basket'][$i]['productID'] ?>" name="id1">
                                <input type="hidden" value="<?= $i ?>" name="id">
                                
                            </form>
                            <?= $_SESSION['basket'][$i]['quantity'] ?>
                            <form method="post">
                                <input type="hidden" value="<?= $_SESSION['basket'][$i]['productID'] ?>" name="id1">
                                <input type="hidden" value="<?= $i ?>" name="id">
                            
                            </form>
                        </div>
                    <h>
                    <th>£<?= $_SESSION['basket'][$i]['price'] * $_SESSION['basket'][$i]['quantity']?></th>
                </tr>
            <?php endfor ?>
            <tr>
                <th></th>
                <th></th>
                <th><p style="text-align: right">Grand Total: </p></th>
                <th>£<?= $totalPrice ?></th>
            </tr>
        </table>  

        <h1>Please fill in details to complete purchase: </h1>
        <form method="post" action="checkout.php" enctype="multipart/form-data">
            <label for="payType">Payment Method: </label>
            <br>
            <select name="payType" id="payType">
                <option value="mastercard">Mastercard</option>
                <option value="visa">Visa</option>
                <option value="amex">American Express</option>
            </select>
            <br><br>
            <label for="cardNum">Card Number: </label>
            <br>
            <input type="text" placeholder="Enter Card Number" id="cardNum" name="cardNum">
            <br><br>
            <label for="postcode">Postcode: </label>
            <br>
            <input type="text" id="postcode" name="postcode" placeholder="Please enter postcode" >
            <br><br>
            <input type="submit" name="pay" value="Complete Purchase">
        </form>
            <!--on this add a drop down selection for method of pay and include other detials like card number and address, this then send over to the database and when complete make button to go home -->
  

    </body> 

</html>