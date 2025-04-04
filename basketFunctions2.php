<?php
    
    function add($db, $productID)
    {
        $query = $db->connect()->query("SELECT * FROM tblProduct WHERE productID ='$productID'");

        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            if(array_search($productID, array_column($_SESSION['basket'],'productID')) !== false)
            {
                $key = array_search($productID, array_column($_SESSION['basket'],'productID'));
                $_SESSION['basket'][$key]['quantity']++;
                
            }
            else
            {
                $toAdd = array(
                    'productID' => $row['productID'],
                    'name' => $row['name'],
                    'image' => $row['image'],
                    'price' => $row['price'],
                    'quantity' => 1
                );
                $_SESSION['basket'][] = $toAdd;
            }
            
        }
    }

    function remove($db, $productID)
    {
        $query = $db->connect()->query("SELECT * FROM tblProduct WHERE productID ='$productID'");

        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            if(array_search($productID, array_column($_SESSION['basket'],'productID')) !== false)
            {
                $key = array_search($productID, array_column($_SESSION['basket'],'productID'));
                
                if($_SESSION['basket'][$key]['quantity'] == 1)
                {
                    
                    array_splice($_SESSION['basket'],$key,1);
                    
                }
                else
                {
                    $_SESSION['basket'][$key]['quantity']--;
                }

            }
        }
    }
    
    function clear()
    {
        $size = sizeof($_SESSION['basket']);
        array_splice($_SESSION['basket'],0,$size);
    }
