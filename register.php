<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Perfume Store|Customer Registration Form</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
	<div id="page-wrapper">
    	<?php 
			$page_title = 'Customer Registration Form'; 
			include_once 'html/header.php';
		?>
    	<div class="clear"></div>
        
        <div id="content-wrapper">
            <div id="contents">
            	<?php include_once 'forms/register.html'; ?>
            </div><!-- /end contents -->
           
            <div id="sidebar">         
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