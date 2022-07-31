<?php
	//database connection
	error_reporting(E_ERROR | E_PARSE);
	$db = new mysqli("localhost","root","","stock");
	if ($db->connect_errno) {
		die("Sorry we have temporally problem with database! Refresh or call administrator if it continue like this");
	}
	
?>
