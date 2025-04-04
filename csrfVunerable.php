<?php
    require 'DB.php';
    ini_set('display_errors',1);
    session_start();

    $db = new DB;

    $_SESSION['account'] = 12345678;
    $account = $_SESSION['account'];

    $query = $db->connect()->prepare("SELECT balance FROM tblAccounts WHERE account = :account");
    $query->bindParam(':account', $account,PDO::PARAM_INT);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $balance = $row['balance'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $amount = $_POST['amount'];
        $target = $_POST['targetAccount'];

        $originNewBalance = $balance - $amount;

        $query = $db->connect()->prepare("SELECT balance FROM tblAccounts WHERE account = :target");
        $query->bindParam(':target', $target, PDO::PARAM_INT);
        $query->execute();


        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $targetBalance = $row['balance'];
        }

        $targetNewBalance = $targetBalance + $amount;

        $query = $db->connect()->prepare("UPDATE tblAccounts SET balance = :newBalance WHERE account = :account;
                                                 UPDATE tblAccounts SET balance = :targetBalance WHERE account = :target");



        $query->execute(array(':newBalance' => $originNewBalance, ':account' => $account, ':targetBalance' => $targetNewBalance, ':target' => $target));

        header('Location: csrfVunerable.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a transfer</title>
</head>
<body>
    <h2>super secure bank</h2>
    <h2>current balance: £<?= $balance ?></h2>

    <form method="POST">
        <label for="amount">amount to transfer</label><br>
        <input type="text" id="amount" name="amount"><br>
        <label for="targetAccount">payee account</label><br>
        <input type="text" id="targetAccount" name="targetAccount"><br>
        <input type="submit" name="submit" value="transfer">
    </form>
</body>
</html>