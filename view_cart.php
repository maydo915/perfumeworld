<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>View Cart|PerfumeWorld.com.au</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
</head>

<body>

    <div id="page-wrapper">
    	<?php include_once 'html/header.php'; ?>
    	<div class="clear"></div>
        
        <div id="content-wrapper">
            <div id="contents">
            	<?php
                    // Include cart class for shopping cart activities
                    require_once 'lib/cart.php';

                    // Create an empty cart object
                    $cart = new Cart();

                    // Intialise counter at first time
                    if(!isset($_SESSION['counter'])){
                            $_SESSION['counter'] = 0;
                    }
                    // Get counter from sesstion
                    $counter = $_SESSION['counter'];

                    // Check whether the cart empty or not
                    if($counter == 0){
                        // Notify user to empty shopping cart
                        echo"<h1>My Shopping Cart</h1>";
                        echo"<h3> Your Shopping Cart is empty !!! </h3>";
                        echo"<p><b> <a href=products.php>Continue Shopping</a> </b></p>";
                    }else{                    
                        // Convert string cart to object
                        $cart = unserialize($_SESSION['cart']);

                        // Iterate and display all item details in shopping cart
                        echo"<h1>My Shopping Cart</h1>";
                        echo "<table>";
                        echo"<tr><th>Image</th><th>Item Name</th><th>Quantity</th><th>Update</th><th>Price</th><th>Total</th></tr>";
                        // Get depth of the cart
                        $depth = $cart->get_depth();
                        for($i = 0; $i < $depth; $i++){
                            $item = $cart->get_item($i);
                            $deleted =  $item->deleted; //why deleted to be accessed directly?
                            // Display items if not mark for deletion
                            if(!$deleted){
                                $item_id = $item->get_item_id();
                                $item_name = $item->get_item_name();
                                $qty = $item->get_qty();
                                $price = $item->get_price();

                                $image_path = "image-thumb/" .$item->get_img_file();
                                $total = $item->get_item_cost();
                                // Format total to 2 decimal places
                                $total = number_format($total, 2);

                                echo "<tr><form action=update_cart.php method=POST>";
                                echo "<td class='spaces'><img src=$image_path alt=></a></td>";
                                echo "<td class='spaces'>$item_name</td>";
                                echo "<td><input type=text name=qty id=qty value=$qty /></td>";
                                echo"<td class='spaces'><INPUT  name=update TYPE=submit id=update value=Update></td>";
                                echo "<td class='spaces'>$price</td>";
                                echo "<td class='left'>$total</td>";
                                echo "<input type=hidden name=item_no id=item_no value=" .$i. ">";

                                echo "</tr></form>";
                            }
                        }
                        // Get number of items in shopping cart and order total
                        // Diplay numbers of item and order total
                        $cart_items = $_SESSION['cart_items'];

                        // Calculating shipping charge - for display to customer ONLY          
                        $order_total = $_SESSION['order_total'];
                        $minimum = 50;
                        $shipping_charge = 0;
                        if($order_total < $minimum){
                                $shipping_charge = 10;
                        }

                        $grant_total = $order_total + $shipping_charge;

                        echo"<tr><td colspan=3 class='left'><b>Number of items: <br />Order total: <br />Shipping: <i class='fa fa-info-circle'></i> <br />Total: </br></b></td>"
                        . "<td colspan=3 class='left'><b>$cart_items<br />$order_total<br />$shipping_charge<br />$grant_total<br /></b>";
                        echo "</table>";
                        //echo "</div>"; //end div 'products'

                        // Not update for grant total

                        // Checkout session
                        echo "<div class=checkout>";      
                        echo '<div class="div1">';
                        echo '</div>';
                        echo '<div class="div2">'; 
                        // Refer user for continuing shopping or checkout
                        //echo "<a href=checkout.php>CHECKOUT</a>";
                        echo "<a href=paypal_payment.php>CHECKOUT WITH PALPAL</a>";
                        echo "<b> <a href=products.php>Continue Shopping</a> </b>";
                        echo '</div>';
                        echo "</div>"; //end checkout div
                    }
                ?>
            
            </div><!-- /end contents -->
            <div id="sidebar">
            </div>
        </div>
        
        <div class="clear"></div>
        <?php include_once 'html/footer.html'; ?>
    </div>
</body>
</html>