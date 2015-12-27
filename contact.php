<?php
    session_start();
    $page_title = 'Contact Us';
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Perfume Store|Contact Us</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<script src="js/ajax_search.js" type="text/javascript"></script>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
</head>

<body>
	<div id="page-wrapper">
    	<?php include_once 'html/header.php'; ?>
    	<div class="clear"></div>
        <div id="content-wrapper">
        	 
            <div class="contact">
                <div class="icon"><span><i class="fa fa-user"></i></span>Customer Services: 9am-4pm Eastern time</div>
                <div class="icon"><span><i class="fa fa-phone"></i></span>Toll free: 1300 999 888</div>
                <div class="icon"><span><i class="fa fa-envelope"></i></span>admin@perfumesworld.com.au</div>
                <div class="icon"><span><i class="fa  fa-map-marker"></i></span>120 Currie Street, Adelaide, 5000, SA, Australia</div>

                <p>In order to provide our customers with excellent service, we process orders using an automated system, therefore orders cannot be canceled or modified after they are placed.</p>
                 
                <div id="map" style="width: 600px; height: 400px"></div> 

           </div><!-- /end contents -->
           
          <div class="contact-sidebar">
               <h3>Get in touch</h3>
               <p>All fields are required.</p>
               <div class="contact-form">
               	<form action="process_contact.php" method="post">
                    <label for="name">Name</label><input type="text" name="name" /><br />
                    <label for="email">Email</label><input type="text" name="email" /><br />
                    <label for="subject">Subject</label><input type="text" name="subject" /><br />
                    <label for="message">Message</label><textarea rows="4" cols="50" name="message"/></textarea><br />
                    <input type="submit" name="submit" value="SUBMIT" />
                    </form>
               </div>
          </div>
        </div><!-- end content wrapper -->
        <div class="clear"></div>
        <?php include_once 'html/footer.html'; ?>
    </div>


	<script type="text/javascript"> 
	  var myLatlng = new google.maps.LatLng(-34.924535,138.595511);
      var myOptions = {
         zoom: 16,
         center: myLatlng,
         mapTypeId: google.maps.MapTypeId.ROADMAP
      };

      var map = new google.maps.Map(document.getElementById("map"), myOptions);
	  
	  var marker = new google.maps.Marker({
		  position: myLatlng,
		  map: map,
		  title: 'Perfume World!'
	  });
   </script>
</body>
</html>