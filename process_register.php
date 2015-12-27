<?php
	session_start();
	
	/*
	*** This section of codes are written here because of avoiding header command issue
	*/
	
	//Capture the user inputs from the form
	$first_name=$_POST['firstName']; //Read first name from the form
	$last_name=$_POST['lastName']; //Read last name from the form
	$email = $_POST['email']; //Read email from the form
	$phone = $_POST['phone']; //Read tel. no. from the form
	$password = $_POST['password']; //Read password from the form
	$confirmPassword = $_POST['confirmPassword']; //Read re-password from the form
	$errorMsg = "";
	$authenticate = FALSE;
	$message = "";
	$captcha;

	//Validate user inputs
	// Ensure no blanks fields.
	if (($first_name == "") or ($last_name == "") or ($email == "")or ($password == "")){	
		//Error message to the user
		$errorMsg = "Please fill all the fields in the form";
	}
	// Check email in right format
	if  (!(strstr($email, "@")) or !(strstr($email, "."))){
		//Error message to the user
		$errorMsg = "Please re-type email, invalid email format";
	}
	// Compare password and confirm-password are the same.
	if ($password != $confirmPassword){
		//Error message to the user
		$errorMsg = "Password is mis match. Please go back and try again";
	}
	
	// Check for spam or automated attacks
	if(isset($_POST['g-recaptcha-response'])){
	  $captcha=$_POST['g-recaptcha-response'];
	}
	
	if(!$captcha){
	    $errorMsg = 'Please and check the the captcha form.';
	    //echo $errorMsg;
	    //exit();
	}else{
		//echo 'Good captcha :)';	
	}
	
	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfqWwgTAAAAAPccNYNMhrnCez8xQguBfeZKsYBi&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
	
	if($response.success == true){	
		//Connect to the server and add a new record
		// Require_once will compile codes and send compiled file where
		// include_one will insert codes in, include is suitable for footer, header, etc
		require_once('lib/conn_perfumeworld.php');

		//===========================================
		// Check whether customer exist or already registed
		//===========================================
		$selectQry = "SELECT email FROM customers WHERE email = '$email'";
		$result = mysqli_query($link, $selectQry);
		// Get record for customer
		$no_customer = mysqli_num_rows($result);
		
		if($no_customer == 1){
			$errorMsg = "This account already exist, please try gain.";
			//$errorMsg .= "<p><a href=register.php>Back to Registration Form</a></p>";
		}else{
			$authenticate = TRUE;
			// Encrypt the password using one way hash md5, good performance but not recommended for commercial apps
			// Suggested encrypt method is "SHA", which uses public/private keys pairs. It has advantage is good perfomance and very secure.
			$password = md5($password);

			//Define the insert query
			$query = "INSERT INTO customers VALUES('', '$first_name', '$last_name', '$phone' , '$password', '$email')";

			//Run the query
			mysqli_query($link, $query) or die( "Unable to insert the record");
			mysqli_close($link);

			// Save the values in session variables
			// Create 2 session variables
			$_SESSION["email"] = $email;
			$_SESSION["customerID"] = $customerID;
			$_SESSION["firstName"] = $first_name;
			$_SESSION["lastName"] = $last_name;
			$_SESSION["phone"] = $phone;
			
			
			// Redirect to member page
			header('Location:profile.php');
			//echo 'Redirect to profile page.';
			// Email to customer for order details
			//mail($email, "Website email", $message);
			exit();
		}

	}
	
?>
<!DOCTYPE html>
<html>
<head>
    <title>Process Register Form | PerfumeWorld.com.au</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <script src="js/local-storage.js" type="text/javascript"></script>
</head>
<body onload="getData()">
    <div id="page-wrapper">
    	<?php include_once 'html/header.php'; ?>
    	<div class="clear"></div>
        
        <div id="content-wrapper">
            <div id="contents">
            	<?php 
					//-----------------------------------------------
					// As error occurs, display form for re-enter
					if(!$authenticate){
						echo "<div class='error'>$errorMsg</div>";
						// Reset capcha value
						$captcha = "";
						include_once 'forms/register.html';
						// Reset errMessage value
						$errorMsg = "";
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