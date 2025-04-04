<?php
  
    include 'sessionManage.php';


    require 'DB.php';
    require 'order.php';
    include 'nav.php';

    $db = new DB;

    $query= $db->connect()->prepare("SELECT * FROM tblOrder ORDER BY OrderID DESC limit 1");
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

            foreach($order as $o)
            {
                $_SESSION['lastOrderID'] = $o->OrderID();
            }


    if (isset($_SESSION['userID']) && isset($_SESSION['lastOrderID'])) 
    {
        $userID = $_SESSION['userID'];
        $OrderID = $_SESSION['lastOrderID'];
        

        $query = $db->connect()->prepare("SELECT * FROM tblOrder WHERE userID = :userID AND OrderID = :OrderID");
        $query->bindParam(':OrderID',$OrderID, PDO::PARAM_INT);
        $query->bindParam(':userID',$userID, PDO::PARAM_INT);
        $query->execute();

        $order = array();


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
    }
?>


<!DOCTYPE html>
<html lang="en" class="direct-page">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>direct</title>
</head>
<body>
    <div class="header"><h1>Order Complete!!!</h1></div>
    

    <h2>Order Summary</h2>
    <div class="ticket">
        <? foreach ($order as $o): ?>
                <p class="orderNum">Order Number: <?= $o->OrderID() ?></p>
                <p>Your Order: <?= $o->orderVal() ?></p>
                <p>Total Price: £ <?= $o->totalPrice() ?></p>
                <p>Total Items: <?= $o->totalItems() ?></p>
                <p>Pay Method: <?= $o->payType() ?></p>
                <p>Date of Purchase: <?= $o->date() ?></p>
                <br>
        <? endforeach ?>
    </div>
    <p>to view all orders check your account from the home page</p>
    <p>note after being redirected you will be required to login again!</p>

    <a href="logout.php" class="continue">Continue</a>
</body>
</html>