<?php
	session_start();
    require_once 'lib/conn_perfumeworld.php';
	$page_title = 'Products';
    $query = "SELECT item_id, item_name, price, imagethumb FROM products";
    $result = mysqli_query($link, $query); 
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Perfume Store|Our Products</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/ajax_search.js" type="text/javascript"></script>

</head>

<body>
	<div id="page-wrapper">
    	<?php include_once 'html/header.php'; ?>
    	<div class="clear"></div>

        <div id="content-wrapper">
            <div id="contents">
                <div class="img-wrapper">
                  	<?php
                   	if($result != null){
                            // Display the products
                            echo "<table>"; 
                            echo"<tr><th>Image</th><th>Item name</th><th>Price</th>
                                    <th>Quatity</th><th></th></tr>";
                            while($record = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                // Get all product records: item_id, item_name, price
                                $item_id = $record['item_id'];
                                $item_name = $record['item_name'];
                                $price = $record['price'];
                                // Path of product image
                                $image_thumb = "image-thumb/" .$record['imagethumb'];
                                echo "<tr><form action='add_to_cart.php' method='POST'>";
                                echo "<input name=item_id type=hidden id=$item_id value=$item_id>";
                                echo "<td><img src='$image_thumb' alt=''></td>";
                                echo "<td>$item_name</td>";
                                echo "<td class='spaces'>$price</td>";
                                echo "<td><input type=text name=qty id=qty value=1 maxlength=2 /></td>";
                                echo "<td><input type=submit name=add id=add value='Add to Cart' /></td>";
                                echo "</form></tr>";
                            }
                            echo "</table>";
			}						   
                   ?>
               </div> 
           </div><!-- /end contents -->
           
        <div id="sidebar">
        <?php 
            include_once('new_arrivals.php'); 
            include_once('perfume_brands.php'); 
        ?>
        </div>

        <?php 
            // Close the database connection
            mysqli_close($link); 
        ?>
        </div><!-- end content wrapper -->

        <div class="clear"></div>
        <?php include_once 'html/footer.html'; ?>
    </div>
    
</body>
</html>