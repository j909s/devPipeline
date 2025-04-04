<?php
    //add the checks for whats being entered for card number and whats being entered for the postcode
    //also make sure the text file is secure - dont know if that means ecypting whatever goes in or just deleting everything everytime so that nothing is in the file
    include 'sessionManage.php';
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
            $txt = "Product: \n";
            fwrite($myfile, $txt);
            $txt = $name . "\n";
            fwrite($myfile, $txt);
            $txt = " Price: \n";
            fwrite($myfile, $txt);
            $txt = $price. "\n";
            fwrite($myfile, $txt);
            $txt = " Quantity: \n";
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

            if(empty($cardNum) || empty($postcode))
            {
                $message =  'You must fill out every field in order to complete purchase!';
            }
            elseif(strlen($cardNum) != 16)
            {
                $message =  'Card number is not within length requirements';
            }
            elseif(!is_numeric($cardNum))
            {
                $message= 'something went wrong with card number, please input again';
            }
            elseif(strlen($postcode)< 0 || strlen($postcode) > 8)
            {
                $message = 'postcode is not within length requirements';
            }
            else
            {
                $db = new DB;

                $query = $db->connect()->prepare("INSERT into tblOrder (userID,totalPrice,totalItems,payType,cardNum,postcode,date,orderVal) VALUES ('$userID','$totalPrice','$totalItems','$payType','$cardNum','$postcode','$date','$orderVal') ");
                $query->execute();
    
                
    
    
                header('Location: direct.php');
            }



           
            



            
        
    }


?>

<!DOCTYPE html>
<html lang="en" class="checkout-page">
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
            <tr class="arow">
                <th></th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            
            <?php for($i = 0; $i < count($_SESSION['basket']); $i++): ?>
                <tr>
                    <th><img src="<?=$_SESSION['basket'][$i]['image'] ?>" width="80px" height="80px"></th>
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
            <label for="payType">Payment Method </label>
            <br>
            <select name="payType" id="payType">
                <option value="mastercard">Mastercard</option>
                <option value="visa">Visa</option>
                <option value="amex">American Express</option>
            </select>
            <br><br>
            <label for="cardNum">Card Number </label>
            <br>
            <input type="text" placeholder="Enter Card Number" maxlength="16" id="cardNum" name="cardNum" required>
            <br><br>
            <label for="postcode">Postcode </label>
            <br>
            <input type="text" id="postcode" name="postcode" maxlength="8" placeholder="Please enter postcode" required>
            <br><br>
            <input type="submit" name="pay" value="Complete Purchase" id="complete">
        </form>
        <?php if(isset($message)):?>
            <p><?php echo $message;?></p>
        <?php endif ?>
            <!--on this add a drop down selection for method of pay and include other detials like card number and address, this then send over to the database and when complete make button to go home -->
  

    </body> 

</html>