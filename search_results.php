<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Search Results |Perfumeworld.com.au</title>
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
					$item_id = $_GET['item_id'];
                
					if(isset($_GET['item_id'])){
						//echo "item not null";
						// Connect to dabase
						require_once 'lib/conn_perfumeworld.php';
						// Define a query for retrieving product details
						$selectQry = "SELECT * FROM products WHERE item_id = '$item_id'";
						//echo $selectQry;
						// Executing the query
						$result = mysqli_query($link, $selectQry);
						if($result != null){
							//echo "query is executed";
							// Loop to get product details
							//echo "<div class='products'>";
							echo "<table>"; 
							echo"<tr><th>Image</th><th>Item name</th><th>Price</th>
								<th>Quatity</th><th></th></tr>";
							while($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
								$item_id = $item['item_id'];
								$item_name = $item['item_name'];
								$price = $item['price'];
								// Path of product image
								$image_thumb = "image-thumb/" .$item['imagethumb'];
								
								echo "<tr><form action='add_to_cart.php' method='POST'>";
								echo "<input name=item_id type=hidden id=$item_id value=$item_id>";
								echo "<td class='spaces'><img src='$image_thumb' alt=''></td>";
								echo "<td class='spaces'>$item_name</td>";
								echo "<td class='spaces'>$price</td>";
								echo "<td class='spaces'><input type=text name=qty id=qty value=1 maxlength=2 /></td>";
								echo "<td><input type=submit name=add id=add value='Add to Cart' /></td>";
								echo "</form></tr>";
							}
							
							echo "</table>";
							//echo "</div>";
							
						}else{
							echo "Database errors.";
						}
					}else{
						//echo "item IS null";
					}
				 ?>
           </div><!-- /end contents -->
           
          <div id="sidebar">
				<?php
                   include_once('new_arrivals.php');
					// Close the database connection
					mysqli_close($link); 
               ?>
          </div>
        </div><!-- end content wrapper -->
        <div class="clear"></div>
        <?php include_once 'html/footer.html'; ?>
    </div>
    
</body>
</html>