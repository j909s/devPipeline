<?php
    include 'sessionManage.php';


    require 'DB.php';
    require 'order.php';
    include 'nav.php';

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
        $db = new DB;

        $query = $db->connect()->prepare("SELECT * FROM tblOrder WHERE userID = :userID");
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

        $query = $db->connect()->prepare("SELECT * FROM tblUsers3 WHERE userID = :userID");
        $query->bindParam(':userID',$userID, PDO::PARAM_INT);
        $query->execute();
        
        $user = array();

        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $userID = $row['userID'];
            $email = $row['email'];
            $username = $row['username'];
            $password = $row['password'];
            

            $user[] = new User($userID, $email, $username,$password);
        } 

    }

?>

<!DOCTYPE hmtl>
<html class="account-page">
    <head>
        <title>Account Information</title>
    </head>
    <body>
    <h2>Account Information </h2>
        <? foreach ($user as $u): ?>
            <p>Username: <?= $u->username() ?></p>
            <p>Email: <?= $u->email() ?></p>
            <br>
        <? endforeach ?>

    <h2>Your Orders</h2>
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
    </body>
</html>