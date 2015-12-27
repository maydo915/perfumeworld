<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Payment by PayPal|Perfumeworld.com.au</title>
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
                            require_once('lib/paypal.class.php');  // include the class file
                            // Re-direct to login page for non-registed customer
                            if(!isset($_SESSION['email'])){
                                    //header("Location: login.php");
                                echo '<a href="login.php">Click here to login for checkout.</a>';
                            }else{
                                    $email = $_SESSION['email'];
                            }

                            if(($_SESSION["counter"]) == 0){                
                                    echo "Your shopping cart is empty.";
                            }else{
                                $p = new paypal_class; 
                                $p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
                                //$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url

                                // setup a variable for this script (ie: 'http://www.micahcarrick.com/paypal.php')
                                $this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

                                // if there is not action variable, set the default action of 'process'
                                if (empty($_GET['action'])) $_GET['action'] = 'process';  

                                switch ($_GET['action']) {
                                    case 'process':      // Process and order...
                                        // Calculating shipping charge - for display to customer ONLY          
                                        $order_total = $_SESSION['order_total'];
                                        $minimum = 50;
                                        $shipping_charge = 0;
                                        if($order_total < $minimum){
                                                $shipping_charge = 10;
                                        }
                                        $grant_total = $order_total + $shipping_charge;
                                        $_SESSION['grant_total'] = $grant_total;
                                        // Add business email address
                                        $biz_email = "perfumeworld_may@gmail.com ";
                                        $p->add_field("business", $biz_email);
                                        $p->add_field('item_name', 'PerfumeWorld - Paypal Test');
                                        // Order total amount
                                        $grant_total_total = $_SESSION['grant_total'];
                                        $p->add_field("amount", $grant_total_total);   
                                        // Australian currency
                                        $p->add_field('currency_code', 'AUD'); 
                                        $p->add_field('return', $this_script.'?action=success');
                                        $p->add_field('cancel_return', $this_script.'?action=cancel');
                                        $p->add_field('notify_url', $this_script.'?action=ipn');
                                        $p->submit_paypal_post(); // submit the fields to paypal
                                        //$p->dump_fields();      // for debugging, output a table of all the fields

                                        break;
                                    case 'success':      // Order was successful...
                                        // This is where you would have the code to
                                        // email an admin, update the database with payment status, activate a
                                        // membership, etc.  
                                        require_once 'lib/cart.php';
                                        require_once('lib/gen_id.php');
                                        // Update the database with payment status
                                        require_once('lib/conn_perfumeworld.php');

                                        $total_price = 0;
                                        $msg = "";
                                        $cart = new Cart();
                                        // Convert cart to the object
                                        $cart = unserialize($_SESSION['cart']);
                                        $depth = $cart->get_depth();
                                        //Generate the order id, with length of 8 digits
                                        $order_id = gen_id(8);

                                        //Use a for loop to Iterate through the cart                
                                        for ($i = 0 ; $i < $depth ; $i++) {
                                            $item = $cart->get_item($i);
                                            $deleted = $item->deleted;
                                            if (!$deleted){
                                                $item_id = $item->get_item_id();
                                                $qty = $item->get_qty();
                                                $price = $item->get_price();
                                                $total_price = $total_price + ($price*$qty);

                                                //Add the record to order_line table
                                                //Create the insert query for the order_line table
                                                $query = "INSERT INTO order_line VALUES('$order_id', '$item_id', '$qty')";
                                                //Run the query using mysql_query()
                                                $result=mysqli_query($link, $query) or die("Database error - Order line");
                                            }
                                        }
                                        //Add the record to order table
                                        //$status = "pending";
                                        $status = "completed";
                                        // Pre-set the timezone
                                        date_default_timezone_set('Australia/Adelaide');
                                        // Get a timestamp
                                        $timestamp = date('D, d/m/Y H:i:s');

                                        //Create the insert query for the order table
                                        // How to get shipping address details ???                
                                        $query = "INSERT INTO orders "
                                                        . "VALUES('$order_id', '$email', '$total_price', '$status', "
                                                        . "'address', 'address2', 'suburb', 'postcode', 'state', "
                                                        . "'$timestamp')";

                                        //echo $query;
                                        //Run the query using mysql_query()
                                        $result=mysqli_query($link, $query) or die("Database error - Orders");
                                        mysqli_close($link);
                                        //Empty the cart
                                        unset($_SESSION["counter"]);
                                        unset($_SESSION['cart']);

                                        echo '<h3>Thank you for your order.</h3>';
                                        echo "<p>Thank you for the order your order number is $order_id <br> "
                                                . "Your order details has been emailed to your $email</p>";
                                        foreach ($_POST as $key => $value) { 
                                           // Customise the information to the user
                                           if($key == "payer_id")
                                                   echo "Payer ID-----: $value<br />";
                                           if($key == "tax")
                                                   echo "Tax: $value<br />";
                                           if($key == "payment_status")
                                                   echo "Payment status: $value";
                                        }
                                        // You could also simply re-direct them to another page, or your own 
                                        // order status page which presents the user with the status of their
                                        // order based on a database

                                        break;
                                    case 'cancel':       // Order was canceled...
                                        // The order was canceled before being completed.

                                        echo "<html><head><title>Canceled</title></head><body><h3>The order was canceled.</h3>";
                                        echo "</body></html>";

                                        break;
                                    case 'ipn':          // Paypal is calling page for IPN validation...
                                        // It's important to remember that paypal calling this script.  There
                                        // is no output here.  This is where you validate the IPN data and if it's
                                        // valid, update your database to signify that the user has payed.  If
                                        // you try and use an echo or printf function here it's not going to do you
                                        // a bit of good.  This is on the "backend".  That is why, by default, the
                                        // class logs all IPN data to a text file.

                                        if ($p->validate_ipn()) {

                                           // Payment has been recieved and IPN is verified.  This is where you
                                           // update your database to activate or process the order, or setup
                                           // the database with the user's order details, email an administrator,
                                           // etc.  You can access a slew of information via the ipn_data() array.


                                           // For this example, we'll just email ourselves ALL the data.
                                           $subject = 'Instant Payment Notification - Recieved Payment';
                                           //$to = 'maydo1275@gmail.com';    //  your email
                                           $to = $email; // customer'e email
                                           $body =  "An instant payment notification was successfully recieved\n";
                                           $body .= "from ".$p->ipn_data['payer_email']." on ".date('m/d/Y');
                                           $body .= " at ".date('g:i A')."\n\nDetails:\n";

                                           foreach ($p->ipn_data as $key => $value) { 
                                                   $body .= "\n$key: $value";                                  
                                           }
                                           mail($to, $subject, $body);
                                        }
                                        break;
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