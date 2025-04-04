<?php

include 'sessionManage.php';

    if($_SESSION['loggedin'] || $_SESSION['admin']) {
        unset($_SESSION['admin']);
        unset($_SESSION['loggedin']);
        unset($_SESSION['lastOrderID']);
        unset($_SESSION['basket']);
        header('Location: index.php');
    }
    elseif($_SESSION['loggedin']){
        unset($_SESSION['loggedin']);
        unset($_SESSION['lastOrderID']);
        unset($_SESSION['basket']);
        header('Location: index.php');
    }
    else{
        echo 'error';
    }

?>