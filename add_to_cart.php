<?php
    // Start the session
    session_start();
    
    // Include cart class for shopping cart
    require_once 'lib/cart.php';
    
    // Get item id and qty to add to the cart
    $item_id = $_POST['item_id'];
    $qty = $_POST['qty'];
    
    // Intialise counter, order total and number of items in shopping cart
    if(!isset($_SESSION['counter'])){
        $_SESSION['counter'] = 0;
        // Initialise cart's numbers of item
        $_SESSION['cart_items'] = 0;
        // Initialise order total
        $_SESSION['order_total'] = 0;
    }
    // Retrieve number of items
    $counter = $_SESSION['counter'];  
    
    // Create an empty cart object for add an item to the cart
    $cart = new Cart();
    
    // Cart was created and there are number items
    if($counter > 0){
        $cart = unserialize($_SESSION['cart']);
    }else{
        $_SESSION['cart'] = "";
    }
    
    // Ensure item id and order quantity are valid
    // If valid refer to products page otherwise process and add to cart
    if(($item_id == "") or $qty < 1){
        header("Location: products.php");
        exit();
    }else{
        // Connect to the database
        require_once 'lib/conn_perfumeworld.php';
        
        // Set a query to retrieve product details and add to cart
        $query = "SELECT item_name, price, imagethumb FROM products WHERE (item_id='$item_id')";
        $result = mysqli_query($link, $query) or die("Database error");
        // Add the item to the cart
        if(mysqli_num_rows($result) ==1){            
            $row = mysqli_fetch_array($result);            
            $item_name = $row['item_name'];
            $price = $row['price'];
            $order_total = $price * $qty;
            $image_file = $row['imagethumb'];
            // Add item to the cart
            $new_item = new Item($item_id, $item_name, $qty, $price, $image_file);
            $cart->add_item($new_item);
            
            // Update the counter
            $_SESSION['counter'] = $counter + 1;            
            // Increment number of cart items
            $_SESSION['cart_items'] += $qty;
            $_SESSION['order_total'] += $order_total;
            
            // Convert cart object back to string type
            $_SESSION['cart'] = serialize($cart);
            
            // Refer user to cart page for overview
            header("Location: view_cart.php");
            // Close database connection
            mysqli_close($link);
        }else{
            header("Location: products.php");
            exit();
        }
    }

