<?php
    

    if($_SERVER['REQUEST_URI'] == "/Development/cmp214/nav.php")
    {
        header('Location: index.php');
    }
    $activePage = basename($_SERVER['PHP_SELF'], ".php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <nav>
        <div class="topnav">
            <ul>
                <li><a class="<?= ($activePage == 'index') ? 'active' : '' ?>" href="index.php">Home</a></li>
                <li><a class="<?= ($activePage == 'basket') ? 'active' : '' ?>" href="basket.php">
                    <div class="itemgroup">
                        <img src="img/basket.png" id="basketIcon"/>
                        <?php 
                            $itemCount =  0;
                            $totalPrice = 0;

                            foreach($_SESSION['basket'] as $item)
                            {
                                $itemCount += $item['quantity'];
                                $totalPrice += $item['quantity'] * $item['price'];
                            }
                        ?>
                        Items: <?= $itemCount ?> || £<?= number_format($totalPrice,2)?>
                    </div>

                </a></li>
                <?php if($_SESSION['loggedin'] ): ?>
                    <li style="float:right"><a href="logout.php">Sign Out</a></li>
                    <li style="float:right"><a class="<?= ($activePage == 'account') ? 'active' : '' ?>" href="account.php">Your Account</a></li>
                    <?php if($_SESSION['admin']==true):?>
                        <li style="float:right"><a class="<?= ($activePage == 'admin') ? 'active' : '' ?>" href="admin.php">Admin Page</a></li>
                    <?php endif; ?>
                <?php else: ?>
                    <li style="float:right"><a class="<?= ($activePage == 'register') ? 'active' : '' ?>"  href="register.php">Sign Up</a></li>
                    <li style="float:right"><a class="<?= ($activePage == 'login') ? 'active' : '' ?>"  href="login.php">Log In</a></li>
                <?php endif; ?>
                
            </ul>

        </div>
    </nav>
</body>
</html>