<?php
/* 
 * Connection to "perfumeworld" database and should be put in seperate php file
 */

/*
$server = "localhost";
$user = "root";
$conn_password = "";
$database = "perfumeworld";
*/

/*
$server = "localhost";
$user = "yumbanhc_pwuser";
$conn_password = "nuochoa_715";
$database = "yumbanhc_perfumeworld";
*/

$server = "localhost";
$user = "maytdo_may";
$conn_password = "abc1234";
$database = "maytdo_perfumeworld";

// Connect to the server
//mysqli is the new object oriented connection method
$link = mysqli_connect($server, $user, $conn_password, $database)
        or die("Error " .  mysqli_error($link));
?>
