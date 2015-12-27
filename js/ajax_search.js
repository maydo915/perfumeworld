/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*  ==============================================   
 *  getHTTPObject(str) 
 *  ============================================== */  
function getHTTPObject() 
{ 
    var xmlhttp; 
    if(window.XMLHttpRequest)
    { 
        // Chrome, Firefox, Safari
        xmlhttp = new XMLHttpRequest(); 
    } 
    else
    { 
        //Internet Explorer
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
        if (!xmlhttp)
        { 
            xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
        } 
    } 
    return xmlhttp; 
}

/*  ==============================================   
 *  showHint(str) 
 *  ============================================== */   
// The server-side script URL
var url = "livesearch.php?itemname="; 

function showHint(str){                

    if(str.len === 0){
        document.getElementById("txtHint").innerHTML = "";
        return; 
    }
    // Create XMLHttp object                
    var xmlhttp = getHTTPObject();
    // Create the function to be executed when the response server ready              
    //xmlhttp.onreadystatechange = handleHttpResponse; //not working                
    xmlhttp.onreadystatechange =  function(){
        if(xmlhttp.readyState === 4 && xmlhttp.status === 200){
           //document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
			var ajaxDisplay = document.getElementById('txtHint');
         	ajaxDisplay.innerHTML = xmlhttp.responseText;
        }                  
    }

    // Send the request off to the file on the server
    xmlhttp.open("GET", url+str, true);
    xmlhttp.send();
} //end showHint

            