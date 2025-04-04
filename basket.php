<?php
    include 'sessionManage.php';
    require "DB.php";
    require 'basketFunctions2.php';
    include 'nav.php';


    $db = new DB;
    $totalPrice = 0;


    if(isset($_POST['increment']))
    {
        $productID = $_POST['id1'];
        add($db,$productID);
        header('location: '.$_SERVER['HTTP_REFERER']);
    }

    if(isset($_POST['decrement']))
    {
        $productID = $_POST['id1'];
        remove($db, $productID);
        header('location: '.$_SERVER['HTTP_REFERER']);
    }


    foreach($_SESSION['basket'] as $item)
    {
        $totalPrice += $item['price'] * $item['quantity'];

    }



?>

<!DOCTYPE html>
<html lang="en" class="basket-page">
    <head>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tyne View Coffee - Your Basket</title>
    </head>
    <body>
        <div class="header">
            <h1>Tyne Brew Ground Coffee - Basket</h1>
            <h2>Review your basket before paying - to pay double press checkout button at bottom</h2>
        </div>
       
    <?php if(!isset($_SESSION['basket']) || empty($_SESSION['basket'])): ?>
        <h2>Your basket is empty</h2>
    <?php else: ?>
        <table>
            <tr class="arow">
                <th></th>
                <th class="irow">Item</th>
                <th class="qrow">Quantity</th>
                <th class="prow">Price</th>
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
                                <input type="submit" value="+" name="increment" id="increment">
                            </form>
                            <?= $_SESSION['basket'][$i]['quantity'] ?>
                            <form method="post">
                                <input type="hidden" value="<?= $_SESSION['basket'][$i]['productID'] ?>" name="id1">
                                <input type="hidden" value="<?= $i ?>" name="id">
                                <input type="submit" value="-" name="decrement" id="decrement">
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
    <?php endif ?>
    
    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Tyne View Coffee - Checkout</h2>
            </div>
            <div class="modal-body">   
                <?php if(!isset($_SESSION['basket']) or empty($_SESSION['basket'])): ?>
                    <p>Your basket is empty!!</p>
                    <p>Pick some items and add to basket in order to checkout</p>
                <?php elseif(isset($_SESSION['loggedin'])):?>
                    <p>Make sure all desired items are in the basket before checking out!</p>
                    <button id="redirect" onclick="window.location.href='checkout.php'">Continue to Checkout</button>
                <?php else: ?>
                    <p>An account is required in order to continue</p>
                    <p>Please log in or create an account using the links below</p>
                    <button id="redirect" onclick="window.location.href='login.php'">Login</button>
                    <button id="redirect" onclick="window.location.href='regsiter.php'">Register</button>
                <?php endif ?>
                <button id="closebtn">Close</button>
            </div>
        </div>
    </div>
    <button id="checkout" onclick="popfunction()">checkout</button>
    <script>  
            function popfunction()
            {
                var modal = document.getElementById("modal");
                var btn = document.getElementById("checkout");
                var span = document.getElementsByClassName("close")[0];
                var close = document.getElementById("closebtn");

                btn.onclick = function(){
                    modal.style.display = "block";
                }
                span.onclick = function(){
                    modal.style.display = "none";
                }
                close.onclick = function(){
                    modal.style.display = "none";
                }
                window.onclick = function(event){
                    if(event.target == modal){
                        modal.style.display = "none";
                    }
                }
            }

        </script>

        

    </body> 

</html>