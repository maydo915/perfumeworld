<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Perfume Store| Customer Login</title>
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
					$product = "";

					// Proccess to access product details from database
					if(isset($_POST['product_search'])){
						$product = $_POST['product_search'];
			
						// Connect to the database
						require_once 'lib/conn_perfumeworld.php';
						// Set a query to get product details
						$querySelect = "SELECT * FROM products WHERE (item_name LIKE '%$product%') OR (description LIKE '%$product%')";
						// Execute the query
						$result = mysqli_query($link, $querySelect);
			
						$no_records = mysqli_num_rows($result);                
			
						if($no_records <= 0){
							echo "Sorry, no products found. Please try again.";
						}  else {                                    
							//Display products
							echo "<div class='products'>";
							echo "<table>";
							echo"<tr><th>Image</th><th>Item Name</th>
								<th>Price</th><th>Quantity</th><th></th></tr>";
							// Loop all records
							while($product_list = mysqli_fetch_array($result, MYSQLI_ASSOC)){
								$item_id = $product_list['item_id'];                    
								$item_name = $product_list['item_name'];
								$category= $product_list['category'];
								$price = $product_list['price'];
								$image_thumb = "image-thumb/" .$product_list['imagethumb'];
								echo "<tr><form action='add_to_cart.php' method='POST'>";
								echo "<input name=item_id type=hidden id=$item_id value=$item_id>";
								echo "<td><img src='$image_thumb'></td>";
								echo "<td>$item_name</td>";
								echo "<td>$price</td>";
								echo "<td><input type=text name=qty id=qty value=1 size=4 maxlength=2 /></td>";
								echo "<td><input type=submit name=add id=add value='Add to Cart' /></td>";
								echo "</form></tr>";
							}
							echo "</table>";                
							echo "</div>"; //end div products
						}
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
        <div class="clear"></div>
        <?php include_once 'html/footer.html'; ?>
    </div>
    
</body>
</html>