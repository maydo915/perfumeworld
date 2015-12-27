<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Customer Profile|PerfumeWorld.com.au</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
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
					$first_name = "";                
					$last_name = "";
					$phone =  "";
					$email = "";
					$name = "";
					$logout =  "";

					// Check whether user is authenticated
					if (isset($_SESSION['email']))
					{
						$email = $_SESSION["email"];
						
						// Connect to database to retrieve customer's details
						require_once 'lib/conn_perfumeworld.php';
						// Set query for records of customer
						$query = "SELECT * FROM customers WHERE email = '$email' ";
						$result = mysqli_query($link, $query);
						$no_customer = mysqli_num_rows($result);
						// Suceffully executing the query
						if($result != null){
							if($no_customer == 1){
								$customer = $result->fetch_array();
								$first_name = $customer['firstName'];
								$last_name = $customer['lastName'];
								$phone = $customer['phone'];
							}
						}
						$name = "$first_name $last_name";
						$logout = "<a href='logout.php'>Log-out</a>";
		
					}else{
						// Redirect to login page
						//header("Location: login.php");
						exit();
					}
					
					echo '<div class="profile">';
					// Display customer details
					echo "<table>";
					echo "<h2>Customer Profile</h2>";
					echo "<tr><td>Email: </td><td>$email</td><td></td></tr>";
					echo "<tr><td>First name: </td><td>$first_name</td></tr>";
					echo "<tr><td>Last name: </td><td>$last_name</td></tr>";
					echo "<tr><td>Telephone: </td><td>$phone</td><td></td></tr>";
					echo "</table>";    
					echo "<p><a href=update_profile.php>Edit</a> | <a href=logout.php>logout.php</a>";
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