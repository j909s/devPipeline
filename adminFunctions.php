<?php

    function removeP($db, $productID)
    {
        $query = $db->connect()->query("DELETE FROM tblProduct WHERE productID ='$productID'");
        $query->execute();
        header('location: '.$_SERVER['HTTP_REFERER']);
    
    }
    function removeO($db, $OrderID)
    {
        $query = $db->connect()->query("DELETE FROM tblOrder WHERE OrderID ='$OrderID'");
        $query->execute();
        header('location: '.$_SERVER['HTTP_REFERER']);
    }



?>