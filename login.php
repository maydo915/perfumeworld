<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Perfume Store|Customer Login</title>
<link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body>
	<div id="page-wrapper">
    	<?php 
			$page_title = 'Log In';
			include_once 'html/header.php'; 
		?>
    	<div class="clear"></div>
        
        <div id="content-wrapper">
            <div id="contents">
            	<?php 
					// Check whether user is authenticated
					if (isset($_SESSION['email'])){
						echo '<p>You have already logged in. <a href=profile.php>Click here to view your profile</a></p>';
					}else{
						include_once 'forms/login.html'; 
					}
				?>
            </div><!-- /end contents -->
           
            <div></div>
        </div><!-- end content wrapper -->
        <div class="clear"></div>
        <?php include_once 'html/footer.html'; ?>
    </div>
    
</body>
</html>