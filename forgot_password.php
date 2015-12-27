<?php 
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Forgot Password|Perfumeworld.com.au</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<div id="page-wrapper">
    	<?php include_once 'html/header.php'; ?>
    	<div class="clear"></div>
        
        <div id="content-wrapper">
            <div id="contents">
               <?php
			   /*
			   		require_once 'lib/_functions.php';
    
					$email = "";
					$errMsg = "";
					$newPassword = "";
					$pwdLength = 10;
					$valid_email = FALSE; // Pre-set to indicate non-authenticate yet
    
					// Process the form as the user enter email.
					if(isset($_POST['email'])){
						$email = $_POST['email'];
						
						// Check whether email is valid
						if(!(strstr($email, "@")) or !(strstr($email, "."))){
							$errMsg = "In-valid email";
						}else{
							//echo "do something here ....";
							// Connect to the server and connect to the database
							require_once 'lib/conn_perfumeworld.php';
							// Create a query
							$selectQuery = "SELECT * FROM customers WHERE email = '$email'";
							$result = mysqli_query($link, $selectQuery) or die("Could not connect to database");
							// Get customer details
							if(mysqli_num_rows($result) == 1){
								$newPassword = gen_password($pwdLength);
								$valid_email = TRUE;
								mysqli_close($link);
							}else{
								$errMsg = "No email found. Please try again.";
							}    
						}        
					}
			   
					if($valid_email){
						$to = $email;
						$subject = "New Password | PerfumeWorld.com.au";
						$from = "admind@perfumeworld.com.au";
						$message = "";
						//mail($to, $subject, $message);
						
						 echo "<p>Your new password: $newPassword</p>";
					}else{
						echo "<div class=error>$errMsg</div>";
					}
				*/	
						
				?>
               <?php
			   		// Embed the forgot password form
                	include_once 'forms/forgot_password.html'; 
			    ?>
           </div><!-- /end contents -->
           
          <div id="sidebar">
                <h3>Similar Products</h3>
               <div class="product"><img src="img/Amarige-tn.jpg" width="160" height="160" alt=""/><br />Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                    <p class="price">$25.99 <span>Add to Cart</span></p></div>
               <div class="product"><img src="img/Brit-tn.jpg" width="160" height="160" alt=""/><br />Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                    <p class="price">$25.99 <span>Add to Cart</span></p></div>
               <div class="product"><img src="img/BCBGMAXAZRIA-tn.jpg" width="160" height="160" alt=""/><br />Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                    <p class="price">$25.99 <span>Add to Cart</span></p></div>
               <div class="product"><img src="img/IFancyYou-tn.jpg" width="160" height="160" alt=""/><br />Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                    <p class="price">$25.99 <span>Add to Cart</span></p></div>
          </div>
        </div><!-- end content wrapper -->
        <div class="clear"></div>
        <?php include_once 'html/footer.html'; ?>
    </div>
    
</body>
</html>