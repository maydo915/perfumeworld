/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var myInterval = setInterval(setData, 3000); //saves data locally every 3 seconds

// Set data -- login page
function setData(){
	var email = document.getElementById("email").value;	
        var firstName = document.getElementById("firstName").value;
        var lastName = document.getElementById("lastName").value;
        var phone = document.getElementById("phone").value;
	var address = document.getElementById("address").value;
        var suburb = document.getElementById("suburb").value;
	var postcode = document.getElementById("postcode").value;

	localStorage.setItem("email", email);
        localStorage.setItem("firstName", firstName);
        localStorage.setItem("lastName", lastName);
        localStorage.setItem("phone", phone);
	localStorage.setItem("address", address);
	localStorage.setItem("suburb", suburb);
        localStorage.setItem("postcode", postcode);	
}

// Get data -- login page
function getData(){
	var email = localStorage.getItem("email");
        var firstname = localStorage.getItem("firstName");
	var lastname = localStorage.getItem("lastName");
        var phone = localStorage.getItem("phone");
	var address = localStorage.getItem("address");
	var suburb = localStorage.getItem("suburb");
	var postcode = localStorage.getItem("postcode");
        
	document.getElementById("email").value = email;
        document.getElementById("firstName").value = firstname;
	document.getElementById("lastName").value = lastname;
	document.getElementById("phone").value = phone;
	document.getElementById("address").value = address;	
        document.getElementById("suburb").value = suburb;
	document.getElementById("postcode").value =  postcode;
}
