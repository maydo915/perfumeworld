// JavaScript Document

//Execute the codes when DOM ready
$(function(){
	var about_us = 'about_us.php';
	var contact = 'contact.php';
	
	$("#nav a").each(function(){   
	   if ($(this).attr("href") == 'about_us.php'){
		   //$(this).parent().addClass("active");
		   //alert("found about us");
	   }else if ($(this).attr("href") == 'contact.php'){
			//alert("found contact");
	   }
	   
    });
	
});