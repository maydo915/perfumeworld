<?php
	session_start();
	$page_title = 'Log Out';
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Customer Logout | Perfumeworld.com.au</title>
<link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body>
	<div id="page-wrapper">
    	<?php include_once 'html/header.php'; ?>
    	<div class="clear"></div>
        
        <div id="content-wrapper">
            <div id="contents">
            	<?php 
					// Check whether user is authenticated
					if(isset($_SESSION["email"])){
						session_destroy();
						echo "<p>You successfully logged out.</p>";
						echo "<p><a href='login.php'>Click here to log-in again</a></p>";
					}else{ // Refer to login page if accidenttally accessed
						header("Location:login.php");
						exit();
					}
				?>
            </div><!-- /end contents -->
            <?php  include_once 'html/sidebar.php'; ?>
        </div><!-- end content wrapper -->
        <div class="clear"></div>
        <?php include_once 'html/footer.html'; ?>
    </div>
    
</body>
</html>