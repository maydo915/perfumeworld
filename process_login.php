<?php
// Start the new session
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
//$errorMsg = "";

$errMsg = "";
$authenticated = FALSE; // Pre-set to indicate non-authenticate yet

$email = $_POST["email"];
$password = $_POST["password"];
//------------------
if (!(isset ($email)) || !(isset ($password))){
    $errMsg = "Field missing";
}else if(!(strstr($email, "@")) or !(strstr($email, "."))){
    $errMsg = "Invalid email, please try again";
}else{ // Process as all data are valid
    // Connect to the server and connect to the database
    require_once 'lib/conn_perfumeworld.php';
    
    // Using one way hash password and compare it against the record from database
    $password = md5($password);
  
    // Create and issue the query
    $selectQuery = "SELECT firstName, lastName, phone, email, password
        FROM customers WHERE (email = '$email') AND (password = '$password')";
    $result = mysqli_query($link, $selectQuery) or die("Database errors.");

    // Get customer details
    if(mysqli_num_rows($result) == 1){
        $row = $result->fetch_array();
        $customerID = $row['customerID'];
        $first_name = $row['firstName'];
        $last_name = $row['lastName'];
        $phone = $row['phone'];
        $email = $row['email'];     
        // Close database connection
        mysqli_close($link);

        // Save the values in session variables
        $_SESSION["email"] = $email;
        //$_SESSION["customerID"] = $customerID;
        $_SESSION["firstName"] = $first_name;
        $_SESSION["lastName"] = $last_name;
        $_SESSION["phone"] = $phone;
        // Redirect to profile page
        header("Location:profile.php");
        exit();
    }else{
        // Redirect to login page
        // Some app has login.php and login_error for displaying error message
        $errMsg = "Invalid email or password. Please try again";
        //header("Location: login.php");
        //exit();
    }
}
/*------------------------------------------------*/
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Log-in</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<div id="page-wrapper">
    	<?php include_once 'html/header.php'; ?>
    	<div class="clear"></div>
        
        <div id="content-wrapper">
            <div id="contents">
            	<?php 
					if(!$authenticated){ 
						echo "<div class='error'>$errMsg</div>";
						include_once 'forms/login.html';
					}
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
        <?php 
			//include_once 'html/content.php'; 
			
		?> 
        <div class="clear"></div>
        <?php include_once 'html/footer.html'; ?>
    </div>

</body>
</html>
