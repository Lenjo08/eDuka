<?php
    if(isset($_GET['list'])){
        extract($_GET);
        $wished_query = "SELECT * FROM wishlist WHERE user = '$user' AND product = '$product'";
        $wished_result = mysqli_query($db, $wished_query) or die(mysqli_error());
        $wished_count = mysqli_num_rows($wished_result);
        if ($list=="wishlist"){
            if ($wished_count == 0) {$wish_query = "INSERT INTO wishlist VALUES(NULL, '$user', '$product')"; $x = "added to";}
            else {$wish_query = "DELETE FROM wishlist WHERE user = '$user' AND product = '$product'"; $x = "removed from";}
            mysqli_query($db, $wish_query);
            $error = "<script> alert('Success! Item $x wishlist.');</script>";
            $_SESSION['wishlist_error'] = $error;
        } elseif ($list=="cart") {
            $carted_query = "SELECT * FROM cart WHERE user = '$user' AND product = '$product'";
            $carted_result = mysqli_query($db, $carted_query);
            $carted_count = mysqli_num_rows($carted_result);
            $carted_row = mysqli_fetch_row($carted_result);
            if(!isset($action)){
                if ($carted_count == 0) {$cart_query = "INSERT INTO cart VALUES(NULL, '$user', '$product', 1)"; $x = "added to";}
                else {$cart_query = "DELETE FROM cart WHERE user = '$user' AND product = '$product'"; $x = "removed from";}
                mysqli_query($db, $cart_query);   
                $error = "<script> alert('Success! Item $x cart.');</script>";
                $_SESSION['wishlist_error'] = $error;
            } else {
                switch ($action){
                    case "inc": $quantity = ++$carted_row[3]; break;
                    case "dec": $quantity = --$carted_row[3]; break;
                    default: echo "<script> alert('Error while tring to increase quantity'); </script>";
                }
                $quantity_query = "UPDATE cart SET quantity = $quantity WHERE user = '$user' AND product = '$product'";
                mysqli_query($db, $quantity_query);
            }
        }
    }