<?php 
if (isset($_SESSION['loggedUser']) && $_SESSION['loggedUser']->getROLE_ADMIN () == "0") {
	header ("location:login.php");
}
?>