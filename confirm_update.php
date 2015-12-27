<?php
    //Start the session
    session_start();
    $errorMsg = "";
    // Redirect to login page to ensure whether customer is authenticated
    if (!isset($_SESSION['email'])){
        header("Location: login.php");
        exit();
    }else{
        $email = $_SESSION['email'];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $phone = $_POST["phone"];
        
        // Update customer's details
        //Connect to the database
	require_once('lib/conn_perfumeworld.php');
        
        // Define an update query
        $updateQry = "UPDATE customers "
                . "SET firstName = '$firstName', lastName = '$lastName', phone = '$phone' "
                . "WHERE email = '$email'";
        //echo $updateQry;
        // Execute the update query
        $result = mysqli_query($link, $updateQry) or die("Unable to update the user's details."); 

        // Close database connection
        mysqli_close($link);
        // Re-direct to profile page
        header("Location: profile.php");
    }
?>

