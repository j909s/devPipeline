<?php
    
    function add($db, $id)
    {
        $query = $db->connect()->query("SELECT * FROM tblProduct WHERE id ='$id'");

        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            if(array_search($id, array_column($_SESSION['basket'],'id')) !== false)
            {
                $key = array_search($id, array_column($_SESSION['basket'],'id'));
                $_SESSION['basket'][$key]['quantity']++;
            }
            else
            {
                $toAdd = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'image' => $row['image'],
                   // 'price' => $row['price'],
                    'quantity' => 1
                );
                $_SESSION['basket'][] = $toAdd;
            }
        }
    }

    function remove($db, $id)
    {
        $query = $db->connect()->query("SELECT * FROM tblProduct WHERE id ='$id'");

        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            if(array_search($id, array_column($_SESSION['basket'],'id')) !== false)
            {
                $key = array_search($id, array_column($_SESSION['basket'],'id'));
                
                if($_SESSION['basket'][$key]['quantity'] != 0)
                {
                    $_SESSION['basket'][$key]['quantity']--;
                }
                else
                {
                    echo 'none in basket';
                }

            }
        }
    }
