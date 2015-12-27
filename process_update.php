<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Update Customer Profile|Perfumeworld.com.au</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/ajax_search.js" type="text/javascript"></script>
</head>

<body>
	<div id="page-wrapper">
    	<?php include_once 'html/header.php'; ?>
    	<div class="clear"></div>
     
        <div id="content-wrapper">
           <div id="contents">
           		<?php
					// Initialise variables
					$errorMsg = "";
					$email = "";
					$firstName = "";
					$lastName = "";
					$phone = "";
					$valid = FALSE;
					
					// Assignment value entered from the form
					$firstName =  $_POST["firstName"];
					$lastName =  $_POST["lastName"];
					$phone =  $_POST["phone"];
					
					// Redirect to login page to ensure whether customer is authenticated
					if (!isset($_SESSION['email'])){
						header("Location: login.php");
						exit();
					}else{
						// Ensure all fields are not empty
						if (($firstName == "") or ($lastName == "") or ($phone == "") )
						{
							//Error message to the user
							$errorMsg = "Please fill all the fields in the form";
						}elseif((!is_int($phone)) && (strlen($phone)<8 || strlen($phone)>10)){
							$errorMsg = "Please re-enter your phone number, 8 to 10 digits only.";
						}else{    
							$valid = TRUE;
						}
					}

            
					// Process update profile of customer 
					// Check whether all data being valid
					echo '<div class="profile">';
					if($valid){
						// Confirm customer's details for changing					
						echo '<table>';
						echo "<h1>Confirm details</h1>";
						echo "<p>Please confirm the following details for updating.</p>";
						echo "<form method=POST action=confirm_update.php>";               
						echo "<tr><td>First name:</td><td>$firstName";
						echo "<input type='hidden' name='firstName' value='$firstName' /></td></tr>";          
						echo "<tr><td>Last name:</td><td>$lastName";
						echo "<input type='hidden' name='lastName' value='$lastName' /></td></tr>";
						echo "<tr><td>Phone:</td><td>$phone";
						echo "<input type='hidden' name='phone' value='$phone' /></td></tr>";
						echo "<tr><td><a href=profile.php>CANCELL</a></td>  ";
						echo "<td><input type='submit' value='CONFIRM UPDATE'</td></tr>";                       echo "</table>";
								 
					}else{                
						// Re-load the form for customer editing
						echo "<p>Please re-enter the following details</p>";
						echo "<form method='POST' action='process_update.php'>";
						echo "<table>";                
						echo "<tr><td><label for='firstName'>First name: </label></td>"
						. "<td><input type='text' name='firstName' id='firstName' value='$firstName' required='required' placeholder='First name' /></td></tr>";
						echo "<tr><td><label for='lastName'>Last name: </label></td>"
						. "<td><input type='text' name='lastName' id='lastName' value='$lastName' required='required' placeholder='Last name' /></td></tr>";
						echo "<tr><td><label for='phone'>Telephone:</label>(8-10 digits only)</td>"
						. "<td><input type='text' name='phone' id='phone' value='$phone' required='required' placeholder='Phone number' /></td></tr>";
						echo "<tr><td></td><td><input type='submit' name='Submit' id='submit' value='UPDATE'></td></tr>";
						echo "</table>";
						echo "</form>";
						//echo '</table>';
						
					}
					
					echo '</div>';
				?>
           </div><!-- /end contents -->
           <?php  include_once 'html/sidebar.php'; ?> 
          
        </div><!-- end content wrapper -->
        <div class="clear"></div>
        <?php include_once 'html/footer.html'; ?>
    </div>
    
</body>
</html>