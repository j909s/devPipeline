<?php
    
    include 'sessionManage.php';

    require "DB.php";
    require 'order.php';
    include 'nav.php';

    $db = new DB;
    

    if(!isset($_GET['OrderID'])|| !is_numeric($_GET['OrderID']))
    {
        header('Location: admin.php');
    }
    else
    {
        $OrderID = $_GET['OrderID'];
        $query= $db->connect()->prepare("SELECT * FROM tblOrder WHERE OrderID = :OrderID LIMIT 1");
        $query->bindParam(':OrderID',$OrderID, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $payType = $_POST['payType'];
            $cardNum = $_POST['cardNum'];
            $postcode = $_POST['postcode'];

            if(!empty($payType) || !empty($cardNum)|| !empty($postcode))
            {
                $query= $db->connect()->prepare("UPDATE tblOrder SET payType = :payType, cardNum = :cardNum, postcode = :postcode WHERE OrderID = :OrderID");
                $query->bindParam(':payType',$payType, PDO::PARAM_STR);
                $query->bindParam(':cardNum',$cardNum, PDO::PARAM_INT);
                $query->bindParam(':postcode',$postcode, PDO::PARAM_STR);
                $query->bindParam(':OrderID',$OrderID, PDO::PARAM_INT);
                $query->execute();
                header('location: admin.php');
            }
        }
        
        
    }


?>

<!DOCTYPE html>
<html lang="en" class="order-edit">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
</head>
<body>
    <div class="header"><h1>Update Order Form: </h1></div>

<p>please note that only payment and delivery information can be changed</p>
        <form method="post" action=<?php echo $_SERVER['PHP_SELF'] . "?OrderID=" . $OrderID;?> enctype="multipart/form-data">
            <label for="payType">Payment Method: </label>
            <br>
            <input type="text" name="payType" id="payType" value="<?php echo $row['payType']?>">
            <br><br>
            <label for="cardNum">Card Number: </label>
            <br>
            <input type="text" value="<?php echo $row['cardNum']?>" id="cardNum" name="cardNum">
            <br><br>
            <label for="postcode">Postcode: </label>
            <br>
            <input type="text" id="postcode" name="postcode" value="<?php echo $row['postcode']?>" >
            <br><br>
            <input type="submit" name="update" value="Update Information" id="complete">
        </form>
</body>
</html>