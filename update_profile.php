<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Perfume Store|Contact Us</title>
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
					// Check whether customer already register. 
					if (!isset($_SESSION['email'])){
						header("Location: login.php");
						exit();
					}else{
						$email = $_SESSION["email"];
					}       
					
					// Connection to database
					require_once 'lib/conn_perfumeworld.php';
					// Define a query for retrieving customers
					$query = "SELECT * FROM customers WHERE email = '$email'";
					$result = mysqli_query($link, $query); 
					// Ensure only one customer match for editing
					$no_customer = mysqli_num_rows($result);
					// Get details as executing sucessfully
					$fileName = '';
					$lastName = '';
					$phone = '';
					if($result != null){
						if($no_customer == 1){
							$customer = $result->fetch_array();
							$firstName = $customer['firstName'];
							$lastName = $customer['lastName'];
							$phone = $customer['phone'];
						}
					}else{
						echo "Error in database.";
					}
            
            
					// Load customer'd details into the form for edit
					echo '<div class="updateprofile">';
					echo "<h1>Profile</h1>";
					echo "<form method='POST' action='process_update.php'>";
						echo "<table>";                
						echo "<tr><td><label for='firstName'>First name: </label></td>"
						. "<td><input type='text' name='firstName' id='firstName' value='$firstName' required='required' placeholder='First name' /></td></tr>";
						echo "<tr><td><label for='lastName'>Last name: </label></td>"
						. "<td><input type='text' name='lastName' id='lastName' value='$lastName' required='required' placeholder='Last name' /></td></tr>";
						echo "<tr><td><label for='phone'>Telephone:</label></td>"
						. "<td><input type='text' name='phone' id='phone' value='$phone' required='required' placeholder='Phone number' /></td></tr>";
						echo "<tr><td></td><td><input type='submit' name='Submit' id='submit' value='EDIT'></td></tr>";
					echo "</table>";
					echo "</form>";
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