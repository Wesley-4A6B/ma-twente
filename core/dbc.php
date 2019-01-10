<?php
	$host = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ma-twente";
	$dbc = mysqli_connect($host, $username, $password, $dbname);

	if(mysqli_connect_errno()) {
	  echo("Failed to connect to the database: " . mysqli_connect_error());
	}
?>