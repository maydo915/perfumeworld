<?php
	session_start();
	$page_title = 'Brands';
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Perfume Store</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/ajax_search.js" type="text/javascript"></script>
<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="js/jssor.js" type="text/javascript"></script>
<script src="js/jssor.slider.js" type="text/javascript"></script>
<script src="js/myslides.js" type="text/javascript"></script>

</head>

<body>
	<div id="page-wrapper">
    	<?php include_once 'html/header.php'; ?>
    	<div class="clear"></div>
        
        <div id="content-wrapper">
              <div id="contents">
				<?php
					// Connect to database and get products by brands
					require_once 'lib/conn_perfumeworld.php';
		   
					$selectQry = "SELECT * FROM brands WHERE brand_img IS NOT NULL";
					$img_path = 'brand_logo/';
					// Execute the query
					$brandList = mysqli_query($link, $selectQry);
					if($brandList != null){					
						while ($brand = mysqli_fetch_array($brandList, MYSQLI_ASSOC)){
							$brand_id = $brand['brand_id'];
							$brand_name = $brand['name'];
							$brand_img = $img_path .$brand['brand_img'];
							echo '<div class="brands">';
							echo "<a href=brand_products.php?brand_id=$brand_id><img src=$brand_img alt='Brand Logo'/></a>";
							echo '</div>';                        
						}    
					}
				?>
           </div><!-- /end contents -->
           
          <div id="sidebar">
               <?php include_once('new_arrivals.php'); ?>
          </div>
        </div><!-- end content wrapper -->
        <div class="clear"></div>
        <?php include_once 'html/footer.html'; ?>
    </div>
    
</body>
</html>