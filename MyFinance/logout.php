<?php 
	// starts the user session 
	session_start();
	// destroys the user session
	session_destroy();
	// redirects the user to the login page
	header ("Location: login.php");
?>