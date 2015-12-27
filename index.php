<?php
	session_start();
	$page_title = 'Home';
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
        <?php include_once 'html/slider.html'; ?>
        
        <div id="content-wrapper">
            <div id="contents">
                <div class="img-wrapper">
                    <?php
                   	// Connect to database
                        require_once 'lib/conn_perfumeworld.php';
                        // Define a query for retrieving products on specials
                        $query = "SELECT * FROM products WHERE special_tag IS NOT NULL";
                        //  Execute the query
                        $results = mysqli_query($link, $query);
                        // Get details of each specials
                        if($results != null){
                            while($product = mysqli_fetch_array($results, MYSQLI_ASSOC)){
                                $item_id = $product['item_id'];
                                // Path of product image
                                $image_thumb = "image-thumb/" .$product['imagethumb'];
                                //echo $item['item_name'];
                                $special_price = $product['special_tag'] * 100; 
                                //echo $product['special_tag'];
                                echo "<div class=specials><h3>".$special_price."%</h3><br /><img src=".$image_thumb."><br />";
                                echo "<form action='add_to_cart.php' method='POST'>";
                                echo $product['item_name']. "<br />";
                                echo "<input name=item_id type=hidden id=$item_id value=$item_id>";
                                echo "<input name=qty type=hidden id=qty value=1>";
                                echo '$' .$product['price'] . "<input type=submit name=add id=add value='Add to Cart' /></form>";
                                echo "</div>";
                            }
                        }							   
                   ?>
               </div> 
           </div><!-- /end contents -->
           <?php  include_once 'html/sidebar.php'; ?>
        </div><!-- end content wrapper -->
        <div class="clear"></div>
        <?php include_once 'html/footer.html'; ?>
    </div>
    
</body>
</html>