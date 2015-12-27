<?php

    // Start the session
    session_start();

    // Include cart class for shopping cart
    require_once 'lib/cart.php';

    // Get item number to remove from the cart
    $item_no = $_POST['item_no'];
    $new_qty = $_POST['qty'];
	
     // Process removing if item number is valid
    if($item_no != null){
        // Get counter value relating to the cart
        $counter = $_SESSION['counter'];
        // Create an empty object for cart
        $cart = new Cart();
        // Convert cart string to object
        $cart = unserialize($_SESSION['cart']);
        $item = $cart->get_item($item_no);
        $old_qty = $item->get_qty();
        $price = $item->get_price();

        // Check whether new order can not be zero, otherwise delete an item
        if($new_qty > 0){   
            // Update number of items in cart
            $_SESSION['cart_items'] = ($_SESSION['cart_items'] - $old_qty) + $new_qty;
            $old_cost = $price * $old_qty;
            $new_cost = $price * $new_qty;
            // Update order total
            $_SESSION['order_total']  = ($_SESSION['order_total'] - $old_cost) + $new_cost;                        
        }elseif($new_qty == 0) {
            // Delete selected item from the cart
            $cart->delete_item($item_no);
            // Update the counter
            $_SESSION['counter'] = $counter -1 ;
            // Update cart number of items
            //$_SESSION['cart_items'] = $_SESSION['cart_items'] - $new_qty;
			 $_SESSION['cart_items'] = $_SESSION['cart_items'] - $old_qty;
            // Update order total
            $order_total = $item->get_item_cost();
            $_SESSION['order_total'] -= $order_total;
        }else{
            // Refer user to cart page for overview
            header("Location: view_cart.php");
            exit();
        }
        // Update quantity order 
        $item->set_qty($new_qty);  
        // Convert cart object back to string
        $_SESSION['cart'] = serialize($cart);
        
        // Refer user to cart page for overview
        header("Location: view_cart.php");
        exit();
    }
