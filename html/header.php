<?php 
	// This included file should NOT be put here 
	include ("lib/breadcrumb.php");
?>
<div id="header-wrapper">    	
    <div id="top-bar">
        <div class="topbar-txt">
           <?php 
				//Start the session
				$name = "";
				if(isset($_SESSION['email'])){
					$firstName = $_SESSION["firstName"];
					echo "<a href='profile.php'>$firstName</a> | <a href=logout.php>Log-out</a>"; 
				}else{
					
					echo'<a href="login.php" title="Customer Login">Login</a> | 
           	<a href="register.php" title="Customer Registration Form">Register</a>';
				
				}
			
			?>
       </div>
       <div id="cart"><a href="view_cart.php" title="View Cart"><img alt="Shopping Cart" src="img/cart.png" /></a></div>
       <div class="clear"></div>
    </div>
    
    <div id="logo-wrapper">
       <div class="sitetitle-wrapper">
           <div id="logo"><a href="index.php" title="Perfume World"><img src="img/logo.png" width="233" height="216" alt="Perfume World Logo"/></a></div>
           <div id="site-title"><a href="index.php" title="Perfume World"><img src="img/site-title.png"  alt="Perfume World"/></a></div>
       </div>
       <div id="search" class="search">
                <form action="process_search.php" method="post">
                	<input type="text" name="product_search" id="product_search" autocomplete="off" onkeyup="showHint(this.value)" placeholder="search brands or products"  />
                   <input type="submit" name="submit" value="SEARCH" />
                   <div id="txtHint"></div>
               </form>     
       </div>
  </div><!-- /end logo wrapper --->
    
    <?php
		$path = $_SERVER["PHP_SELF"];
		$file = basename($path, ".php"); 
	?>
          
    <div id="nav">
        <ul>
           <li><a href="index.php">Home</a></li>
           <li><a href="products.php">Products</a></li>
           <li><a href="brands.php">Brands</a></li>
           <li><a class="active" href="about_us.php">About Us</a></li>
           <li><a href="contact.php">Contact</a></li>
       </ul>
  </div>  
  <div id="crumb-wrapper">
  		<div class="pagetitle"><h2><?php echo $page_title; ?></h2></div>
       <div class="breadcrumb"><p>
	   		<?php 
				// Get current path of file
				//$path = $_SERVER["PHP_SELF"];
				//$file = basename($path, ".php"); 
				//echo breadcrumb($path); 
				//echo $file;
			?></p></div>
  </div>
</div><!-- end header wrapper -->
        