<?php
    session_start();
    $page_title = 'Check Out';
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Perfume Store| Customer Login</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<script src="js/ajax_search.js" type="text/javascript"></script>
</head>

<body>
	<div id="page-wrapper">
    	<?php include_once 'html/header.php'; ?>
    	<div class="clear"></div>
       
      	<div id="content-wrapper">
            <div id="contents">
                <?php
                    // Checkout for registed customers ONLY
                    if(!isset($_SESSION['email'])){
                            // Refer to log-in form
                            //header("Location: login.php");
                            echo '<a href="login.php">Click here to login for checkout.</a>';
                    }else{
                        // Ensure whether the cart is empty
                        if(($_SESSION["counter"]) == 0){                
                                echo "Your shopping cart is empty.";
                        }else{
                            echo "<div id=checkout>";
                            // Calculating shipping charge, ONLY charge of $10 for order under $50         
                            $order_total = $_SESSION['order_total'];
                            $minimum = 50;
                            $shipping_charge = 0;
                            if($order_total < $minimum){
                                    $shipping_charge = 10;
                            }
                            $tax = number_format(($order_total/11), 2) ;
                            $grant_total = $order_total + $shipping_charge;
                            // Register grant total for payment purpose.
                            $_SESSION['grant_total'] = $grant_total;

                            echo "<h3>Your order details</h3>"; 
                            echo "<p>Order total: " .$order_total."</p>";
                            echo "<p>Tax inclusive: ($tax)</p>";
                            echo "<p>Shipping<i class=icon-info-sign></i>: $shipping_charge</p>";
                            echo "<h3>Total: $grant_total</h3>";
                            echo "<hr class=style-two>";
                            echo "</div>"; //end div checkout

                            // Include payment form to gathering shipping address and card details
                            include_once 'forms/payment_form.html';
                        }            
                    }
                ?>
            </div><!-- /end contents -->
           
          <div id="sidebar">
          </div>
        </div><!-- end content wrapper -->
        <div class="clear"></div>
        <?php include_once 'html/footer.html'; ?>
    </div>
    
</body>
</html>